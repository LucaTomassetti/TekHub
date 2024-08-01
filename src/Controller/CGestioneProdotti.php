<?php

use Doctrine\DBAL\Types\DateTimeTzImmutableType;

class CGestioneProdotti{
    public static function listaProdotti(){
        
        $view = new VGestioneProdotti();
        if (!isset($_GET['page'])) {
            // Redirect to the same URL with ?page=1
            $url = $_SERVER['REQUEST_URI'];
            $url = rtrim('?', $url);
            $url .= '?page=1';
            header("Location: $url");
        }
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if (CUtente::isLogged()) {
            if($_SESSION['utente'] instanceof EVenditore){
                $array_prodotti = FPersistentManager::getInstance()->getAllProducts($_SESSION['utente'], $page);
                $view->listaProdotti($array_prodotti);
            }else {
                header('Location: /TekHub/utente/home');
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function addProduct(){
        
        $view = new VGestioneProdotti();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if($_SESSION['utente'] instanceof EVenditore){
                $array_categorie = FPersistentManager::getInstance()->getAllCategories();
                $view->addProductForm($array_categorie);
            }else{
                header('Location: /TekHub/utente/login');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            foreach ($postData as $key => $value) {
                $array_data[$key] = $value;
            }
            $allowed_types = array('image/jpeg', 'image/png');

            if(isset($_FILES['images'])){
                // Controllo se le immagini inserite eccedono una dimensione di 1MB
                foreach($_FILES['images']['size'] as $key => $value) {
                    if($_FILES['images']['size'][$key] > 1000000){
                        $view->errorImageUpload();
                        exit;
                    }
                }
                // Controllo il tipo di file caricati
                foreach($_FILES['images']['type'] as $key => $value) {
                    if(!(in_array($_FILES['images']['type'][$key], $allowed_types))){
                        $view->errorImageUpload();
                        exit;
                    }
                }

                // Inserisci il prodotto una volta
                if($array_data['productType'] == 'nuovo'){
                    $prod = new ENuovo(null, $array_data['nome'], $array_data['descrizione'], $array_data['marca'],$array_data['modello'],$array_data['colore'],$array_data['prezzo-nuovo'], $array_data['quantita_disp']);
                    FPersistentManager::getInstance()->insertProdottoNuovo($prod);
                } else {
                    $prod = new EUsato(null, $array_data['nome'], $array_data['descrizione'], $array_data['marca'],$array_data['modello'],$array_data['colore'],$array_data['prezzo-asta']);
                    $asta = new EAsta(new DateTimeImmutable($array_data['data-inizio-asta']), new DateTimeImmutable($array_data['data-fine-asta']));
                    $prod->setAsta($asta);
                    FPersistentManager::getInstance()->insertProdottoUsato($prod);
                }
                
                // Trova il prodotto appena inserito
                $found_prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $prod->getIdProdotto());
                
                // Inserisci ogni immagine e collegala al prodotto
                foreach($_FILES['images']['tmp_name'] as $key => $value) {
                    $fileName = $_FILES['images']['name'][$key];
                    $fileSize = $_FILES['images']['size'][$key];
                    $fileType = $_FILES['images']['type'][$key];
                    $content = file_get_contents($_FILES['images']['tmp_name'][$key]);
                    $base64content = base64_encode($content);
                    $image = new EImmagine($fileName, $fileSize, $fileType, $base64content);
                        
                    FPersistentManager::getInstance()->insertImmagine($image);
                    
                    // Trova l'immagine appena inserita
                    $found_image = FPersistentManager::getInstance()->find(EImmagine::class, $image->getIdImage());
                    
                    // Collega l'immagine al prodotto
                    FPersistentManager::getInstance()->updateImageProdotto($found_prodotto, $found_image);   
                }
            }
            $found_categoria = FPersistentManager::getInstance()->find(ECategoria::class, $array_data['categoria']);
            $found_venditore = FPersistentManager::getInstance()->find(EVenditore::class, $_SESSION['utente']->getIdVenditore());

            FPersistentManager::getInstance()->updateVendCatProdotto($found_prodotto, $found_venditore, $found_categoria);
            if($array_data['productType'] == 'usato'){
                FPersistentManager::getInstance()->updateVendAsta($found_prodotto, $found_venditore);
            }
            $_SESSION['product_added'] = true;
            header('Location: /TekHub/gestioneProdotti/listaProdotti');
        }
    }
    public static function modificaProdotto($productId){
        
        $view = new VGestioneProdotti();
        $prodotto_da_modificare = FPersistentManager::getInstance()->find(EProdotto::class, $productId);
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if($_SESSION['utente'] instanceof EVenditore){
                $tmp_immagini = FPersistentManager::getInstance()->getAllImages($prodotto_da_modificare);
                foreach($tmp_immagini as $immagine){
                    $array_immagini[] = $immagine;
                }
                $view->modifyProductForm($prodotto_da_modificare, $array_immagini);
            }else{
                header('Location: /TekHub/utente/login');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            foreach ($postData as $key => $value) {
                $array_data[$key] = $value;
            }
            $allowed_types = array('image/jpeg', 'image/png');

            FPersistentManager::getInstance()->updateProdotto($prodotto_da_modificare, $array_data);

            if(isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'][0])){
                //Elimino tutte le immagini nel database relative al prodotto
                FPersistentManager::getInstance()->deleteAllImages($productId);
                // Controllo se le immagini inserite eccedono una dimensione di 1MB
                foreach($_FILES['images']['size'] as $key => $value) {
                    if($_FILES['images']['size'][$key] > 1000000){
                        $view->errorImageUpload();
                        exit;
                    }
                }
                // Controllo il tipo di file caricati
                foreach($_FILES['images']['type'] as $key => $value) {
                    if(!(in_array($_FILES['images']['type'][$key], $allowed_types))){
                        $view->errorImageUpload();
                        exit;
                    }
                }

                // Trova il prodotto appena inserito
                $found_prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $productId);
                
                // Inserisci ogni immagine e collegala al prodotto
                foreach($_FILES['images']['tmp_name'] as $key => $value) {
                    $fileName = $_FILES['images']['name'][$key];
                    $fileSize = $_FILES['images']['size'][$key];
                    $fileType = $_FILES['images']['type'][$key];
                    $content = file_get_contents($_FILES['images']['tmp_name'][$key]);
                    $base64content = base64_encode($content);
                    $image = new EImmagine($fileName, $fileSize, $fileType, $base64content);
                        
                    FPersistentManager::getInstance()->insertImmagine($image);
                    
                    // Trova l'immagine appena inserita
                    $found_image = FPersistentManager::getInstance()->find(EImmagine::class, $image->getIdImage());
                    
                    // Collega l'immagine al prodotto
                    FPersistentManager::getInstance()->updateImageProdotto($found_prodotto, $found_image);   
                }
            }

            $_SESSION['product_modified'] = true;
            header('Location: /TekHub/gestioneProdotti/listaProdotti');
        }
    }
    public static function eliminaProdotto($productId){
        
        //Elimino prima tutte le immagini legate all'id del prodotto
        //per non avere problemi con le chiavi esterne
        FPersistentManager::getInstance()->deleteAllImages($productId);
        FPersistentManager::getInstance()->deleteProdotto($productId);
        $_SESSION['product_deleted'] = true;
        header('Location: /TekHub/gestioneProdotti/listaProdotti');
    }
    
}
?>
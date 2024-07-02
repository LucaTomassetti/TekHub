<?php
class CGestioneProdotti{
    public static function listaProdotti(){
        session_start();
        $view = new VGestioneProdotti();
        if (CUtente::isLogged()) {
            if($_SESSION['utente'] instanceof EVenditore){
                $array_prodotti_nuovi = FPersistentManager::getInstance()->getAllNewProducts($_SESSION['utente']);
                $array_prodotti_usati = FPersistentManager::getInstance()->getAllUsedProducts($_SESSION['utente']);
                $array_prodotti = array_merge($array_prodotti_nuovi, $array_prodotti_usati);
                unset($array_prodotti_nuovi);
                unset($array_prodotti_usati);

                for($i = 0; $i < sizeof($array_prodotti); $i++){
                    $prod_item = FPersistentManager::getInstance()->find(EProdotto::class,$array_prodotti[$i]['id_prodotto']);
                    $array_immagini = FPersistentManager::getInstance()->getAllImages($prod_item);
                    foreach($array_immagini as $immagine){
                        //Poiché $array_immagini[0]['imageData'] contiene l'id della Risorsa, uso
                        //la funzione stream_get_contents($array_immagini[0]['imageData']) per 
                        //riottenere la stringa base64 memorizzata nel database per poi
                        //assegnarla di nuovo all'array 
                        $immagine['imageData'] = stream_get_contents($immagine['imageData']);
                        $array_prodotti[$i]['images'] = $immagine;
                    }
                } 
                $view->listaProdotti($array_prodotti);
            }else {
                header('Location: /TekHub/utente/home');
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function addProduct(){
        session_start();
        $view = new VGestioneProdotti();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if($_SESSION['utente'] instanceof EVenditore){
                $view->addProductForm();
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
                    $prod = new ENuovo(null, $array_data['nome'], $array_data['descrizione'], $array_data['pricefornew'], $array_data['quantita_disp']);
                    FPersistentManager::getInstance()->insertProdottoNuovo($prod);
                } else {
                    $prod = new EUsato(null, $array_data['nome'], $array_data['descrizione'], $array_data['prezzo-asta']);
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
            $_SESSION['product_added'] = true;
            header('Location: /TekHub/gestioneProdotti/listaProdotti');
        }
    }
}
?>
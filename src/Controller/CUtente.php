<?php

use Doctrine\Common\Collections\ArrayCollection;

class CUtente {
    public static function home(){
        $view_home = new VUtente();
        session_start();
        /* Per la gestione del carrello
        $array_prodotti = array('prodotto_1'=> new EProdotto('prova','prova',0,0),
                                'prodotto_2'=> new EProdotto('prova','prova',0,0));
         $_SESSION['cart'] = $array_prodotti;
        */
        if (static::isLogged()) {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view_home->loginSuccessAcquirente();
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view_home->loginSuccessVenditore();
            }
        } else {
            $view_home->logout();
        }
    }
    public static function login(){
        $view = new VUtente();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if (static::isLogged()) {
                header('Location: /TekHub/utente/home');
            } else {
                $view->showLoginForm();
            }
        }elseif ($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $_POST['email-log'];
            $password = $_POST['password-log'];
            $utente = FPersistentManager::getInstance()->findUtente($email);
            if($utente == null){
                $view->loginError();
            } else if (password_verify($password, $utente[0]->getPassword())) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['utente'] = $utente[0];

                    if (isset($_COOKIE['auth'])) {
                        header('Location: /TekHub/utente/home');
                    } else {
                        setcookie('auth', base64_encode($utente[0]->getEmail()), time() + (86400 * 30), "/"); // 30 giorni
                        header('Location: /TekHub/utente/home');
                    }
                }
                header('Location: /TekHub/utente/home');
            } else {
                $view->loginError();
            }
        }
        
    }
    public static function isLogged()
    {
        $identificato = false;
        // Controlla se il cookie di sessione esiste
        if (isset($_COOKIE['PHPSESSID'])) {
            // Avvia la sessione se non è già avviata
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Controlla se l'utente è loggato basandosi su una variabile di sessione specifica
            if (isset($_SESSION['utente'])) {
                $identificato = true;
            }
        }
        return $identificato;
    }
    
    public static function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /TekHub/utente/home');

    }
    public static function signUp(){
        $view_register = new VUtente();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $view_register->signUp();
        }elseif ($_SERVER['REQUEST_METHOD']=="POST"){
            $postData = $_POST;
            foreach ($postData as $key => $value) {
                $array_data[$key] = $value;
            }
            /**
             * Creo un oggetto temporaneo necessario per controllare successivamente nell'altra tabella se esiste già l'email
             * assegnando al campo email la stessa email dell'oggetto $new_utente
             */
            if($array_data['userType'] == 'venditore'){
                $new_utente  = new EVenditore($array_data['nome'],$array_data['cognome'],$array_data['partita_iva'],$array_data['società'],$array_data['email'],password_hash($array_data['password'], PASSWORD_DEFAULT),$array_data['username'], $array_data['cellulare']);
                $temp = new EAcquirente(null,null,null,null,$new_utente->getEmail(),null);
            }else{
                $new_utente = new EAcquirente($array_data['nome'],$array_data['cognome'],$array_data['username'],password_hash($array_data['password'], PASSWORD_DEFAULT), $array_data['email'],$array_data['cellulare']);
                $temp = new EVenditore(null,null,null,null,$new_utente->getEmail(),null,null,null);
            }
            /**
             * Assegno a $same_class_new_utente il risultato della query findUtente($new_utente) 
             * Se $same_class_new_utente = null significa che l'email non è stata usata da nessuno nella tabella della sua classe
             */ 
            $same_class_new_utente = FPersistentManager::getInstance()->findUtente($new_utente);
             /**
             * Assegno a $check_email il risultato della query findUtente($temp) 
             * Se $check_email = null significa che l'email non è stata usata da nessuno nella tabella dell'altra classe
             */ 
            $check_email = FPersistentManager::getInstance()->findUtente($temp);
            /* Controllo se l'email esiste già */
            if($check_email != null || ($check_email == null && $same_class_new_utente != null)){
                // se esiste ricarico la form per la registrazione
                $view_register->signUpError();
            }else if($check_email == null && $same_class_new_utente == null){
                if ($array_data['password'] != $array_data['confirm-password']) {
                    $view_register->checkPassSignUp();
                } else {
                    FPersistentManager::getInstance()->insertNewUtente($new_utente);
                    $view_register->signUpSuccess();
                }
            }
            
        }
    }
    public static function userDataForm()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view_utente->userDataForm(1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view_utente->userDataForm(0,1);
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function userDataSection()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view_utente->userDataSection(0,0,1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view_utente->userDataSection(0,0,0,1);
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function userHistoryOrders()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view_utente->userHistoryOrders(1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view_utente->userHistoryOrders(0,1);
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function deleteAccount()
    {
        session_start();
        $utente = $_SESSION['utente'];
        FPersistentManager::getInstance()->deleteUtente($utente);
        session_unset();
        session_destroy();
        header('Location: /TekHub/utente/home');
    }
    public static function carrello()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            $view_utente->carrello();
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function changePass() {
        session_start();
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view->changePass(1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view->changePass(0,1);
            }else{
                header('Location: /TekHub/utente/login');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $password_old = $_POST['password'];
            if (password_verify($password_old, $_SESSION['utente']->getPassword())) {
                $new_password = $_POST['new-password'];
                $confirm_password = $_POST['new-confirm-password'];
                if ($new_password != $password_old) {
                    if ($new_password == $confirm_password) {
                        FPersistentManager::getInstance()->updatePass($_SESSION['utente'], $new_password);
                        if($_SESSION['utente'] instanceof EAcquirente){
                            $view->userDataSection(0,1,1,0);
                        }else if($_SESSION['utente'] instanceof EVenditore){
                            $view->userDataSection(0,1,0,1);
                        }
                    } else {
                        if($_SESSION['utente'] instanceof EAcquirente){
                            $view->errorPassUpdate(1,0);
                        }else if($_SESSION['utente'] instanceof EVenditore){
                            $view->errorPassUpdate(0,1);
                        }
                    }
                } elseif ($new_password == $password_old) {
                    if($_SESSION['utente'] instanceof EAcquirente){
                        $view->equalPasswordError(1,0);
                    }else if($_SESSION['utente'] instanceof EVenditore){
                        $view->equalPasswordError(0,1);
                    }
                } 
            } else {
                if($_SESSION['utente'] instanceof EAcquirente){
                    $view->errorOldPass(1,0);
                }else if($_SESSION['utente'] instanceof EVenditore){
                    $view->errorOldPass(0,1);
                }
            }
        }
    }

    public static function changeUserData()
    {
        session_start();
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if($_SESSION['utente'] instanceof EAcquirente){
                $view->userDataForm(1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view->userDataForm(0,1);
            }else{
                header('Location: /TekHub/utente/login');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            foreach ($postData as $key => $value) {
                $array_data[$key] = $value;
            }
            FPersistentManager::getInstance()->updateUtente($_SESSION['utente'], $array_data);

            //Aggiorno la sessione con i nuovi dati aggiornati
            $updated_cliente = FPersistentManager::getInstance()->findUtente($_SESSION['utente']);
            $_SESSION['utente'] = $updated_cliente[0];
            if($_SESSION['utente'] instanceof EAcquirente){
                $view->userDataSection(1,0,1,0);
            }else if($_SESSION['utente'] instanceof EVenditore){
                $view->userDataSection(1,0,0,1);
            }
        }
    }
    public static function gestioneProdotti(){
        session_start();
        $view = new VUtente();
        if (static::isLogged()) {
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
                // Ottieni il referer della richiesta
                $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

                // Verifica se il referer corrisponde a un determinato valore
                // Ad esempio, controlla se il referer contiene una specifica URL
                if (strpos($referer, 'addProduct') !== false) {
                    $called_from_referer = true;
                } else {
                    $called_from_referer = false;
                }
                $view->listaProdotti($array_prodotti, $called_from_referer);
            }else {
                header('Location: /TekHub/utente/home');
            }
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function addProduct(){
        session_start();
        $view = new VUtente();
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
            header('Location: /TekHub/utente/gestioneProdotti');
        }
    }
}
?>
<?php

class CUtente {
    public static function home(){
        $view_home = new VUtente();
        $array_prodotti = FPersistentManager::getInstance()->getLatestProductsHome();
        $array_categorie = FPersistentManager::getInstance()->getAllCategories();
        if (!isset($_COOKIE['cart'])) {
            setcookie('cart', json_encode([]), time() + (86400 * 30), "/"); // 30 giorni
        }
        if(isset($_SESSION['role']) && $_SESSION['role'] == "utente_bloccato"){
            $view_home->accessDenied();
        }else{
            if (static::isLogged()) {
                if($_SESSION['utente'] instanceof EAcquirente){
                    $view_home->loginSuccessAcquirente($array_prodotti, $array_categorie);
                }else if($_SESSION['utente'] instanceof EVenditore){
                    $view_home->loginSuccessVenditore();
                }else if($_SESSION['utente'] instanceof EAdmin){
                    $view_home->loginSuccessAdmin();
                }
            } else {
                $view_home->logout($array_prodotti, $array_categorie);
            }
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

                $_SESSION['utente'] = $utente[0];

                // Salvo il ruolo dell'utente nella sessione in base al tipo di instanza della classe
                // per poi fare il controllo dei permessi nel CFrontController
                if($_SESSION['utente'] instanceof EAcquirente){
                    if($utente[0]->isBlocked()){
                        $_SESSION['role'] = 'utente_bloccato';
                    }else{
                        $_SESSION['role'] = 'acquirente';
                    }
                    // Per testare gli utenti bloccati dall'admin : $_SESSION['role'] = 'utente_bloccato';
                }else if($_SESSION['utente'] instanceof EVenditore){
                    if($utente[0]->isBlocked()){
                        $_SESSION['role'] = 'utente_bloccato';
                    }else{
                        $_SESSION['role'] = 'venditore';
                    }
                }elseif($_SESSION['utente']instanceof EAdmin){
                    $_SESSION['role'] = 'admin';
                }

                if (isset($_COOKIE['auth'])) {
                    header('Location: /TekHub/utente/home');
                } else {
                    setcookie('auth', base64_encode($utente[0]->getEmail()), time() + (86400 * 30), "/"); // 30 giorni
                    header('Location: /TekHub/utente/home');
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
                    $_SESSION['signUpSuccess'] = true;
                    header('Location: /TekHub/utente/home');
                }
            }
            
        }
    }
    public static function userDataForm()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            $view_utente->userDataForm();
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function userDataSection()
    {
        $view_utente = new VUtente();
        if (static::isLogged()) {
            $view_utente->userDataSection();
        } else {
            header('Location: /TekHub/utente/login');
        }
    }
    public static function userHistoryOrders()
    {
        $view_utente = new VUtente();
        $ordini = FPersistentManager::getInstance()->getOrdiniUtente();
        $view_utente->userHistoryOrders($ordini);
    }
    public static function deleteAccount()
    {
        $utente = $_SESSION['utente'];
        FPersistentManager::getInstance()->deleteUtente($utente);
        session_unset();
        session_destroy();
        header('Location: /TekHub/utente/home');
    }
    public static function changePass() {
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if(isset($_SESSION['utente'])){
                $view->changePass();
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
                        $_SESSION['changepasswordsucces'] = true;
                        header('Location: /TekHub/utente/userDataSection');
                    } else {
                        $view->errorPassUpdate();
                    }
                } elseif ($new_password == $password_old) {
                    $view->equalPasswordError();
                } 
            } else {
                $view->errorOldPass(1,0);
            }
        }
    }

    public static function changeUserData()
    {
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if(isset($_SESSION['utente'])){
                $view->userDataForm();
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
            $_SESSION['changeuserdatasucces'] = true;
            header('Location: /TekHub/utente/userDataSection');
        }
    }
    public static function indirizzi() {
        $view_utente = new VUtente();
        $array_indirizzi = FPersistentManager::getInstance()->getAllIndirizziUtente($_SESSION['utente']);
        
        $messages = [];
        if (isset($_SESSION['address_deleted'])) {
            $messages['success'] = "L'indirizzo è stato eliminato con successo.";
            unset($_SESSION['address_deleted']);
        }
        if (isset($_SESSION['address_added'])) {
            $messages['success'] = "L'indirizzo è stato aggiunto con successo.";
            unset($_SESSION['address_added']);
        }
        if (isset($_SESSION['address_reactivated'])) {
            $messages['success'] = "L'indirizzo è stato riattivato con successo.";
            unset($_SESSION['address_reactivated']);
        }
        if (isset($_SESSION['address_soft_deleted'])) {
            $messages['info'] = "L'indirizzo è stato nascosto ma non completamente eliminato poiché è associato a ordini esistenti.";
            unset($_SESSION['address_soft_deleted']);
        }
        if (isset($_SESSION['address_error'])) {
            $messages['error'] = $_SESSION['address_error'];
            unset($_SESSION['address_error']);
        }
        
        $view_utente->indirizzi($array_indirizzi, $messages);
    }

    public static function aggiungiIndirizzi(){
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $view->aggiungiIndirizzi();
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            $errors = [];

            // Validazione del campo "via"
            if (!preg_match('/^Via\s+[A-Za-z\s]+\s+\d+$/', $postData['via'])) {
                $errors[] = "L'indirizzo deve essere nel formato 'Via Nome strada n_civico'";
            }

            // Validazione del campo "cap"
            if (!preg_match('/^\d{5}$/', $postData['cap'])) {
                $errors[] = "Il CAP deve essere composto da esattamente 5 cifre";
            }

            if (empty($errors)) {
                // Se non ci sono errori, procedi con l'inserimento
                foreach ($postData as $key => $value) {
                    $array_data[$key] = $value;
                }
                //Si assume per semplicità che gli indirizzi siano univoci, 
                //cioè che non ci sono più famiglie che abitano nella stesso indirizzo,
                // nello stesso numero civico e nello stesso cap
                FPersistentManager::getInstance()->insertIndirizzo($array_data);
                $_SESSION['address_added'] = true;
                header('Location: /TekHub/utente/indirizzi');
            } else {
                // Se ci sono errori, mostra nuovamente il form con i messaggi di errore
                $view->aggiungiIndirizziConErrori($errors);
            }
        }
    }
    public static function riattivaIndirizzo($indirizzo, $cap) {
        $found_indirizzo = FPersistentManager::getInstance()->findIndirizzo($indirizzo, $cap);
        
        if ($found_indirizzo) {
            FPersistentManager::getInstance()->riattivaIndirizzo($found_indirizzo[0]);
            $_SESSION['address_reactivated'] = true;
        } else {
            $_SESSION['address_error'] = "Errore: l'indirizzo non è stato trovato.";
        }
        
        header('Location: /TekHub/utente/indirizzi');
        exit();
    }
    public static function eliminaIndirizzo($indirizzo, $cap) {
        $found_indirizzo = FPersistentManager::getInstance()->findIndirizzo($indirizzo, $cap);
        
        if ($found_indirizzo) {
            if (FPersistentManager::getInstance()->canIndirizzoBeHardDeleted($indirizzo, $cap)) {
                FPersistentManager::getInstance()->deleteIndirizzo($found_indirizzo[0]);
                $_SESSION['address_deleted'] = true;
            } else {
                FPersistentManager::getInstance()->softDeleteIndirizzo($found_indirizzo[0]);
                $_SESSION['address_soft_deleted'] = true;
            }
        } else {
            $_SESSION['address_error'] = "Errore: l'indirizzo non è stato trovato.";
        }
        
        header('Location: /TekHub/utente/indirizzi');
        exit();
    }
    public static function aggiungiCarte() {
        $view = new VUtente();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $view->aggiungiCarte();
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            $errors = self::validateCreditCardData($postData);
            
            if (empty($errors)) {
                try {
                    FPersistentManager::getInstance()->insertCartaDiCredito($postData);
                    $_SESSION['credit_card_added'] = true;
                    header('Location: /TekHub/utente/carteCredito');
                    exit;
                } catch (Exception $e) {
                    $errors[] = "Errore durante l'inserimento della carta: " . $e->getMessage();
                }
            }
            
            if (!empty($errors)) {
                $view->aggiungiCarteConErrori($errors);
            }
        }
    }

    private static function validateCreditCardData($data) {
        $errors = [];

        // Validazione nome e cognome
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['nome']) || !preg_match("/^[a-zA-Z\s]+$/", $data['cognome'])) {
            $errors[] = "Il nome e il cognome devono contenere solo lettere e spazi.";
        }

        // Validazione numero carta
        if (!preg_match("/^\d{16}$/", $data['numeroCarta'])) {
            $errors[] = "Il numero della carta deve essere composto da 16 cifre.";
        }

        // Validazione scadenza
        if (!preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $data['scadenza'])) {
            $errors[] = "La data di scadenza deve essere nel formato MM/YY.";
        } else {
            $expiration = \DateTime::createFromFormat('m/y', $data['scadenza']);
            $now = new \DateTime();
            if ($expiration < $now) {
                $errors[] = "La carta di credito è scaduta.";
            }
        }

        // Validazione CCV
        if (!preg_match("/^\d{3}$/", $data['ccv'])) {
            $errors[] = "Il CCV deve essere composto da 3 cifre.";
        }

        // Validazione gestore
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['gestore'])) {
            $errors[] = "Il nome del gestore deve contenere solo lettere e spazi.";
        }

        return $errors;
    }

    public static function carteCredito() {
        $view_utente = new VUtente();
        $carte = FPersistentManager::getInstance()->getAllCarteUtente($_SESSION['utente']);
        
        $messages = [];
        if (isset($_SESSION['card_added'])) {
            $messages['success'] = "La carta di credito è stato aggiunta con successo.";
            unset($_SESSION['card_added']);
        }
        if (isset($_SESSION['card_deleted'])) {
            $messages['success'] = "La carta di credito è stata eliminata con successo.";
            unset($_SESSION['card_deleted']);
        }
        if (isset($_SESSION['card_reactivated'])) {
            $messages['success'] = "La carta di credito è stata riattivata con successo.";
            unset($_SESSION['card_reactivated']);
        }
        if (isset($_SESSION['card_soft_deleted'])) {
            $messages['info'] = "La carta di credito è stata nascosta ma non completamente eliminata poiché è associata a ordini esistenti.";
            unset($_SESSION['card_soft_deleted']);
        }
        if (isset($_SESSION['card_error'])) {
            $messages['error'] = $_SESSION['card_error'];
            unset($_SESSION['card_error']);
        }
        
        $view_utente->carteCredito($carte, $messages);
    }

    public static function eliminaCarta($numeroCarta) {
        $found_carta = FPersistentManager::getInstance()->findCartaDiCredito($numeroCarta);
        
        if ($found_carta) {
            if (FPersistentManager::getInstance()->canCartaDiCreditoBeHardDeleted($numeroCarta)) {
                FPersistentManager::getInstance()->deleteCartaDiCredito($found_carta[0]);
                $_SESSION['card_deleted'] = true;
            } else {
                FPersistentManager::getInstance()->softDeleteCartaDiCredito($found_carta[0]);
                $_SESSION['card_soft_deleted'] = true;
            }
        } else {
            $_SESSION['card_error'] = "Errore: la carta di credito non è stata trovata.";
        }
        
        header('Location: /TekHub/utente/carteCredito');
        exit();
    }
    public static function riattivaCarta($numeroCarta) {
        $found_carta = FPersistentManager::getInstance()->findCartaDiCredito($numeroCarta);
        
        if ($found_carta) {
            FPersistentManager::getInstance()->riattivaCarta($found_carta[0]);
            $_SESSION['card_reactivated'] = true;
        } else {
            $_SESSION['card_error'] = "Errore: la carta di credito non è stata trovata.";
        }
        
        header('Location: /TekHub/utente/carteCredito');
        exit();
    }
    public static function gestisciProdotti()
    {
        $view_admin = new VAdminDashboard();
       if (static::isLogged()) {
            $view_admin->gestioneProdotti();
       } else {
           header('Location: /TekHub/utente/login');
        }
    }
    

    public static function searchProducts() {
        if (!isset($_SESSION['utente']) || !($_SESSION['utente'] instanceof EAdmin)) {
            header('Location: /TekHub/utente/login');
            exit;
         }
     
         $view_admin = new VAdminDashboard();
     
         if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])) {
             $search_term = $_POST['search'];
             $products = FPersistentManager::getInstance()->getProductById($search_term);
             $view_admin->displaySearchResults($products);
         } 
     }

     public static function deleteProduct($id) {
        if (!isset($_SESSION['utente']) || !($_SESSION['utente'] instanceof EAdmin)) {
            header('Location: /TekHub/utente/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $result = FPersistentManager::getInstance()->deleteAllImages($id);
            $result = FPersistentManager::getInstance()->deleteProdotto($id);
            if ($result) {
                $_SESSION['product_deleted'] = true;
            } else {
                $_SESSION['product_delete_error'] = true;
            }
            header('Location: /TekHub/utente/gestisciProdotti');
            exit;
        }
    }
}
?>
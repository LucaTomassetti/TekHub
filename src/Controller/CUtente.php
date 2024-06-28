<?php
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
                if($_SESSION['utente'] instanceof EAcquirente){
                    $view->loginSuccessAcquirente();
                }else if($_SESSION['utente'] instanceof EVenditore){
                    $view->loginSuccessVenditore();
                }
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
        FPersistentManager::getInstance()->deleteAcquirente($utente);
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
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postData = $_POST;
            foreach ($postData as $key => $value) {
                $array_data[$key] = $value;
            }
            FPersistentManager::getInstance()->updateAcquirente($_SESSION['utente'], $array_data);

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
        $view->listaProdotti();
    }
}
?>
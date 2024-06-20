<?php
class CUtente {
    public static function home(){
        $view_home = new VUtente();
        $view_home->home();
        header("Location: /TekHub/utente/home");
        
    }
    public static function login(){
        $view = new VUtente();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $view->showLoginForm();
        }elseif ($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $_POST['email-log'];
            //$cliente = getEntityManager()->getRepository('EAcquirente')->findOneBy(array('email' => $email));
            $cliente = FPersistentManager::getInstance()->findUtente($email);
            $username = $cliente[0]->getUsername();
            if($cliente == null){
                $view->loginError();
            } else{
                if($username == 'admin' && $email == 'admin@admin.com'){
                    $view->showAdminDashboard();
                }else{
                    $view->loginSuccess();
                }
            }

        }
        
    }
    
    public static function logout(){
        $view_logout = new VUtente();
        $view_logout->logout();

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
                $new_utente  = new EVenditore($array_data['nome'],$array_data['cognome'],$array_data['partita_iva'],$array_data['società'],$array_data['email'],$array_data['password'],$array_data['username']);
                $temp = new EAcquirente(null,null,null,null,$new_utente->getEmail(),null);
            }else{
                $new_utente = new EAcquirente($array_data['nome'],$array_data['cognome'],$array_data['username'],$array_data['password'], $array_data['email'],$array_data['cellulare']);
                $temp = new EVenditore(null,null,null,null,$new_utente->getEmail(),null,null);
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
                FPersistentManager::getInstance()->insertNewUtente($new_utente);
                $view_register->signUpSuccess();
            }
            
        }
    }
}
?>
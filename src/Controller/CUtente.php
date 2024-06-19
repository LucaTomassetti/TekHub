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
            $cliente = getEntityManager()->getRepository('EAcquirente')->findAcquirente($email);
            if($cliente == null){
                $view->loginError();
            } else{
                $view->loginSuccess();
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
            $new_cliente = new EAcquirente($array_data['nome'],$array_data['cognome'],$array_data['username'],$array_data['password'], $array_data['email'],$array_data['cellulare']);
            $check_email = getEntityManager()->getRepository('EAcquirente')->findAcquirente($new_cliente->getEmail());
            /* Controllo se l'email esiste già */
            if($check_email != null){
                // se esiste ricarico la form per la registrazione
                $view_register->signUpError();
            }else{
                getEntityManager()->getRepository('EAcquirente')->insertNewCliente($new_cliente);
                $view_register->signUpSuccess();
            }
            
        }
    }
}
?>
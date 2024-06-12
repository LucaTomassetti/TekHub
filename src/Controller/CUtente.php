<?php
class CUtente{

    public static function login(){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $view = new VUtente();
            $view->showLoginForm();
        }elseif ($_SERVER['REQUEST_METHOD']=="POST")
        self::verifica();
    }
    public static function verifica(){
        $view = new VUtente();
        $username = UHTTPMethods::post('username');  

        if(!empty($username)){
            $view->loginError();
        }else{
            header('Location: /TekHub/homepage');
        }
    }
}

?>
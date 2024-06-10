<?php
class CLogin{

    public static function showLoginForm(){
        $view = new VAcquirente();
        $view->showLoginForm();
    }
    public static function checkLogin(){
        $view = new VAcquirente();
        $username = UHTTPMethods::post('username');  

        if($username == ''){
            $view->loginError();
        }else{
            header('Location: /TekHub/homepage');
            $view->home();
        }
    }
}

?>
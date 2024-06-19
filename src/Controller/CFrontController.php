<?php
class CFrontController{

    public function run(){

        $URL = parse_url($_SERVER['REQUEST_URI'])['path'];
        $URL = explode('/', $URL);

        array_shift($URL);
        
        $file = "./src/Controller/C".ucfirst($URL[1]).".php";

        $controllerClass = "C".ucfirst($URL[1]);
        $methodName = !empty($URL[2]) ? $URL[2] : ' ';
        
        if(file_exists($file)){
            require_once $file;
            // Check if the method exists in the controller
            if (method_exists($controllerClass, $methodName)) {
                // Call the method
                $params = array_slice($URL, 2); // Get optional parameters
                call_user_func_array([$controllerClass, $methodName], $params);
            }else {
                // Method not found, handle appropriately (e.g., show 404 page)
                header('Location: /TekHub/utente/home');
            }

        } else{
            header('Location: /TekHub/utente/home');
        }
    }
}

?>
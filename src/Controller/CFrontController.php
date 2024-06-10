<?php
class CFrontController{

    public function run(){

        $URL = parse_url($_SERVER['REQUEST_URI'])['path'];
        $URL = explode('/', $URL);

        array_shift($URL);
        
        $file = "./src/Controller/C".ucfirst($URL[1]).".php";

        $controllerClass = "C".ucfirst($URL[1]);
        $methodName = !empty($URL[2]) ? $URL[2] : ' ';
        
        if($URL[1] == ''){
            header('Location: /TekHub/homepage');
            require_once './src/Controller/CHomepage.php';
        }else if(file_exists($file)){
            require_once $file;
            // Check if the method exists in the controller
            if (method_exists($controllerClass, $methodName)) {
                // Call the method
                $params = array_slice($URL, 2); // Get optional parameters
                call_user_func_array([$controllerClass, $methodName], $params);
            }

        }
        else{
            $file = "./src/Controller/_404.php";
            http_response_code(404);
            require $file;
        }
    }
}

?>
<?php
class CFrontController{

    public function run(){

        $URL = parse_url($_SERVER['REQUEST_URI'])['path'];
        $URL = explode('/', $URL);
        
        $file = "./src/Controller/C".ucfirst($URL[2]).".php";
        if($URL[2] == ''){
            header('Location: /TekHub/homepage');
            require './src/Controller/CHomepage.php';
        }else if(file_exists($file)){
            require $file;
        }
        else{
            $file = "./src/Controller/_404.php";
            http_response_code(404);
            require $file;
        }
    }
}

?>
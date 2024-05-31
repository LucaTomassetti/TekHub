<?php
class CFrontController{

    public function run(){

        $URL = $_GET['url'];
        $URL = explode('/', $URL);
        if($URL[0]==''){
            $URL[0] = 'index'; 
            header('Location: index');
        }
        $file = "./src/Controller/C".ucfirst($URL[0]).".php";
        if(file_exists($file)){
            require $file;
        }
        else{
            $file = "./src/Controller/_404.php";
            require $file;
        }
    }
}

?>
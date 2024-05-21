<?php
//require_once __DIR__ .'/src/Utility/autoload.inc.php';
require_once __DIR__ .'/config/bootstrap.php';

function show($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}
function splitURL(){
    $URL = $_GET['url'];
    $URL = explode('/', $URL);
    return $URL;
}
function loadController(){
    $URL = splitURL();
    $file = "./src/Controller/C".ucfirst($URL[0]).".php";
    if(file_exists($file)){
        require $file;
    }
    else{
        $file = "./src/Controller/_404.php";
        require $file;
    }
}
show(splitURL());
loadController();

//$a1 = new EAcquirente(NULL,'boh','boh','boh','boh','boh@boh.com',3891237564);

//$entityManager->persist($a1);

//flush() serve per sincronizzare le modifiche nel database
$entityManager->flush();
?>
<?php
//require_once __DIR__ .'/src/Utility/autoload.inc.php';
require_once __DIR__ .'/config/bootstrap.php';
/**
 * function show($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
    }
 */

 $fc = new CFrontController();
 $fc->run();

//flush() serve per sincronizzare le modifiche nel database
$entityManager->flush();
?>
<?php
//require_once __DIR__ .'/src/Utility/autoload.inc.php';
require_once __DIR__ .'/config/bootstrap.php';
require_once __DIR__ . "/config/StartSmarty.php";
/**
 * function show($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
    }
 */

 $fc = new CFrontController();
 $fc->run();

 $smarty = new StartSmarty();
/**
 * To verify that smarty works out, you can run the 
 * following method:
 * $smarty->testInstall();
 */

//flush() serve per sincronizzare le modifiche nel database
$entityManager->flush();
?>
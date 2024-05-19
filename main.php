<?php
require_once __DIR__ .'/src/Utility/autoload.inc.php';
require_once __DIR__ .'/config/bootstrap.php';


$a1 = new EAcquirente(NULL,'boh','boh','boh','boh','boh@boh.com',3891237564);

$entityManager->persist($a1);

//flush() serve per sincronizzare le modifiche nel database
$entityManager->flush();
?>
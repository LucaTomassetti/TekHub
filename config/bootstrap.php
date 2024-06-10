<?php
/**
 * Questo script rappresenta il file di configurazione 
 * e di creazione del database e dell'EntityManager
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Utility/autoload.inc.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;

$dbParams = [
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'pippo',
    'dbname'   => 'tekhub',
];
//Check if the database exists
try{
    $conn =  new PDO("mysql:host=".$dbParams['host']."; charset=utf8;", $dbParams['user'], $dbParams['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $dbParams['dbname']."'");
    if($stmt->rowCount() == 0){
        // Database does not exist, create it
        
        $sql = "CREATE DATABASE " . $dbParams['dbname'];
        $conn->exec($sql);
    }
    $conn = null;
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    die();
}
//Obtaining the entity manager
function getEntityManager() : EntityManager
{
    $entityManager = null;

    if ($entityManager === null)
    {
        $paths = [__DIR__ . '/../src/Entity/'];
        $isDevMode = false;
        global $dbParams;
        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);
        $entityManager = new EntityManager($connection, $config);
    }

    return $entityManager;
}

//Generating the database schema
$schemaTool = new SchemaTool(getEntityManager());
$classes = getEntityManager()->getMetadataFactory()->getAllMetadata();
/**
 * Using $schemaTool->createSchema($classes) works too but when you
 * reload the main.php page, you get error 500 and the problem 
 * lies to the fact that the tables already exist,
 * so it's better to use updateSchema($classes) also because
 * even if the tables don't exist, they are recreated
 */
$schemaTool->updateSchema($classes);

?>
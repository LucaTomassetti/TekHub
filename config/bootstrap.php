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
use Doctrine\ORM\Tools\ToolsException;

$dbParams = [
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'pippo',
    'dbname'   => 'tekhub',
];

// Check if the database exists
try {
    $conn = new PDO("mysql:host=".$dbParams['host']."; charset=utf8;", $dbParams['user'], $dbParams['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $dbParams['dbname']."'");
    if ($stmt->rowCount() == 0) {
        // Database does not exist, create it
        $sql = "CREATE DATABASE " . $dbParams['dbname'];
        $conn->exec($sql);
    }
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Configuration parameters
$paths = [__DIR__ . '/../src/Entity/'];
$isDevMode = false;
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$config->setProxyDir(__DIR__ . '/../proxies');  // Directory where proxies will be generated
$config->setProxyNamespace('Proxies');       // Namespace for proxies

// Create connection
$connection = DriverManager::getConnection($dbParams, $config);

// Obtain the entity manager
$entityManager = new EntityManager($connection, $config);

try {
    // Get the Metadata of the entities
    $classes = $entityManager->getMetadataFactory()->getAllMetadata();

    // Create SchemaTool
    $schemaTool = new SchemaTool($entityManager);

    $schemaTool->updateSchema($classes);

    // Generate the proxy classes
    $proxyFactory = $entityManager->getProxyFactory();
    foreach ($classes as $class) {
        $proxyFactory->generateProxyClasses([$class], $config->getProxyDir());
    }

    //echo "Proxies generated successfully!";
} catch (ToolsException $e) {
    echo "An error occurred: " . $e->getMessage();
}

/**
 * Using $schemaTool->createSchema($classes) works too but when you
 * reload the main.php page, you get error 500 and the problem 
 * lies to the fact that the tables already exist,
 * so it's better to use updateSchema($classes) also because
 * even if the tables don't exist, they are recreated
 * 
 * $schemaTool->updateSchema($classes);
 */

// Function to get the EntityManager
function getEntityManager() : EntityManager
{
    global $entityManager;
    return $entityManager;
}

?>

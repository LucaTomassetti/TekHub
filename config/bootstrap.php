<?php
/**
 * Questo script rappresenta il file di configurazione del database e
 * della creazione dell'EntityManager
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;

$paths = [__DIR__ . '/../src/Entity/'];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'pippo',
    'dbname'   => 'tekhub',
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

?>
#!/usr/bin/env php
<?php
/**
 * Questo script permette di utilizzare il prompt dei comandi per accedere al SchemaTool,
 * un componente che permette di generare lo schema del database relazionale basandosi
 * interamente sulle classi definite in entity e ai metadati utilizzati 
 * ( in questo caso l'Attribute sintax )
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// replace with path to your own project bootstrap file
require __DIR__ .'/../config/bootstrap.php';

ConsoleRunner::run(
    new SingleManagerProvider(getEntityManager())
);
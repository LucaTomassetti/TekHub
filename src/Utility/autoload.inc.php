<?php

// questa vecchia versione di __autoload() va in conflitto
// con l'autoloader di smarty 
//
//     function __autoload($className) {
//         include( "classi/$className" . ".class.php" );
//     }

function my_autoloader($className) {
	if ( $className == 'Smarty') {
       include_once( __DIR__ . '/../../smarty-libs/Smarty.class.php' );
	} else { 
        $first = $className[0];
        if ( $first == 'E') {
           include_once( __DIR__ . '/../Entity/'. $className . '.php' ); 
        } elseif ($first == 'F') {
           include_once( __DIR__ . '/../Foundation/'. $className . '.php' ); 
        } elseif ( $first == 'V') {
           include_once( __DIR__ . '/../View/'. $className . '.php' );
        }
    }
}

spl_autoload_register('my_autoloader');

?>

<?php

class CGestioneOrdiniInAttesa {

    public static function ordiniInAttesa() {

        $view = new VGestioneOrdiniInAttesa();
        
        if (!isset($_GET['orderpage'])) {
            $url = $_SERVER['REQUEST_URI'];
            $url = rtrim('?', $url);
            $url .= '?orderpage=1';
            header("Location: $url");
        }
        // Ottieni il numero della pagina dalla query string, se presente, altrimenti imposta su 1
        $page = isset($_GET['orderpage']) ? (int)$_GET['orderpage'] : 1;

        // Verifica se l'utente è loggato e se è un venditore
        if ($_SESSION['utente'] instanceof EVenditore) {
            // Recupera il venditore dalla sessione
            $venditore = $_SESSION['utente'];

            // Ottieni gli ordini effettuati per la pagina corrente
            $array_ordini = FPersistentManager::getInstance()->getAllOrdini($venditore, $page);
            $view->ordiniInAttesa($array_ordini);
        } else {
            header('Location: /TekHub/utente/home');
            exit();
        }
    }
}

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
    public static function prendiInCarico($ordineId, $prodottoId) {
        $ordine = FPersistentManager::getInstance()->find(EOrdine::class, $ordineId);
        $ordineProdotto = FPersistentManager::getInstance()->findOrdineProdotto($ordineId, $prodottoId);
        
        if (!$ordineProdotto) {
            // Gestisci l'errore
            $_SESSION['error'] = "Prodotto non trovato nell'ordine.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/ordiniInAttesa');
            exit();
        }

        // Aggiorna lo stato del prodotto specifico
        $ordineProdotto->setStato_ordine('Preso in carico');
        FPersistentManager::getInstance()->update($ordineProdotto);
        
        // Controlla se tutti i prodotti dell'ordine sono presi in carico
        $tuttiInSpedizione = true;
        foreach ($ordine->getQProdottoOrdine() as $op) {
            if ($op->getStato_ordine() != 'Preso in carico') {
                $tuttiInSpedizione = false;
                break;
            }
        }
        
        // Se tutti i prodotti sono presi in carico, aggiorna lo stato dell'ordine
        if ($tuttiInSpedizione) {
            $ordine->setStato_ordine('Preso in carico');
            FPersistentManager::getInstance()->update($ordine);
        }
        
        $_SESSION['success'] = "Prodotto preso in carico con successo.";
        header('Location: /TekHub/gestioneOrdiniInAttesa/ordiniInAttesa');
        exit();
    }
}

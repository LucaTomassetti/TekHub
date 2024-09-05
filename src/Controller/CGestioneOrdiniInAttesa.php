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
            $array_ordini = FPersistentManager::getInstance()->getAllInElaborazione($venditore, $page);
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
        $tuttiInCarico = true;
        foreach ($ordine->getQProdottoOrdine() as $op) {
            if ($op->getStato_ordine() == 'In elaborazione') {
                $tuttiInCarico = false;
                break;
            }
        }
        
        // Se tutti i prodotti sono presi in carico, aggiorna lo stato dell'ordine
        if ($tuttiInCarico) {
            $ordine->setStato_ordine('Preso in carico');
            FPersistentManager::getInstance()->update($ordine);
        }

        $_SESSION['success'] = "Prodotto preso in carico con successo.";
        header('Location: /TekHub/gestioneOrdiniInAttesa/ordiniInAttesa');
        exit();
    }
 
    public static function statoOrdini() {
        if ($_SESSION['utente'] instanceof EVenditore) {
            $venditore = $_SESSION['utente'];
            $page = isset($_GET['orderpage']) ? (int)$_GET['orderpage'] : 1;
    
            $manager = FPersistentManager::getInstance();
            $array_ordini = $manager->getOrdiniConProdottiVenditore($venditore, $page);

            $view = new VGestioneOrdiniInAttesa();
            $view->statoOrdini($array_ordini);  
        } else {
            header('Location: /TekHub/utente/home');
            exit();
        }
    } 

    //per aggiornare lo stato degli ordini presi in carico
    /*public static function aggiornaStatoOrdine($ordineId, $prodottoId) {
        $nuovoStato = $_POST['nuovoStato'];
        // Recupera l'ordine e il prodotto associato
        $ordine = FPersistentManager::getInstance()->find(EOrdine::class, $ordineId);
        $ordineProdotto = FPersistentManager::getInstance()->findOrdineProdotto($ordineId, $prodottoId);
        
        if (!$ordineProdotto) {
            // Gestione errore, prodotto non trovato
            $_SESSION['error'] = "Prodotto non trovato nell'ordine.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
            exit();
        }
    
        // Controlla se il nuovo stato è valido ("In spedizione" o "Consegnato")
        if ($nuovoStato != 'In spedizione' && $nuovoStato != 'Consegnato') {
            // Stato non valido, gestisci errore
            $_SESSION['error'] = "Stato non valido. Deve essere 'In spedizione' o 'Consegnato'.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
            exit();
        }
    
        // Aggiorna lo stato del prodotto specifico
        FPersistentManager::getInstance()->cambiaStatoOrdineProdotto($ordineId, $prodottoId, $nuovoStato);
    
        // Controlla se tutti i prodotti dell'ordine sono nello stesso stato
        $tuttiAggiornati = true;
        foreach ($ordine->getQProdottoOrdine() as $op) {
            if ($op->getStato_ordine() != $nuovoStato) {
                $tuttiAggiornati = false;
                break;
            }
        }
        $_SESSION['tuttiAggiornati'] = $tuttiAggiornati == true ? 1 : 0;
    
        // Se tutti i prodotti hanno lo stesso nuovo stato, aggiorna lo stato dell'ordine
        if ($tuttiAggiornati) {
            FPersistentManager::getInstance()->cambiaStatoOrdine($ordineId, $nuovoStato);
        }
    
        // Messaggio di successo
        $_SESSION['success'] = "Prodotto aggiornato con successo allo stato '$nuovoStato'.";
        header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
        exit();
    }*/
    public static function aggiornaStatoOrdine($ordineId, $prodottoId) {
        $nuovoStato = $_POST['nuovoStato'];
        $ordine = FPersistentManager::getInstance()->find(EOrdine::class, $ordineId);
        $ordineProdotto = FPersistentManager::getInstance()->findOrdineProdotto($ordineId, $prodottoId);
        
        if (!$ordineProdotto) {
            $_SESSION['error'] = "Prodotto non trovato nell'ordine.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
            exit();
        }
    
        $statiValidi = ['In elaborazione', 'Preso in carico', 'In spedizione', 'Consegnato'];
        $statoAttualeIndex = array_search($ordineProdotto->getStato_ordine(), $statiValidi);
        $nuovoStatoIndex = array_search($nuovoStato, $statiValidi);
    
        if ($nuovoStatoIndex <= $statoAttualeIndex || $nuovoStatoIndex === false) {
            $_SESSION['error'] = "Stato non valido o non puoi tornare a uno stato precedente.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
            exit();
        }
    
        // Verifica se tutti gli altri prodotti sono almeno nello stato precedente
        $tuttiProdottiPronti = true;
        foreach ($ordine->getQProdottoOrdine() as $op) {
            if ($op->getProdottoId()->getIdProdotto() != $prodottoId) {
                $statoOp = array_search($op->getStato_ordine(), $statiValidi);
                if ($statoOp < $statoAttualeIndex) {
                    $tuttiProdottiPronti = false;
                    break;
                }
            }
        }
    
        if (!$tuttiProdottiPronti) {
            $_SESSION['error'] = "Non puoi aggiornare questo prodotto finché tutti gli altri non sono almeno nello stato '" . $statiValidi[$statoAttualeIndex] . "'.";
            header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
            exit();
        }
    
        FPersistentManager::getInstance()->cambiaStatoOrdineProdotto($ordineId, $prodottoId, $nuovoStato);
    
        // Verifica se tutti i prodotti sono nello stesso stato
        $tuttiStessoStato = true;
        foreach ($ordine->getQProdottoOrdine() as $op) {
            if ($op->getStato_ordine() != $nuovoStato) {
                $tuttiStessoStato = false;
                break;
            }
        }
    
        if ($tuttiStessoStato) {
            FPersistentManager::getInstance()->cambiaStatoOrdine($ordineId, $nuovoStato);
            $_SESSION['success'] = "Ordine e prodotto aggiornati con successo allo stato '$nuovoStato'.";
        } else {
            $_SESSION['success'] = "Prodotto aggiornato con successo allo stato '$nuovoStato'. L'ordine rimane nello stato '" . $ordine->getStato_ordine() . "'.";
        }
    
        header('Location: /TekHub/gestioneOrdiniInAttesa/statoOrdini');
        exit();
    }
}

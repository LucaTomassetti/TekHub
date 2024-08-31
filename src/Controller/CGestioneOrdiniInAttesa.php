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

    public static function statoOrdini() {
        if ($_SESSION['utente'] instanceof EVenditore) {
            $venditore = $_SESSION['utente'];
            $page = isset($_GET['orderpage']) ? (int)$_GET['orderpage'] : 1;
    
            $manager = FPersistentManager::getInstance();
            $array_ordini = $manager->getAllPresiInCarico($venditore, $page);
    
            $view = new VGestioneOrdiniInAttesa();
            $view->statoOrdini($array_ordini);  
        } else {
            header('Location: /TekHub/utente/home');
            exit();
        }
    }

    public function cambiaStatoOrdine(EOrdine $ordine, $nuovoStato) {
        // Stato corrente dell'ordine
        $statoCorrente = $ordine->getStato_ordine();

        // Definizione delle transizioni di stato consentite
        $transizioniConsentite = [
            'Preso in carico' => ['In spedizione'],
            'In spedizione' => ['Consegnato']
        ];

        // Controllo se la transizione di stato è consentita
        if (isset($transizioniConsentite[$statoCorrente]) && in_array($nuovoStato, $transizioniConsentite[$statoCorrente])) {
            // Cambia lo stato dell'ordine
            $ordine->setStato_ordine($nuovoStato);

            // Aggiorna l'ordine nel database
            FPersistentManager::getInstance()->update($ordine);

            // Gestione delle azioni successive al cambio di stato
            if ($nuovoStato == 'In spedizione') {
                // Esegui azioni per l'ordine in spedizione, ad esempio:
                // $this->notificaUtente($ordine);
            } elseif ($nuovoStato == 'Consegnato') {
                // Esegui azioni per l'ordine consegnato, ad esempio:
                // $this->aggiornaInventario($ordine);
            }

            return true;
        } else {
            throw new Exception("Il cambio di stato non è consentito.");
        }
    }


    
    
}

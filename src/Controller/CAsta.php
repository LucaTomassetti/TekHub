<?php

class CAsta {
    public static function effettuaOfferta($idProdotto) {
        $view = new VAsta();
        
        try {
            $prodotto = FPersistentManager::getInstance()->find(EUsato::class, $idProdotto);

            if (!$prodotto) {
                throw new \Exception("Prodotto non trovato");
            }

            $asta = $prodotto->getAsta();
            self::aggiornaStatoAsta($prodotto);  // Aggiorna lo stato dell'asta prima di procedere

            if ($asta->getStatoAsta() !== 'In corso') {
                throw new \Exception("L'asta non è attualmente in corso");
            }

            if (!self::verificaRequisitiUtente()) {
                throw new \Exception("Per effettuare un'offerta, devi avere almeno un indirizzo e una carta di credito registrati.");
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $importoOfferta = $_POST['importo'];
                $ultimaOfferta = FPersistentManager::getInstance()->getUltimaOffertaValida($prodotto);

                if ($importoOfferta <= $prodotto->getFloorPrice() || ($ultimaOfferta && $importoOfferta <= $ultimaOfferta->getImporto())) {
                    throw new \Exception("L'offerta deve essere superiore al prezzo di partenza e all'ultima offerta valida.");
                }

                $acquirenteId = $_SESSION['utente']->getId();
                // Cerca un'offerta esistente dell'utente per questa asta
                $offertaEsistente = FPersistentManager::getInstance()->getOffertaUtentePerAsta($prodotto, $acquirenteId);
                
                if ($offertaEsistente) {
                    // Aggiorna l'offerta esistente
                    $offerta = FPersistentManager::getInstance()->aggiornaOfferta($offertaEsistente, $importoOfferta);
                } else {
                    // Crea una nuova offerta
                    $offerta = FPersistentManager::getInstance()->insertOfferta($prodotto, $importoOfferta, $acquirenteId);
                }
                FPersistentManager::getInstance()->aggiornaStatoOfferte($prodotto);
                $_SESSION['offerta_effettuata'] = true;
                self::aggiornaStatoAsta($prodotto);
            }
            header('Location: /TekHub/gestioneAcquisto/vediProdotto/'.$idProdotto);
        } catch (\Exception $e) {
            $view->mostraErrore($e->getMessage());
        }
    }

    private static function verificaRequisitiUtente() {
        $indirizzi = FPersistentManager::getInstance()->getAllIndirizziUtente($_SESSION['utente']);
        $carte = FPersistentManager::getInstance()->getAllCarteUtente($_SESSION['utente']);

        return !empty($indirizzi) && !empty($carte);
    }

    private static function aggiornaStatoAsta(EUsato $prodotto) {
        $asta = $prodotto->getAsta();
        $now = new DateTime('now', new DateTimeZone('Europe/Rome'));

        $dataCreazione = $asta->getDataCreazione();
        $dataFine = $asta->getDataFine();

        if ($now < $dataCreazione) {
            $nuovoStato = 'Non iniziata';
        } elseif ($now >= $dataCreazione && $now < $dataFine) {
            $nuovoStato = 'In corso';
        } else {
            $nuovoStato = 'Terminata';
        }

        // Aggiorna lo stato solo se è cambiato
        if ($asta->getStatoAsta() !== $nuovoStato) {
            $asta->setStatoAsta($nuovoStato);
            FPersistentManager::getInstance()->update($asta);

            // Se l'asta è appena terminata, gestisci la conclusione
            if ($nuovoStato === 'Terminata') {
                $ultimaOfferta = FPersistentManager::getInstance()->getUltimaOffertaValida($prodotto);
                if ($ultimaOfferta) {
                    $vincitore = $ultimaOfferta->getAcquirente();
                    self::creaOrdineAutomatico($prodotto, $vincitore);
                } else {
                    error_log("L'asta per il prodotto ID " . $prodotto->getIdProdotto() . " è terminata senza offerte valide.");
                }
            }
        }

        FPersistentManager::getInstance()->aggiornaStatoOfferte($prodotto);
    }

    private static function creaOrdineAutomatico(EUsato $prodotto, EAcquirente $vincitore) {
        $ultimaOfferta = FPersistentManager::getInstance()->getUltimaOffertaValida($prodotto);
        
        if (!$ultimaOfferta) {
            // Non ci sono offerte valide, non creare un ordine
            return;
        }

        // Crea un nuovo ordine
        $ordine = new EOrdine();
        $ordine->setAcquirente($vincitore);
        $ordine->setData_ordine(new DateTime());
        $ordine->setStato_ordine('In elaborazione');
        $ordine->setQuantita_tot_prodotti(1);
        $ordine->setImporto_tot($ultimaOfferta->getImporto());
        
        // Assegna l'indirizzo e la carta di credito (prendi il primo disponibile per semplicità)
        $indirizzi = FPersistentManager::getInstance()->getAllIndirizziUtente($vincitore);
        $carte = FPersistentManager::getInstance()->getAllCarteUtente($vincitore);
        
        if (!empty($indirizzi) && !empty($carte)) {
            $ordine->setIndirizzo_spedizione($indirizzi[0]);
            $ordine->setCarta_ordine($carte[0]);
            
            // Crea OrdineProdotto
            $ordineProdotto = new EOrdineProdotto();
            $ordineProdotto->setOrdineId($ordine);
            $ordineProdotto->setProdottoId($prodotto);
            $ordineProdotto->setQuantitaOrdinataProdotto(1);
            $ordineProdotto->setStato_ordine('In elaborazione');
            
            FPersistentManager::getInstance()->persist($ordine);
            FPersistentManager::getInstance()->persist($ordineProdotto);
            FPersistentManager::getInstance()->flush();
        } else {
            // Gestisci il caso in cui l'utente non abbia indirizzi o carte registrate
            // Potresti voler notificare l'admin o l'utente in questo caso
            error_log("Impossibile creare l'ordine automatico per il vincitore ID " . $vincitore->getId() . ": mancano indirizzo o carta di credito.");
        }
    }

    public static function visualizzaOfferteEffettuate() {
        $view = new VAsta();
        $offerte = FPersistentManager::getInstance()->getOfferteUtente($_SESSION['utente']);
        $view->mostraOfferteEffettuate($offerte);
    }

    public static function rilancia($idOfferta) {
        $offerta = FPersistentManager::getInstance()->find(EOfferta::class, $idOfferta);
        if ($offerta && $offerta->getAcquirente()->getId() == $_SESSION['utente']->getId()) {
            header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $offerta->getProdotto()->getIdProdotto());
        } else {
            // Gestisci errore
        }
    }
}

?>
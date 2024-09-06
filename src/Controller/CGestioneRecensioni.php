<?php
    class CGestioneRecensioni {
        public static function aggiungi($idProdotto) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $view = new VGestioneRecensioni();
                if (!FPersistentManager::getInstance()->haAcquistatoProdotto($idProdotto)) {
                    $_SESSION['recensione_error'] = "Non puoi recensire un prodotto che non hai acquistato.";
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                    return;
                }
                $acquirente = FPersistentManager::getInstance()->find(EAcquirente::class, $_SESSION['utente']->getId());
                $prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $idProdotto);
                
                $recensione_esistente = FPersistentManager::getInstance()->getRecensioneUtente($acquirente, $prodotto);
                if ($recensione_esistente) {
                    $_SESSION['recensione_error'] = "Hai già scritto una recensione per questo prodotto. Puoi modificarla ma non aggiungerne una nuova.";
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                }else{
                    try {
                        $testo = $_POST['testo'];
                        $valutazione = $_POST['valutazione'];
                        
                        $recensione = new ERecensione();
                        $recensione->setTesto($testo);
                        $recensione->setValutazione($valutazione);
                        $recensione->setAcquirente($acquirente);
                        $recensione->setProdotto($prodotto);
                        
                        FPersistentManager::getInstance()->aggiungiRecensione($recensione);
            
                        $_SESSION['recensione_success'] = "La tua recensione è stata aggiunta con successo!";
                    } catch (Exception $e) {
                        $_SESSION['recensione_error'] = "Si è verificato un errore durante l'aggiunta della recensione: " . $e->getMessage();
                    }
                    
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                }
            }
        }
        public static function modifica($idProdotto) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $acquirente = FPersistentManager::getInstance()->find(EAcquirente::class, $_SESSION['utente']->getId());
                $prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $idProdotto);
                
                if (!FPersistentManager::getInstance()->haAcquistatoProdotto($idProdotto)) {
                    $_SESSION['recensione_error'] = "Non puoi modificare una recensione per un prodotto che non hai acquistato.";
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                    return;
                }
                
                $recensione_id = $_POST['recensione_id'];
                $recensione = FPersistentManager::getInstance()->find(ERecensione::class, $recensione_id);
                
                if ($recensione->getAcquirente()->getId() != $acquirente->getId()) {
                    $_SESSION['recensione_error'] = "Non puoi modificare una recensione che non ti appartiene.";
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                }else{
                    try {
                        $testo = $_POST['testo'];
                        $valutazione = $_POST['valutazione'];
                        
                        $recensione->setTesto($testo);
                        $recensione->setValutazione($valutazione);
                        
                        FPersistentManager::getInstance()->aggiungiRecensione($recensione);
            
                        $_SESSION['recensione_success'] = "La tua recensione è stata modificata con successo!";
                    } catch (Exception $e) {
                        $_SESSION['recensione_error'] = "Si è verificato un errore durante la modifica della recensione: " . $e->getMessage();
                    }
                    
                    header("Location: /TekHub/gestioneAcquisto/vediProdotto/" . $idProdotto);
                }
            }
        }
    
        public static function rispondi($idRecensione) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $venditore = FPersistentManager::getInstance()->find(EVenditore::class, $_SESSION['utente']->getIdVenditore());
                $recensione = FPersistentManager::getInstance()->find(ERecensione::class, $idRecensione);
                
                // Verifica se il venditore è autorizzato a rispondere
                if (!self::puo_rispondere($venditore, $recensione)) {
                    // Mostra un errore
                    $_SESSION['errore'] = "Non sei autorizzato a rispondere a questa recensione.";
                    header("Location: /TekHub/gestioneRecensioni/listaRecensioni");
                }
                
                $risposta = $_POST['risposta'];
                
                $recensione->setRispostaVenditore($risposta, new DateTime());
                
                FPersistentManager::getInstance()->flush();
                $_SESSION['successo'] = "Risposta inviata con successo.";
                // Reindirizza alla pagina delle recensioni del venditore
                header("Location: /TekHub/gestioneRecensioni/listaRecensioni");
            }
        }
    
        public static function segnala($idRecensione) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $venditore = FPersistentManager::getInstance()->find(EVenditore::class, $_SESSION['utente']->getIdVenditore());
                $recensione = FPersistentManager::getInstance()->find(ERecensione::class, $idRecensione);
                
                // Verifica se il venditore può segnalare questa recensione(nel senso se corrisponde all'id della sessione)
                if (!self::puo_segnalare($venditore, $recensione)) {
                    // Mostra un errore
                    $_SESSION['errore'] = "Non puoi segnalare questa recensione.";
                    header("Location: /TekHub/gestioneRecensioni/listaRecensioni");
                }
                
                $motivo = $_POST['motivo'];
                
                $segnalazione = new ESegnalazione();
                $segnalazione->setVenditore($venditore);
                $segnalazione->setMotivo($motivo);
                $recensione->setSegnalazione($segnalazione);
                
                FPersistentManager::getInstance()->persist($segnalazione);
                FPersistentManager::getInstance()->flush();
                $_SESSION['successo'] = "Segnalazione inviata con successo.";
                // Reindirizza alla pagina delle recensioni del venditore
                header("Location: /TekHub/gestioneRecensioni/listaRecensioni");
            }
        }
     
        public static function listaRecensioni() {
            $venditore = FPersistentManager::getInstance()->find(EVenditore::class, $_SESSION['utente']->getIdVenditore());
            $page = isset($_GET['recensioni_page']) ? (int)$_GET['recensioni_page'] : 1;
            $itemsPerPage = 4;
        
            $recensioni = FPersistentManager::getInstance()->getRecensioniVenditore($venditore, $page, $itemsPerPage);
            
            $view = new VGestioneRecensioni();
            $view->mostraRecensioniVenditore($recensioni);
        }
    
        private static function puo_rispondere($venditore, $recensione) {
            return $recensione->getProdotto()->getVenditore()->getIdVenditore() == $venditore->getIdVenditore();
        }
    
        private static function puo_segnalare($venditore, $recensione) {
            return $recensione->getProdotto()->getVenditore()->getIdVenditore() == $venditore->getIdVenditore();
        }
    }
?>
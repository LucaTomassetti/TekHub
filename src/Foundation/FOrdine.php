<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FOrdine extends EntityRepository {
    public function findOrdiniUtente($idCliente)
    {
        return $this->findBy(['acquirente' => $idCliente], ['id_ordine' => 'DESC']);
    }
    public function creaOrdine($indirizzo, $cap, $numeroCarta, $carrello){
        $em = getEntityManager();
        $em->beginTransaction();

        try {
            $cliente = $em->find(EAcquirente::class, $_SESSION['utente']->getId());
            $indirizzoObj = FPersistentManager::getInstance()->findIndirizzo($indirizzo, $cap);
            if (!$indirizzoObj) {
                throw new \Exception("Indirizzo non trovato");
            }
            $cartaObj = FPersistentManager::getInstance()->findCarta($numeroCarta);
            if (!$cartaObj) {
                throw new \Exception("Carta di credito non trovata");
            }

            $ordine = new EOrdine();
            $ordine->setAcquirente($cliente);
            $ordine->setIndirizzo_spedizione($indirizzoObj[0]);
            $ordine->setCarta_ordine($cartaObj[0]);
            $ordine->setIsPresoInCarico(false);

            $totale = 0;
            $quantitaTotale = 0;

            foreach ($carrello as $idProdotto => $quantita) {
                $prodotto = $em->find(EProdotto::class, $idProdotto);
                $ordineProdotto = new EOrdineProdotto();
                $ordineProdotto->setOrdineId($ordine);
                $ordineProdotto->setProdottoId($prodotto);
                $ordineProdotto->setQuantitaOrdinataProdotto($quantita);
                $ordineProdotto->setIsPresoInCarico(false);
                $em->persist($ordineProdotto);

                $ordine->addQProdottoOrdine($ordineProdotto);

                $totale += $prodotto->getPrezzoFisso() * $quantita;
                $quantitaTotale += $quantita;

                $prodotto->setQuantitaDisp($prodotto->getQuantitaDisp() - $quantita);
                $em->persist($prodotto);
            }

            $ordine->setImporto_tot($totale);
            $ordine->setQuantita_tot_prodotti($quantitaTotale);

            $em->persist($ordine);
            $em->flush();
            $em->commit();
            return $ordine;
        } catch (Exception $e) {
            $em->rollback();
            throw $e;
        }
    }
}
?>
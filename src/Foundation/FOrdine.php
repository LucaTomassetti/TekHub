<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

            $totale = 0;
            $quantitaTotale = 0;

            foreach ($carrello as $idProdotto => $quantita) {
                $prodotto = $em->find(EProdotto::class, $idProdotto);
                $ordineProdotto = new EOrdineProdotto();
                $ordineProdotto->setOrdineId($ordine);
                $ordineProdotto->setProdottoId($prodotto);
                $ordineProdotto->setQuantitaOrdinataProdotto($quantita);
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
    public function getOrdiniConProdottiVenditore(EVenditore $venditore, $currentPage = 1, $pageSize = 10) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('DISTINCT o')
           ->from('EOrdine', 'o')
           ->join('o.q_prodotto_ordine', 'op')
           ->join('op.prodotto_id', 'p')
           ->where('p.venditore = :venditore')
           ->setParameter('venditore', $venditore)
           ->orderBy('o.data_ordine', 'DESC');

        $query = $qb->getQuery()
                    ->setFirstResult(($currentPage - 1) * $pageSize)
                    ->setMaxResults($pageSize);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return [
            'ordini' => $paginator,
            'n_ordini' => count($paginator),
            'currentPage' => $currentPage,
            'pageSize' => $pageSize,
            'totalPages' => ceil(count($paginator) / $pageSize)
        ];
    }

    //per aggiornare lo stato
    public function cambiaStato($ordine, $nuovoStato ){
        $em = getEntityManager();
        $found_ordine = $em->find(EOrdine::class, $ordine->getId_ordine());
        $found_ordine->setStato_ordine($nuovoStato);

        $em->persist($found_ordine);
        $em->flush();
    }

    //per la soft delete degli ordini presi in carico
    public function deleteOrdine($ordine) {
        $em = getEntityManager();
        $found_ordine = $em->find(EOrdine::class, $ordine);
        if(!$found_ordine->isDeleted()){
            $found_ordine->setDeleted(true);
        }
        $em->flush();
    }
}
?>
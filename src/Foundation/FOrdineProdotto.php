<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FOrdineProdotto extends EntityRepository {
    public function aggiungiProdottoOrdine(EOrdine $ordine, EProdotto $prodotto, $quantita) {
        $em = $this->getEntityManager();
        $ordineProdotto = new EOrdineProdotto();
        $ordineProdotto->setOrdineId($ordine);
        $ordineProdotto->setProdottoId($prodotto);
        $ordineProdotto->setQuantitaOrdinataProdotto($quantita);
        
        $em->persist($ordineProdotto);
        $em->flush();
        
        return $ordineProdotto;
    }

    public function getAllOrdini($venditore, $currentPage = 1, $pageSize = 4){
        $dql = "SELECT ordine.acquirente.id_acquirente, ordine.indirizzo_spedizione, ordine.cap_spedizione, OP.quantita_ordinata_prodotto, ordine.data_ordine, prodotto.id_prodotto 
                FROM EOrdineProdotto OP 
                JOIN OP.prodotto_id prodotto ON OP.prodotto_id = prodotto.id_prodotto
                JOIN OP.ordine_id ordine ON OP.ordine_id = ordine.id_ordine
                WHERE prodotto.venditore = ?1";
        $query = getEntityManager()->createQuery($dql)
        ->setParameter(1, $venditore)
        ->setFirstResult(($currentPage - 1) * $pageSize)
        ->setMaxResults($pageSize);

        $paginator = new Paginator($query, fetchJoinCollection: true);

        return [
        'ordini' => iterator_to_array($paginator),
        'n_ordini' => count($paginator),
        'currentPage' => $currentPage,
        'pageSize' => $pageSize,
        'totalPages' => ceil(count($paginator) / $pageSize)
    
    ];    
    }

}
?>
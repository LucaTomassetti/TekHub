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
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('DISTINCT o')
        ->from('EOrdine', 'o')
        ->join('o.q_prodotto_ordine', 'op')
        ->join('op.prodotto_id', 'p')
        ->where('p.venditore = :venditore')
        ->setParameter('venditore', $venditore)
        ->orderBy('o.data_ordine', 'DESC');

        $query = $qb->getQuery();

        // Calcola il numero totale di risultati
        $totalItems = count($query->getResult());

        // Applica la paginazione
        $query->setFirstResult(($currentPage - 1) * $pageSize)
            ->setMaxResults($pageSize);

        // Esegui la query
        $results = $query->getResult();

        return [
            'ordini' => $results,
            'n_ordini' => $totalItems,
            'currentPage' => $currentPage,
            'pageSize' => $pageSize,
            'totalPages' => ceil($totalItems / $pageSize)
        ];
    }
    public function findOrdineProdotto($ordineId, $prodottoId) {
        return $this->findOneBy([
            'ordine_id' => $ordineId,
            'prodotto_id' => $prodottoId
        ]);
    }

    public function getAllPresiInCarico($venditore, $currentPage = 1, $pageSize = 4) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('DISTINCT o')
            ->from('EOrdine', 'o')
            ->join('o.q_prodotto_ordine', 'op')
            ->join('op.prodotto_id', 'p')
            ->where('p.venditore = :venditore')
            ->andWhere('o.stato_ordine = :stato')
            ->setParameter('venditore', $venditore)
            ->setParameter('stato', 'Preso in carico')
            ->orderBy('o.data_ordine', 'DESC');
    
        $query = $qb->getQuery();
    
        // Calcola il numero totale di risultati
        $totalItems = count($query->getResult());
    
        // Applica la paginazione
        $query->setFirstResult(($currentPage - 1) * $pageSize)
            ->setMaxResults($pageSize);
    
        // Esegui la query
        $results = $query->getResult();
    
        return [
            'ordini' => $results,
            'n_ordini' => $totalItems,
            'currentPage' => $currentPage,
            'pageSize' => $pageSize,
            'totalPages' => ceil($totalItems / $pageSize),
        ];
    }    

    public function findAllOrdiniPresiInCarico($ordineId, $prodottoId) {
        return $this->findOneBy([
            'ordine_id' => $ordineId,
            'prodotto_id' => $prodottoId,
            'stato' => 'Preso in carico'
        ]);
    }
    
    

}
?>
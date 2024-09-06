<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Query\Parameter;

class FProdotto extends EntityRepository {
    public function insertProdotto(EProdotto $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function deleteProdotto($prodotto) {
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto);
        if(!$found_prodotto->isDeleted()){
            $found_prodotto->setDeleted(true);
        }
        $em->flush();
    }
    public function updateImageProdotto(EProdotto $prodotto, EImmagine $immagine){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $found_image =  $em->find(EImmagine::class, $immagine->getIdImage());
        $found_prodotto->addImage($found_image);
        $em->persist($found_prodotto);
        $em->flush();
    }
    public function updateVendCatProdotto(EProdotto $prodotto, EVenditore $venditore, ECategoria $categoria){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $found_venditore = $em->find(EVenditore::class, $venditore->getIdVenditore());
        $found_categoria = $em->find(ECategoria::class, $categoria->getNomeCategoria());
        $found_prodotto->setVenditore($found_venditore);
        $found_prodotto->setCategoryName($found_categoria);
        $em->persist($found_prodotto);
        $em->flush();
    }
    public function getAllProductsByVend(EVenditore $venditore, $page = 1, $filtri = [], $pageSize = 4) {
        $qb = getEntityManager()->createQueryBuilder();
        $qb->select('p')
           ->from('EProdotto', 'p')
           ->where('p.venditore = :venditore')
           ->andWhere('p.is_deleted = false')
           ->setParameter('venditore', $venditore);
    
        if (!empty($filtri['query'])) {
            $qb->andWhere('p.nome LIKE :query OR p.descrizione LIKE :query')
               ->setParameter('query', '%' . $filtri['query'] . '%');
        }
        if (!empty($filtri['categoria'])) {
            $qb->andWhere('p.category_name = :categoria')
               ->setParameter('categoria', $filtri['categoria']);
        }
        if (!empty($filtri['marca'])) {
            $qb->andWhere('p.marca = :marca')
               ->setParameter('marca', $filtri['marca']);
        }
        if (!empty($filtri['condizione'])) {
            $conditions = [];
            foreach ($filtri['condizione'] as $condition) {
                if ($condition === 'nuovo') {
                    $conditions[] = 'p INSTANCE OF ENuovo';
                } elseif ($condition === 'usato') {
                    $conditions[] = 'p INSTANCE OF EUsato';
                }
            }
            if (!empty($conditions)) {
                $qb->andWhere(implode(' OR ', $conditions));
            }
        }
    
        $query = $qb->getQuery()
                    ->setFirstResult(($page - 1) * $pageSize)
                    ->setMaxResults($pageSize);
    
        $paginator = new Paginator($query, $fetchJoinCollection = true);
    
        $risultati = iterator_to_array($paginator);
    
        // Filtra i risultati per prezzo in PHP
        if (!empty($filtri['prezzo_max'])) {
            $risultati = array_filter($risultati, function($prodotto) use ($filtri) {
                if ($prodotto instanceof ENuovo) {
                    return $prodotto->getPrezzoFisso() <= $filtri['prezzo_max'];
                } elseif ($prodotto instanceof EUsato) {
                    return $prodotto->getFloorPrice() <= $filtri['prezzo_max'];
                }
                return false;
            });
        }
    
        return [
            'prodotti' => $risultati,
            'totalItems' => count($paginator),
            'currentPage' => $page,
            'itemsPerPage' => $pageSize,
            'totalPages' => ceil(count($paginator) / $pageSize)
        ];
    }
    public function getAllProducts($currentPage = 1, $pageSize = 4){
        $dql = "SELECT prodotto
            FROM EProdotto prodotto
            WHERE prodotto.is_deleted = false";
        $query = getEntityManager()->createQuery($dql);
        $query->setFirstResult(($currentPage - 1) * $pageSize)
        ->setMaxResults($pageSize);

        $paginator = new Paginator($query, fetchJoinCollection: true);

        return [
        'prodotti' => iterator_to_array($paginator),
        'n_prodotti' => count($paginator),
        'currentPage' => $currentPage,
        'pageSize' => $pageSize,
        'totalPages' => ceil(count($paginator) / $pageSize)
        ];
    }
    public function getProductById($id, $currentPage = 1, $pageSize = 4){
        $dql= "SELECT prodotto 
        FROM EProdotto prodotto 
        WHERE prodotto.id_prodotto= ?1
        AND prodotto.is_deleted = false";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id);
        $query->setMaxResults(1);
        $query->setFirstResult(($currentPage - 1) * $pageSize)
        ->setMaxResults($pageSize);

        $paginator = new Paginator($query, fetchJoinCollection: true);

        return [
        'prodotti' => iterator_to_array($paginator),
        'n_prodotti' => count($paginator),
        'currentPage' => $currentPage,
        'pageSize' => $pageSize,
        'totalPages' => ceil(count($paginator) / $pageSize)
        ];
    
    }
}
?>
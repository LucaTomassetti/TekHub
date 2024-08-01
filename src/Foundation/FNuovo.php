<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Query\Parameter;

class FNuovo extends EntityRepository {
    public function insertProdottoNuovo(EProdotto $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function getAllNewSameCatProd($categoria, $currentPage = 1, $pageSize = 4){
        $dql = "SELECT nuovo
                FROM ENuovo nuovo
                JOIN nuovo.category_name categoria
                WHERE nuovo.category_name = ?1";
        $query = getEntityManager()->createQuery($dql)
        ->setParameter(1, $categoria)
        ->setFirstResult(($currentPage - 1) * $pageSize)
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
    public function getLatestNewProducts(){
        $dql = "SELECT nuovo.id_prodotto, nuovo.nome, nuovo.prezzo_fisso, categoria.nome_categoria
                FROM ENuovo nuovo
                JOIN nuovo.category_name categoria
                ORDER BY nuovo.id_prodotto DESC";
        $query = getEntityManager()->createQuery($dql)
        ->setMaxResults(4);
        return $query->getResult();
    }
    public function updateProdottoNuovo(ENuovo $prodotto, $array_data){
        $em = getEntityManager();
        $found_prodotto = $em->find(ENuovo::class, $prodotto->getIdProdotto());
        $found_prodotto->setNome($array_data['nome']);
        $found_prodotto->setDescrizione($array_data['descrizione']);
        $found_prodotto->setMarca($array_data['marca']);
        $found_prodotto->setModello($array_data['modello']);
        $found_prodotto->setColore($array_data['colore']);
        $found_prodotto->setPrezzoFisso($array_data['prezzo-nuovo']);
        $found_prodotto->setQuantitaDisp($array_data['quantita_disp']);
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
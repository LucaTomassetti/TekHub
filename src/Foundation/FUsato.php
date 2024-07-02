<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FUsato extends EntityRepository {
    public function insertProdottoUsato(EUsato $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function getAllUsedProducts(EVenditore $venditore){
        $dql = "SELECT DISTINCT usato.id_prodotto, usato.nome, categoria.nome_categoria, usato.floor_price 
            FROM EUsato usato 
            JOIN usato.category_name categoria
            WHERE usato.venditore = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $venditore);
        return $query->getResult();
    }
}
?>
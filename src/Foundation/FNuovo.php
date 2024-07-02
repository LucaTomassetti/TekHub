<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FNuovo extends EntityRepository {
    public function insertProdottoNuovo(EProdotto $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function getAllNewProducts(EVenditore $venditore){
        $dql = "SELECT DISTINCT nuovo.id_prodotto, nuovo.nome, categoria.nome_categoria, nuovo.prezzo_fisso 
            FROM ENuovo nuovo 
            JOIN nuovo.category_name categoria
            WHERE nuovo.venditore = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $venditore);
        return $query->getResult();
    }
}
?>
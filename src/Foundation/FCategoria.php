<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FCategoria extends EntityRepository {
    public function getAllCategories(){
        $dql = "SELECT categoria FROM ECategoria categoria";
        $query = getEntityManager()->createQuery($dql);
        return $query->getResult();
    }
    public function findCategoria($categoria){
        $dql = "SELECT categoria FROM ECategoria categoria WHERE categoria.nome_categoria = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $categoria);
        $query->setMaxResults(1);
        return $query->getResult();
    }
}
?>
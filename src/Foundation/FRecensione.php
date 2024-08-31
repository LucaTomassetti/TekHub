<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FRecensione extends EntityRepository {

    public function findRecensioneByID($id){
        $dql="SELECT recensione FROM ERecensione recensione WHERE recensione.id=?1";
        $query=getEntityManager()->createQuery();
        $query->setParameter(1,$id);
        $query->setMaxResults(1);
        return $query->getResult();
    }

}
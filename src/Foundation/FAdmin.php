<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FAdmin extends EntityRepository{

    public function findAdmin($email){
        $dql = "SELECT a FROM EAdmin a WHERE a.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function findAdminById($id){
        $dql = "SELECT a FROM EAdmin a WHERE a.id_admin = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id);
        $query->setMaxResults(1);
        return $query->getResult();
    }

}
<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FVenditore extends EntityRepository {

    public function findVenditore($email){
        $dql = "SELECT venditore FROM EVenditore venditore WHERE venditore.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function insertNewVenditore(EVenditore $cliente){
        $em = getEntityManager();
        $em->persist($cliente);
        $em->flush();
    }

}
?>
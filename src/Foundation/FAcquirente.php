<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FAcquirente extends EntityRepository {

    public function findAcquirente($email){
        $dql = "SELECT acquirente FROM EAcquirente acquirente WHERE acquirente.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function insertNewCliente(EAcquirente $cliente){
        $em = getEntityManager();
        $em->persist($cliente);
        $em->flush();
    }

}
?>
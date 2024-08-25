<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FIndirizzo extends EntityRepository {
    public function findIndirizzo($indirizzo, $cap){
        $dql = "SELECT indirizzo FROM EIndirizzo indirizzo WHERE indirizzo.indirizzo = ?1 AND indirizzo.cap = ?2";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $indirizzo);
        $query->setParameter(2, $cap);
        $query->setMaxResults(1);
        return $query->getResult();
    }

    public function insertIndirizzo($array_data){
        $new_indirizzo = new EIndirizzo($array_data['via'], $array_data['cap']);
        $em = getEntityManager();
        $found_cliente = $em->find(EAcquirente::class, $_SESSION['utente']->getId());
        $new_indirizzo->setClienteResidente($found_cliente);
        $em->persist($new_indirizzo);
        $em->flush();
    }

    public function getAllIndirizziUtente($idUtente)
    {
        return getEntityManager()->createQueryBuilder('i')
            ->select('i')
            ->from(EIndirizzo::class, 'i')  // Aggiunta esplicita della clausola FROM
            ->where('i.cliente_residente = :idUtente')
            ->setParameter('idUtente', $idUtente)
            ->orderBy('i.is_deleted', 'ASC')
            ->addOrderBy('i.indirizzo', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function deleteIndirizzo(EIndirizzo $indirizzo) {
        $em = getEntityManager();
        $found_indirizzo = $em->find(EIndirizzo::class, [
            'indirizzo' => $indirizzo->getIndirizzo(),
            'cap' => $indirizzo->getCap()
        ]);
        $em->remove($found_indirizzo);
        $em->flush();
    }

    public function findAllActive()
    {
        return getEntityManager()->createQueryBuilder('i')
            ->where('i.is_deleted = :isDeleted')
            ->setParameter('isDeleted', false)
            ->getQuery()
            ->getResult();
    }

    public function softDelete(EIndirizzo $indirizzo)
    {
        $indirizzo->setDeleted(true);
        getEntityManager()->flush();
    }

    public function canBeHardDeleted($indirizzo, $cap): bool
    {
        $qb = getEntityManager()->createQueryBuilder();
        $count = $qb->select('COUNT(o.id_ordine)')
            ->from('EOrdine', 'o')
            ->join('o.indirizzo_spedizione', 'i')
            ->where('i.indirizzo = :indirizzo')
            ->andWhere('i.cap = :cap')
            ->setParameter('indirizzo', $indirizzo)
            ->setParameter('cap', $cap)
            ->getQuery()
            ->getSingleScalarResult();

        return $count === 0;
    }
}
?>

<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FCartaDiCredito extends EntityRepository {
    public function findCarta($numeroCarta){
        $dql = "SELECT carta FROM ECartaDiCredito carta WHERE carta.numero_carta = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $numeroCarta);
        $query->setMaxResults(1);
        return $query->getResult();
    }

    public function insertCarta($array_data){
        $new_carta = new ECartaDiCredito($array_data['nome'], $array_data['cognome'], $array_data['scadenza'], $array_data['numeroCarta'], $array_data['ccv'], $array_data['gestore']);
        $em = getEntityManager();
        $found_cliente = $em->find(EAcquirente::class, $_SESSION['utente']->getId());
        $new_carta->setProprietario($found_cliente);
        $em->persist($new_carta);
        $em->flush();
    }

    public function getAllCarteUtente($idUtente)
    {
        return getEntityManager()->createQueryBuilder('c')
            ->select('c')
            ->from(ECartaDiCredito::class, 'c')  // Aggiunta esplicita della clausola FROM
            ->where('c.proprietario = :idUtente')
            ->setParameter('idUtente', $idUtente)
            ->orderBy('c.is_deleted', 'ASC')
            ->addOrderBy('c.numero_carta', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function deleteCarta(ECartaDiCredito $carta) {
        $em = getEntityManager();
        $found_carta = $em->find(ECartaDiCredito::class, $carta->getNumero_carta());
        $em->remove($found_carta);
        $em->flush();
    }

    public function findAllActive()
    {
        return getEntityManager()->createQueryBuilder('c')
            ->where('c.is_deleted = :isDeleted')
            ->setParameter('isDeleted', false)
            ->getQuery()
            ->getResult();
    }

    public function softDelete(ECartaDiCredito $carta)
    {
        $carta->setDeleted(true);
        getEntityManager()->flush();
    }

    public function canBeHardDeleted($numeroCarta): bool
    {
        $qb = getEntityManager()->createQueryBuilder();
        $count = $qb->select('COUNT(o.id_ordine)')
            ->from('EOrdine', 'o')
            ->where('o.carta_ordine = :numeroCarta')
            ->setParameter('numeroCarta', $numeroCarta)
            ->getQuery()
            ->getSingleScalarResult();

        return $count === 0;
    }
}
?>
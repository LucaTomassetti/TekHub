<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FImmagine extends EntityRepository {
    public function insertImmagine(EImmagine $immagine){
        $em = getEntityManager();
        $em->persist($immagine);
        $em->flush();
    }
    public function findImage($image){
        $dql = "SELECT immagine FROM EImmagine immagine WHERE immagine.id_image = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $image);
        $query->setMaxResults(1);
        return $query->getResult();
    }

}
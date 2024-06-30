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
    public function findLastIdImage(){
        $dql = 'SELECT immagine.id_image FROM EImmagine immagine ORDER BY immagine.id_image DESC';
        $result = getEntityManager()->createQuery($dql)
                    ->setMaxResults(1)
                    ->getOneOrNullResult();
        return $result ? $result['id_image'] : null;
    }
    public function findImage($image){
        $dql = "SELECT immagine FROM EImmagine immagine WHERE immagine.id_image = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $image);
        $query->setMaxResults(1);
        return $query->getResult();
    }

}
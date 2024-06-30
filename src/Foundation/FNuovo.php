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
}
?>
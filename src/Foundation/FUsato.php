<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FUsato extends EntityRepository {
    public function insertProdottoUsato(EUsato $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
}
?>
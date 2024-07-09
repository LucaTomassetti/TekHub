<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FAsta extends EntityRepository {
    public function updateVendAsta(EUsato $prodotto, EVenditore $venditore){
        $em = getEntityManager();
        $found_prodotto = $em->find(EUsato::class, $prodotto->getIdProdotto());
        $found_prodotto->getAsta()->setVenditore($venditore);
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
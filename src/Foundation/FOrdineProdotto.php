<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FOrdineProdotto extends EntityRepository {
    public function aggiungiProdottoOrdine(EOrdine $ordine, EProdotto $prodotto, $quantita) {
        $em = $this->getEntityManager();
        $ordineProdotto = new EOrdineProdotto();
        $ordineProdotto->setOrdineId($ordine);
        $ordineProdotto->setProdottoId($prodotto);
        $ordineProdotto->setQuantitaOrdinataProdotto($quantita);
        
        $em->persist($ordineProdotto);
        $em->flush();
        
        return $ordineProdotto;
    }
}
?>
<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FProdotto extends EntityRepository {
    public function insertNewProdotto(EProdotto $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function deleteProdotto(EProdotto $prodotto) {
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $em->remove($found_prodotto);
        $em->flush();
    }
    public function updateProdotto(EProdotto $prodotto, $array_data){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $found_prodotto->setTitolo($array_data['titolo']);
        $found_prodotto->setNome($array_data['titolo']);
        $found_prodotto->setDescrizione($array_data['descrizione']);
        $found_prodotto->setImmagini($array_data['immagini']);
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
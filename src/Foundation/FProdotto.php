<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FProdotto extends EntityRepository {
    public function insertProdotto(EProdotto $prodotto){
        $em = getEntityManager();
        $em->persist($prodotto);
        $em->flush();
    }
    public function findLastId(){
        $dql = 'SELECT prodotto.id_prodotto FROM EProdotto prodotto ORDER BY prodotto.id_prodotto DESC';
        $result = getEntityManager()->createQuery($dql)
                    ->setMaxResults(1)
                    ->getOneOrNullResult();
        return $result ? $result['id_prodotto'] : null;
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
    public function getAllProducts(){
        $dql = "SELECT prodotto FROM EProdotto prodotto";
        $query = getEntityManager()->createQuery($dql);
        return $query->getResult();
    }
    public function updateImageProdotto(EProdotto $prodotto, EImmagine $immagine){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $found_image =  $em->find(EImmagine::class, $immagine->getIdImage());
        $found_prodotto->addImage($found_image);
        $found_image->setProdotto($found_prodotto);
        $em->persist($found_prodotto);
        $em->flush();
    }
    public function updateVendCatProdotto(EProdotto $prodotto, EVenditore $venditore, ECategoria $categoria){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $prodotto->getIdProdotto());
        $found_venditore = $em->find(EVenditore::class, $venditore->getIdVenditore());
        $found_categoria = $em->find(ECategoria::class, $categoria->getNomeCategoria());
        $found_venditore->setIdVenditore($venditore->getIdVenditore()+1);
        $found_prodotto->setVenditore($found_venditore);
        $found_prodotto->setCategoryName($found_categoria);
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
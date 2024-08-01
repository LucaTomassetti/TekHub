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
    public function getAllImages(EProdotto $prodotto){
        $dql = "SELECT immagine
            FROM EImmagine immagine
            WHERE immagine.prodotto = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $prodotto);
        $tmp_immagini = $query->getArrayResult();
        foreach($tmp_immagini as $immagine){
            //Poiché $array_immagini[0]['imageData'] contiene l'id della Risorsa, uso
            //la funzione stream_get_contents($array_immagini[0]['imageData']) per 
            //riottenere la stringa base64 memorizzata nel database per poi
            //assegnarla di nuovo all'array 
            $immagine['imageData'] = stream_get_contents($immagine['imageData']);
            $array_immagini[] = $immagine;
        }
        return $array_immagini;
    }
    public function getAllObjectImages(EProdotto $prodotto){
        $dql = "SELECT immagine
            FROM EImmagine immagine
            WHERE immagine.prodotto = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $prodotto);
        return $query->getResult();
    }
    public function deleteAllImages($productId){
        $em = getEntityManager();
        $found_prodotto = $em->find(EProdotto::class, $productId);
        $found_images = self::getAllObjectImages($found_prodotto);
        foreach($found_images as $image){
            $em->remove($image);
        }
        $em->flush();
    }
}
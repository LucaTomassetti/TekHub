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
    public function getAllNewProducts(EVenditore $venditore){
        $dql = "SELECT DISTINCT nuovo.id_prodotto, nuovo.nome, categoria.nome_categoria, nuovo.prezzo_fisso 
            FROM ENuovo nuovo 
            JOIN nuovo.category_name categoria
            WHERE nuovo.venditore = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $venditore);
        return $query->getResult();
    }
    public function updateProdottoNuovo(ENuovo $prodotto, $array_data){
        $em = getEntityManager();
        $found_prodotto = $em->find(ENuovo::class, $prodotto->getIdProdotto());
        $found_prodotto->setNome($array_data['nome']);
        $found_prodotto->setDescrizione($array_data['descrizione']);
        $found_prodotto->setMarca($array_data['marca']);
        $found_prodotto->setModello($array_data['modello']);
        $found_prodotto->setColore($array_data['colore']);
        $found_prodotto->setPrezzoFisso($array_data['prezzo-nuovo']);
        $found_prodotto->setQuantitaDisp($array_data['quantita_disp']);
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
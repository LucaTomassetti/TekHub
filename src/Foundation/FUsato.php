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
    public function getAllUsedProducts(EVenditore $venditore){
        $dql = "SELECT DISTINCT usato.id_prodotto, usato.nome, categoria.nome_categoria, usato.floor_price 
            FROM EUsato usato 
            JOIN usato.category_name categoria
            WHERE usato.venditore = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $venditore);
        return $query->getResult();
    }
    public function updateProdottoUsato(EUsato $prodotto, $array_data){
        $em = getEntityManager();
        $found_prodotto = $em->find(EUsato::class, $prodotto->getIdProdotto());
        $found_prodotto->setNome($array_data['nome']);
        $found_prodotto->setDescrizione($array_data['descrizione']);
        $found_prodotto->setMarca($array_data['marca']);
        $found_prodotto->setModello($array_data['modello']);
        $found_prodotto->setColore($array_data['colore']);
        //In teoria il prezzo di partenza non può essere modificato nel tempo visto
        //che vengono effettuate poi delle offerte
        //$found_prodotto->setFloorPrice($array_data['prezzo-asta']);
        //Visto che nel DB si modificava anche la data di inizio con la data attuale dopo
        //aver inviato la form di modifica, controllo se $array_data['data-inizio-asta'] esiste
        //(se non esiste significa che mi trovo nella form di modifica altrimenti mi trovo
        //nella form di aggiunta dei prodotti e quindi devo settare la data di inizio)
        if(isset($array_data['data-inizio-asta'])){
            $found_prodotto->getAsta()->setDataCreazione(new DateTimeImmutable($array_data['data-inizio-asta']));
        }
        $found_prodotto->getAsta()->setDataFine(new DateTimeImmutable($array_data['data-fine-asta']));
        $em->persist($found_prodotto);
        $em->flush();
    }
}
?>
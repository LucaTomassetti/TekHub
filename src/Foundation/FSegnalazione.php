<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FSegnalazione extends EntityRepository {

    public function findSegnalazione($id){
        $dql= "SELECT segnalazione FROM ESegnalazione segnalazione WHERE segnalazione.id_segnalazione=?1";
        $query=getEntityManager()->createQuery();
        $query->SetParameter(1,$id);
        $query->setMaxResults(1);
        return $query->getResult();   
    }

    public function deleteSegnalazione($id){
        $entityManager = $this->getEntityManager();
        $segnalazione = $this->find($id);
        if ($segnalazione) {
            $entityManager->remove($segnalazione);
            $entityManager->flush();
            return true;
        }
        return false;
    }



}
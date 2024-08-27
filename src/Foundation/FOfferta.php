<?php

use Doctrine\ORM\EntityRepository;

class FOfferta extends EntityRepository {
    
    public function insertOfferta(EUsato $prodotto, $importo, $acquirenteId) {
        $em = $this->getEntityManager();
        
        $acquirente = $em->getReference(EAcquirente::class, $acquirenteId);
        
        $offerta = new EOfferta($importo, new \DateTime());
        $offerta->setAcquirente($acquirente);
        $offerta->setProdotto($prodotto);
        $offerta->setStato('In attesa');

        $em->persist($offerta);
        $em->flush();

        return $offerta;
    }

    public function getUltimaOffertaValida(EUsato $prodotto) {
        return $this->findOneBy(
            ['prodotto' => $prodotto],
            ['importo' => 'DESC']
        );
    }

    public function getOfferteUtente(EAcquirente $acquirente) {
        return $this->findBy(
            ['acquirente' => $acquirente],
            ['data' => 'DESC']
        );
    }

    public function aggiornaStatoOfferte(EUsato $prodotto) {
        $offerte = $this->findBy(['prodotto' => $prodotto], ['importo' => 'DESC']);
        $asta = $prodotto->getAsta();
        
        foreach ($offerte as $key => $offerta) {
            if ($asta->getStatoAsta() == 'Terminata') {
                if ($key === 0) {
                    $offerta->setStato('Prodotto aggiudicato');
                } else {
                    $offerta->setStato('Persa');
                }
            } else {
                if ($key === 0) {
                    $offerta->setStato('Vincente');
                } else {
                    $offerta->setStato('Superata');
                }
            }
            getEntityManager()->persist($offerta);
        }
        getEntityManager()->flush();
    }

    public function getOffertaUtentePerAsta(EUsato $prodotto, $acquirenteId) {
        return $this->findOneBy([
            'prodotto' => $prodotto,
            'acquirente' => $acquirenteId
        ]);
    }

    public function aggiornaOfferta(EOfferta $offerta, $nuovoImporto) {
        $offerta->setImporto($nuovoImporto);
        $offerta->setData(new \DateTime());
        $offerta->setStato('In attesa');
        $this->getEntityManager()->flush();
        return $offerta;
    }

}

?>
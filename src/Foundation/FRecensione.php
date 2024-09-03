<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FRecensione extends EntityRepository {

    public function findRecensioneByID($id){
        $dql="SELECT recensione FROM ERecensione recensione WHERE recensione.id=?1";
        $query=getEntityManager()->createQuery();
        $query->setParameter(1,$id);
        $query->setMaxResults(1);
        return $query->getResult();
    }

    public function getRecensioniVenditore($venditore, $page = 1, $itemsPerPage = 4) {
        $qb = $this->createQueryBuilder('r')
            ->join('r.prodotto', 'p')
            ->where('p.venditore = :venditore')
            ->setParameter('venditore', $venditore);
    
        $totalItems = count($qb->getQuery()->getResult());
    
        $qb->setFirstResult(($page - 1) * $itemsPerPage)
           ->setMaxResults($itemsPerPage);
    
        $items = $qb->getQuery()->getResult();
    
        return [
            'items' => $items,
            'n_recensioni' => $totalItems,
            'currentPage' => $page,
            'itemsPerPage' => $itemsPerPage,
            'totalPages' => ceil($totalItems / $itemsPerPage)
        ];
    }

    public function getRecensioniProdotto($prodotto, $page = 1, $itemsPerPage = 5) {
        $qb = $this->createQueryBuilder('r')
            ->where('r.prodotto = :prodotto')
            ->setParameter('prodotto', $prodotto);

        $totalItems = count($qb->getQuery()->getResult());

        $qb->setFirstResult(($page - 1) * $itemsPerPage)
           ->setMaxResults($itemsPerPage);

        $items = $qb->getQuery()->getResult();

        return [
            'items' => $items,
            'n_recensioni' => $totalItems,
            'currentPage' => $page,
            'itemsPerPage' => $itemsPerPage,
            'totalPages' => ceil($totalItems / $itemsPerPage)
        ];
    }

    public function haAcquistatoProdotto($idProdotto) {
        $em = getEntityManager();
        $found_cliente = $em->find(EAcquirente::class, $_SESSION['utente']->getId());
        $qb = $em->createQueryBuilder();
        $result = $qb->select('COUNT(DISTINCT o.id_ordine)')
        ->from('EOrdine', 'o')
        ->join('o.q_prodotto_ordine', 'op')
        ->where('op.prodotto_id = :prodotto')
        ->andWhere('o.acquirente = :cliente')
        ->setParameter('prodotto', $idProdotto)
        ->setParameter('cliente', $found_cliente)
        ->getQuery()
        ->getSingleScalarResult();

        return $result > 0;  // Restituisce true se il cliente ha acquistato il prodotto, false altrimenti
    }
    public function getRecensioneUtente($acquirente, $prodotto) {
        $em = getEntityManager();
        return $em->getRepository('ERecensione')->findOneBy([
            'acquirente' => $acquirente,
            'prodotto' => $prodotto
        ]);
    }
    public function getSegnalazioniNonGestite() {
        return getEntityManager()->getRepository(ESegnalazione::class)->findBy(['gestita' => false]);
    }

    public function aggiungiRecensione($recensione) {
        $em = getEntityManager();
        $em->persist($recensione);
        $em->flush();
    }

    public function aggiungiSegnalazione($segnalazione) {
        $em = getEntityManager();
        $em->persist($segnalazione);
        $em->flush();
    }

    public function gestisciSegnalazione($segnalazione, $azione) {
        $segnalazione->setGestita(true);
        if ($azione === 'blocca') {
            $acquirente = $segnalazione->getRecensione()->getAcquirente();
            $acquirente->setBlocca(true);
        }
        getEntityManager()->flush();
    }

}
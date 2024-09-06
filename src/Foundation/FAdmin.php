<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FAdmin extends EntityRepository{

    public function findAdmin($email){
        $dql = "SELECT a FROM EAdmin a WHERE a.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function findAdminById($id){
        $dql = "SELECT a FROM EAdmin a WHERE a.id_admin = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function updatePass(EAdmin $admin, $new_password){
        $em = getEntityManager();
        $found_admin = $em->find(EAdmin::class, $admin->getId());
        $found_admin->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
         //Aggiorno la sessione
         $_SESSION['utente']->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
        $em->persist($found_admin);
        $em->flush();
    }
    public function updateAdmin(EAdmin $cliente, $array_data){
        $em = getEntityManager();
        $found_cliente = $em->find(EAdmin::class, $cliente->getId());
        $found_cliente->setNome($array_data['nome']);
        $found_cliente->setCognome($array_data['cognome']);
        //Aggiorno la sessione
        $_SESSION['utente']->setNome($array_data['nome']);
        $_SESSION['utente']->setCognome($array_data['cognome']);
        $em->persist($found_cliente);
        $em->flush();
    }
    public function deleteAdmin(EAdmin $admin) {
        $em = getEntityManager();
        $found_admin = $em->find(EAdmin::class, $admin->getId());
        $em->remove($found_admin);
        $em->flush();
    }

    public function softDeleteUtente($utente) {
        $em=getEntityManager();
        $utente->setDeleted(true);
        $em->persist($utente);
        $em->flush();
    }

    public function getAllUsersPaginated($page = 1, $itemsPerPage = 10) {
        $offset = ($page - 1) * $itemsPerPage;
        $limit = $itemsPerPage + 1;  // Richiediamo un elemento in più per determinare se c'è una pagina successiva
        
        $em = getEntityManager();
        
        // Query per gli acquirenti
        $qbAcquirenti = $em->createQueryBuilder();
        $qbAcquirenti->select('a.id_acquirente as id', 'a.nome', 'a.cognome', 'a.email', 'a.is_deleted', 'a.is_blocked', "'acquirente' as tipo")
           ->from('EAcquirente', 'a')
           ->where('a.is_deleted = :isDeleted')
           ->setParameter('isDeleted', false)
           ->setMaxResults($limit)
           ->setFirstResult($offset)
           ->orderBy('a.id_acquirente', 'ASC');

        // Query per i venditori
        $qbVenditori = $em->createQueryBuilder();
        $qbVenditori->select('v.id_venditore as id', 'v.nome', 'v.cognome', 'v.email', 'v.is_deleted', 'v.is_blocked', "'venditore' as tipo")
           ->from('EVenditore', 'v')
           ->where('v.is_deleted = :isDeleted')
           ->setParameter('isDeleted', false)
           ->setMaxResults($limit)
           ->setFirstResult($offset)
           ->orderBy('v.id_venditore', 'ASC');

        // Esecuzione delle query
        $acquirenti = $qbAcquirenti->getQuery()->getResult();
        $venditori = $qbVenditori->getQuery()->getResult();

        // Unione e ordinamento dei risultati
        $utenti = array_merge($acquirenti, $venditori);
        usort($utenti, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        // Tagliamo l'array al numero di elementi richiesti
        $hasMorePages = count($utenti) > $itemsPerPage;
        $utenti = array_slice($utenti, 0, $itemsPerPage);

        // Conteggio totale degli utenti (questa query verrà eseguita solo quando necessario)
        $totalItems = $this->getTotalUsersCount();

        return [
            'utenti' => $utenti,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $page,
            'totalPages' => ceil($totalItems / $itemsPerPage),
            'hasMorePages' => $hasMorePages
        ];
    }
    public function getFilteredUsersPaginated($id, $page = 1, $itemsPerPage = 10) {
        $offset = ($page - 1) * $itemsPerPage;
        $limit = $itemsPerPage + 1;  // Richiediamo un elemento in più per determinare se c'è una pagina successiva
        
        $em = getEntityManager();
        
        // Query per gli acquirenti
        $qbAcquirenti = $em->createQueryBuilder();
        $qbAcquirenti->select('a.id_acquirente as id', 'a.nome', 'a.cognome', 'a.email', 'a.is_deleted', 'a.is_blocked', "'acquirente' as tipo")
           ->from('EAcquirente', 'a')
           ->where('a.is_deleted = :isDeleted')
           ->andWhere('a.id_acquirente=:id')
           ->setParameter('isDeleted', false)
           ->setParameter('id',$id)
           ->setMaxResults($limit)
           ->setFirstResult($offset)
           ->orderBy('a.id_acquirente', 'ASC');

        // Query per i venditori
        $qbVenditori = $em->createQueryBuilder();
        $qbVenditori->select('v.id_venditore as id', 'v.nome', 'v.cognome', 'v.email', 'v.is_deleted', 'v.is_blocked', "'venditore' as tipo")
           ->from('EVenditore', 'v')
           ->where('v.is_deleted = :isDeleted')
           ->andWhere('v.id_venditore=:id')
           ->setParameter('isDeleted', false)
           ->setParameter('id',$id)
           ->setMaxResults($limit)
           ->setFirstResult($offset)
           ->orderBy('v.id_venditore', 'ASC');

        // Esecuzione delle query
        $acquirenti = $qbAcquirenti->getQuery()->getResult();
        $venditori = $qbVenditori->getQuery()->getResult();

        // Unione e ordinamento dei risultati
        $utenti = array_merge($acquirenti, $venditori);
        usort($utenti, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        // Tagliamo l'array al numero di elementi richiesti
        $hasMorePages = count($utenti) > $itemsPerPage;
        $utenti = array_slice($utenti, 0, $itemsPerPage);

        // Conteggio totale degli utenti (questa query verrà eseguita solo quando necessario)
        $totalItems = $this->getTotalUsersCount();

        return [
            'utenti' => $utenti,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $page,
            'totalPages' => ceil($totalItems / $itemsPerPage),
            'hasMorePages' => $hasMorePages
        ];
    }


    private function getTotalUsersCount() {
        $em = getEntityManager();

        $qbAcquirenti = $em->createQueryBuilder();
        $qbAcquirenti->select('COUNT(a.id_acquirente)')
           ->from('EAcquirente', 'a')
           ->where('a.is_deleted = :isDeleted')
           ->setParameter('isDeleted', false);

        $qbVenditori = $em->createQueryBuilder();
        $qbVenditori->select('COUNT(v.id_venditore)')
           ->from('EVenditore', 'v')
           ->where('v.is_deleted = :isDeleted')
           ->setParameter('isDeleted', false);

        $totalAcquirenti = $qbAcquirenti->getQuery()->getSingleScalarResult();
        $totalVenditori = $qbVenditori->getQuery()->getSingleScalarResult();

        return $totalAcquirenti + $totalVenditori;
    }

    public function getAllSegnalazioniPaginated($page = 1, $itemsPerPage = 5) {
        $offset = ($page - 1) * $itemsPerPage;
        $em = getEntityManager();
    
        // Query for paginated results
        $qb = $em->createQueryBuilder();
        $qb->select('s.id_segnalazione', 's.motivo', 'v.id_venditore as venditore_id', 'v.nome as venditore_nome')
           ->from('ESegnalazione', 's')
           ->leftJoin('s.venditore', 'v')
           ->where('s.gestita=false')
           ->setFirstResult($offset)
           ->setMaxResults($itemsPerPage)
           ->orderBy('s.id_segnalazione', 'ASC');
    
        $query = $qb->getQuery();
    
        // Simplified count query
        $countQb = $em->createQueryBuilder();
        $countQb->select('COUNT(s.id_segnalazione)')
                ->from('ESegnalazione', 's')
                ->where('s.gestita=false');
        
        $totalItems = $countQb->getQuery()->getSingleScalarResult();
    
        // Calculate total pages
        $totalPages = ceil($totalItems / $itemsPerPage);
    
        // Get the results as an array
        $items = $query->getArrayResult();
    
        return [
            'items' => $items,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ];
    }
    public function findSegnalazioniByVenditoreId($idVenditore,$page = 1, $itemsPerPage = 5){
        $offset = ($page - 1) * $itemsPerPage;
        $em = getEntityManager();
    
        // Query for paginated results
        $qb = $em->createQueryBuilder();
        $qb->select('s.id_segnalazione', 's.motivo', 'v.id_venditore as venditore_id', 'v.nome as venditore_nome')
           ->from('ESegnalazione', 's')
           ->leftJoin('s.venditore', 'v')
           ->where('s.gestita=false')
           ->andWhere('s.venditore=:venditore')
           ->setParameter('venditore', $idVenditore)
           ->setFirstResult($offset)
           ->setMaxResults($itemsPerPage)
           ->orderBy('s.id_segnalazione', 'ASC');
    
        $query = $qb->getQuery();
    
        // Simplified count query
        $countQb = $em->createQueryBuilder();
        $countQb->select('COUNT(s.id_segnalazione)')
                ->from('ESegnalazione', 's')
                ->where('s.gestita=false')
                ->andWhere('s.venditore=:venditore')
                ->setParameter('venditore', $idVenditore);
                
        $totalItems = $countQb->getQuery()->getSingleScalarResult();
    
        // Calculate total pages
        $totalPages = ceil($totalItems / $itemsPerPage);
    
        // Get the results as an array
        $items = $query->getArrayResult();
    
        return [
            'items' => $items,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ];

    }
    public function risolviSegnalazione($id_segnalazione){
        $em=getEntityManager();
        $found_segnalazione = $em->find(ESegnalazione::class, $id_segnalazione);
        $found_segnalazione->setGestita(true);

        $em->persist($found_segnalazione);
        $em->flush();
    }

}
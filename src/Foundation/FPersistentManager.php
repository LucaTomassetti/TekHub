<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FPersistentManager{

    /**
     * Singleton Class
     */
     private static $instance;
     private $repositories = [];


     private function __construct(){


     }

     public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get the repository for an entity.
     *
     * @param string $entityClass
     * @return EntityRepository
     */
    public function getRepository(string $entityClass): EntityRepository
    {
        if (!isset($this->repositories[$entityClass])) {
            $this->repositories[$entityClass] = getEntityManager()->getRepository($entityClass);
        }

        return $this->repositories[$entityClass];
    }

    /**
     * Persist an entity.
     *
     * @param object $entity
     */
    public function persist($entity): void
    {
       getEntityManager()->persist($entity);
    }

    /**
     * Remove an entity.
     *
     * @param object $entity
     */
    public function remove($entity): void
    {
       getEntityManager()->remove($entity);
    }

    /**
     * Flush the changes to the database.
     */
    public function flush(): void
    {
       getEntityManager()->flush();
    }

    /**
     * Clear the EntityManager.
     */
    public function clear(): void
    {
       getEntityManager()->clear();
    }

    /**
     * Find an entity by its identifier.
     *
     * @param string $entityClass
     * @param mixed $id
     * @return object|null
     */
    public function find(string $entityClass, $id)
    {
        return $this->getRepository($entityClass)->find($id);
    }

    /**
     * Find all entities of a class.
     *
     * @param string $entityClass
     * @return array
     */
    public function findAll(string $entityClass): array
    {
        return $this->getRepository($entityClass)->findAll();
    }

    /**
     * Find entities by criteria.
     *
     * @param string $entityClass
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function findBy(string $entityClass, array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->getRepository($entityClass)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Find one entity by criteria.
     *
     * @param string $entityClass
     * @param array $criteria
     * @return object|null
     */
    public function findOneBy(string $entityClass, array $criteria)
    {
        return $this->getRepository($entityClass)->findOneBy($criteria);
    }
    public function refresh($entity){
        getEntityManager()->refresh($entity);
    }
    public function findUtente($utente){
        /** Se $cliente è un oggetto richiamerà findCliente($cliente->getEmail())
         * altrimenti se è una stringa (cioè se è una email) richiamerà findCliente($cliente)
         */
        if($utente instanceof EAcquirente){
            if(is_object($utente)){
                return getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente->getEmail());
            }else if(is_string($utente)){
                return getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente);
            }else{
                return null;
            }
        }else if($utente instanceof EVenditore){
            if(is_object($utente)){
                return getEntityManager()->getRepository('EVenditore')->findVenditore($utente->getEmail());
            }else if(is_string($utente)){
                return getEntityManager()->getRepository('EVenditore')->findVenditore($utente);
            }else{
                return null;
            }
        } elseif($utente instanceof EAdmin){
            if(is_object($utente)){
                return getEntityManager()->getRepository('EAdmin')->findAdmin($utente->getEmail());
            }else if(is_string($utente)){
                return getEntityManager()->getRepository('EAdmin')->findAdmin($utente);
            }else{
                return null;
            }    
        }else if(is_string($utente)){
            if(getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente) != null){
                return getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente);
            }else if(getEntityManager()->getRepository('EVenditore')->findVenditore($utente) != null){
                return getEntityManager()->getRepository('EVenditore')->findVenditore($utente);
            }else if(getEntityManager()->getRepository('EAdmin')->findAdmin($utente)!= null){
                return getEntityManager()->getRepository('EAdmin')->findAdmin($utente);
            }else{
                return null;
            }       
        }
    }
    public function findAcquirenteById($id){
        return getEntityManager()->getRepository('EAcquirente')->findAcquirenteById($id);
    }
    public function findVenditoreById($id){
        return getEntityManager()->getRepository('EVenditore')->findVenditoreById($id);
    }
    public function findAdminById($id){
        return getEntityManager()->getRepository('EAdmin')->findAdminById($id);
    }

    public function insertNewUtente($new_utente){
        if($new_utente instanceof EAcquirente){
            getEntityManager()->getRepository('EAcquirente')->insertNewAcquirente($new_utente);
        }else if($new_utente instanceof EVenditore){
            getEntityManager()->getRepository('EVenditore')->insertNewVenditore($new_utente);
        } 
        
    }
    public function updatePass($utente, $new_password){
        if($utente instanceof EAcquirente){
            getEntityManager()->getRepository('EAcquirente')->updatePass($utente, $new_password);
        }else if($utente instanceof EVenditore){
            getEntityManager()->getRepository('EVenditore')->updatePass($utente, $new_password);
        }else if($utente instanceof EAdmin){
            getEntityManager()->getRepository('EAdmin')->updatePass($utente, $new_password);
        } 
    }
    public function updateUtente($utente, $array_data){
        if($utente instanceof EAcquirente){
            getEntityManager()->getRepository('EAcquirente')->updateAcquirente($utente, $array_data);
        }else if($utente instanceof EVenditore){
            getEntityManager()->getRepository('EVenditore')->updateVenditore($utente, $array_data);
        } 
    }
    public function deleteUtente($utente){
        if($utente instanceof EAcquirente){
            getEntityManager()->getRepository('EAcquirente')->deleteAcquirente($utente);
        }else if($utente instanceof EVenditore){
            getEntityManager()->getRepository('EVenditore')->deleteVenditore($utente);
        }else if($utente instanceof EAdmin){
            getEntityManager()->getRepository('EAdmin')->deleteAdmin($utente);
        } 
    }
    public function updateProdotto($prodotto, $array_data){
        if($prodotto instanceof ENuovo){
            getEntityManager()->getRepository('ENuovo')->updateProdottoNuovo($prodotto, $array_data);
        }else if($prodotto instanceof EUsato){
            getEntityManager()->getRepository('EUsato')->updateProdottoUsato($prodotto, $array_data);
        } 
    }
    public function getAllProducts($currentPage){
        return getEntityManager()->getRepository('EProdotto')->getAllProducts($currentPage);
    }
    public function getAllProductsByVend(EVenditore $venditore, $page, $filtri){
        return getEntityManager()->getRepository('EProdotto')->getAllProductsByVend($venditore, $page, $filtri);
    }
    public function getAllNewSameCatProd($categoria, $currentPage){
        return getEntityManager()->getRepository('ENuovo')->getAllNewSameCatProd($categoria, $currentPage);
    }
    public function getAllUsedSameCatProd($categoria, $currentPage){
        return getEntityManager()->getRepository('EUsato')->getAllUsedSameCatProd($categoria, $currentPage);
    }
    public function getAllSameCatProducts($categoria, $id_prodotto, $currentPage){
        $prod = FPersistentManager::getInstance()->find(EProdotto::class, $id_prodotto);
        if($prod instanceof ENuovo){
            $all_prodotti_nuovi = FPersistentManager::getInstance()->getAllNewSameCatProd($categoria, $currentPage);
            foreach($all_prodotti_nuovi['prodotti'] as $key => $prodotto_nuovo){
                if($prodotto_nuovo->getIdProdotto() == $id_prodotto){
                    unset($all_prodotti_nuovi['prodotti'][$key]);
                }
            }
            // Riorganizzo l'array visto che ho un buco in quello originale
            $all_prodotti_nuovi['prodotti'] = array_values($all_prodotti_nuovi['prodotti']);
            return $all_prodotti_nuovi;
        } else if ($prod instanceof EUSato){
            $all_prodotti_usati = FPersistentManager::getInstance()->getAllUsedSameCatProd($categoria, $currentPage);
            foreach($all_prodotti_usati['prodotti'] as $key => $prodotto_usato){
                if($prodotto_usato->getIdProdotto() == $id_prodotto){
                    unset($all_prodotti_usati['prodotti'][$key]);
                }
            }
            // Riorganizzo l'array visto che ho un buco in quello originale
            $all_prodotti_usati['prodotti'] = array_values($all_prodotti_usati['prodotti']);
            return $all_prodotti_usati;
        }
    }
    public function getLatestNewProducts(){
        return getEntityManager()->getRepository('ENuovo')->getLatestNewProducts();
    }
    public function getLatestProductsHome(){

        $array_prodotti = FPersistentManager::getInstance()->getLatestNewProducts();
    
        for($i = 0; $i < sizeof($array_prodotti); $i++){
            $prod_item = FPersistentManager::getInstance()->find(EProdotto::class,$array_prodotti[$i]['id_prodotto']);
            $array_immagini = FPersistentManager::getInstance()->getAllImages($prod_item);
            foreach($array_immagini as $immagine) {
                $array_prodotti[$i]['images'] = $immagine;
            }
        }
        return $array_prodotti;
    }
    public function getAllCategories(){
        return getEntityManager()->getRepository('ECategoria')->getAllCategories();
    }
    public function getAllImages($prodotto){
        return getEntityManager()->getRepository('EImmagine')->getAllImages($prodotto);
    }
    public function insertProdotto($prodotto){
        getEntityManager()->getRepository('EProdotto')->insertProdotto($prodotto);
    }
    public function insertProdottoNuovo($prodotto){
        getEntityManager()->getRepository('ENuovo')->insertProdottoNuovo($prodotto);
    }
    public function insertProdottoUsato($prodotto){
        getEntityManager()->getRepository('EUsato')->insertProdottoUsato($prodotto);
    }
    public function insertImmagine($immagine){
        getEntityManager()->getRepository('EImmagine')->insertImmagine($immagine);
    }
    public function findCategoria($categoria){
        return getEntityManager()->getRepository('ECategoria')->findCategoria($categoria);
    }
    public function findImage($image){
        return getEntityManager()->getRepository('EImmagine')->findImage($image);
    }
    public function updateVendCatProdotto($prodotto, $venditore, $categoria){
        getEntityManager()->getRepository('EProdotto')->updateVendCatProdotto($prodotto, $venditore, $categoria);
    }
    public function updateImageProdotto($prodotto, $immagine){
        getEntityManager()->getRepository('EProdotto')->updateImageProdotto($prodotto,$immagine);
    }
    public function deleteProdotto($prodotto){
        getEntityManager()->getRepository('EProdotto')->deleteProdotto($prodotto);
    }
    public function deleteAllImages($productId){
        getEntityManager()->getRepository('EImmagine')->deleteAllImages($productId);
    }
    public function updateVendAsta($prodotto, $venditore){
        getEntityManager()->getRepository('EAsta')->updateVendAsta($prodotto, $venditore);
    }
    
    //aggiunto per gestione Ordini in attesa
    public function getAllOrdini($venditore, $page){
        return getEntityManager()->getRepository('EOrdineProdotto')->getAllOrdini($venditore, $page);
    }

    public function creaOrdine($indirizzo, $cap, $carta_id, $carrello) {
        return getEntityManager()->getRepository('EOrdine')->creaOrdine($indirizzo, $cap, $carta_id, $carrello);
    }

    public function aggiungiProdottoOrdine(EOrdine $ordine, EProdotto $prodotto, $quantita) {
        return getEntityManager()->getRepository('EOrdineProdotto')->aggiungiProdottoOrdine($ordine, $prodotto, $quantita);
    }
    public function getAllIndirizziUtente(EAcquirente $acquirente) {
        return getEntityManager()->getRepository('EIndirizzo')->getAllIndirizziUtente($acquirente->getId());
    }

    public function getAllCarteUtente(EAcquirente $acquirente) {
        return getEntityManager()->getRepository('ECartaDiCredito')->getAllCarteUtente($acquirente->getId());
    }

    public function findIndirizzo($indirizzo, $cap) {
        return getEntityManager()->getRepository('EIndirizzo')->findIndirizzo($indirizzo, $cap);
    }

    public function findCarta($numeroCarta) {
        return getEntityManager()->getRepository('ECartaDiCredito')->findCarta($numeroCarta);
    }
    public function insertIndirizzo($array_data){
        getEntityManager()->getRepository('EIndirizzo')->insertIndirizzo($array_data);
    }
    public function deleteIndirizzo($indirizzo){
        getEntityManager()->getRepository('EIndirizzo')->deleteIndirizzo($indirizzo);
    }
    public function insertCartaDiCredito($array_data) {
        getEntityManager()->getRepository('ECartaDiCredito')->insertCarta($array_data);
    }

    public function deleteCartaDiCredito($numeroCarta) {
        getEntityManager()->getRepository('ECartaDiCredito')->deleteCarta($numeroCarta);
    }
    public function getOrdiniUtente(){
        return getEntityManager()->getRepository('EOrdine')->findOrdiniUtente($_SESSION['utente']->getId());
    }
    public function findCartaDiCredito($numero_carta){
        return getEntityManager()->getRepository('ECartaDiCredito')->findCarta($numero_carta);
    }
    public function findAllActiveIndirizzi() {
        return getEntityManager()->getRepository('EIndirizzo')->findAllActive();
    }

    public function softDeleteIndirizzo(EIndirizzo $indirizzo) {
        $indirizzo->setDeleted(true);
        getEntityManager()->flush();
    }

    public function canIndirizzoBeHardDeleted($indirizzo, $cap): bool {
        return getEntityManager()->getRepository('EIndirizzo')->canBeHardDeleted($indirizzo, $cap);
    }

    public function findAllActiveCarteDiCredito() {
        return getEntityManager()->getRepository('ECartaDiCredito')->findAllActive();
    }

    public function softDeleteCartaDiCredito(ECartaDiCredito $carta) {
        $carta->setDeleted(true);
        getEntityManager()->flush();
    }

    public function canCartaDiCreditoBeHardDeleted($numeroCarta): bool {
        return getEntityManager()->getRepository('ECartaDiCredito')->canBeHardDeleted($numeroCarta);
    }
    public function riattivaIndirizzo(EIndirizzo $indirizzo) {
        $indirizzo->setDeleted(false);
        getEntityManager()->flush();
    }

    public function riattivaCarta(ECartaDiCredito $carta) {
        $carta->setDeleted(false);
        getEntityManager()->flush();
    }
    public function cercaProdotti($query, $categoria) {
        $dql = "SELECT p FROM EProdotto p WHERE p.nome LIKE :query";
        if ($categoria) {
            $dql .= " AND p.category_name = :categoria";
        }
        $query = getEntityManager()->createQuery($dql)
            ->setParameter('query', '%' . $query . '%');
        if ($categoria) {
            $query->setParameter('categoria', $categoria);
        }
        return $query->getResult();
    }
    
    public function getProdottiFiltrati($filtri, $page = 1, $pageSize = 4) {
        $qb = getEntityManager()->createQueryBuilder();
        $qb->select('p')
           ->from('EProdotto', 'p')
           ->where('1 = 1');
    
        if ($filtri['query']) {
            $qb->andWhere('p.nome LIKE :query OR p.descrizione LIKE :query')
               ->setParameter('query', '%' . $filtri['query'] . '%');
        }
        if ($filtri['categoria']) {
            $qb->andWhere('p.category_name = :categoria')
               ->setParameter('categoria', $filtri['categoria']);
        }
        if ($filtri['marca']) {
            $qb->andWhere('p.marca = :marca')
               ->setParameter('marca', $filtri['marca']);
        }
    
        if (in_array('nuovo', $filtri['condizione'])) {
            $qb->andWhere('p INSTANCE OF ENuovo');
        }
        if (in_array('usato', $filtri['condizione'])) {
            $qb->andWhere('p INSTANCE OF EUsato');
        }
    
        $query = $qb->getQuery();
    
        $paginator = new Paginator($query, $fetchJoinCollection = true);
    
        $risultati = iterator_to_array($paginator);
    
        // Filtra i risultati per prezzo in PHP
        if ($filtri['prezzo_max']) {
            $risultati = array_filter($risultati, function($prodotto) use ($filtri) {
                if ($prodotto instanceof ENuovo) {
                    return $prodotto->getPrezzoFisso() <= $filtri['prezzo_max'];
                } elseif ($prodotto instanceof EUsato) {
                    return $prodotto->getFloorPrice() <= $filtri['prezzo_max'];
                }
                return false;
            });
        }
    
        $totalItems = count($risultati);
        $risultati = array_slice($risultati, ($page - 1) * $pageSize, $pageSize);
    
        return [
            'prodotti' => $risultati,
            'n_prodotti' => $totalItems,
            'currentPage' => $page,
            'itemsPerPage' => $pageSize,
            'totalPages' => ceil($totalItems / $pageSize),
        ];
    }
    
    public function getAllBrands() {
        $dql = "SELECT DISTINCT p.marca FROM EProdotto p";
        $query = getEntityManager()->createQuery($dql);
        $results = $query->getResult();
        return array_column($results, 'marca');
    }
    public function getOrdiniConProdottiVenditore(EVenditore $venditore, $currentPage = 1, $pageSize = 10) {
        return getEntityManager()->getRepository('EOrdine')->getOrdiniConProdottiVenditore($venditore, $currentPage, $pageSize);
    }

    public function findOrdineProdotto($ordineId, $prodottoId) {
        return getEntityManager()->getRepository('EOrdineProdotto')->findOrdineProdotto($ordineId, $prodottoId);
    }

    public function update($entity) {
        try {
            getEntityManager()->persist($entity);
            getEntityManager()->flush();
            return true;
        } catch (Exception $e) {
            // Log dell'errore
            error_log("Errore durante l'aggiornamento dell'entità: " . $e->getMessage());
            return false;
        }
    }
    public function insertOfferta(EUsato $prodotto, $importo, $acquirenteId) {
        return getEntityManager()->getRepository(EOfferta::class)->insertOfferta($prodotto, $importo, $acquirenteId);
    }
    
    public function getUltimaOffertaValida(EUsato $prodotto) {
        return getEntityManager()->getRepository(EOfferta::class)->getUltimaOffertaValida($prodotto);
    }
    
    public function getOfferteUtente(EAcquirente $acquirente) {
        return getEntityManager()->getRepository(EOfferta::class)->getOfferteUtente($acquirente);
    }
    
    public function aggiornaStatoOfferte(EUsato $prodotto) {
        getEntityManager()->getRepository(EOfferta::class)->aggiornaStatoOfferte($prodotto);
    }
    public function getOffertaUtentePerAsta(EUsato $prodotto, $acquirenteId){
        return getEntityManager()->getRepository(EOfferta::class)->getOffertaUtentePerAsta($prodotto, $acquirenteId);
    }
    public function aggiornaOfferta(EOfferta $offerta, $nuovoImporto){
        return getEntityManager()->getRepository(EOfferta::class)->aggiornaOfferta($offerta, $nuovoImporto);
    }
}
?>
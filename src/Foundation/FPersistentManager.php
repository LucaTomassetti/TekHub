<?php
use Doctrine\ORM\EntityRepository;

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
        } else if(is_string($utente)){
            if(getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente) != null){
                return getEntityManager()->getRepository('EAcquirente')->findAcquirente($utente);
            }else if(getEntityManager()->getRepository('EVenditore')->findVenditore($utente) != null){
                return getEntityManager()->getRepository('EVenditore')->findVenditore($utente);
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
        } 
    }
    public function updateProdotto($prodotto, $array_data){
        if($prodotto instanceof ENuovo){
            getEntityManager()->getRepository('ENuovo')->updateProdottoNuovo($prodotto, $array_data);
        }else if($prodotto instanceof EUsato){
            getEntityManager()->getRepository('EUsato')->updateProdottoUsato($prodotto, $array_data);
        } 
    }
    public function getAllProducts($venditore, $currentPage){
        return getEntityManager()->getRepository('EProdotto')->getAllProducts($venditore, $currentPage);
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
}
?>
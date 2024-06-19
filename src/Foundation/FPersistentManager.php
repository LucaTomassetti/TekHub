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

    public function findAcquirente($cliente){
        /** Se $cliente è un oggetto richiamerà findCliente($cliente->getEmail())
         * altrimenti se è una stringa (cioè se è una email) richiamerà findCliente($cliente)
         */
        if(is_object($cliente)){
            return getEntityManager()->getRepository('EAcquirente')->findAcquirente($cliente->getEmail());
        }else if(is_string($cliente)){
            return getEntityManager()->getRepository('EAcquirente')->findAcquirente($cliente);
        }
        else{
            return null;
        }
        
    }
    public function insertNewCliente($new_cliente){
        getEntityManager()->getRepository('EAcquirente')->insertNewCliente($new_cliente);
    }

}
?>
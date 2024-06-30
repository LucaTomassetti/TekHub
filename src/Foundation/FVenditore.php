<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FVenditore extends EntityRepository {

    public function findVenditore($email){
        $dql = "SELECT venditore FROM EVenditore venditore WHERE venditore.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function findVenditoreById($id){
        $entityManager = getEntityManager();
        $dql = "SELECT venditore.id_venditore FROM EVenditore venditore WHERE venditore.id_venditore = :id";
        
        $query = $entityManager->createQuery($dql)
                               ->setParameter('id', $id);

        $result = $query->getOneOrNullResult();
        
        if ($result) {
            return $result['id_venditore'];
        }

        return null;
    }
    public function insertNewVenditore(EVenditore $cliente){
        $em = getEntityManager();
        $em->persist($cliente);
        $em->flush();
    }
    public function deleteVenditore(EVenditore $cliente) {
        $em = getEntityManager();
        /**
         * Poiché l'entità da eliminare risulta detached, l'entity manager deve
         * recuperarla e poi rimuoverla però recuperandola con il Persistent Manager
         * si riceve comunque l'errore che l'entità è detached, cioè non gestita dal
         * entity Manager. Quindi nel controllore recupero tramite il Persistent Manager 
         * l'oggetto cliente dalla sessione che passo al metodo deleteCliente. 
         * Successivamente recupero di nuovo l'oggetto (per evitare l'errore dell'entity manager)
         * così da farlo gestire dall'entity manager e poi richiamare il metodo remove
         */
        $found_cliente = $em->find(EVenditore::class, $cliente->getIdVenditore());
        $em->remove($found_cliente);
        $em->flush();
    }
    public function updatePass(EVenditore $cliente, $new_password){
        $em = getEntityManager();
        $found_cliente = $em->find(EVenditore::class, $cliente->getIdVenditore());
        $found_cliente->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
        $em->persist($found_cliente);
        $em->flush();
    }
    public function updateVenditore(EVenditore $cliente, $array_data){
        $em = getEntityManager();
        $found_cliente = $em->find(EVenditore::class, $cliente->getIdVenditore());
        $found_cliente->setNome($array_data['nome']);
        $found_cliente->setCognome($array_data['cognome']);
        $found_cliente->setUsername($array_data['username']);
        $found_cliente->setCellulare($array_data['cellulare']);
        $found_cliente->setIdVenditore($array_data['id_venditore']);
        $em->persist($found_cliente);
        $em->flush();
    }
}
?>
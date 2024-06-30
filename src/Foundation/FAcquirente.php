<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class FAcquirente extends EntityRepository {

    public function findAcquirente($email){
        $dql = "SELECT acquirente FROM EAcquirente acquirente WHERE acquirente.email = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $email);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function findAcquirenteById($id){
        $dql = "SELECT acquirente FROM EAcquirente acquirente WHERE acquirente.id_acquirente = ?1";
        $query = getEntityManager()->createQuery($dql);
        $query->setParameter(1, $id);
        $query->setMaxResults(1);
        return $query->getResult();
    }
    public function insertNewAcquirente(EAcquirente $cliente){
        $em = getEntityManager();
        $em->persist($cliente);
        $em->flush();
    }
    public function deleteAcquirente(EAcquirente $cliente) {
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
        $found_cliente = $em->find(EAcquirente::class, $cliente->getId());
        $em->remove($found_cliente);
        $em->flush();
    }
    public function updatePass(EAcquirente $cliente, $new_password){
        $em = getEntityManager();
        $found_cliente = $em->find(EAcquirente::class, $cliente->getId());
        $found_cliente->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
        $em->persist($found_cliente);
        $em->flush();
    }
    public function updateAcquirente(EAcquirente $cliente, $array_data){
        $em = getEntityManager();
        $found_cliente = $em->find(EAcquirente::class, $cliente->getId());
        $found_cliente->setNome($array_data['nome']);
        $found_cliente->setCognome($array_data['cognome']);
        $found_cliente->setUsername($array_data['username']);
        $found_cliente->setCellulare($array_data['cellulare']);
        $em->persist($found_cliente);
        $em->flush();
    }

}
?>
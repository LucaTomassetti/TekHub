<?php

class CAdmin{
    //prende i dati degli utenti dal PersistentManager per darli a VAdminDashboard
    public static function gestisciUtenti() {
        $view = new VAdminDashboard();
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9; // Numero di utenti per pagina
        
        $utenti_info = FPersistentManager::getInstance()->getAllUsersPaginated($page, $itemsPerPage);
        $view->gestisciUtenti($utenti_info);
    }
    //prende i dati degli utenti con l'ID inserito dal PersistentManager per darli a VAdminDashboard
    public static function filterUsersPaginated(){
        $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        if (isset($_POST['id'])) {
            $id= $_POST['id'];
            $utenti= FPersistentManager::getInstance()->getFilteredUsersPaginated($id);
            
        } else {
            $utenti = FPersistentManager::getInstance()->getAllUsersPaginated($page,$itemsPerPage=6);
        }
        $view = new VAdminDashboard();
        $view->displayFilteredUsers($utenti);
    }
    //chiede al PersistentMAnager di eliminare un utente dati il ruolo e l'ID, invia una mail all'interessato.
    public static function eliminaUtente($userId, $userType) {
        $entityClass = $userType === 'acquirente' ? 'EAcquirente' : 'EVenditore';
        $utente = FPersistentManager::getInstance()->find($entityClass, $userId);
        if ($utente) {
            FPersistentManager::getInstance()->softDeleteUtente($utente);
            
            $mailer = new UEMailer();
            $mailer->sendAccountDeletionEmail($utente->getEmail());
            
            $_SESSION['message'] = "L'utente è stato eliminato con successo.";
        } else {
            $_SESSION['error'] = "Utente non trovato.";
        }
        header('Location: /TekHub/admin/gestisciUtenti');
    }
    //chiede al PersistentManager di bloccare un utente dati il ruolo e l'ID.
    public static function bloccaUtente($userId, $userType) {
        $entityClass = $userType === 'acquirente' ? 'EAcquirente' : 'EVenditore';
        $utente = FPersistentManager::getInstance()->find($entityClass, $userId);
        if ($utente) {
            $utente->setBlocked(true);
            FPersistentManager::getInstance()->update($utente);
            $_SESSION['message'] = "L'utente è stato bloccato con successo.";
        } else {
            $_SESSION['error'] = "Utente non trovato.";
        }
        header('Location: /TekHub/admin/gestisciUtenti');
    }
    //chiede al PersistentManager di sbloccare un utente dati il ruolo e l'ID.
    public static function sbloccaUtente($userId, $userType) {
        $entityClass = $userType === 'acquirente' ? 'EAcquirente' : 'EVenditore';
        $utente = FPersistentManager::getInstance()->find($entityClass, $userId);
        if ($utente) {
            $utente->setBlocked(false);
            FPersistentManager::getInstance()->update($utente);
            $_SESSION['message'] = "L'utente è stato sbloccato con successo.";
        } else {
            $_SESSION['error'] = "Utente non trovato.";
        }
        header('Location: /TekHub/admin/gestisciUtenti');
    }
    //chiede al PersistentManager i dati di tutte le segnalazioni per darli a VAdminDashboard
    public static function gestisciSegnalazioni() {
        $view = new VAdminDashboard();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 10;

        $segnalazioni = FPersistentManager::getInstance()->getAllSegnalazioniPaginated($page, $itemsPerPage);
        
        // Ensure 'items' key exists and is an array
        if (!isset($segnalazioni['items']) || !is_array($segnalazioni['items'])) {
            $segnalazioni['items'] = [];
        }

        $view->gestioneSegnalazioni($segnalazioni);
    }
    //prende dal PersistentManager i dati della segnalazione con l'ID cercato per farli a VAdminDashboard
    public static function filterSegnalazioni() {
        if (isset($_POST['venditore_id'])) {
            $id_venditore = $_POST['venditore_id'];
            $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $segnalazioni = FPersistentManager::getInstance()->findSegnalazioniByVenditoreId($id_venditore,$page);
            
        } else {
            $segnalazioni = FPersistentManager::getInstance()->getAllSegnalazioniPaginated();
        }
        $view = new VAdminDashboard();
        $view->displayFilteredSegnalazioni($segnalazioni);
    }
    //chiede al PersistentManager di cambiare lo stato di una segnalazione, dato l'ID, da irrisolta a risolta
    public static function risolviSegnalazione($id_segnalazione) {
        FPersistentManager::getInstance()->risolviSegnalazione($id_segnalazione);
        $_SESSION['message'] = "Segnalazione gestita.";
        header('Location: /TekHub/admin/gestisciSegnalazioni');
    }
    //chiede al PersistentManager i dati di tutte i prodotti per darli a VAdminDashboard
    public static function gestisciProdotti(){
        $view = new VAdminDashboard();
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Verifica se ci sono messaggi di successo nella sessione
        $product_added = isset($_SESSION['product_added']) && $_SESSION['product_added'];
        $product_modified = isset($_SESSION['product_modified']) && $_SESSION['product_modified'];
        $product_deleted = isset($_SESSION['product_deleted']) && $_SESSION['product_deleted'];
        
        // Rimuovi i messaggi di successo dalla sessione
        unset($_SESSION['product_added']);
        unset($_SESSION['product_modified']);
        unset($_SESSION['product_deleted']);

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id_prodotto'])){
            $search_term = $_POST['id_prodotto'];
        $prodotto = FPersistentManager::getInstance()->getProductById($search_term, $page, $pageSize = 4);
        $categorie = FPersistentManager::getInstance()->getAllCategories();
                $marche = FPersistentManager::getInstance()->getAllBrands();
        $view->gestisciProdotti($prodotto, $categorie, $marche, $product_added, $product_modified, $product_deleted);
        }else{   
        $array_prodotti = FPersistentManager::getInstance()->getAllProducts($page, $pageSize = 4);
                $categorie = FPersistentManager::getInstance()->getAllCategories();
                $marche = FPersistentManager::getInstance()->getAllBrands();
                $view->gestisciProdotti($array_prodotti, $categorie, $marche, $product_added, $product_modified, $product_deleted);
        }
    }
    //chiede al PersistentManager di cancellare un prodotto dato l'ID, una volta fatto manda una mail al venditore di riferimento
     public static function deleteProduct($id) {
        if (!isset($_SESSION['utente']) || !($_SESSION['utente'] instanceof EAdmin)) {
            header('Location: /TekHub/utente/login');
            exit;
        }
        try{
            $result = FPersistentManager::getInstance()->deleteAllImages($id);
            $result = FPersistentManager::getInstance()->deleteProdotto($id);
            $prodotto= FPersistentManager::getInstance()->find(EProdotto::class, $id);
            $utente= $prodotto->getVenditore();
            $mailer = new UEMailer();
                $mailer->sendProductDeletionEmail($utente->getEmail(), $prodotto->getNome());
                $_SESSION['message'] = "Prodotto eliminato.";

        }catch(\Exception $e){
            $_SESSION['error'] = "Si è verificato un errore".$e->getMessage();
        }
           
        header('Location: /TekHub/admin/gestisciProdotti');
        exit;
        
    }
}
?>
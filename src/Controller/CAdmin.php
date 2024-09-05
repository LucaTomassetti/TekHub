<?php

class CAdmin{
    public static function gestisciUtenti() {
        $view = new VAdminDashboard();
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 9; // Numero di utenti per pagina
        
        $utenti_info = FPersistentManager::getInstance()->getAllUsersPaginated($page, $itemsPerPage);
        $view->gestisciUtenti($utenti_info);
    }

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
}
?>
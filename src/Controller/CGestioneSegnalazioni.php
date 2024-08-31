<?php

class CGestioneSegnalazioni{

    public function gestioneSegnalazioni() {
        $view = new VAdminDashboard();
        $view->gestioneSegnalazioni();
    }

    public function filterSegnalazioni() {
        if (isset($_POST['id_segnalazione'])) {
            $id = $_POST['id_segnalazione'];
            $segnalazioni = FPersistentManager::getInstance()->findSegnalazione($id);
            $view = new VAdminDashboard();
            $view->displayFilteredSegnalazioni($segnalazioni);
        } else {
            // Handle error or redirect
            header('Location: /TekHub/gestioneSegnalazioni/gestioneSegnalazioni');
        }
    }

    public function deleteSegnalazione($id) {
        $result = FPersistentManager::getInstance()->deleteSegnalazione($id);
        if ($result) {
            // Segnalazione deleted successfully
            // You might want to add a success message here
        } else {
            // Failed to delete segnalazione
            // You might want to add an error message here
        }
        // Redirect back to the segnalazioni management page
        header('Location: /TekHub/gestioneSegnalazioni/gestioneSegnalazioni');
    }

}
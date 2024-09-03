<?php

class VAdminDashboard{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    public function gestioneProdotti(){
       $loginVariables = (new VUtente)->checkLogin();
       foreach ($loginVariables as $key => $value) {
           $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('search_form', 1);
        $this->smarty->display('gestisciProdotti.tpl');
    }

    public function gestisciUtenti($utenti_info) {
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('utenti_info', $utenti_info);
        if (isset($_SESSION['message'])) {
            $this->smarty->assign('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            $this->smarty->assign('error', $_SESSION['error']);
            unset($_SESSION['error']);
        }
        $this->smarty->display('gestisciUtenti.tpl');
    }

    public function gestioneSegnalazioni(){
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('filter_form', 1);
        $this->smarty->display('gestisciSegnalazioni.tpl');
    }

    public function displaySearchResults($products) {
        $this->smarty->assign('search_form', 1);
        $this->smarty->assign('search_results', 1);
        $this->smarty->assign('products', $products);
        $this->smarty->assign('show_delete_button', true);
        $this->smarty->display('gestisciProdotti.tpl');
    }

    public function displayFilteredSegnalazioni($segnalazioni) {
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('filter_form', 1);
        $this->smarty->assign('filtered_results', 1);
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->display('gestisciSegnalazioni.tpl');
    }
}
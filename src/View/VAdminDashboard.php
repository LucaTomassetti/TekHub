<?php

class VAdminDashboard{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    public function gestisciProdotti($array_prodotti, $categorie, $marche, $product_added, $product_modified, $product_deleted){

        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        if (isset($_SESSION['message'])) {
            $this->smarty->assign('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            $this->smarty->assign('error', $_SESSION['error']);
            unset($_SESSION['error']);
        }

        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->assign('array_categorie', $categorie);
        $this->smarty->assign('marche', $marche);
        $this->smarty->assign('listaProdotti', 1);
        $this->smarty->assign('addedProductSuccess', $product_added);
        $this->smarty->assign('modifiedProductSuccess', $product_modified);
        $this->smarty->assign('deletedProductSuccess', $product_deleted);
        $this->smarty->assign('prodottoFiltrato',0);
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

    public function gestioneSegnalazioni($segnalazioni) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('filter_form', 1);
        $this->smarty->assign('segnalazioni', $segnalazioni);
        if (isset($_SESSION['message'])) {
            $this->smarty->assign('message', $_SESSION['message']);
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            $this->smarty->assign('error', $_SESSION['error']);
            unset($_SESSION['error']);
        }
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->display('gestisciSegnalazioni.tpl');
    }

    public function displaySearchResults($products) {
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
                
        $this->smarty->assign('search_results', 1);
        $this->smarty->assign('products', $products);
        $this->smarty->assign('prodottoFiltrato', 1);
        $this->smarty->display('gestisciProdotti.tpl');
    }

    public function displayFilteredSegnalazioni($segnalazioni) {
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        if (!isset($segnalazioni['items']) || !is_array($segnalazioni['items'])) {
            $segnalazioni['items'] = [];
        }
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->display('gestisciSegnalazioni.tpl');
    }

    public function displayFilteredUsers($utenti){
        $loginVariables=(new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value){
            $this->smarty->assign($key, $value);
        }
        if (!isset($utenti['items']) || !is_array($utenti['items'])) {
            $utenti['items'] = [];
        }
        $this->smarty->assign('utenti_info', $utenti);
        $this->smarty->display('gestisciUtenti.tpl');
    }
}
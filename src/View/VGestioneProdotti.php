<?php

class VGestioneProdotti{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    public function listaProdotti($array_prodotti){
        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('listaProdotti', 1);
        $this->smarty->assign('addedProductSuccess', 0);
        // Verifica se il messaggio di successo è presente nella sessione
        $product_added = isset($_SESSION['product_added']) && $_SESSION['product_added'];

        // Rimuovi il messaggio di successo dalla sessione
        unset($_SESSION['product_added']);
        // Controlla se il metodo è stato chiamato dalla form per aggiungere un prodotto
        if ($product_added) {
            $this->smarty->assign('addedProductSuccess', 1);
        }

        $this->smarty->display('userinfo.tpl');
    }
    public function addProductForm(){
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('addProductForm', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorImageUpload(){
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('addProductForm', 1);
        $this->smarty->assign('errorImageUpload', 1);
        $this->smarty->display('userinfo.tpl');
    }
}
?>
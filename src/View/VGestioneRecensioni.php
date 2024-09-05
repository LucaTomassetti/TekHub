<?php

class VGestioneRecensioni{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();
        $this->smarty->assign('cart_quantity', (new VUtente)->countItemCart());
        $data = (new VUtente)->cart_header();
        $this->smarty->assign('prodotti_carrello', $data['array_carrello']);
        $this->smarty->assign('subtotal', $data['subtotal']);
        $this->smarty->assign('carrello', $data['carrello']);
        $this->smarty->assign('is_cart_empty', !isset($_COOKIE['cart']) || empty($data['carrello']) ? 1 : 0);
    }
    public function mostraRecensioniProdotto($prodotto, $recensioni, $puoRecensire) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('prodotto', $prodotto);
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->assign('puoRecensire', $puoRecensire);
        $this->smarty->display('recensioniProdotto.tpl');
    }

    public function mostraRecensioniVenditore($recensioni) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        if(isset($_SESSION['errore'])){
            $this->smarty->assign('error', $_SESSION['errore']);
        }
        if(isset($_SESSION['successo'])){
            $this->smarty->assign('success', $_SESSION['successo']);
        }
        unset($_SESSION['errore']);
        unset($_SESSION['successo']);
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->display('recensioniVenditore.tpl');
    }

    public function mostraFormRecensione($prodotto) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('prodotto', $prodotto);
        $this->smarty->display('formRecensione.tpl');
    }

    public function mostraFormRisposta($recensione) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('recensione', $recensione);
        $this->smarty->display('formRisposta.tpl');
    }

    public function mostraFormSegnalazione($recensione) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('recensione', $recensione);
        $this->smarty->display('formSegnalazione.tpl');
    }

}
?>
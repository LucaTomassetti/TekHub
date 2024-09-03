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
        $this->smarty->assign('prodotto', $prodotto);
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->assign('puoRecensire', $puoRecensire);
        $this->smarty->display('recensioniProdotto.tpl');
    }

    public function mostraRecensioniVenditore($recensioni) {
        $this->smarty->assign('recensioni', $recensioni);
        $this->smarty->display('recensioniVenditore.tpl');
    }

    public function mostraFormRecensione($prodotto) {
        $this->smarty->assign('prodotto', $prodotto);
        $this->smarty->display('formRecensione.tpl');
    }

    public function mostraFormRisposta($recensione) {
        $this->smarty->assign('recensione', $recensione);
        $this->smarty->display('formRisposta.tpl');
    }

    public function mostraFormSegnalazione($recensione) {
        $this->smarty->assign('recensione', $recensione);
        $this->smarty->display('formSegnalazione.tpl');
    }

    public function mostraErrore($messaggio) {
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('errore.tpl');
    }

    public function mostraSuccesso($messaggio) {
        $this->smarty->assign('successo', $messaggio);
        $this->smarty->display('successo.tpl');
    }

}
?>
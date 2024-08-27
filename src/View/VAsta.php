<?php

class VAsta {
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
        $this->smarty->assign('cart_quantity', (new VUtente)->countItemCart());
        $data = (new VUtente)->cart_header();
        $this->smarty->assign('prodotti_carrello', $data['array_carrello']  ? $data['array_carrello'] : 0);
        $this->smarty->assign('subtotal', $data['subtotal']);
        $this->smarty->assign('carrello', $data['carrello']);
        $this->smarty->assign('is_cart_empty', !isset($_COOKIE['cart']) || empty($data['carrello']) ? 1 : 0);
    }

    public function mostraErrore($messaggio) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('errore_messaggio', $messaggio);
        $this->smarty->display('erroreAsta.tpl');
    }

    public function mostraOfferteEffettuate($offerte) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('offerte', $offerte);
        $this->smarty->display('offerteEffettuate.tpl');
    }
}

?>
<?php

class VGestioneAcquisto{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();
        $this->smarty->assign('cart_quantity', (new VUtente)->countItemCart());
        $data = (new VUtente)->cart_header();
        $this->smarty->assign('prodotti_carrello', $data['array_carrello']  ? $data['array_carrello'] : 0);
        $this->smarty->assign('subtotal', $data['subtotal']);
        $this->smarty->assign('carrello', $data['carrello']);
        $this->smarty->assign('is_cart_empty', !isset($_COOKIE['cart']) || empty($data['carrello']) ? 1 : 0);
    }
    public function shop($prodotti, $categorie, $marche, $filtri_applicati) {
        $this->smarty->assign('array_prodotti', $prodotti);
        $this->smarty->assign('array_categorie', $categorie);
        $this->smarty->assign('marche', $marche);
        $this->smarty->assign('filtri_applicati', $filtri_applicati);
        $this->smarty->assign('search_bar', 1);
        $this->smarty->assign('shop', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function vediProdotto($prodotto, $immagini, $same_cat_products){
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('same_cat_products', $same_cat_products);
        $this->smarty->assign('nomeProdotto', $prodotto->getNome());
        $this->smarty->assign('descrizione', $prodotto->getDescrizione());
        $this->smarty->assign('marca', $prodotto->getMarca());
        $this->smarty->assign('modello', $prodotto->getModello());
        $this->smarty->assign('colore', $prodotto->getColore());
        $this->smarty->assign('categoria', $prodotto->getCategoryName()->getNomeCategoria());
        $this->smarty->assign('immagini', $immagini);
        $this->smarty->assign('productId', $prodotto->getIdProdotto());
        if($prodotto instanceof ENuovo){
            $this->smarty->assign('isProdottoNuovo', 1);
            $this->smarty->assign('quantita_disp', $prodotto->getQuantitaDisp());
            $this->smarty->assign('prezzo_fisso', $prodotto->getPrezzoFisso());
        }else if($prodotto instanceof EUsato){
            $this->smarty->assign('isProdottoNuovo', 0);
            $this->smarty->assign('data_inizio_asta', $prodotto->getAsta()->getDataCreazione());
            $this->smarty->assign('data_fine_asta', $prodotto->getAsta()->getDataFine());
            $this->smarty->assign('floor_price', $prodotto->getFloorPrice());
        }
        $this->smarty->display('infoProdotto.tpl');
    }
    public function carrello(){
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('qty_updated', 0);
        $qty_updated = isset($_SESSION['qty_updated']) && $_SESSION['qty_updated'];
        unset($_SESSION['qty_updated']);
        if($qty_updated) {
            $this->smarty->assign('qty_updated', 1);
        }
        $this->smarty->display('carrello.tpl');
    }
    public function mostraCheckoutForm($indirizzi, $carte, $prodotti_carrello, $totale_carrello) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->assign('indirizzi', $indirizzi);
        $this->smarty->assign('carte', $carte);
        $this->smarty->assign('prodotti_carrello', $prodotti_carrello);
        $this->smarty->assign('totale_carrello', $totale_carrello);

        $this->smarty->display('checkout.tpl');
    }

    public function mostraConfermaOrdine($ordine) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->assign('ordine', $ordine);

        $this->smarty->display('ordineCompletato.tpl');
    }
    public function dettaglioOrdine($ordine){
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('ordine', $ordine);
        $this->smarty->assign('dettaglioOrdine', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function erroreOrdine() {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('errore_ordine', 0);
        if(isset($_SESSION['errore_ordine'])) {
            $this->smarty->assign('errore_ordine', $_SESSION['errore_ordine']);
            unset($_SESSION['errore_ordine']);
        }

        $this->smarty->display('erroreOrdine.tpl');
    }

}
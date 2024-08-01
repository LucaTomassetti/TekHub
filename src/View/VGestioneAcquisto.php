<?php

class VGestioneAcquisto{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    public function vediProdotto($prodotto, $immagini, $same_cat_products){
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

}
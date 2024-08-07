<?php

class VGestioneProdotti{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    public function listaProdotti($array_prodotti, $product_added, $product_modified, $product_deleted){
        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('listaProdotti', 1);
        $this->smarty->assign('addedProductSuccess', 0);
        $this->smarty->assign('modifiedProductSuccess', 0);
        $this->smarty->assign('deletedProductSuccess', 0);

        // Controlla se il metodo è stato chiamato dalla form per aggiungere un prodotto
        if ($product_added) {
            $this->smarty->assign('addedProductSuccess', 1);
        }
        if ($product_modified) {
            $this->smarty->assign('modifiedProductSuccess', 1);
        }
        if ($product_deleted) {
            $this->smarty->assign('deletedProductSuccess', 1);
        }

        $this->smarty->display('userinfo.tpl');
    }
    public function addProductForm($array_categorie){
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('addProductForm', 1);
        $this->smarty->assign('array_categorie', $array_categorie);
        $this->smarty->display('userinfo.tpl');
    }
    public function modifyProductForm($prodotto, $immagini){
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
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
        $this->smarty->assign('modifyProductForm', 1);
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
<?php

class CGestioneAcquisto{
    public static function vediProdotto($prodotto_id){

        $view = new VGestioneAcquisto();
        if (!isset($_GET['page'])) {
            // Redirect to the same URL with ?page=1
            $url = $_SERVER['REQUEST_URI'];
            $url = rtrim('?', $url);
            $url .= '?page=1';
            header("Location: $url");
        }
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $prod = FPersistentManager::getInstance()->find(EProdotto::class, $prodotto_id);
        $same_cat_products = FPersistentManager::getInstance()->getAllSameCatProducts($prod->getCategoryName()->getNomeCategoria(), $prodotto_id, $page);
        $immagini = FPersistentManager::getInstance()->getAllImages($prod);
        $view->vediProdotto($prod, $immagini, $same_cat_products);
    }

}
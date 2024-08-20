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
    public static function aggiungiAlCarrello($idProdotto)
    {
        if (!(isset($_COOKIE['cart']))) {
            setcookie('cart', 0, time() + (86400 * 30), "/"); // 30 giorni
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $quantita = 1;
        } else {
            $quantita = $_POST['quantity'];
        }
        $carrello = json_decode($_COOKIE['cart'], true);
        if (!(empty($carrello)) || array_key_exists($idProdotto, $carrello)) {
            $carrello[$idProdotto] += $quantita;
        } else {
            $carrello[$idProdotto] = $quantita;
        }
        $found_prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $idProdotto);
        $quantita_massima = $found_prodotto->getQuantitaDisp();
        if($carrello[$idProdotto] > $quantita_massima) {
            $carrello[$idProdotto] = $quantita_massima;
            $_SESSION['q_max_raggiunta'] = true;
        }
        json_encode($carrello);
        setcookie('cart', json_encode($carrello), time() + (86400 * 30), "/");

        $_SESSION['added_to_cart'] = isset($_SESSION['q_max_raggiunta']) && $_SESSION['q_max_raggiunta'] ? false : true;
        header('Location: /TekHub/utente/home');
    }
    public static function rimuoviDalCarrello($idProdotto){
        $carrello = json_decode($_COOKIE['cart'], true);
        unset($carrello[$idProdotto]);
        json_encode($carrello);
        setcookie('cart', json_encode($carrello), time() + (86400 * 30), "/");
        $_SESSION['removed_from_cart'] = true;
        header('Location: /TekHub/utente/home');
    }
    public static function vediCarrello(){

    }
    public static function effettuaCheckout(){

    }

}
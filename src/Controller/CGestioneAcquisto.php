<?php

class CGestioneAcquisto{
    public static function shop() {
        $view = new VGestioneAcquisto();
        
        $filtri = [
            'query' => isset($_GET['query']) ? $_GET['query'] : '',
            'categoria' => isset($_GET['categoria']) ? $_GET['categoria'] : '',
            'marca' => isset($_GET['marca']) ? $_GET['marca'] : '',
            'prezzo_max' => isset($_GET['prezzo_max']) ? (int)$_GET['prezzo_max'] : 5000,
            'condizione' => isset($_GET['condizione']) ? $_GET['condizione'] : [],
        ];
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if(isset($_GET['query']) || isset($_GET['categoria']) || isset($_GET['marca']) || isset($_GET['prezzo_max']) || isset($_GET['condizione'])){
            $prodotti = FPersistentManager::getInstance()->getProdottiFiltrati($filtri, $page);
        }else{
            $prodotti = FPersistentManager::getInstance()->getAllProducts($page);
        }
        $categorie = FPersistentManager::getInstance()->getAllCategories();
        $marche = FPersistentManager::getInstance()->getAllBrands();
        
        $view->shop($prodotti, $categorie, $marche, $filtri);
    }
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
    public static function svuotaCarrello() {
        if (isset($_COOKIE['cart'])) {
            setcookie('cart', json_encode([]), time() - 3600, "/"); 
            $_SESSION['carrello_svuotato'] = true;
        }
        header('Location: /TekHub/utente/home');
    }
    public static function vediCarrello(){
        if (!(isset($_COOKIE['cart']))) {
            setcookie('cart', json_encode([]), time() + (86400 * 30), "/");  // 30 giorni
        }
        $view_cart = new VGestioneAcquisto();
        $view_cart->carrello();
    }
    public static function aggiornaQuantita($idProdotto){
        if (!isset($_COOKIE['cart'])) {
            setcookie('cart', json_encode([]), time() + (86400 * 30), "/"); // 30 giorni
        }
        $carrello = json_decode($_COOKIE['cart'], true);
        $newQuantity = $_POST['quantity'];
        // Aggiorna la quantità nel carrello
        $carrello[$idProdotto] = (int)$newQuantity;

        // Verifica che la nuova quantità non superi la quantità disponibile
        $found_prodotto = FPersistentManager::getInstance()->find(EProdotto::class, $idProdotto);
        $quantita_massima = $found_prodotto->getQuantitaDisp();

        if ($carrello[$idProdotto] > $quantita_massima) {
            $carrello[$idProdotto] = $quantita_massima;
            $_SESSION['q_max_raggiunta'] = true;
        } else {
            $_SESSION['q_max_raggiunta'] = false;
        }

        // Se la nuova quantità è 0, rimuovi il prodotto dal carrello
        if ($carrello[$idProdotto] == 0) {
            unset($carrello[$idProdotto]);
        }

        // Aggiorna il cookie del carrello
        $nuovo_carrello = json_encode($carrello);
        setcookie('cart', $nuovo_carrello, time() + (86400 * 30), "/");
        $_SESSION['qty_updated'] = true;
        header('Location: /TekHub/gestioneAcquisto/vediCarrello');
    }
    public static function effettuaCheckout(){
        $view = new VGestioneAcquisto();
    
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Recupera gli indirizzi e le carte di credito dell'utente
            $indirizzi = FPersistentManager::getInstance()->getAllIndirizziUtente($_SESSION['utente']);
            $carte = FPersistentManager::getInstance()->getAllCarteUtente($_SESSION['utente']);
            
            // Recupera i prodotti nel carrello
            $carrello = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
            $prodotti_carrello = [];
            $totale_carrello = 0;
            
            foreach ($carrello as $id_prodotto => $quantita) {
                $prodotto = FPersistentManager::getInstance()->find(ENuovo::class, $id_prodotto);
                if ($prodotto) {
                    $prodotti_carrello[] = [
                        'prodotto' => $prodotto,
                        'quantita' => $quantita
                    ];
                    $totale_carrello += $prodotto->getPrezzoFisso() * $quantita;
                }
            }
            
            $view->mostraCheckoutForm($indirizzi, $carte, $prodotti_carrello, $totale_carrello);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Gestisci il completamento dell'ordine
            $indirizzo_id = $_POST['indirizzo'];
            $carta_id = $_POST['carta'];
            $carrello = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
            // Crea un nuovo ordine
            $ordine = FPersistentManager::getInstance()->creaOrdine($_SESSION['utente'], $indirizzo_id, $carta_id, $carrello);
            // Aggiungi i prodotti all'ordine
            $carrello = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
            foreach ($carrello as $id_prodotto => $quantita) {
                $prodotto = FPersistentManager::getInstance()->find(ENuovo::class, $id_prodotto);
                if ($prodotto) {
                    FPersistentManager::getInstance()->aggiungiProdottoOrdine($ordine, $prodotto, $quantita);
                }
            }
            
            // Svuota il carrello
            setcookie('cart', json_encode([]), time() - 3600, "/");
            
            // Mostra la pagina di conferma dell'ordine
            $view->mostraConfermaOrdine($ordine);
        }
    }
    public static function completaOrdine(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: /TekHub/utente/home');
            exit;
        }

        $view = new VGestioneAcquisto();

        try {
            // Recupera i dati dal form
            $indirizzo = explode('|', $_POST['indirizzo']);
            $numeroCarta = $_POST['carta'];

            // Recupera il carrello dalla sessione o dal cookie
            $carrello = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

            if (empty($carrello)) {
                throw new \Exception("Il carrello è vuoto");
            }

            // Crea l'ordine
            $ordine = FPersistentManager::getInstance()->creaOrdine($indirizzo[0], $indirizzo[1], $numeroCarta, $carrello);

            if (!$ordine) {
                throw new \Exception("Errore nella creazione dell'ordine");
            }

            // Svuota il carrello
            setcookie('cart', json_encode([]), time() - 3600, "/");

            // Mostra la pagina di conferma dell'ordine
            $view->mostraConfermaOrdine($ordine);

        } catch (\Exception $e) {
            // Gestione degli errori
            error_log("Errore durante il completamento dell'ordine: " . $e->getMessage());
            
            // Reindirizza l'utente a una pagina di errore o al carrello con un messaggio di errore
            $_SESSION['errore_ordine'] = "Si è verificato un errore durante il completamento dell'ordine. " . $e->getMessage();
            header('Location: /TekHub/gestioneAcquisto/erroreOrdine');
            exit;
        }
    }
    public static function dettaglioOrdine($idOrdine)
    {
        $view_utente = new VGestioneAcquisto();
        $ordine = FPersistentManager::getInstance()->find(EOrdine::class, $idOrdine);
        
        if ($ordine && $ordine->getAcquirente()->getId() == $_SESSION['utente']->getId()) {
            $view_utente->dettaglioOrdine($ordine);
        } else {
            // Gestione dell'errore: ordine non trovato o non appartiene all'utente corrente
            header('Location: /TekHub/utente/userHistoryOrders');
        }
    }
    public static function erroreOrdine(){
        $view = new VGestioneAcquisto();
        $view->erroreOrdine();

    }

}
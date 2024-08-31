<?php

class VUtente{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();
        $this->smarty->assign('cart_quantity', self::countItemCart());
        $data = self::cart_header();
        $this->smarty->assign('prodotti_carrello', $data['array_carrello']);
        $this->smarty->assign('subtotal', $data['subtotal']);
        $this->smarty->assign('carrello', $data['carrello']);
        $this->smarty->assign('is_cart_empty', !isset($_COOKIE['cart']) || empty($data['carrello']) ? 1 : 0);
    }
    public function cart_header(){
        if (!isset($_COOKIE['cart'])) {
            setcookie('cart', json_encode([]), time() + (86400 * 30), "/"); // 30 giorni
        }
        $array_carrello = [];
        $carrello = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
        if($carrello){
            foreach($carrello as $id => $qty){
                $prod = FPersistentManager::getInstance()->find(ENuovo::class, $id);
                $array_carrello[] = [
                    'prodotto' => $prod,
                    'quantita' => $qty
                ];
            } 
        }
        $subtotal = 0;
        if(!empty($array_carrello)){
            foreach($array_carrello as $item){
                $subtotal += $item['prodotto']->getPrezzoFisso() * $item['quantita'];
            }
        }
        return [
            'array_carrello' => $array_carrello ? $array_carrello : [],
            'subtotal' => $subtotal,
            'carrello' => $carrello
        ];
        
    }
    public function countItemCart()
    {
        if (!(isset($_COOKIE['cart']))) {
            return 0;
        }
        $carrello = json_decode($_COOKIE['cart']);
        $cont = 0;
        foreach ($carrello as $id => $quantity) {
            $cont += $quantity;
        }
        return $cont;
    }
    public function checkLogin()
    {
        $loginVariables = [
            'check_login_acquirente' => 0,
            'check_login_admin' => 0,
            'check_login_venditore' => 0,
            'utente_non_loggato' => 1
        ];

        if(isset($_SESSION['utente'])){
            $loginVariables['utente_non_loggato'] = 0;
            if ($_SESSION['utente'] instanceof EAcquirente) {
                $loginVariables['check_login_acquirente'] = 1;   
            }else if ($_SESSION['utente'] instanceof EVenditore) {
                $loginVariables['check_login_venditore'] = 1;
            }else if ($_SESSION['utente'] instanceof EAdmin) {
                $loginVariables['check_login_admin'] = 1;
            }
        }
        return $loginVariables;
    }
    public function accessDenied()
    {
        $this->smarty->display('accessDenied.tpl');
    }
    public function accessUnAuthorized(){
        $this->smarty->display('accessUnAuthorized.tpl');
    }
    public function showLoginForm(){
        $this->smarty->display('login.tpl');
    }
    public function loginSuccessAcquirente($array_prodotti, $array_categorie){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('carrello_svuotato', 0);
        $carrello_svuotato = isset($_SESSION['carrello_svuotato']) && $_SESSION['carrello_svuotato'];
        unset($_SESSION['carrello_svuotato']);
        if ($carrello_svuotato) {
            $this->smarty->assign('carrello_svuotato', 1);
        }
        $this->smarty->assign('removed_from_cart', 0);
        $removed_from_cart = isset($_SESSION['removed_from_cart']) && $_SESSION['removed_from_cart'];
        unset($_SESSION['removed_from_cart']);
        if ($removed_from_cart) {
            $this->smarty->assign('removed_from_cart', 1);
        }
        $this->smarty->assign('added_to_cart', 0);
        $added_to_cart = isset($_SESSION['added_to_cart']) && $_SESSION['added_to_cart'];
        unset($_SESSION['added_to_cart']);
        if ($added_to_cart) {
            $this->smarty->assign('added_to_cart', 1);
        }
        $this->smarty->assign('q_max_raggiunta', 0);
        $q_max_raggiunta = isset($_SESSION['q_max_raggiunta']) && $_SESSION['q_max_raggiunta'];
        unset($_SESSION['q_max_raggiunta']);
        if ($q_max_raggiunta) {
            $this->smarty->assign('q_max_raggiunta', 1);
        }
        $this->smarty->assign('errore_log', 0);
        $this->smarty->assign('search_bar', 1);
        $this->smarty->assign('array_categorie', $array_categorie);
        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->display('homepage.tpl');
    }
    public function loginSuccessVenditore(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        $this->smarty->assign('username', $_SESSION['utente']->getUsername());
        $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('userDataSection', 1);
        $this->smarty->assign('errore_log', 0);
        $this->smarty->display('userinfo.tpl');
    }
    public function loginSuccessAdmin(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('search_form', 1);
        $this->smarty->assign('admin', 1);
        $this->smarty->display('gestisciProdotti.tpl');
    }

    public function loginError(){
        $this->smarty->assign('errore_log', 1);
        $this->smarty->display('login.tpl');
    }
    public function logout($array_prodotti, $array_categorie){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('carrello_svuotato', 0);
        $carrello_svuotato = isset($_SESSION['carrello_svuotato']) && $_SESSION['carrello_svuotato'];
        unset($_SESSION['carrello_svuotato']);
        if ($carrello_svuotato) {
            $this->smarty->assign('carrello_svuotato', 1);
        }
        $this->smarty->assign('removed_from_cart', 0);
        $removed_from_cart = isset($_SESSION['removed_from_cart']) && $_SESSION['removed_from_cart'];
        unset($_SESSION['removed_from_cart']);
        if ($removed_from_cart) {
            $this->smarty->assign('removed_from_cart', 1);
        }
        $this->smarty->assign('added_to_cart', 0);
        $added_to_cart = isset($_SESSION['added_to_cart']) && $_SESSION['added_to_cart'];
        unset($_SESSION['added_to_cart']);
        if ($added_to_cart) {
            $this->smarty->assign('added_to_cart', 1);
        }
        $this->smarty->assign('q_max_raggiunta', 0);
        $q_max_raggiunta = isset($_SESSION['q_max_raggiunta']) && $_SESSION['q_max_raggiunta'];
        unset($_SESSION['q_max_raggiunta']);
        if ($q_max_raggiunta) {
            $this->smarty->assign('q_max_raggiunta', 1);
        }
        $this->smarty->assign('search_bar', 1);
        $this->smarty->assign('array_categorie', $array_categorie);
        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->assign('signUpSuccess', 0);
        // Verifica se il messaggio di successo è presente nella sessione
        $signUpSuccess = isset($_SESSION['signUpSuccess']) && $_SESSION['signUpSuccess'];

        // Rimuovi il messaggio di successo dalla sessione
        unset($_SESSION['signUpSuccess']);
        // Controlla se il metodo è stato chiamato dalla form per aggiungere un prodotto
        if ($signUpSuccess) {
            $this->smarty->assign('signUpSuccess', 1);
        }
        $this->smarty->display('homepage.tpl');
    }
    public function signUp(){
        $this->smarty->display('registration.tpl');
    }
    public function checkPassSignUp(){
        $this->smarty->assign('check_pass', 1);
        $this->smarty->display('registration.tpl');
    }
    public function signUpError(){
        $this->smarty->assign('errore_r', 1);
        $this->smarty->display('registration.tpl');
    }
    public function userDataForm(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        if(!($_SESSION['utente'] instanceof EAdmin)){
            $this->smarty->assign('username', $_SESSION['utente']->getUsername());
            $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        }
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('userDataForm', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function userDataSection(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('changeuserdatasucces', 0);
        $this->smarty->assign('changepasswordsucces', 0);
        // Verifica se il messaggio di successo è presente nella sessione
        $changeuserdatasucces = isset($_SESSION['changeuserdatasucces']) && $_SESSION['changeuserdatasucces'];
        $changepasswordsucces = isset($_SESSION['changepasswordsucces']) && $_SESSION['changepasswordsucces'];

        // Rimuovi il messaggio di successo dalla sessione
        unset($_SESSION['changeuserdatasucces']);
        unset($_SESSION['changepasswordsucces']);
        // Controlla se il metodo è stato chiamato dalla form per aggiungere un prodotto
        if ($changeuserdatasucces) {
            $this->smarty->assign('changeuserdatasucces', 1);
        }
        if ($changepasswordsucces) {
            $this->smarty->assign('changepasswordsucces', 1);
        }
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        if(!($_SESSION['utente'] instanceof EAdmin)){
            $this->smarty->assign('username', $_SESSION['utente']->getUsername());
            $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        }
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('userDataSection', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function userHistoryOrders($ordini){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('ordini', $ordini);
        $this->smarty->assign('userHistoryOrders', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function changePass(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('changepass', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorPassUpdate(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('errorpassupdate', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorOldPass(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('erroroldpass', 1);
        $this->smarty->display('userinfo.tpl');
    }

    public function equalPasswordError() {
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('equalpassworderr', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function indirizzi($array_indirizzi, $messages = []) {
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('array_indirizzi', $array_indirizzi);
        $this->smarty->assign('messages', $messages);
        $this->smarty->assign('indirizzi', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function carteCredito($carte_credito, $messages = []) {
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('carte_credito', $carte_credito);
        $this->smarty->assign('messages', $messages);
        $this->smarty->assign('carteCredito', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function aggiungiIndirizzi(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('aggiungiIndirizzi', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function aggiungiIndirizziConErrori($errors) {
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('aggiungiIndirizzi', 1);
        $this->smarty->assign('errors', $errors);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorEliminaIndirizzi() {
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('indirizzi', 1);
        $this->smarty->assign('errorEliminaIndirizzi', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorEliminaCarta(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('errorEliminaCarta', true);
        $this->smarty->assign('carteCredito', true);
        $this->smarty->display('userinfo.tpl');
    }
    public function aggiungiCarte(){
        $loginVariables = self::checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('aggiungiCarte', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function aggiungiCarteConErrori($errors) {
        $this->smarty->assign('errors', $errors);
        $this->smarty->assign('aggiungiCarte', 1);
        $this->smarty->display('userinfo.tpl');
    }
}
?>
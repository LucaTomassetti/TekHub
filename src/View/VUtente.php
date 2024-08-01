<?php

class VUtente{

    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }
    public function accessUnAuthorized(){
        $this->smarty->display('accessUnAuthorized.tpl');
    }
    public function showLoginForm(){
        $this->smarty->display('login.tpl');
    }
    public function loginSuccessAcquirente($array_prodotti, $array_categorie){
        $this->smarty->assign('errore_log', 0);
        $this->smarty->assign('search_bar', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('check_login_acquirente', 1);
        $this->smarty->assign('array_categorie', $array_categorie);
        $this->smarty->assign('array_prodotti', $array_prodotti);
        $this->smarty->display('homepage.tpl');
    }
    public function loginSuccessVenditore(){
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        $this->smarty->assign('username', $_SESSION['utente']->getUsername());
        $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('userDataSection', 1);
        $this->smarty->assign('errore_log', 0);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function loginError(){
        $this->smarty->assign('errore_log', 1);
        $this->smarty->display('login.tpl');
    }
    public function logout($array_prodotti, $array_categorie){
        $this->smarty->assign('check_login', 0);
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
    public function showAdminDashboard(){
        $this->smarty->display('admin_dashboard.tpl');
    }
    public function userDataForm($check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        $this->smarty->assign('username', $_SESSION['utente']->getUsername());
        $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('userDataForm', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function userDataSection($changeuserdatasucces, $changepasswordsucces,$check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('nome', $_SESSION['utente']->getNome());
        $this->smarty->assign('cognome', $_SESSION['utente']->getCognome());
        $this->smarty->assign('username', $_SESSION['utente']->getUsername());
        $this->smarty->assign('cellulare', $_SESSION['utente']->getCellulare());
        $this->smarty->assign('email', $_SESSION['utente']->getEmail());
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('changepasswordsucces', $changepasswordsucces);
        $this->smarty->assign('changeuserdatasucces', $changeuserdatasucces);
        $this->smarty->assign('userDataSection', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function userHistoryOrders($check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('userHistoryOrders', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function changePass($check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('changepass', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorPassUpdate($check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('errorpassupdate', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function errorOldPass($check_login_acquirente,$check_login_venditore){
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('erroroldpass', 1);
        $this->smarty->display('userinfo.tpl');
    }

    public function equalPasswordError($check_login_acquirente,$check_login_venditore) {
        $this->smarty->assign('check_login_acquirente', $check_login_acquirente);
        $this->smarty->assign('check_login_venditore', $check_login_venditore);
        $this->smarty->assign('check_login', 1);
        $this->smarty->assign('changepass', 1);
        $this->smarty->assign('equalpassworderr', 1);
        $this->smarty->display('userinfo.tpl');
    }
    public function carrello() {
        $this->smarty->assign('check_login', 1);
        $this->smarty->display('carrello.tpl');
    }
}
?>
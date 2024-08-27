<?php

class VGestioneOrdiniInAttesa {

    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Mostra la lista degli ordini.
     *
     * @param array $array_ordini Un array di ordini da visualizzare.
     * @param bool $order_processed Indica se un ordine è stato processato con successo.
     * @param bool $order_error Indica se si è verificato un errore durante il processamento di un ordine.
     */
    public function ordiniInAttesa(array $array_ordini) {
        $loginVariables = (new VUtente)->checkLogin();
        foreach ($loginVariables as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('array_ordini', $array_ordini);
        
        if (isset($_SESSION['success'])) {
            $this->smarty->assign('success', $_SESSION['success']);
            unset($_SESSION['success']);
        }
        
        if (isset($_SESSION['error'])) {
            $this->smarty->assign('error', $_SESSION['error']);
            unset($_SESSION['error']);
        }
        
        $this->smarty->display('ordiniAttesa.tpl');
    }

    
}
?>

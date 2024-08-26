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
        $this->smarty->assign('array_ordini', $array_ordini);
        $this->smarty->assign('check_login_venditore', 1);
        $this->smarty->assign('check_login', 1);
        $this->smarty->display('ordiniAttesa.tpl');
    }

    
}
?>

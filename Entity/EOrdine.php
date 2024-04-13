<?php
class EOrdine{
    private String $id_ordine;
    private $data;
    private String $stato;
    private int $quantita_prodotto;
    private float $importo_tot;
    private $id_venditore;
    
    public function __construct($id_ordine,$data, $stato,$quantita_prodotto, $importo_tot,$id_venditore){
        $this->id_ordine = $id_ordine;
        $this->data = $data;
        $this->stato = $stato;
        $this->quantita_prodotto = $quantita_prodotto;
        $this->importo_tot = $importo_tot;
        $this->id_venditore = $id_venditore;
    }
    
}
?>
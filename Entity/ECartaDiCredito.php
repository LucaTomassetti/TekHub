<?php
class ECartaDiCredito{
    
    private String $nome_titolare;
    private String $cognome_titolare;
    private String $data_scadenza;
    private String $numero_carta;
    private int $cvv;
    private String $gestore_carta;

    public function __construct($nome_titolare, $cognome_titolare, $data_scadenza, $numero_carta, $cvv, $gestore_carta){
        
        $this->nome_titolare = $nome_titolare;
        $this->cognome_titolare = $cognome_titolare;
        $this->data_scadenza = $data_scadenza;
        $this->cvv = $cvv;
        $this->gestore_carta = $gestore_carta;
    
    }

}
?>
<?php
class EProdtto{

    private String $id_prodotto;
    private String $nome;
    private String $descrizione;
    private $prezzo;
    private int $quantità_disponibili;

    public function __construct($id_prodotto, $nome, $descrizione, $prezzo, $quantità_disponibili){

        $this->id_prodotto = $id_prodotto;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantità_disponibili = $quantità_disponibili;

    }

}
?>
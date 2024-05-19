<?php
class EProdotto{

    private $id_prodotto;
    private $nome;
    private $descrizione;
    private $prezzo;
    private $quantita_disponibili;

    public function __construct($id_prodotto, $nome, $descrizione, $prezzo, $quantita_disponibili){

        $this->id_prodotto = $id_prodotto;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantita_disponibili = $quantita_disponibili;

    }

    /**
     * Get the value of id_prodotto
     *
     * @return $id_prodotto
     */
    public function getIdProdotto()
    {
        return $this->id_prodotto;
    }

    /**
     * Set the value of id_prodotto
     *
     * @param $id_prodotto
     */
    public function setIdProdotto($id_prodotto)
    {
        $this->id_prodotto = $id_prodotto;
    }

    /**
     * Get the value of nome
     *
     * @return $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get the value of descrizione
     *
     * @return $descrizione
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set the value of descrizione
     *
     * @param $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * Get the value of prezzo
     *
     * @return $prezzo
     */
    public function getPrezzo()
    {
        return $this->prezzo;
    }

    /**
     * Set the value of prezzo
     *
     * @param $prezzo
     */
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    /**
     * Get the value of quantita_disponibili
     *
     * @return $quantita_disponibili
     */
    public function getQuantitaDisponibili()
    {
        return $this->quantita_disponibili;
    }

    /**
     * Set the value of quantita_disponibili
     *
     * @param $quantita_disponibili
     */
    public function setQuantitaDisponibili($quantita_disponibili)
    {
        $this->quantita_disponibili = $quantita_disponibili;
    }
}
?>
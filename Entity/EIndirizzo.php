<?php
class EIndirizzo{
    private $indirizzo;
    private $ordini;

    public function __construct($indirizzo){
      $this->indirizzo = $indirizzo;
    }

    /**
     * Get the value of indirizzo
     *
     * @return $indirizzo
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set the value of indirizzo
     *
     * @param $indirizzo
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;
    }

    /**
     * Get the value of ordini
     *
     * @return $ordini
     */
    public function getOrdini()
    {
        return $this->ordini;
    }

    /**
     * Set the value of ordini
     *
     * @param $ordini
     */
    public function setOrdini($ordini)
    {
        $this->ordini = $ordini;
    }
}
?>
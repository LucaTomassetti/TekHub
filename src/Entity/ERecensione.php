<?php
class ERecesione{
    private $id;
    private $testo;
    private $valutazione;

    public function __construct($id, $testo, $valutazione) {
        $this->id = $id;
        $this->testo=$testo;
        $this->valutazione=$valutazione;

    }


    /**
     * Get the value of id
     *
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set the value of id
    *
    * @param $id
    */   
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of testo
     *
     * @return $testo
     */
    public function getTesto()
    {
        return $this->testo;
    }

    /**
    * Set the value of testo
    *
    * @param $testo
    */   
    public function setTesto($testo)
    {
        $this->testo = $testo;

    }

    /**
     * Get the value of valutazione
     *
     * @return $valutazione
     */
    public function getValutazione()
    {
        return $this->valutazione;
    }

    /**
    * Set the value of valutazione
    *
    * @param $valutazione
    */   
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;

    }
}
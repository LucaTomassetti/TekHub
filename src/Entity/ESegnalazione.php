<?php
class ESegnalazione{

    private $id;
    private $data_erogazione;
    private $tipo;
    private $messaggio;

    public function __construct($id,$data_erogazione,$tipo,$messaggio) {
        $this->id=$id;
        $this->data_erogazione = $data_erogazione;
        $this->tipo=$tipo;
        $this->messaggio=$messaggio;
    }
    

    /**
     * Get the value of data_erogazione
     *
     * @return $data_erogazione
     */
    public function getDataErogazione()
    {
        return $this->data_erogazione;
    }

    /**
    * Set the value of data_erogazione
    *
    * @param $data_erogazione
    */   
    public function setDataErogazione($data_erogazione)
    {
        $this->data_erogazione = $data_erogazione;

    }

    /**
     * Get the value of tipo
     *
     * @return $tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
    * Set the value of tipo
    *
    * @param $tipo
    */   
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

    }

    /**
     * Get the value of messaggio
     *
     * @return $messaggio
     */
    public function getMessaggio()
    {
        return $this->messaggio;
    }

    /**
    * Set the value of messaggio
    *
    * @param $messaggio
    */   
    public function setMessaggio($messaggio)
    {
        $this->messaggio = $messaggio;

    }
}
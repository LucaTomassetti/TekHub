<?php
class EOfferta{
    private $id_offerta;
    private $importo;
    private $data;

    public function __construct($id_offerta,$importo,$data) {
        $this->id_offerta = $id_offerta;
        $this->importo=$importo;
        $this->data=$data;

    }

    /**
     * Get the value of id_offerta
     *
     * @return $id_offerta
     */
    public function getIdOfferta()
    {
        return $this->id_offerta;
    }

    /**
    * Set the value of id_offerta
    *
    * @param $id_offerta
    */   
    public function setIdOfferta($id_offerta)
    {
        $this->id_offerta = $id_offerta;

    }

    /**
     * Get the value of importo
     *
     * @return $importo
     */
    public function getImporto()
    {
        return $this->importo;
    }

    /**
    * Set the value of importo
    *
    * @param $importo
    */   
    public function setImporto($importo)
    {
        $this->importo = $importo;

    }

    /**
     * Get the value of data
     *
     * @return $data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
    * Set the value of data
    *
    * @param $data
    */   
    public function setData($data)
    {
        $this->data = $data;

    }
}
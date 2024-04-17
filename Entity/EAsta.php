<?php

class EAsta{
    private $id_asta;
    private $floor_price;
    private $data_creazione;
    private $data_fine;

    public function __consruct($id_asta,$floor_price,$data_creazione,$data_fine){
        $this->id_asta=$id_asta;
        $this->floor_price=$floor_price;
        $this->data_creazione=$data_creazione;
        $this->data_fine=$data_fine;
    }

    /**
     * Get the value of id_asta
     *
     * @return $id_asta
     */
    public function getIdAsta()
    {
        return $this->id_asta;
    }

    /**
     * Set the value of id_asta
     *
     * @param $id_asta
     */
    public function setIdAsta($id_asta)
    {
        $this->id_asta = $id_asta;
    }

    /**
     * Get the value of floor_price
     *
     * @return $floor_price
     */
    public function getFloorPrice()
    {
        return $this->floor_price;
    }

    /**
     * Set the value of floor_price
     *
     * @param $floor_price
     */
    public function setFloorPrice($floor_price)
    {
        $this->floor_price = $floor_price;
    }

    /**
     * Get the value of data_creazione
     *
     * @return $data_creazione
     */
    public function getDataCreazione()
    {
        return $this->data_creazione;
    }

    /**
     * Set the value of data_creazione
     *
     * @param $data_creazione
     */
    public function setDataCreazione($data_creazione)
    {
        $this->data_creazione = $data_creazione;
    }

    /**
     * Get the value of data_fine
     *
     * @return $data_fine
     */
    public function getDataFine()
    {
        return $this->data_fine;
    }

    /**
     * Set the value of data_fine
     *
     * @param $data_fine
     */
    public function setDataFine($data_fine)
    {
        $this->data_fine = $data_fine;
    }
}

?>
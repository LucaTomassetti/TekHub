<?php
class ERimborso{

    private $id;
    private $importo;
    private $data_erogazione;

    public function __construct($id, $importo, $data_erogazione){

        $this->id = $id;
        $this->importo = $importo;
        $this->data_erogazione = $data_erogazione;
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
}
?>
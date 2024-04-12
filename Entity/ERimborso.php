<?php
class ERimborso{

    private $id;
    private $importo;
    private String $data_erogazione;

    public function __construct($id, $importo, $data_erogazione){

        $this->id = $id;
        $this->importo = $importo;
        $this->data_erogazione = $data_erogazione;
    }

}
?>
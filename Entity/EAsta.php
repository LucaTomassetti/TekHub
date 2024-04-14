<?php

class EAsta{
    private String $id_asta;
    private float $floor_price;
    private String $data_creazione;
    private String $data_fine;

    public function __consruct($id_asta,$floor_price,$data_creazione,$data_fine){
        $this->id_asta=$id_asta;
        $this->floor_price=$floor_price;
        $this->data_creazione=$data_creazione;
        $this->data_fine=$data_fine;
    }

}

?>
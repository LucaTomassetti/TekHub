<?php

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table('p_usato')]
class EUsato extends EProdotto{
    #[ORM\Column(type: 'integer', columnDefinition: "DOUBLE(5,2)")]
    private $floor_price;
    
    #[ORM\OneToOne(targetEntity: EAsta::class, inversedBy: 'usato')]
    #[ORM\JoinColumn(name: 'asta_id', referencedColumnName: 'id_asta')]
    private EAsta|null $asta = null;

    public $discr = "p_usato";

    public function __construct($id_prodotto, $nome, $descrizione, $floor_price) {
        parent::__construct($id_prodotto, $nome, $descrizione);
        $this->floor_price = $floor_price;
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
}


?>
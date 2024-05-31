<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
#[Table('p_usato')]
class EUsato extends EProdotto{
    #[Column(type: 'integer', columnDefinition: "DOUBLE(5,2)")]
    private $floor_price;

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
<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table('p_usato')]
class EUsato extends EProdotto{
    #[ORM\Column(type: 'integer', columnDefinition: "DOUBLE(5,2)")]
    private $floor_price;
    
    #[ORM\OneToOne(targetEntity: EAsta::class, inversedBy: 'usato')]
    #[ORM\JoinColumn(name: 'asta_id', referencedColumnName: 'id_asta', nullable:false)]
    private EAsta|null $asta = null;

    #[ORM\OneToMany(targetEntity:EOfferta::class, mappedBy:'p_usato_id')]
    private Collection $offerte;

    public $discr = "p_usato";

    public function __construct($id_prodotto, $nome, $descrizione, $floor_price) {
        parent::__construct($id_prodotto, $nome, $descrizione);
        $this->floor_price = $floor_price;
        $this->offerte = new ArrayCollection();
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
     * Get the value of asta
     */
    public function getAsta(): ?EAsta
    {
        return $this->asta;
    }

    /**
     * Set the value of asta
     */
    public function setAsta(?EAsta $asta): self
    {
        $this->asta = $asta;

        return $this;
    }

    /**
     * Get the value of offerte
     */
    public function getOfferte(): Collection
    {
        return $this->offerte;
    }

    /**
     * Set the value of offerte
     */
    public function setOfferte(Collection $offerte): self
    {
        $this->offerte = $offerte;

        return $this;
    }
}


?>
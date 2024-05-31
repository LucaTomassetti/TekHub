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
#[Table('p_nuovo')]
class ENuovo extends EProdotto{
    #[Column(type: 'integer', columnDefinition: "DOUBLE(5,2)")]
    private $prezzo_fisso;

    #[Column(type: 'integer')]
    private $quantita_disp;

    public $discr = "p_nuovo";

    public function __construct($id_prodotto, $nome, $descrizione, $prezzo_fisso, $quantita_disp) {
        parent::__construct($id_prodotto, $nome, $descrizione);
        $this->prezzo_fisso = $prezzo_fisso;
        $this->quantita_disp = $quantita_disp;
    }

    /**
     * Get the value of prezzo_fisso
     *
     * @return $prezzo_fisso
     */
    public function getPrezzoFisso()
    {
        return $this->prezzo_fisso;
    }

    /**
     * Set the value of prezzo_fisso
     *
     * @param $prezzo_fisso
     */
    public function setPrezzoFisso($prezzo_fisso)
    {
        $this->prezzo_fisso = $prezzo_fisso;
    }

    /**
     * Get the value of quantita_disp
     *
     * @return $quantita_disp
     */
    public function getQuantitaDisp()
    {
        return $this->quantita_disp;
    }

    /**
     * Set the value of quantita_disp
     *
     * @param $quantita_disp
     */
    public function setQuantitaDisp($quantita_disp)
    {
        $this->quantita_disp = $quantita_disp;
    }
}


?>
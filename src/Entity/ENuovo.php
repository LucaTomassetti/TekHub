<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FNuovo::class)]
#[ORM\Table('p_nuovo')]
class ENuovo extends EProdotto{
    #[ORM\Column(type: 'integer', columnDefinition: "DOUBLE(7,2)")]
    private $prezzo_fisso;

    #[ORM\Column(type: 'integer')]
    private $quantita_disp;

    public $discr = "p_nuovo";

    public function __construct($id_prodotto, $nome, $descrizione, $marca, $modello, $colore, $prezzo_fisso, $quantita_disp) {
        parent::__construct($nome, $descrizione,$marca, $modello, $colore);
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
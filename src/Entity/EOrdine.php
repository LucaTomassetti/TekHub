<?php
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[Table('ordine')]
class EOrdine{

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    #[OneToMany(targetEntity:EIndirizzo::class, mappedBy:'ordini',cascade: ['ALL'])]
    private int|null $id_ordine = null;

    #[Column(type: 'datetime')]
    private $data;

    #[Column(type: 'string')]
    private $stato;

    #[Column(type: 'integer')]
    private $quantita_prodotto;

    #[Column(type: 'float')]
    private $importo_tot;

    //#[Column(type: 'string')]
    private $id_venditore;
    
    public function __construct($id_ordine,$data, $stato,$quantita_prodotto, $importo_tot,$id_venditore){
        $this->id_ordine = $id_ordine;
        $this->data = $data;
        $this->stato = $stato;
        $this->quantita_prodotto = $quantita_prodotto;
        $this->importo_tot = $importo_tot;
        $this->id_venditore = $id_venditore;
    }

    /**
     * Get the value of id_ordine
     *
     * @return $id_ordine
     */
    public function getIdOrdine()
    {
        return $this->id_ordine;
    }

    /**
     * Set the value of id_ordine
     *
     * @param $id_ordine
     */
    public function setIdOrdine($id_ordine)
    {
        $this->id_ordine = $id_ordine;
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

    /**
     * Get the value of stato
     *
     * @return $stato
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set the value of stato
     *
     * @param $stato
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    }

    /**
     * Get the value of quantita_prodotto
     *
     * @return $quantita_prodotto
     */
    public function getQuantitaProdotto()
    {
        return $this->quantita_prodotto;
    }

    /**
     * Set the value of quantita_prodotto
     *
     * @param $quantita_prodotto
     */
    public function setQuantitaProdotto($quantita_prodotto)
    {
        $this->quantita_prodotto = $quantita_prodotto;
    }

    /**
     * Get the value of importo_tot
     *
     * @return $importo_tot
     */
    public function getImportoTot()
    {
        return $this->importo_tot;
    }

    /**
     * Set the value of importo_tot
     *
     * @param $importo_tot
     */
    public function setImportoTot($importo_tot)
    {
        $this->importo_tot = $importo_tot;
    }

    /**
     * Get the value of id_venditore
     *
     * @return $id_venditore
     */
    public function getIdVenditore()
    {
        return $this->id_venditore;
    }

    /**
     * Set the value of id_venditore
     *
     * @param $id_venditore
     */
    public function setIdVenditore($id_venditore)
    {
        $this->id_venditore = $id_venditore;
    }
}
?>
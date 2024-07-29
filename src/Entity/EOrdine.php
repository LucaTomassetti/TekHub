<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('ordine')]
class EOrdine{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_ordine = null;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\Column(type: 'boolean')]
    private $is_preso_in_carico;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $stato;

    #[ORM\Column(type: 'integer')]
    private $quantita_prodotto;

    #[ORM\Column(type: 'float')]
    private $importo_tot;

    #[ORM\OneToMany(targetEntity:EIndirizzo::class, mappedBy:'ordine')]
    private Collection $indirizzi;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'ordini')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $acquirente = null;

    #[ORM\ManyToOne(targetEntity: ECartaDiCredito::class, inversedBy:'ordini')]
    #[ORM\JoinColumn(name:'carta_ordine', referencedColumnName:'numero_carta')]
    private ECartaDiCredito|null $carta_ordine = null;

    #[ORM\OneToMany(targetEntity: EOrdineProdotto::class, mappedBy: 'ordine_id')]
    private Collection $q_prodotto_ordine;
    
    public function __construct($data, $stato,$quantita_prodotto, $importo_tot){
        $this->data = $data;
        $this->stato = $stato;
        $this->quantita_prodotto = $quantita_prodotto;
        $this->importo_tot = $importo_tot;
        $this->indirizzi = new ArrayCollection();
        $this->q_prodotto_ordine = new ArrayCollection();
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
     * Get the value of indirizzi
     *
     * @return $indirizzi
     */
    public function getIndirizzi()
    {
        return $this->indirizzi;
    }

    /**
     * Get the value of acquirente
     *
     * @return $acquirente
     */
    public function getAcquirente()
    {
        return $this->acquirente;
    }

    /**
     * Set the value of acquirente
     *
     * @param $acquirente
     */
    public function setAcquirente($acquirente)
    {
        $this->acquirente = $acquirente;
    }

    /**
     * Get the value of carta_ordine
     */
    public function getCartaOrdine(): ?ECartaDiCredito
    {
        return $this->carta_ordine;
    }

    /**
     * Set the value of carta_ordine
     */
    public function setCartaOrdine(?ECartaDiCredito $carta_ordine)
    {
        $this->carta_ordine = $carta_ordine;
    }

    /**
     * Get the value of q_prodotto_ordine
     */
    public function getQProdottoOrdine(): Collection
    {
        return $this->q_prodotto_ordine;
    }

    /**
     * Set the value of q_prodotto_ordine
     */
    public function setQProdottoOrdine(Collection $q_prodotto_ordine)
    {
        $this->q_prodotto_ordine = $q_prodotto_ordine;
    }

    /**
     * Get the value of is_preso_in_carico
     */
    public function getIsPresoInCarico()
    {
        return $this->is_preso_in_carico;
    }

    /**
     * Set the value of is_preso_in_carico
     */
    public function setIsPresoInCarico($is_preso_in_carico)
    {
        $this->is_preso_in_carico = $is_preso_in_carico;
    }
}
?>
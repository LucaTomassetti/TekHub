<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FOrdine::class)]
#[ORM\Table('ordine')]
class EOrdine{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_ordine = null;

    #[ORM\Column(type: 'date')]
    private $data_ordine;

    #[ORM\Column(type: 'boolean')]
    private $is_preso_in_carico;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $stato_ordine;

    #[ORM\Column(type: 'integer')]
    private $quantita_tot_prodotti;

    #[ORM\Column(type: 'float', columnDefinition:'DOUBLE(8,2)')]
    private $importo_tot;

    #[ORM\ManyToOne(targetEntity: EIndirizzo::class, inversedBy: 'ordini')]
    #[ORM\JoinColumn(name: 'indirizzo_spedizione', referencedColumnName: 'indirizzo')]
    #[ORM\JoinColumn(name: 'cap_spedizione', referencedColumnName: 'cap')]
    private EIndirizzo|null $indirizzo_spedizione = null;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'ordini')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $acquirente = null;

    #[ORM\ManyToOne(targetEntity: ECartaDiCredito::class, inversedBy:'ordini')]
    #[ORM\JoinColumn(name: 'carta_di_credito', referencedColumnName: 'numero_carta',nullable:false)]
    private ECartaDiCredito|null $carta_ordine = null;

    #[ORM\OneToMany(targetEntity: EOrdineProdotto::class, mappedBy: 'ordine_id')]
    private Collection $q_prodotto_ordine;
    
    public function __construct(){
        $this->data_ordine = new \DateTime();
        $this->stato_ordine = 'In elaborazione';
        $this->quantita_tot_prodotti = 0;
        $this->importo_tot = 0.0;
        $this->q_prodotto_ordine = new ArrayCollection();
    }

    public function addQProdottoOrdine(EOrdineProdotto $ordineProdotto){
        if (!$this->q_prodotto_ordine->contains($ordineProdotto)) {
            $this->q_prodotto_ordine[] = $ordineProdotto;
            $ordineProdotto->setOrdineId($this);
        }
    }

    public function removeQProdottoOrdine(EOrdineProdotto $ordineProdotto){
        if ($this->q_prodotto_ordine->removeElement($ordineProdotto)) {
            // set the owning side to null (unless already changed)
            if ($ordineProdotto->getOrdineId() === $this) {
                $ordineProdotto->setOrdineId(null);
            }
        }
    }
    /**
     * Get the value of id_ordine
     *
     * @return $id_ordine
     */
    public function getId_ordine()
    {
        return $this->id_ordine;
    }

    /**
     * Set the value of id_ordine
     *
     * @param $id_ordine
     */
    public function setId_ordine($id_ordine)
    {
        $this->id_ordine = $id_ordine;
    }

    /**
     * Get the value of data_ordine
     */ 
    public function getData_ordine()
    {
        return $this->data_ordine;
    }

    /**
     * Set the value of data_ordine
     *
     * @return  self
     */ 
    public function setData_ordine($data_ordine)
    {
        $this->data_ordine = $data_ordine;

        return $this;
    }

    /**
     * Get the value of stato
     *
     * @return $stato
     */
    public function getStato_ordine()
    {
        return $this->stato_ordine;
    }

    /**
     * Set the value of stato
     *
     * @param $stato
     */
    public function setStato_ordine($stato_ordine)
    {
        $this->stato_ordine = $stato_ordine;
    }

    /**
     * Get the value of quantita_tot_prodotti
     */ 
    public function getQuantita_tot_prodotti()
    {
        return $this->quantita_tot_prodotti;
    }

    /**
     * Set the value of quantita_tot_prodotti
     *
     * @return  self
     */ 
    public function setQuantita_tot_prodotti($quantita_tot_prodotti)
    {
        $this->quantita_tot_prodotti = $quantita_tot_prodotti;

        return $this;
    }

    /**
     * Get the value of importo_tot
     *
     * @return $importo_tot
     */
    public function getImporto_tot()
    {
        return $this->importo_tot;
    }

    /**
     * Set the value of importo_tot
     *
     * @param $importo_tot
     */
    public function setImporto_tot($importo_tot)
    {
        $this->importo_tot = $importo_tot;
    }

     /**
     * Get the value of indirizzo_spedizione
     */ 
    public function getIndirizzo_spedizione()
    {
        return $this->indirizzo_spedizione;
    }

    /**
     * Set the value of indirizzo_spedizione
     *
     * @return  self
     */ 
    public function setIndirizzo_spedizione($indirizzo_spedizione)
    {
        $this->indirizzo_spedizione = $indirizzo_spedizione;

        return $this;
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
    public function getCarta_ordine(): ?ECartaDiCredito
    {
        return $this->carta_ordine;
    }

    /**
     * Set the value of carta_ordine
     */
    public function setCarta_ordine(?ECartaDiCredito $carta_ordine)
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
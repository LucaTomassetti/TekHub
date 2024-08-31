<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FOfferta::class)]
#[ORM\Table('offerta')]
class EOfferta{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id_offerta;

    #[ORM\Column(type: 'integer', columnDefinition:'DOUBLE(7,2)')]
    private $importo;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\Column(type: 'string', length: 20)]
    private $stato;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'offerte')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $acquirente = null;

    #[ORM\ManyToOne(targetEntity: EUsato::class, inversedBy:'offerte')]
    #[ORM\JoinColumn(name:'prodotto', referencedColumnName:'id_prodotto', nullable:true)]
    private EUsato|null $prodotto = null;

    public function __construct($importo, \DateTime $data) {
        $this->importo = $importo;
        $this->data = $data;
        $this->stato = 'In attesa';
    }

    public function getStato(): string {
        return $this->stato;
    }

    public function setStato(string $stato): self {
        $this->stato = $stato;
        return $this;
    }
    /**
     * Get the value of id_offerta
     *
     * @return $id_offerta
     */
    public function getIdOfferta()
    {
        return $this->id_offerta;
    }

    /**
    * Set the value of id_offerta
    *
    * @param $id_offerta
    */   
    public function setIdOfferta($id_offerta)
    {
        $this->id_offerta = $id_offerta;

    }

    /**
     * Get the value of importo
     *
     * @return $importo
     */
    public function getImporto()
    {
        return $this->importo;
    }

    /**
    * Set the value of importo
    *
    * @param $importo
    */   
    public function setImporto($importo)
    {
        $this->importo = $importo;

    }

    public function setData(\DateTime $data){
        $this->data = $data;
    }

    public function getData(): \DateTime {
        return $this->data;
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
     * Get the value of prodotto
     */
    public function getProdotto(): ?EUsato
    {
        return $this->prodotto;
    }

    /**
     * Set the value of prodotto
     */
    public function setProdotto(?EUsato $prodotto)
    {
        $this->prodotto = $prodotto;
    }
}
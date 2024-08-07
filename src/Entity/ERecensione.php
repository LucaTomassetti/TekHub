<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('recensione')]
class ERecensione{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', columnDefinition: 'TEXT')]
    private $testo;

    #[ORM\Column(type: 'integer', columnDefinition:'INT(5)')]
    private $valutazione;

    #[ORM\ManyToOne(targetEntity:EAcquirente::class, inversedBy:'recensioni')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $acquirente = null;
    
    #[ORM\ManyToOne(targetEntity:EProdotto::class, inversedBy:'recensioni')]
    #[ORM\JoinColumn(name:'prodotto', referencedColumnName:'id_prodotto', nullable:true)]
    private EProdotto|null $prodotto = null;

    #[ORM\OneToOne(targetEntity: ESegnalazione::class, inversedBy: 'recensione')]
    #[ORM\JoinColumn(name: 'segnalazione', referencedColumnName: 'id_segnalazione', nullable:true)]
    private ESegnalazione|null $segnalazione = null;

    public function __construct($testo, $valutazione) {
        $this->testo=$testo;
        $this->valutazione=$valutazione;

    }


    /**
     * Get the value of id
     *
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set the value of id
    *
    * @param $id
    */   
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of testo
     *
     * @return $testo
     */
    public function getTesto()
    {
        return $this->testo;
    }

    /**
    * Set the value of testo
    *
    * @param $testo
    */   
    public function setTesto($testo)
    {
        $this->testo = $testo;

    }

    /**
     * Get the value of valutazione
     *
     * @return $valutazione
     */
    public function getValutazione()
    {
        return $this->valutazione;
    }

    /**
    * Set the value of valutazione
    *
    * @param $valutazione
    */   
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;

    }

    /**
     * Get the value of acquirente
     */
    public function getAcquirente(): ?EAcquirente
    {
        return $this->acquirente;
    }

    /**
     * Set the value of acquirente
     */
    public function setAcquirente(?EAcquirente $acquirente): self
    {
        $this->acquirente = $acquirente;

        return $this;
    }

    /**
     * Get the value of prodotto
     */
    public function getProdotto(): ?EProdotto
    {
        return $this->prodotto;
    }

    /**
     * Set the value of prodotto
     */
    public function setProdotto(?EProdotto $prodotto): self
    {
        $this->prodotto = $prodotto;

        return $this;
    }

    /**
     * Get the value of segnalazione
     */
    public function getSegnalazione(): ?ESegnalazione
    {
        return $this->segnalazione;
    }

    /**
     * Set the value of segnalazione
     */
    public function setSegnalazione(?ESegnalazione $segnalazione): self
    {
        $this->segnalazione = $segnalazione;

        return $this;
    }
}
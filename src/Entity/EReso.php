<?php
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Color;

#[ORM\Entity]
#[ORM\Table('reso')]
class EReso {

    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_reso = null;

    #[ORM\Column(type:'string', columnDefinition: 'TEXT')]
    private $descrizione;

    #[ORM\Column(type:'date')]
    private $data_reso;

    #[ORM\Column(type:'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $stato_reso;

    #[ORM\ManyToOne(targetEntity:EAcquirente::class, inversedBy:'resi')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $acquirente = null;

    #[ORM\ManyToOne(targetEntity:EProdotto::class, inversedBy:'resi')]
    #[ORM\JoinColumn(name:'prodotto', referencedColumnName:'id_prodotto', nullable:true)]
    private EProdotto|null $prodotto = null;

    public function __construct($descrizione, $data_reso, $stato_reso) {
        $this->descrizione = $descrizione;
        $this->data_reso = $data_reso;
        $this->stato_reso = $stato_reso;
    }

    /**
     * Get the value of id_reso
     */ 
    public function getId_reso()
    {
        return $this->id_reso;
    }

    /**
     * Get the value of descrizione
     */ 
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set the value of descrizione
     *
     * @return  self
     */ 
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get the value of data_reso
     */ 
    public function getData_reso()
    {
        return $this->data_reso;
    }

    /**
     * Set the value of data_reso
     *
     * @return  self
     */ 
    public function setData_reso($data_reso)
    {
        $this->data_reso = $data_reso;

        return $this;
    }

    /**
     * Get the value of stato_reso
     */ 
    public function getStato_reso()
    {
        return $this->stato_reso;
    }

    /**
     * Set the value of stato_reso
     *
     * @return  self
     */ 
    public function setStato_reso($stato_reso)
    {
        $this->stato_reso = $stato_reso;

        return $this;
    }

    /**
     * Get the value of prodotto
     */ 
    public function getProdotto()
    {
        return $this->prodotto;
    }

    /**
     * Set the value of prodotto
     *
     * @return  self
     */ 
    public function setProdotto($prodotto)
    {
        $this->prodotto = $prodotto;

        return $this;
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
}
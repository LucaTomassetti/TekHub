<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FCartaDiCredito::class)]
#[ORM\Table('carta_di_credito')]
class ECartaDiCredito{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 16, columnDefinition: 'VARCHAR(16)')]
    private $numero_carta;

    #[ORM\Column(type: 'string', length: 50, columnDefinition: 'VARCHAR(50)')]
    private $nome_titolare;

    #[ORM\Column(type: 'string', length: 70, columnDefinition: 'VARCHAR(70)')]
    private $cognome_titolare;

    #[ORM\Column(type: 'string', length: 5, columnDefinition: 'VARCHAR(5)')]  // Cambiato da 'date' a 'string'
    private $data_scadenza;

    #[ORM\Column(type: 'integer', columnDefinition: 'INT(3)')]
    private $ccv;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $gestore_carta;

    #[ORM\Column(type: 'boolean')]
    private $is_deleted = false;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'carte_di_credito')]
    #[ORM\JoinColumn(name:'proprietario', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $proprietario = null;

    #[ORM\OneToMany(targetEntity: EOrdine::class, mappedBy:'carta_ordine')]
    private Collection $ordini;

    public function __construct($nome_titolare = null, $cognome_titolare = null, $data_scadenza = null, $numero_carta = null, $ccv = null, $gestore_carta = null){
        if ($nome_titolare !== null) {
            $this->nome_titolare = $nome_titolare;
            $this->cognome_titolare = $cognome_titolare;
            $this->setData_scadenza($data_scadenza);
            $this->numero_carta = $numero_carta;
            $this->ccv = $ccv;
            $this->gestore_carta = $gestore_carta;
        }
    
    }

    public function isDeleted(): bool
    {
        return $this->is_deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->is_deleted = $deleted;
        return $this;
    }
    /**
     * Get the value of nome_titolare
     */ 
    public function getNome_titolare()
    {
        return $this->nome_titolare;
    }

    /**
     * Set the value of nome_titolare
     *
     * @return  self
     */ 
    public function setNome_titolare($nome_titolare)
    {
        $this->nome_titolare = $nome_titolare;

        return $this;
    }

    /**
     * Get the value of cognome_titolare
     */ 
    public function getCognome_titolare()
    {
        return $this->cognome_titolare;
    }

    /**
     * Set the value of cognome_titolare
     *
     * @return  self
     */ 
    public function setCognome_titolare($cognome_titolare)
    {
        $this->cognome_titolare = $cognome_titolare;

        return $this;
    }

    public function setData_scadenza($data_scadenza)
    {
        // Assicuriamoci che la data sia nel formato MM/YY
        if (preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $data_scadenza)) {
            $this->data_scadenza = $data_scadenza;
        } else {
            throw new \InvalidArgumentException('Il formato della data di scadenza deve essere MM/YY');
        }
    }

    public function getData_scadenza()
    {
        return $this->data_scadenza;
    }

    /**
     * Get the value of numero_carta
     */ 
    public function getNumero_carta()
    {
        return $this->numero_carta;
    }

    /**
     * Set the value of numero_carta
     *
     * @return  self
     */ 
    public function setNumero_carta($numero_carta)
    {
        $this->numero_carta = $numero_carta;

        return $this;
    }

    /**
     * Get the value of gestore_carta
     */ 
    public function getGestore_carta()
    {
        return $this->gestore_carta;
    }

    /**
     * Set the value of gestore_carta
     *
     * @return  self
     */ 
    public function setGestore_carta($gestore_carta)
    {
        $this->gestore_carta = $gestore_carta;

        return $this;
    }

    /**
     * Get the value of ccv
     */ 
    public function getCcv()
    {
        return $this->ccv;
    }

    /**
     * Set the value of ccv
     *
     * @return  self
     */ 
    public function setCcv($ccv)
    {
        $this->ccv = $ccv;

        return $this;
    }

    /**
     * Get the value of proprietario
     */ 
    public function getProprietario()
    {
        return $this->proprietario;
    }

    /**
     * Set the value of proprietario
     *
     * @return  self
     */ 
    public function setProprietario($proprietario)
    {
        $this->proprietario = $proprietario;

        return $this;
    }

    /**
     * Get the value of ordini
     */ 
    public function getOrdini()
    {
        return $this->ordini;
    }

    /**
     * Set the value of ordini
     *
     * @return  self
     */ 
    public function setOrdini($ordini)
    {
        $this->ordini = $ordini;

        return $this;
    }
}
?>
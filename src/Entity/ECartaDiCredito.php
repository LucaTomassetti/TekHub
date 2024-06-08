<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('carta_di_credito')]
class ECartaDiCredito{
    #[ORM\Id]
    #[ORM\Column(type: 'bigint', columnDefinition:'BIGINT(16)')]
    private $numero_carta;

    #[ORM\Column(type: 'string', length:50, columnDefinition:'VARCHAR(50)')]
    private $nome_titolare;

    #[ORM\Column(type: 'string', length:70, columnDefinition:'VARCHAR(70)')]
    private $cognome_titolare;

    #[ORM\Column(type: 'date')]
    private $data_scadenza;

    #[ORM\Column(type: 'integer', columnDefinition: 'INT(3)')]
    private $cvv;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $gestore_carta;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'carte_di_credito')]
    #[ORM\JoinColumn(name:'id_proprietario', referencedColumnName:'id_acquirente')]
    private EAcquirente|null $proprietario = null;

    #[ORM\OneToMany(targetEntity: EOrdine::class, mappedBy:'carta_ordine')]
    private Collection $ordini;

    public function __construct($nome_titolare, $cognome_titolare, $data_scadenza, $numero_carta, $cvv, $gestore_carta){
        
        $this->nome_titolare = $nome_titolare;
        $this->cognome_titolare = $cognome_titolare;
        $this->data_scadenza = $data_scadenza;
        $this->cvv = $cvv;
        $this->gestore_carta = $gestore_carta;
        $this->ordini = new ArrayCollection();
    
    }

    /**
     * Get the value of nome_titolare
     *
     * @return $nome_titolare
     */
    public function getNomeTitolare()
    {
        return $this->nome_titolare;
    }

    /**
     * Set the value of nome_titolare
     *
     * @param $nome_titolare
     */
    public function setNomeTitolare($nome_titolare)
    {
        $this->nome_titolare = $nome_titolare;
    }

    /**
     * Get the value of cognome_titolare
     *
     * @return $cognome_titolare
     */
    public function getCognomeTitolare()
    {
        return $this->cognome_titolare;
    }

    /**
     * Set the value of cognome_titolare
     *
     * @param $cognome_titolare
     */
    public function setCognomeTitolare($cognome_titolare)
    {
        $this->cognome_titolare = $cognome_titolare;
    }

    /**
     * Get the value of data_scadenza
     *
     * @return $data_scadenza
     */
    public function getDataScadenza()
    {
        return $this->data_scadenza;
    }

    /**
     * Set the value of data_scadenza
     *
     * @param $data_scadenza
     */
    public function setDataScadenza($data_scadenza)
    {
        $this->data_scadenza = $data_scadenza;
    }

    /**
     * Get the value of numero_carta
     *
     * @return $numero_carta
     */
    public function getNumeroCarta()
    {
        return $this->numero_carta;
    }

    /**
     * Set the value of numero_carta
     *
     * @param $numero_carta
     */
    public function setNumeroCarta($numero_carta)
    {
        $this->numero_carta = $numero_carta;
    }

    /**
     * Get the value of cvv
     *
     * @return $cvv
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set the value of cvv
     *
     * @param $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * Get the value of gestore_carta
     *
     * @return $gestore_carta
     */
    public function getGestoreCarta()
    {
        return $this->gestore_carta;
    }

    /**
     * Set the value of gestore_carta
     *
     * @param $gestore_carta
     */
    public function setGestoreCarta($gestore_carta)
    {
        $this->gestore_carta = $gestore_carta;
    }

    /**
     * Get the value of ordini
     */
    public function getOrdini(): Collection
    {
        return $this->ordini;
    }

    /**
     * Set the value of ordini
     */
    public function setOrdini(Collection $ordini): self
    {
        $this->ordini = $ordini;

        return $this;
    }

    /**
     * Get the value of proprietario
     */
    public function getProprietario(): ?EAcquirente
    {
        return $this->proprietario;
    }

    /**
     * Set the value of proprietario
     */
    public function setProprietario(?EAcquirente $proprietario): self
    {
        $this->proprietario = $proprietario;

        return $this;
    }
}
?>
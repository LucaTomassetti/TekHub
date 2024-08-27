<?php
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass:FAsta::class)]
#[ORM\Table('asta')]
class EAsta{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id_asta;

    #[ORM\Column(type: 'datetime')]
    private $data_creazione;

    #[ORM\Column(type: 'datetime')]
    private $data_fine;

    #[ORM\OneToOne(targetEntity: EUsato::class, mappedBy: 'asta')]
    private EUsato|null $usato = null;

    #[ORM\ManyToOne(targetEntity: EVenditore::class, inversedBy:'aste')]
    #[ORM\JoinColumn(name:'venditore', referencedColumnName:'id_venditore', nullable:true)]
    private EVenditore|null $venditore = null;

    #[ORM\Column(type: 'string', length: 20)]
    private $stato_asta;

    public function __construct($data_creazione, $data_fine) {
        $this->data_creazione = $data_creazione;
        $this->data_fine = $data_fine;
        $this->stato_asta = 'In corso';
    }

    public function getStatoAsta(): string {
        return $this->stato_asta;
    }

    public function setStatoAsta(string $stato_asta): self {
        $this->stato_asta = $stato_asta;
        return $this;
    }

    /**
     * Get the value of id_asta
     *
     * @return $id_asta
     */
    public function getIdAsta()
    {
        return $this->id_asta;
    }

    /**
     * Get the value of data_creazione
     *
     * @return $data_creazione
     */
    public function getDataCreazione(): \DateTime {
        return $this->data_creazione;
    }

    /**
     * Set the value of data_creazione
     *
     * @param $data_creazione
     */
    public function setDataCreazione($data_creazione)
    {
        $this->data_creazione = $data_creazione;
    }

    /**
     * Get the value of data_fine
     *
     * @return $data_fine
     */
    public function getDataFine(): \DateTime {
        return $this->data_fine;
    }

    /**
     * Set the value of data_fine
     *
     * @param $data_fine
     */
    public function setDataFine($data_fine)
    {
        $this->data_fine = $data_fine;
    }

    /**
     * Get the value of usato
     */
    public function getUsato(): ?EUsato
    {
        return $this->usato;
    }

    /**
     * Set the value of usato
     */
    public function setUsato(?EUsato $usato): self
    {
        $this->usato = $usato;

        return $this;
    }

    /**
     * Get the value of venditore
     */
    public function getVenditore(): ?EVenditore
    {
        return $this->venditore;
    }

    /**
     * Set the value of venditore
     */
    public function setVenditore(?EVenditore $venditore): self
    {
        $this->venditore = $venditore;

        return $this;
    }
}

?>
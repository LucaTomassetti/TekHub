<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('segnalazione')]
class ESegnalazione{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_segnalazione = null;

    #[ORM\Column(type: 'text', columnDefinition:'TEXT')]
    private $motivo;

    #[ORM\Column(type: 'boolean')]
    private $gestita = false;

    #[ORM\OneToOne(targetEntity: ERecensione::class, mappedBy: 'segnalazione')]
    private ERecensione|null $recensione = null;

    #[ORM\ManyToOne(targetEntity:EVenditore::class, inversedBy:'segnalazioni')]
    #[ORM\JoinColumn(name:'venditore', referencedColumnName:'id_venditore', nullable:true)]
    private EVenditore|null $venditore = null;

    public function __construct() {

    }

    /**
     * Get the value of messaggio
     *
     * @return $messaggio
     */
    public function getMessaggio()
    {
        return $this->motivo;
    }

    /**
    * Set the value of messaggio
    *
    * @param $messaggio
    */   
    public function setMessaggio($motivo)
    {
        $this->motivo = $motivo;

    }

    /**
     * Get the value of recensione
     */
    public function getRecensione(): ?ERecensione
    {
        return $this->recensione;
    }

    /**
     * Set the value of recensione
     */
    public function setRecensione(?ERecensione $recensione): self
    {
        $this->recensione = $recensione;

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

    /**
     * Get the value of id_segnalazione
     */
    public function getIdSegnalazione(): ?int
    {
        return $this->id_segnalazione;
    }

    /**
     * Get the value of gestita
     */
    public function getGestita()
    {
        return $this->gestita;
    }

    /**
     * Set the value of gestita
     */
    public function setGestita($gestita): self
    {
        $this->gestita = $gestita;

        return $this;
    }
}
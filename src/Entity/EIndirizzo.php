<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FIndirizzo::class)]
#[ORM\Table('indirizzo')]
class EIndirizzo{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length:40, columnDefinition:'VARCHAR(40)')]
    private string|null $indirizzo = null;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 5, columnDefinition: 'VARCHAR(5)')]
    private string|null $cap = null;

    #[ORM\Column(type: 'boolean')]
    private $is_deleted = false;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'indirizzi')]
    #[ORM\JoinColumn(name:'cliente_residente', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $cliente_residente = null;

    #[ORM\OneToMany(targetEntity:EOrdine::class, mappedBy:'indirizzo_spedizione')]
    private Collection $ordini;

    public function __construct($indirizzo, $cap){
        $this->indirizzo = $indirizzo;
        $this->cap = $cap;
        $this->ordini = new ArrayCollection();
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
     * Get the value of indirizzo
     */ 
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set the value of indirizzo
     */
    public function setIndirizzo(?string $indirizzo)
    {
        $this->indirizzo = $indirizzo;
    }
    public function getClienteResidente(): ?EAcquirente
    {
        return $this->cliente_residente;
    }

    public function setClienteResidente(?EAcquirente $cliente_residente): self
    {
        $this->cliente_residente = $cliente_residente;
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

    /**
     * Get the value of cap
     */
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * Set the value of cap
     */
    public function setCap($cap)
    {
        $this->cap = $cap;
    }
}
?>
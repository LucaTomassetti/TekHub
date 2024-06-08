<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('ordine_prodotto')]
class EOrdineProdotto {
    #[ORM\Column(type:'integer')]
    private $quantita_ordinata_prodotto;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:EOrdine::class, inversedBy:'q_prodotto_ordine')]
    #[ORM\JoinColumn(name:'id_ordine', referencedColumnName:'id_ordine')]
    private EOrdine|null $ordine_id= null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:EProdotto::class, inversedBy:'q_prodotto_ordine')]
    #[ORM\JoinColumn(name:'id_prodotto', referencedColumnName:'id_prodotto')]
    private EProdotto|null $prodotto_id= null;

    public function __construct($quantita_ordinata_prodotto) {
        $this->quantita_ordinata_prodotto = $quantita_ordinata_prodotto;
    }

    /**
     * Get the value of quantita_ordinata_prodotto
     */
    public function getQuantitaOrdinataProdotto()
    {
        return $this->quantita_ordinata_prodotto;
    }

    /**
     * Set the value of quantita_ordinata_prodotto
     */
    public function setQuantitaOrdinataProdotto($quantita_ordinata_prodotto): self
    {
        $this->quantita_ordinata_prodotto = $quantita_ordinata_prodotto;

        return $this;
    }

    /**
     * Get the value of ordine_id
     */
    public function getOrdineId(): ?EOrdine
    {
        return $this->ordine_id;
    }

    /**
     * Set the value of ordine_id
     */
    public function setOrdineId(?EOrdine $ordine_id): self
    {
        $this->ordine_id = $ordine_id;

        return $this;
    }

    /**
     * Get the value of prodotto_id
     */
    public function getProdottoId(): ?EProdotto
    {
        return $this->prodotto_id;
    }

    /**
     * Set the value of prodotto_id
     */
    public function setProdottoId(?EProdotto $prodotto_id): self
    {
        $this->prodotto_id = $prodotto_id;

        return $this;
    }
}
?>
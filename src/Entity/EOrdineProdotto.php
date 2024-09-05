<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FOrdineProdotto::class)]
#[ORM\Table('ordine_prodotto')]
class EOrdineProdotto {
    #[ORM\Column(type:'integer')]
    private $quantita_ordinata_prodotto;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:EOrdine::class, inversedBy:'q_prodotto_ordine')]
    #[ORM\JoinColumn(name:'ordine_id', referencedColumnName:'id_ordine')]
    private EOrdine|null $ordine_id= null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:EProdotto::class, inversedBy:'q_prodotto_ordine')]
    #[ORM\JoinColumn(name:'prodotto_id', referencedColumnName:'id_prodotto')]
    private EProdotto|null $prodotto_id= null;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $stato_ordine_prodotto;

    public function __construct() {
        $this->quantita_ordinata_prodotto = 0;
        $this->stato_ordine_prodotto = 'In elaborazione';
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

    public function getStato_ordine() {
        return $this->stato_ordine_prodotto;
    }

    public function setStato_ordine($stato_ordine_prodotto) {
        $this->stato_ordine_prodotto = $stato_ordine_prodotto;
    }

    public function isPresoInCarico() {
        return $this->stato_ordine_prodotto == 'Preso in carico';   
    }

    //per aggiornare lo  stato degli ordini presi in carico
    public function isInSpedizione()
    {
        return $this->stato_ordine_prodotto == 'In spedizione';
    }

    public function isConsegnato(){

        return $this->stato_ordine_prodotto == 'Consegnato';
    }
   
}
?>
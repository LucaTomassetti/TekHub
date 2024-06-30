<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FProdotto::class)]
#[ORM\Table('prodotto')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name:'discr', type:'string')]
#[ORM\DiscriminatorMap(['prodotto'=>'EProdotto', 'p_nuovo'=>'ENuovo', 'p_usato'=>'EUsato'])]
class EProdotto{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue()]
    private int|null $id_prodotto = null;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $nome;

    #[ORM\Column(type: 'string', columnDefinition: "TEXT")]
    private $descrizione;

    #[ORM\OneToMany(targetEntity:EImmagine::class, mappedBy:'prodotto')]
    private Collection $immagini;

    #[ORM\ManyToOne(targetEntity: ECategoria::class, inversedBy:'prodotti')]
    #[ORM\JoinColumn(name:'category_name', referencedColumnName:'nome_categoria', nullable:true)]
    private ECategoria|null $category_name = null;

    #[ORM\ManyToOne(targetEntity: EVenditore::class, inversedBy:'prodotti')]
    #[ORM\JoinColumn(name:'venditore', referencedColumnName:'id_venditore', nullable:true)]
    private EVenditore|null $venditore = null;

    #[ORM\OneToMany(targetEntity:EReso::class, mappedBy:'prodotto')]
    private Collection $resi;

    #[ORM\OneToMany(targetEntity:ERecensione::class, mappedBy:'prodotto')]
    private Collection $recensioni;

    #[ORM\OneToMany(targetEntity: EOrdineProdotto::class, mappedBy: 'prodotto_id')]
    private Collection $q_prodotto_ordine;

    #[ORM\OneToMany(targetEntity:ERimborso::class, mappedBy:'prodotto')]
    private Collection $rimborsi;

    public $discr = "prodotto";

    public function __construct($nome, $descrizione){
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->immagini = new ArrayCollection();
        $this->resi = new ArrayCollection();
        $this->recensioni = new ArrayCollection();
        $this->q_prodotto_ordine = new ArrayCollection();
        $this->rimborsi = new ArrayCollection();
    }

    /**
     * Get the value of id_prodotto
     *
     * @return $id_prodotto
     */
    public function getIdProdotto()
    {
        return $this->id_prodotto;
    }

    /**
     * Set the value of id_prodotto
     *
     * @param $id_prodotto
     */
    public function setIdProdotto($id_prodotto)
    {
        $this->id_prodotto = $id_prodotto;
    }

    /**
     * Get the value of nome
     *
     * @return $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get the value of descrizione
     *
     * @return $descrizione
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set the value of descrizione
     *
     * @param $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * Get the value of category_name
     *
     * @return $category_name
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * Set the value of category_name
     *
     * @param $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * Get the value of resi
     */
    public function getResi(): Collection
    {
        return $this->resi;
    }

    /**
     * Set the value of resi
     */
    public function setResi(Collection $resi)
    {
        $this->resi = $resi;
    }

    /**
     * Get the value of immagini
     */
    public function getImmagini(): Collection
    {
        return $this->immagini;
    }

    public function addImage(EImmagine $image): self
    {
        if (!$this->immagini->contains($image)) {
            $this->immagini[] = $image;
            $image->setProdotto($this);
        }

        return $this;
    }

    public function removeImage(EImmagine $image): self
    {
        if ($this->immagini->removeElement($image)) {
            // Set the owning side to null (unless already changed)
            if ($image->getProdotto() === $this) {
                $image->setProdotto(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of recensioni
     */
    public function getRecensioni(): Collection
    {
        return $this->recensioni;
    }

    /**
     * Set the value of recensioni
     */
    public function setRecensioni(Collection $recensioni)
    {
        $this->recensioni = $recensioni;
    }

    /**
     * Get the value of q_prodotto_ordine
     */
    public function getQProdottoOrdine(): Collection
    {
        return $this->q_prodotto_ordine;
    }

    /**
     * Set the value of q_prodotto_ordine
     */
    public function setQProdottoOrdine(Collection $q_prodotto_ordine)
    {
        $this->q_prodotto_ordine = $q_prodotto_ordine;
    }

    /**
     * Get the value of rimborsi
     */
    public function getRimborsi(): Collection
    {
        return $this->rimborsi;
    }

    /**
     * Set the value of rimborsi
     */
    public function setRimborsi(Collection $rimborsi)
    {
        $this->rimborsi = $rimborsi;
    }

    /**
     * Get the value of venditore
     */
    public function getVenditore()
    {
        return $this->venditore;
    }

    /**
     * Set the value of venditore
     */
    public function setVenditore($venditore)
    {
        $this->venditore = $venditore;
    }
}
?>
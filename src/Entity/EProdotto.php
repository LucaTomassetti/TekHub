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

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $marca;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(100)')]
    private $modello;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(30)')]
    private $colore;

    #[ORM\Column(type: 'boolean')]
    private $is_deleted = false;

    #[ORM\OneToMany(targetEntity:EImmagine::class, mappedBy:'prodotto')]
    private Collection $immagini;

    #[ORM\ManyToOne(targetEntity: ECategoria::class, inversedBy:'prodotti')]
    #[ORM\JoinColumn(name:'category_name', referencedColumnName:'nome_categoria', nullable:true)]
    private ECategoria|null $category_name = null;

    #[ORM\ManyToOne(targetEntity: EVenditore::class, inversedBy:'prodotti')]
    #[ORM\JoinColumn(name:'venditore', referencedColumnName:'id_venditore', nullable:true)]
    private EVenditore|null $venditore = null;

    #[ORM\OneToMany(targetEntity:ERecensione::class, mappedBy:'prodotto')]
    private Collection $recensioni;

    #[ORM\OneToMany(targetEntity: EOrdineProdotto::class, mappedBy: 'prodotto_id')]
    private Collection $q_prodotto_ordine;

    public $discr = "prodotto";

    public function __construct($nome, $descrizione, $marca, $modello, $colore){
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->marca = $marca;
        $this->modello = $modello;
        $this->colore = $colore;
        $this->immagini = new ArrayCollection();
        $this->recensioni = new ArrayCollection();
        $this->q_prodotto_ordine = new ArrayCollection();
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

    /**
     * Get the value of marca
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     */
    public function setMarca($marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of modello
     */
    public function getModello()
    {
        return $this->modello;
    }

    /**
     * Set the value of modello
     */
    public function setModello($modello): self
    {
        $this->modello = $modello;

        return $this;
    }

    /**
     * Get the value of colore
     */
    public function getColore()
    {
        return $this->colore;
    }

    /**
     * Set the value of colore
     */
    public function setColore($colore): self
    {
        $this->colore = $colore;

        return $this;
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
}
?>
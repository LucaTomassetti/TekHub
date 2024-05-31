<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('prodotto')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name:'discr', type:'string')]
#[ORM\DiscriminatorMap(['prodotto'=>'EProdotto', 'p_nuovo'=>'ENuovo', 'p_usato'=>'EUsato'])]
class EProdotto{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue()]
    private $id_prodotto;

    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'string', columnDefinition: "TEXT")]
    private $descrizione;

    #[ORM\ManyToOne(targetEntity: ECategoria::class, inversedBy:'prodotti')]
    #[ORM\JoinColumn(name:'categoria', referencedColumnName:'nome_categoria')]
    private ECategoria|null $categoria = null;

    public $discr = "prodotto";

    public function __construct($id_prodotto, $nome, $descrizione){

        $this->id_prodotto = $id_prodotto;
        $this->nome = $nome;
        $this->descrizione = $descrizione;

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
     * Get the value of categoria
     *
     * @return $categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @param $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
}
?>
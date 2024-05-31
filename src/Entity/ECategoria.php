<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('categoria')]
class ECategoria{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private $nome_categoria;

    #[ORM\OneToMany(targetEntity:EProdotto::class, mappedBy:'categoria')]
    private Collection $prodotti;

    public function __construct ($nome_categoria) {
        $this->nome_categoria= $nome_categoria;
        $this->prodotti = new ArrayCollection();
    }

    /**
     * Get the value of nome_categoria
     *
     * @return $nome_categoria
     */
    public function getNomeCategoria()
    {
        return $this->nome_categoria;
    }

    /**
     * Set the value of nome_categoria
     *
     * @param $nome_categoria
     */
    public function setNomeCategoria($nome_categoria)
    {
        $this->nome_categoria = $nome_categoria;
    }

    /**
     * Get the value of prodotti
     *
     * @return $prodotti
     */
    public function getProdotti()
    {
        return $this->prodotti;
    }

    /**
     * Set the value of prodotti
     *
     * @param $prodotti
     */
    public function setProdotti($prodotti)
    {
        $this->prodotti = $prodotti;
    }
}

?>
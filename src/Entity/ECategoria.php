<?php
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
#[Table('categoria')]
class ECategoria{
    
    #[id]
    #[Column(type: 'string')]
    private $nome_categoria;

    #[OneToMany(targetEntity:EProdotto::class, mappedBy:'prodotto')]

    public function __construct ($nome_categoria) {
        $this->nome_categoria= $nome_categoria;
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
}

?>
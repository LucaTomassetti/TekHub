<?php

class ECategoria{
    private $nome_categoria;

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
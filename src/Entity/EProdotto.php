<?php
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[Entity]
#[Table('prodotto')]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name:'discr', type:'string')]
#[DiscriminatorMap(['prodotto'=>'EProdotto', 'p_nuovo'=>'ENuovo', 'p_usato'=>'EUsato'])]
class EProdotto{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue()]
    private $id_prodotto;

    #[Column(type: 'string')]
    private $nome;

    #[Column(type: 'string', columnDefinition: "TEXT")]
    private $descrizione;


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
}
?>
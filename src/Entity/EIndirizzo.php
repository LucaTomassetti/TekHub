<?php
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
#[Table('indirizzo')]
class EIndirizzo{

    #[Column(type: 'string')]
    private $nome;

    #[Id, ManyToOne(targetEntity: EAcquirente::class, inversedBy:'id_acquirente')]
    #[JoinColumn(name:'acquirenti', referencedColumnName:'id')]
    #[Column]
    private Collection $acquirenti;

    #[Id, ManyToOne(targetEntity: EOrdine::class, inversedBy:'id_ordine')]
    #[JoinColumn(name:'ordini', referencedColumnName:'id')]
    #[Column]
    private Collection $ordini;

    public function __construct($nome){
      $this->nome = $nome;
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
     * Get the value of acquirenti
     *
     * @return $acquirenti
     */
    public function getAcquirenti()
    {
        return $this->acquirenti;
    }

    /**
     * Get the value of ordini
     *
     * @return $ordini
     */
    public function getOrdini()
    {
        return $this->ordini;
    }
}
?>
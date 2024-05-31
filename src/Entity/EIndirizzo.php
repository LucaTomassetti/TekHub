<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('indirizzo')]
class EIndirizzo{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', columnDefinition:'INT(5)')]
    private $cap;

    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'string')]
    private $comune;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'indirizzi')]
    #[ORM\JoinColumn(name:'acquirenti', referencedColumnName:'id_acquirente')]
    private EAcquirente|null $acquirenti = null;

    #[ORM\ManyToOne(targetEntity: EOrdine::class, inversedBy:'indirizzi')]
    #[ORM\JoinColumn(name:'ordini', referencedColumnName:'id_ordine')]
    private EOrdine|null $ordini = null;

    public function __construct($cap, $nome, $comune){
      $this->nome = $nome;
      $this->cap = $cap;
      $this->comune = $comune;
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

    /**
     * Get the value of cap
     *
     * @return $cap
     */
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * Set the value of cap
     *
     * @param $cap
     */
    public function setCap($cap)
    {
        $this->cap = $cap;
    }

    /**
     * Get the value of comune
     *
     * @return $comune
     */
    public function getComune()
    {
        return $this->comune;
    }

    /**
     * Set the value of comune
     *
     * @param $comune
     */
    public function setComune($comune)
    {
        $this->comune = $comune;
    }
}
?>
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
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente')]
    private EAcquirente|null $acquirente = null;

    #[ORM\ManyToOne(targetEntity: EOrdine::class, inversedBy:'indirizzi')]
    #[ORM\JoinColumn(name:'ordine', referencedColumnName:'id_ordine')]
    private EOrdine|null $ordine = null;

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

    /**
     * Get the value of acquirente
     *
     * @return $acquirente
     */
    public function getAcquirente()
    {
        return $this->acquirente;
    }

    /**
     * Set the value of acquirente
     *
     * @param $acquirente
     */
    public function setAcquirente($acquirente)
    {
        $this->acquirente = $acquirente;
    }

    /**
     * Get the value of ordine
     *
     * @return $ordine
     */
    public function getOrdine()
    {
        return $this->ordine;
    }

    /**
     * Set the value of ordine
     *
     * @param $ordine
     */
    public function setOrdine($ordine)
    {
        $this->ordine = $ordine;
    }
}
?>
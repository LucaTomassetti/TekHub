<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FVenditore::class)]
#[ORM\Table('venditore')]
class EVenditore{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_venditore = null;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $nome;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $cognome;

    #[ORM\Column(type: 'string', length:11, columnDefinition: 'VARCHAR(11)')]
    private $partita_iva;

    #[ORM\Column(type: 'string')]
    private $societa;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $email;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $username;

    #[ORM\OneToMany(targetEntity:ERimborso::class, mappedBy:'venditore')]
    private Collection $rimborsi;

    #[ORM\OneToMany(targetEntity:EProdotto::class, mappedBy:'venditore')]
    private Collection $prodotti;

    #[ORM\OneToMany(targetEntity:ESegnalazione::class, mappedBy:'venditore')]
    private Collection $segnalazioni;

    #[ORM\OneToMany(targetEntity:EAsta::class, mappedBy:'venditore')]
    private Collection $aste;

    public function __construct($nome,$cognome,$partita_iva,$societa,$email,$password,$username){
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->partita_iva=$partita_iva;
        $this->societa=$societa;
        $this->email=$email;
        $this->password=$password;
        $this->username=$username;
        $this->rimborsi = new ArrayCollection();
        $this->prodotti = new ArrayCollection();
        $this->segnalazioni = new ArrayCollection();
        $this->aste = new ArrayCollection();
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
     * Get the value of cognome
     *
     * @return $cognome
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Set the value of cognome
     *
     * @param $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * Get the value of partita_iva
     *
     * @return $partita_iva
     */
    public function getPartitaIva()
    {
        return $this->partita_iva;
    }

    /**
     * Set the value of partita_iva
     *
     * @param $partita_iva
     */
    public function setPartitaIva($partita_iva)
    {
        $this->partita_iva = $partita_iva;
    }

    /**
     * Get the value of societa
     *
     * @return $societa
     */
    public function getSocieta()
    {
        return $this->societa;
    }

    /**
     * Set the value of societa
     *
     * @param $societa
     */
    public function setSocieta($societa)
    {
        $this->societa = $societa;
    }

    /**
     * Get the value of email
     *
     * @return $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of password
     *
     * @return $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of username
     *
     * @return $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the value of id_venditore
     */
    public function getIdVenditore(): ?int
    {
        return $this->id_venditore;
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
    public function setRimborsi(Collection $rimborsi): self
    {
        $this->rimborsi = $rimborsi;

        return $this;
    }

    /**
     * Get the value of prodotti
     */
    public function getProdotti(): Collection
    {
        return $this->prodotti;
    }

    /**
     * Set the value of prodotti
     */
    public function setProdotti(Collection $prodotti): self
    {
        $this->prodotti = $prodotti;

        return $this;
    }

    /**
     * Get the value of segnalazioni
     */
    public function getSegnalazioni(): Collection
    {
        return $this->segnalazioni;
    }

    /**
     * Set the value of segnalazioni
     */
    public function setSegnalazioni(Collection $segnalazioni): self
    {
        $this->segnalazioni = $segnalazioni;

        return $this;
    }

    /**
     * Get the value of aste
     */
    public function getAste(): Collection
    {
        return $this->aste;
    }

    /**
     * Set the value of aste
     */
    public function setAste(Collection $aste): self
    {
        $this->aste = $aste;

        return $this;
    }
}
?>
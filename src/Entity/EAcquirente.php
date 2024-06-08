<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('acquirente')]
class EAcquirente{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_acquirente = null;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $nome;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $cognome;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $username;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $email;

    #[ORM\Column(type: 'integer', columnDefinition: 'BIGINT(10)')]
    private $cellulare;

    #[ORM\OneToMany(targetEntity:EIndirizzo::class, mappedBy:'acquirente')]
    private Collection $indirizzi;

    #[ORM\OneToMany(targetEntity:EOfferta::class, mappedBy:'acquirente')]
    private Collection $offerte;

    #[ORM\OneToMany(targetEntity:EOrdine::class, mappedBy:'acquirente')]
    private Collection $ordini;

    #[ORM\OneToMany(targetEntity:EReso::class, mappedBy:'acquirente')]
    private Collection $resi;

    #[ORM\OneToMany(targetEntity:ERecensione::class, mappedBy:'acquirente')]
    private Collection $recensioni;

    #[ORM\OneToMany(targetEntity:ECartaDiCredito::class, mappedBy:'proprietario')]
    private Collection $carte_di_credito;

    #[ORM\OneToMany(targetEntity:ERimborso::class, mappedBy:'cliente_rimborsato')]
    private Collection $rimborsi;

    public function __construct($id,$nome,$cognome,$username,$password,$email,$cellulare){
       $this->nome = $nome;
       $this->cognome = $cognome;
       $this->id_acquirente = $id;
       $this->username = $username;
       $this->password = $password;
       $this->email = $email;
       $this->cellulare = $cellulare; 
       $this->indirizzi = new ArrayCollection();
       $this->offerte = new ArrayCollection();
       $this->ordini = new ArrayCollection();
       $this->resi = new ArrayCollection();
       $this->recensioni = new ArrayCollection();
       $this->carte_di_credito = new ArrayCollection();
       $this->rimborsi = new ArrayCollection();
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
     * Get the value of id
     *
     * @return $id
     */
    public function getId()
    {
        return $this->id_acquirente;
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
     * Get the value of cellulare
     *
     * @return $cellulare
     */
    public function getCellulare()
    {
        return $this->cellulare;
    }

    /**
     * Set the value of cellulare
     *
     * @param $cellulare
     */
    public function setCellulare($cellulare)
    {
        $this->cellulare = $cellulare;
    }

    /**
     * Get the value of indirizzi
     *
     * @return $indirizzi
     */
    public function getIndirizzi()
    {
        return $this->indirizzi;
    }

    /**
     * Get the value of offerte
     *
     * @return $offerte
     */
    public function getOfferte()
    {
        return $this->offerte;
    }

    /**
     * Set the value of offerte
     *
     * @param $offerte
     */
    public function setOfferte($offerte)
    {
        $this->offerte = $offerte;
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
     * Set the value of ordini
     *
     * @param $ordini
     */
    public function setOrdini($ordini)
    {
        $this->ordini = $ordini;
    }

    /**
     * Get the value of resi
     */
    public function getResi(): Collection
    {
        return $this->resi;
    }

    /**
     * Set the value of resi
     */
    public function setResi(Collection $resi): self
    {
        $this->resi = $resi;

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
    public function setRecensioni(Collection $recensioni): self
    {
        $this->recensioni = $recensioni;

        return $this;
    }

    /**
     * Get the value of carte_di_credito
     */
    public function getCarteDiCredito(): Collection
    {
        return $this->carte_di_credito;
    }

    /**
     * Set the value of carte_di_credito
     */
    public function setCarteDiCredito(Collection $carte_di_credito): self
    {
        $this->carte_di_credito = $carte_di_credito;

        return $this;
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
}

?>
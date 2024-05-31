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

    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'string')]
    private $cognome;

    #[ORM\Column(type: 'string')]
    private $username;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string')]
    private $email;

    #[ORM\Column(type: 'integer', columnDefinition: "BIGINT(10)")]
    private $cellulare;

    #[ORM\OneToMany(targetEntity:EIndirizzo::class, mappedBy:'acquirente')]
    private Collection $indirizzi;

    #[ORM\OneToMany(targetEntity:EOfferta::class, mappedBy:'acquirente')]
    private Collection $offerte;

    #[ORM\OneToMany(targetEntity:EOrdine::class, mappedBy:'acquirente')]
    private Collection $ordini;

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
}

?>
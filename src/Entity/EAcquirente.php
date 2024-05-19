<?php
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
#[Table('acquirente')]
class EAcquirente{

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    #[OneToMany(targetEntity:EIndirizzo::class, mappedBy:'acquirenti',cascade: ['ALL'])]
    private int|null $id_acquirente = null;

    #[Column(type: 'string')]
    private $nome;

    #[Column(type: 'string')]
    private $cognome;

    #[Column(type: 'string')]
    private $username;

    #[Column(type: 'string')]
    private $password;

    #[Column(type: 'string')]
    private $email;

    #[Column(type: 'integer', columnDefinition: "DECIMAL(10, 0)")]
    private $cellulare;

    public function __construct($id,$nome,$cognome,$username,$password,$email,$cellulare){
       $this->nome = $nome;
       $this->cognome = $cognome;
       $this->id_acquirente = $id;
       $this->username = $username;
       $this->password = $password;
       $this->email = $email;
       $this->cellulare = $cellulare; 
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
}

?>
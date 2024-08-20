<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:FAdmin::class)]
#[ORM\Table('admin')]
class EAdmin{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_admin = null;

    #[ORM\Column(type: 'string', length:50, columnDefinition: 'VARCHAR(50)')]
    private $nome;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private $cognome;

    #[ORM\Column(type: 'string', length:70, columnDefinition: 'VARCHAR(70)')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;


    public function __construct($nome,$cognome,$email,$password){
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->email=$email;
        $this->password=$password;
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
        return $this->id_admin;
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

}
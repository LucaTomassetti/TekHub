<?php
class EAcquirente{
    private $nome;
    private $cognome;
    private $id;
    private $username;
    private $password;
    private $email;
    private $cellulare;
    private $ordini;
    private $indirizzi;

    public function __construct($nome,$cognome,$id,$username,$password,$email,$cellulare){
       $this->nome = $nome;
       $this->cognome = $cognome;
       $this->id = $id;
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
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Get the value of indirizzi
     *
     * @return $indirizzi
     */
    public function getIndirizzi()
    {
        return $this->indirizzi;
    }

    /**
     * Set the value of indirizzi
     *
     * @param $indirizzi
     */
    public function setIndirizzi($indirizzi)
    {
        $this->indirizzi = $indirizzi;
    }
}

?>
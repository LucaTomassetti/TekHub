<?php
class EVenditore{
    private $id;
    private $nome;
    private $cognome;
    private $partita_iva;
    private $societa;
    private $email;
    private $password;
    private $username;

    public function __construct($id,$nome,$cognome,$partita_iva,$societa,$email,$password,$username){
        $this->id=$id;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->partita_iva=$partita_iva;
        $this->societa=$societa;
        $this->email=$email;
        $this->password=$password;
        $this->username=$username;
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
}
?>
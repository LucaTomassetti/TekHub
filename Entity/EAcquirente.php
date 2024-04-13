<?php
class EAcquirente{
    private String $nome;
    private String $cognome;
    private String $id;
    private String $username;
    private String $password;
    private String $email;
    private String $cellulare;
    private $ordini = array();
    private $indirizzi = array();

    public function __construct($nome,$cognome,$id,$username,$password,$email,$cellulare){
       $this->nome = $nome;
       $this->cognome = $cognome;
       $this->id = $id;
       $this->username = $username;
       $this->password = $password;
       $this->email = $email;
       $this->cellulare = $cellulare; 
    }
    
}

?>
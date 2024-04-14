<?php
class EVenditore{
    private String $id;
    private String $nome;
    private String $cognome;
    private String $partita_iva;
    private String $società;
    private String $email;
    private String $password;
    private String $username;

    public function __construct($id,$nome,$cognome,$partita_iva,$società,$email,$password,$username){
        $this->id=$id;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->partita_iva=$partita_iva;
        $this->società=$società;
        $this->email=$email;
        $this->password=$password;
        $this->username=$username;
    }
}

?>

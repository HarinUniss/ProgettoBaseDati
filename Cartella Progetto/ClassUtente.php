<?php

class ClassUtente
{
    private $id_utente = ""; private $nome = ""; private $cognome = "";
    private $indirizzo = ""; private $civico =""; private $citta= "";
    private $telefono = ""; private $email = ""; private $foto ="";
    private $tipo ="";

    //Costruttore Dev'essere preceduto da 2 underscore
    function __construct($id, $cognome, $nome, $indirizzo, $civico, $citta, $telefono, $email, $foto, $tipo){
        $this->id_utente = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->indirizzo = $indirizzo;
        $this->civico = $civico;
        $this->citta = $citta;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->foto = $foto;
        $this->tipo = $tipo;
    }

    public function getIndirizzo(){ return $this->indirizzo; }
    public function getCivico(){ return $this->civico; }
    public function getCitta(){ return $this->citta; }
    public function getTelefono(){ return $this->telefono; }
    public function getEmail(){ return $this->email; }
    public function getFoto(){ return $this->foto; }
    public function getTipo(){ return $this->tipo; }
    function getIDUtente(){ return $this->id_utente; }
    function getNome(){ return $this->nome; }
    function getCognome(){ return $this->cognome; }

    function setIDUtente($id_utente){ $this->id_utente = $id_utente;}
    function setNome($nome){ $this->nome = $nome; }
    function setCognome($cognome){ $this->cognome = $cognome; }
    public function setIndirizzo(string $indirizzo): void
    {
        $this->indirizzo = $indirizzo;
    }

    public function setCivico(string $civico): void
    {
        $this->civico = $civico;
    }

    public function setCitta(string $citta): void
    {
        $this->citta = $citta;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setFoto(string $foto): void
    {
        $this->foto = $foto;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    //function toString(){ return "ClassUtente { ID:".$this->getIDUtente()." Nome:".$this->getNome()." Cognome:".$this->getCognome()." }";}

}
?>
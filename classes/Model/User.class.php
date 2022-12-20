<?php
class User {
    public $id;
    public $email;
    public $password;
    public $tipusIdent;
    public $numeroIdent;
    public $nom;
    public $cognoms;
    public $sexe;
    public $naixement;
    public $adreca;
    public $codiPostal;
    public $poblacio;
    public $provincia;
    public $telefon;
    public $imatge;
    public $status;
    public $navegador;
    public $plataforma;
    public $dataCreacio;
    public $dataDarrerAcces;
    
    public function __construct() {}
    
    public function getId()         { return $this->id; }
    public function getEmail()      { return $this->email; }
    public function getPassword()   { return $this->password; }
    public function getTipusIdent() { return $this->tipusIdent; }
    public function getNumeroIdent(){ return $this->numeroIdent; }
    public function getNom()        { return $this->nom; }
    public function getCognoms()    { return $this->cognoms; }
    public function getSexe()       { return $this->sexe; }
    public function getNaixement()  { return $this->naixement; }
    public function getAdreca()     { return $this->adreca; }
    public function getCodiPostal() { return $this->codiPostal; }
    public function getPoblacio()   { return $this->poblacio; }
    public function getProvincia()  { return $this->provincia; }
    public function getTelefon()    { return $this->telefon; }
    public function getImatge()     { return $this->imatge; }
    public function getStatus()     { return $this->status; }
    public function getNavegador()  { return $this->navegador; }
    public function getPlataforma() { return $this->plataforma;  }
    public function getDataCreacio(){ return $this->dataCreacio; }
    public function getDataDarrerAcces() { return $this->dataDarrerAcces; }
}


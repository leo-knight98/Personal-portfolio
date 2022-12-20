<?php

class Comentari {
    private $data;
    private $nom;
    private $mail;
    private $experiencia;
    private $missatge;
    

    public function __construct($nom, $email, $experiencia, $missatge, $data=null) {
        $this->nom = $nom;
        $this->mail = $email;
        $this->experiencia = $experiencia;
        $this->missatge = $missatge;
        $this->data = ($data==null) ? date("d/m/Y") : $data;
    }
    
    /**
     * @return mixed
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getMissatge() {
        return $this->missatge;
    }
    
    /**
     * @return mixed
     */
    public function getExperiencia() {
        return $this->experiencia;
    }
    
    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }
   
}

?>


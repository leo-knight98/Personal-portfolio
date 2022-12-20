<?php

class Contact {
    private $data;
    private $nom;
    private $mail;
    private $missatge;
    

    public function __construct($nom, $email, $missatge, $data=null) {
        $this->data = (is_null($data)) ? date("d/m/Y") : $data;
        $this->nom = $nom;
        $this->mail = $email;
        $this->missatge = $missatge;
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
    public function getEmail() {
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
    public function getData() {
        return $this->data;
    }
   
}

?>


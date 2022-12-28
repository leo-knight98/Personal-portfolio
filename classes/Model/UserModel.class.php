<?php

class UserModel {

    public function __construct() {}
    
    public static function create(User $usuariACrear) {
        $email = $usuariACrear->getEmail();
        $password = $usuariACrear->getPassword();
        $tipusIdent = $usuariACrear->getTipusIdent();
        $numeroIdent = $usuariACrear->getNumeroIdent();
        $nom = $usuariACrear->getNom();
        $cognoms = $usuariACrear->getCognoms();
        $sexe = $usuariACrear->getSexe();
        $naixement = $usuariACrear->getNaixement();
        $adreca = $usuariACrear->getAdreca();
        $codiPostal = $usuariACrear->getCodiPostal();
        $poblacio = $usuariACrear->getPoblacio();
        $provincia = $usuariACrear->getProvincia();
        $telefon = $usuariACrear->getTelefon();
        $imatge = $usuariACrear->getImatge();
        
        $model = new Model();
        $conn = $model->write;
        $sql = "INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssssssss', $email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge);

        if(!$stmt->execute()) {
            echo "error";
        } else {
            echo "executed";
        }

        $stmt->close();
        $model->disconnect();
    }
    
    public static function read() {
        $model = new Model();
        
        $model->disconnect();
    }
    
    public static function getOneById($id) {
        $model = new Model();
        
        $model->disconnect();
        
    }
    
    public static function getOneByMail($mail) {
        $model = new Model();
        $conn = $model->read;
        $sql = "SELECT id, email, password FROM tbl_usuaris WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $model->disconnect();

        return $user;
    }
    
    public static function update(User $usuariAModificar) {
        $model = new Model();
        
        $model->disconnect();       
    }
    
    public static function delete(User $usuariAEsborrar) {
        $model = new Model();
        
        $model->disconnect();
    }
}


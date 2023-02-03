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
        
        //$stmt->bind_param('ssssssssssssss', $email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge);

        if(!$stmt->execute($email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge)) {
            echo "error";
        } else {
            echo "executed";
        }

        $model->disconnect();
    }
    
    public static function read() {
        $model = new Model();
        $conn = $model->read;
        $stmt = $conn->prepare("SELECT * FROM tbl_usuaris");
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        $current = new User();
        while($current = $result->fetch_object()) {
            $users[] = $current;
        }
        
        return $users;
        $model->disconnect();
    }
    
    public static function getOneById($id) {
        $model = new Model();
        $conn = $model->read;
        $sql = "SELECT * FROM tbl_usuaris WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        $stmt->close();
        $model->disconnect();

        $userReturn = new User();
        foreach($user as $key => $value) {
            $userReturn->$key = $value;
        }
        return $userReturn;
        $model->disconnect();        
    }
    
    public static function getOneByMail($mail) {
        $model = new Model();
        $conn = $model->read;
        $sql = "SELECT * FROM tbl_usuaris WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($mail);
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        $model->disconnect();

        $userReturn = new User();
        foreach($user as $key => $value) {
            $userReturn->$key = $value;
        }
        return $userReturn;
    }
    
    public static function update(User $usuariAModificar) {
        $model = new Model();
        $conn = $model->write;

        $keys = [];
        $values = [];
        $types = '';
        $str = '';

        foreach($usuariAModificar as $key => $value) {
            $keys[] = $key;
            $values[] = $value;

            if(gettype($value) == 'string') {
                $types .= 's';
            } else if(gettype($value) == 'integer') {
                $types .= 'i';
            } else if(gettype($value) == 'float') {
                $types .= 'd';
            } else {
                $types .= 'b';
            }
        }

        for($i = 0; $i < count($keys); $i++) {
            if($i == count($keys) -1) {
                $str .= "$keys[$i]=?";
            } else {
                $str .= "$keys[$i]=?, ";
            }
        }
        
        $sql = "UPDATE tbl_usuaris SET $str WHERE id={$usuariAModificar->id}";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, $values);
        $stmt->execute();
        $model->disconnect();       
    }
    
    public static function delete(User $usuariAEsborrar) {
        
        $model = new Model();
        $conn = $model->write;
        $id = $usuariAEsborrar->id;
        $sql = "DELETE FROM tbl_usuaris WHERE id = ?";
        $stmt = $conn->prepare($sql);
        echo "entro";
        if($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
        } else {
            echo $conn->error;
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $model->disconnect();
    }
}


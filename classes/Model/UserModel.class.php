<?php

class UserModel {

    public function __construct() {}
    
    public static function create(User $usuariACrear) {
        $model = new Model();
        $conn = $model->write;
        echo "Created conn<br>";

        $stmt = mysqli_prepare($conn, "INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        
        $stmt->bind_param('ssssssssssssss', $usuariACrear->email, $usuariACrear->password, $usuariACrear->tipusIdent, $usuariACrear->numeroIdent, $usuariACrear->nom, $usuariACrear->cognoms, $usuariACrear->sexe, $usuariACrear->naixement, $usuariACrear->adreca, $usuariACrear->codiPostal, $usuariACrear->poblacio, $usuariACrear->provincia, $usuariACrear->telefon, $usuariACrear->imatge);

        if(!$stmt->execute()) {
            echo "error";
        } else {
            echo "inserted";
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
    
    public static function getOneByMail($id) {
        $model = new Model();
        
        $model->disconnect();        
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


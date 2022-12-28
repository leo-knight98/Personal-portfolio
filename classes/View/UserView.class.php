<?php
class UserView extends View{
    private $user;
    
    public function __construct(User $user=null) {
        parent::__construct();
        $this->user = (is_null($user)) ? new User() : $user;
    }
    
    public function login() {
        require_once $this->getFitxer();

        $options = [
            "type" => "text",
            "name" => "email",
            "placeholder" => "email",
            "class" => "llarg",
            "span" => (isset($errorsDetectats["email"])) ? $errorsDetectats["email"] : "",
        ];
        $input_email = $this->html_generateInput($options);

        $options = [
            "type" => "password",
            "name" => "pass",
            "placeholder" => "Contrasenya",
            "class" => "llarg",
            "span" => (isset($errorsDetectats["pass"])) ? $errorsDetectats["pass"] : "",
        ];
        $input_pass = $this->html_generateInput($options);

        $options = [
            "type" => "submit",
            "name" => "submit",
            "class" => "submit action-button",
            "value" => "Envia Dades"
        ];
        $input_bSend = $this->html_generateInput($options);

        $form = "<form method='post'>
            <label>$email</label><br>
            $input_email<br>
            <label>$password_form</label><br>
            $input_pass<br>
            $input_bSend
        </form>";
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_login.php";
        include "templates/footer.php";
    }
    
    public function registre($errorsDetectats=null) {
        require_once $this->getFitxer();

        $options = [
            "type" => "text",
            "name" => "email",
            "placeholder" => "email (Obligatori)",
            "class" => "llarg",
            "value" => $this->user->getEmail(),
            "span" => (isset($errorsDetectats["email"])) ? $errorsDetectats["email"] : "",
        ];
        $input_email = $this->html_generateInput($options);
 
        $options = [
            "type" => "password",
            "name" => "pass",
            "placeholder" => "Contrasenya (Obligatori)",
            "class" => "llarg",
            "value" => $this->user->getPassword(),
            "span" => (isset($errorsDetectats["pass"])) ? $errorsDetectats["pass"] : "",
        ];
        $input_pass = $this->html_generateInput($options);
        
        $options = [
            "type" => "password",
            "name" => "cpass",
            "placeholder" => "Confirma contrasenya (Obligatori)",
            "class" => "llarg",
            "value" => $this->user->cPassword,
            "span" => (isset($errorsDetectats["cpass"])) ? $errorsDetectats["cpass"] : "",
        ];
        $input_cpass = $this->html_generateInput($options);
        
        $atributs = [
            "class" => "curt",
            "name" => "tipus",
             "span" => (isset($errorsDetectats["tipus"])) ? $errorsDetectats["tipus"] : ""
        ];
        $opcions = [
            "NIF" => $nif,
            "NIE" => $nie,
            "PAS" => $passport
        ];
        $seleccionat = (is_null($this->user->getTipusIdent())) ? "NIF" : $this->user->getTipusIdent();
        $select_Tipus = $this->html_generateSelect($opcions, $seleccionat, $atributs);
        
        $options = [
            "type" => "text",
            "name" => "dni",
            "placeholder" => "DNI (Obligatori)",
            "class" => "curt",
            "value" => $this->user->getNumeroIdent(),
            "span" => (isset($errorsDetectats["dni"])) ? $errorsDetectats["dni"] : ""
        ];
        $input_dni = $this->html_generateInput($options);
        $options = [
            "type" => "text",
            "name" => "nom",
            "placeholder" => "Nom (Obligatori)",
            "class" => "llarg",
            "value" => $this->user->getNom(),
            "span" => (isset($errorsDetectats["nom"])) ? $errorsDetectats["nom"] : ""
        ];
        $input_nom = $this->html_generateInput($options);
        
         $options = [
            "type" => "text",
            "name" => "cognoms",
            "placeholder" => "Cognoms (Obligatori)",
            "class" => "llarg",
             "value" => $this->user->getCognoms(),
             "span" => (isset($errorsDetectats["cognoms"])) ? $errorsDetectats["cognoms"] : ""
        ];
        $input_cognoms = $this->html_generateInput($options);
        
        $opcions = [
            "sexe1" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "H",
                "checked" => ($this->user->getSexe() == "H") ? true : false,
                "label" => $male
            ]];
        $select_Sexe = $this->html_generateRadioButon($opcions) . "<br>";
        $opcions = [
            "sexe2" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "D",
                "checked" => ($this->user->getSexe() == "D") ? true : false,
                "label" => $female
            ]
        ];
        $select_Sexe .= $this->html_generateRadioButon($opcions) . "<br>";
        $opcions = [
            "sexe3" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "NB",
                "checked" => ($this->user->getSexe() == "NB") ? true : false,
                "label" => $nb
            ]
        ];
        $select_Sexe .= $this->html_generateRadioButon($opcions);
        
        $options = [
            "type" => "text",
            "name" => "naixement",
            "placeholder" => "Data de naixement (Obligatori)",
            "class" => "llarg",
            "value" => $this->user->getNaixement(),
            "span" => (isset($errorsDetectats["dNaixement"])) ? $errorsDetectats["dNaixement"] : ""
        ];
        $input_naixement = $this->html_generateInput($options);
        
        $options = [
            "class" => "llarg",
            "name" => "adreca",
            "placeholder" => "Adreça",
            "value" => $this->user->getAdreca(),
            "span" => (isset($errorsDetectats["adreca"])) ? $errorsDetectats["adreca"] : ""
        ];
        $input_adreca = $this->html_generateInput($options);
        
        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "cp",
            "placeholder" => "C.P.",
            "value" => $this->user->getCodiPostal(),
            "span" => (isset($errorsDetectats["cp"])) ? $errorsDetectats["cp"] : ""
        ];
        $input_cp = $this->html_generateInput($options);
        
        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "poblacio",
            "placeholder" => "Població",
            "value" => $this->user->getPoblacio(),
            "span" => (isset($errorsDetectats["poblacio"])) ? $errorsDetectats["poblacio"] : ""
        ];
        $input_poblacio = $this->html_generateInput($options);
        
        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "provincia",
            "placeholder" => "Provincia",
            "value" => $this->user->getProvincia(),
            "span" => (isset($errorsDetectats["provincia"])) ? $errorsDetectats["provincia"] : ""
        ];
        $input_provincia = $this->html_generateInput($options);
        
         $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "telefon",
            "placeholder" => "Teléfon",
             "value" => $this->user->getTelefon(),
             "span" => (isset($errorsDetectats["telefon"])) ? $errorsDetectats["telegon"] : ""
        ];
        $input_telefon = $this->html_generateInput($options);
        
        $options = [
            "type" => "hidden",
            "name" => "MAX_FILE_SIZ",
            "value" => "2097152"
        ];
        $input_maxFileSize = $this->html_generateInput($options);
        
        $options = [
            "type" => "file",
            "class" => "llarg",
            "name" => "imatge",
            "id" => "imatge",
            "value" => $this->user->getImatge(),
            "span" => (isset($errorsDetectats["imatge"])) ? $errorsDetectats["imatge"] : ""
        ];
        $input_imatge = $this->html_generateInput($options);
        
        $options = [
            "type" => "submit",
            "name" => "submit",
            "class" => "submit action-button",
            "value" => "Envia Dades"
        ];
        $input_bSend = $this->html_generateInput($options);

        $form = "<form method='post'>
            <label>$email</label><br>
            $input_email<br>
            <label>$password_form</label><br>
            $input_pass<br>
            <label>$password_confirm</label><br>
            $input_cpass<br>
            <label>$id_type</label><br>
            $select_Tipus<br>
            <label>$n_id</label><br>
            $input_dni<br>
            <label>$name</label><br>
            $input_nom<br>
            <label>$surname</label><br>
            $input_cognoms<br>
            <label>$gender</label><br>
            $select_Sexe<br>
            <label>$age</label><br>
            $input_naixement<br>
            <label>$address<label><br>
            $input_adreca</br>
            <label>$cp</label><br>
            $input_cp<br>
            <label>$poblacio</label><br>
            $input_poblacio</br>
            <label>$region</label><br>
            $input_provincia<br>
            <label>$tlf</label><br>
            $input_telefon<br>
            $input_maxFileSize
            <label>$profile</label><br>
            $input_imatge<br>
            $input_bSend
        </form>";
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_register.php";
        include "templates/footer.php";
    }
}
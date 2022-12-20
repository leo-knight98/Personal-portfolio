<?php
class UserView extends View{
    private $user;
    
    public function __construct(User $user=null) {
        parent::__construct();
        $this->user = (is_null($user)) ? new User() : $user;
    }
    
    public function login() {
        require_once $this->getFitxer();       
        
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
        
        $options = [
            "type" => "button",
            "name" => "next",
            "class" => "next action-button",
            "value" => "Next"
        ];
        $input_bNext = $this->html_generateInput($options);
        
         $atributs = [
            "class" => "curt",
            "name" => "tipus",
             "span" => (isset($errorsDetectats["tipus"])) ? $errorsDetectats["tipus"] : ""
        ];
        $opcions = [
            "NIF" => "NIF: Número d'Identificació Fiscal",
            "NIE" => "NIE: Número d'Identificació d'Extranjers",
            "PAS" => "PAS: Passaport"
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
                "label" => "Home"
            ],
            "sexe2" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "D",
                "checked" => ($this->user->getSexe() == "D") ? true : false,
                "label" => "Dona"
            ]
        ];
        $select_Sexe = $this->html_generateRadioButon($opcions);
        
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
            "type" => "button",
            "name" => "previous",
            "class" => "previous action-button",
            "value" => "Previous"
        ];
        $input_bPrev = $this->html_generateInput($options);
        
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

        $form = "<form action='ok.php' method='post'>
            <label>$name</label><br>

        </form>";
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_register.php";
        include "templates/footer.php";
    }
}
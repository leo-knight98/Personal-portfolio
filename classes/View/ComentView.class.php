<?php
class ComentView extends View{
    private $coment;
    
    public function __construct($coment) {
        parent::__construct();
        $this->coment = $coment;
    }
    
    public function show($errorsDetectats=null) {
        require_once $this->getFitxer();
        $html_opacityLang[$this->lang]="style=\"opacity:1;\"";
     
        $opcionsExperiencia = [
            "MB" => "Molt bona",
            "B" => "Bona",
            "R" => "Regular",
            "D" => "Dolenta",
            "MD" => "Molt dolenta"
        ];
        
        $options = [
            "type" => "text",
            "name" => "nom",
            "placeholder" => "Digue'ns el teu nom",
            "value" => $this->coment->getNom(),
            "class" => (isset($errorsDetectats["nom"])) ? "invalid" : "",
            "span" => $errorsDetectats["nom"]
        ];
        $input_nom = $this->html_generateInput($options);
        
        $options = [
            "type" => "text",
            "name" => "email",
            "placeholder" => "Digue'ns el teu mail per pasar-nos en contacte",
            "value" => $this->coment->getMail(),
            "class" => (isset($errorsDetectats["mail"])) ? "invalid" : "",
            "span" => $errorsDetectats["mail"]
        ];
        $input_mail = $this->html_generateInput($options);
        
        $atributs = [
            "name" => "experiencia",
            "span" => $errorsDetectats["experiencia"]
        ];
        $seleccionat = (!is_null($this->coment->getExperiencia())) ? $this->coment->getExperiencia() : "MB";
        $select_Experiencia = $this->html_generateSelect($opcionsExperiencia, $seleccionat, $atributs);
        
        $options = [
            "type" => "textarea",
            "rows" => "4",
            "name" => "missatge",
            "placeholder" => "Què ens vols dir?",
            "value" => $this->coment->getMissatge(),
            "class" => (isset($errorsDetectats["missatge"])) ? "invalid" : "",
            "span" => $errorsDetectats["missatge"]
        ];
        $input_missatge = $this->html_generateInput($options);
       
        
        $capcelera = "<tr><th>Missatge</th><th>Experiència</th><th>Nom</th><th>Mail</th><th>Data</th></tr>";
        
        $formulari = "<form action=\"?coment/show\" method=\"post\" target=\"blank\">";
        $formulari .= "<tr><td>$input_missatge</td><td>$select_Experiencia</td><td>$input_nom</td><td>$input_mail</td>";
        $formulari .= "<td><input type=\"submit\" name=\"boto\" value=\"$contacteEnviar\" class=\"btn\"></td></tr>";
        $formulari .= "</form>";
        
        foreach ($this->comentaris as $key => $value) {
            $cos .= "<tr><td>{$value->getMissatge()}</td><td>{$value->getExperiencia()}</td><td>{$value->getNom()}</td><td>{$value->getMail()}</td><td>{$value->getData()}</td></tr>\n";
        }
        
        $resultat = "<table><thead>$capcelera</thead>$formulari<tbody>$cos</tbody></table>";
        
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_comment.php";
        include "templates/footer.php";
    }
  
}
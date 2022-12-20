<?php

abstract class View {
    protected $lang;

    public function __construct() {
        if (isset($_COOKIE["lang"])) {
            $this->lang = $_COOKIE["lang"];
        } else {
            $this->lang = "cat";
        }
    }
    
    public function getFitxer() {
        $file = "languages/{$this->lang}.php";
        if (file_exists($file)) {
            return $file;
        } else {
            throw new Exception("No existeix el fitxer de traduccicons $file");
        }
    }
    
    
    /*
     * funció html_generateSelect: a partir d'un array associatiu, genera codi
     * html per la visualització d'un control SELECT-OPTION generand un menú
     * desplegable.
     *
     * paràmetres:
     * * opcions: array associatiu, en el que la clau representa el valor a definir i
     *      el valor serà el text a mostrar.
     * * atributs: (Opcional) Array associatiu amb parelles atribut-valor segons la
     *       definició html.
     *       https://www.w3schools.com/tags/tag_select.asp apartat Attributes
     *       autofocus: boolean
     *       disabled: boolean
     *       form: string
     *       multible: boolean
     *       name: string
     *       required: boolean
     *       size: integer
     *       class: string
     *       id: string
     *       label: string
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateSelect($opcions, $seleccionat, $atributs) {
        if (isset($atributs)) {
            //atribut autofocus: boolean
            if ($atributs['autofocus']===true) {
                $attAutofocus = "autofocus ";
            }
            
            //atribut disabled: boolean
            if ($atributs['disabled']===true) {
                $attDisabled = "disabled ";
            }
            
            //atribut form: string
            if (isset($atributs['form'])) {
                $attForm = "form=\"{$atributs['form']}\"";
            }
            
            //atribut multible: boolean
            if (isset($atributs['multiple'])) {
                $attMultiple = "multiple";
            }
            
            //atribut name: string
            if (isset($atributs['name'])) {
                $attName = "name=\"{$atributs['name']}\"";
            }
            
            //atribut required: boolean
            if (isset($atributs['required'])) {
                $attRequred = "required";
            }
            
            //atribut size: integer
            if (isset($atributs['size'])) {
                $attSize = "size=\"{$atributs['size']}\"";
            }
            
            //atribut class: string
            if (isset($atributs['class'])) {
                $attClass = "class=\"{$atributs['class']}\"";
            }
            
            //atribut id: string
            if (isset($atributs['id'])) {
                $attId = "id=\"{$atributs['id']}\"";
            }
            
            //label no és un atribut, però ho tractarem com si ho fos.
            if (isset($atributs['label'])) {
                $attLabel = "<label for='".$atributs['id']."'>".$atributs['label']."</label><br/>\n";
            }
        }
        
        $resultat = $attLabel;
        $resultat .= "<select $attId $attClass $attName $attSize $attForm $attRequred $attMultiple $attDisabled $attAutofocus>\n";
        foreach ($opcions as $key => $value) {
            $resultat .= "<option value=\"$key\"";
            if (isset($seleccionat) && $seleccionat===$key ) {
                $resultat .= " selected";
            }
            $resultat .=">".ucwords($value)."</option>\n";
        }
        $resultat .="</select>\n";
        if (isset($atributs['span'])) {
            $resultat .= "<span class=\"error\" > {$atributs['span']} </span>\n";
        }
        
        return $resultat;
    }
    
    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "name" que representa el valor a definir,
     *       "label" que emmagatzemarà el text a mostrar,
     *       "value" el valor a assignar,
     *       "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateCheckBox($opcions, $abans="true") {
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\">{$value['label']}</label><br>\n";
            unset($value['label']);
            
            $value["type"] = "checkbox";
            $value["id"] = $key;
            $input = $this->html_generateInput($value);
            $input = ($bChecked) ? str_replace(">","checked >",$input) : $input;
            $resultat = '';
            
            if ($abans) {
                $resultat .= "$input\n$label";
            } else {
                $resultat .= "$label\n$input";
            }
        }
        
        return $resultat;
    }
    
    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "name" que representa el valor a definir,
     *       "label" que emmagatzemarà el text a mostrar,
     *       "value" el valor a assignar,
     *       "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateRadioButon($opcions, $abans="true") {
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\" class=\"fs-form\">{$value['label']}</label>";
            unset($value['label']);
            
            $value["type"] = "radio";
            $value["id"] = $key;
            $input = $this->html_generateInput($value);
            $input = ($bChecked) ? str_replace(">","checked >",$input) : $input;
            $resultat = '';
            
            if ($abans) {
                $resultat .= "$input\n$label";
            } else {
                $resultat .= "$label\n$input";
            }
        }
        
        return $resultat;
    }
    
    /*
     * funció html_generateInput: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls INPUT.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "type"
     *       "name" ,
     *       "placeholder"
     *       "class"
     *       "value"
     *       o qualsevol altre atribut de INPUT
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    public function html_generateInput($options) {
        $resultat = "<input ";
        
        foreach ($options as $key => $value) {
            $resultat .= ($key!="span") ? "$key =\"$value\" " : "";
        }
        $resultat .= ">\n";
        if (isset($options['span'])) {
            $resultat .= "<span class=\"error\" > {$options['span']} </span>\n";
        }
        return $resultat;
    }
    
    
}

?>
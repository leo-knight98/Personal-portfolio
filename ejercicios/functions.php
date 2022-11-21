<?php
function html_generate_checkBox($array) {
    $html = '';

    foreach($array as $key => $value) {
        $label = "<label>";
        $input = "<input type='checkbox'";
    
        foreach($value as $etiqueta => $valor) {
            if(gettype($valor) == "boolean" && $valor == true) {
                $input .= " $etiqueta";
            } else if($etiqueta == "label") {
                $label .= $valor;
            } else if($etiqueta != "checked") {
                $input .= " $etiqueta = '$valor'";
            }       
        }
        $label .= "</label>";
        $input .= ">";
        $html .= $input . $label . "<br>";
    }
    
    return $html;
}

function html_generate_select($options, $attrs) {
    $html = "<select ";
    $label = '';
    foreach($attrs as $key => $value) {
        if($value == false) {
            $html .= '';
        } else if($key == "label") {
            $label = "<label>$value</label><br>";
        } else {
            $html .= "$key = '$value' ";
        }
    }
    $html .= ">";

    foreach($options as $key => $value) {
        $html .= "<option value='$key'>$value</option>";
    }

    $html .= "</select>";
    $html = $label . $html;
    return $html;
}

function extract_images($url) {
    $codi = file_get_contents($url);
    $pos_inici = strpos($codi, '<figure');
    $figure = substr($codi, $pos_inici);
    $inici_link = 1;
    $images = array();

    while($inici_link = strpos($figure, 'data-image', $pos_inici)) {
        
        $final_link = strpos($figure, 'data-multi', $inici_link);
        $link = substr($figure, $inici_link, $final_link - $inici_link);
        
        $imatge_principi = strpos($link, '"');
        $imatge_final = strpos($link, '"', $imatge_principi + 1);
        $link_img = trim(substr($link, $imatge_principi, $imatge_final - $imatge_principi));

        $pos_inici = $final_link + 1;
        array_push($images, "<img src=$link_img\" />");
    }

    return $images;
}

function numero_mayusculas($string) {
    $contador = 0;
    $arr = str_split($string);

    for($i = 0; $i < count($arr); $i++) {
        if(ctype_alpha($arr[$i])) {
            if($arr[$i] == strtoupper($arr[$i])) $contador++;
        }
    }

    if($contador != 0) {
        $contador = (count($arr) - $contador) * 2;
    }
    
    return $contador;
}

function numero_minusculas($string) {
    $contador = 0;
    $arr = str_split($string);

    for($i = 0; $i < count($arr); $i++) {
        if(ctype_alpha($arr[$i])) {
            if($arr[$i] == strtolower($arr[$i])) $contador++;
        }
    }

    if($contador != 0) {
        $contador = (count($arr) - $contador) * 2;
    }
    
    return $contador;
}

function cuenta_numeros($string) {
    $contador = 0;
    $arr = str_split($string);

    for($i = 0; $i < count($arr); $i++) {
        if(ctype_digit($arr[$i])) {
            $contador++;
        }
    }

    if($contador != 0) {
        $contador = $contador * 4;
    }
    
    return $contador;
}

function cuenta_simbolos($string) {
    $contador = 0;
    $arr = str_split($string);

    for($i = 0; $i < count($arr); $i++) {
        if(ctype_punct($arr[$i])) {
            $contador++;
        }
    }

    if($contador != 0) {
        $contador = $contador * 6;
    }
    
    return $contador;
}

function encontrar_repetidos($string) {
    $string = strtolower($string);
    $arr = str_split($string);
    $contador = 0;

    for($i = 0; $i < count($arr); $i++) {
        for($j = $i + 1; $j < count($arr); $j++) {
            if($string[$i] == $string[$j]) {
                $contador++;
            }
        }
    }

    $contador = $contador * ($contador - 1);
    return $contador;
}

function calcular($pass) {
    $contador = strlen($pass) * 4;
    $contador += numero_mayusculas($pass);
    $contador += numero_minusculas($pass);
    $contador += cuenta_numeros($pass);
    $contador += cuenta_simbolos($pass);
    $contador -= encontrar_repetidos($pass);

    if(ctype_alpha($pass) && ctype_digit($pass)) {
        $contador -= strlen($pass);
    }

    return $contador;
}

function sanitize ($stringANetejar, $convertirAlowercase=1){
    if (empty($stringANetejar)) {
        $stringANetejar = "";
    } else {
        $stringANetejar = trim($stringANetejar);
        $stringANetejar = htmlspecialchars(stripslashes(trim($stringANetejar, '-')));
        $stringANetejar = strip_tags($stringANetejar);
        // Preserve escaped octets.
        $stringANetejar = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $stringANetejar);
        // Remove percent signs that are not part of an octet.
        $stringANetejar = str_replace('%', '', $stringANetejar);
        // Restore octets.
        $stringANetejar = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $stringANetejar);
        
        switch ($convertirAlowercase) {            
            case 1:
                if (function_exists('mb_strtolower')) {
                    $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                } else {
                    $stringANetejar = strtolower($stringANetejar);
                }
                break;
            case 2:
                if (function_exists('mb_strtoupper')) {
                    $stringANetejar = mb_strtoupper($stringANetejar, 'UTF-8');
                } else {
                    $stringANetejar = strtoupper($stringANetejar);
                }
                break;
            case 3:
                if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                    $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                    $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                    
                } else {
                    $stringANetejar = strtolower($stringANetejar);
                    $stringANetejar[0] = strtoupper($stringANetejar[0]);
                }
                break;
            case 4:
                if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                    $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                    $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                    $inici=0;
                    while ($pos = strpos($stringANetejar, " ", 1)) {
                        $inici=$pos+1;
                        $stringANetejar[$inici] = mb_strtoupper($stringANetejar[$inici], 'UTF-8');
                    }
                } else {
                    $stringANetejar = strtolower($stringANetejar);
                    $stringANetejar[0] = strtoupper($stringANetejar[0]);
                    $inici=0;
                    while ($pos = strpos($stringANetejar, " ", $inici)) {
                        $inici=$pos+1;
                        $stringANetejar[$inici] = strtoupper($stringANetejar[$inici]);
                        
                    }
                }
                break;
        }
    }
    return $stringANetejar;
}
?>
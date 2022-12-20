<?php

class Controller {

    public function __construct() {}
    
    /**
     *
     * @param mixed $stringANetejar : Cadena a la que volem eliminar els caràcters perillosos
     * @param int $convertirAlowercase :
     *      [0] No converir
     *      [1] Convertir la cadena a mínúscules
     *      [2] Convertir la cadena a MAJÚSCULES
     *      [3] Convertir la cadena a UC (primera majúscula, reasta minúscula
     *      [4] Convertir la cadena a UC per paraules (estil nom)
     * @return string|mixed
     */
    function sanitize ($stringANetejar, $convertirAlowercase=0){
        if (strlen($stringANetejar)==0) {
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
                        $stringANetejar[0] = mb_strtoupper($stringANetejar, 'UTF-8');
                        
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                    }
                    break;
                case 4:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar, 'UTF-8');
                        $inici=0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
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
    
    function esTipus($dadaAVerificar) {
        $tipusValids = array ("NIF", "NIE", "PAS");
        if (in_array($dadaAVerificar, $tipusValids) ) {
            $esCorrecte = true;
        } else {
            $esCorrecte = false;
        }
        return $esCorrecte;
    }
    function esSexe($dadaAVerificar) {
        $tipusValids = array ("H", "D");
        if (in_array($dadaAVerificar, $tipusValids) ) {
            $esCorrecte = true;
        } else {
            $esCorrecte = false;
        }
        return $esCorrecte;
    }
    
    function validarNif ($nif) {
        $nif = strtoupper($nif);
        $lletresValides = "TRWAGMYFPDXBNJZSQVHLCKE";
        $nifCorrecte = FALSE;
        
        if ((strlen($nif)== 9) && (strpos("XYZ0123456789",$nif[0])!==false)) {
            $numero = substr($nif, 0, 8);
            $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);
            
            if(substr($nif, -1, 1) == substr($lletresValides, $numero % 23, 1)) {
                $nifCorrecte = TRUE;
            }
        }
        return $nifCorrecte;
    }
    
    function esEmail($emailAVerificar) {
        if (filter_var($emailAVerificar,FILTER_VALIDATE_EMAIL)) {
            $esEmail = true;
        } else {
            $esEmail = false;
        }
        return $esEmail;
    }
    
    function esNom($nomAValidar) {
        if (preg_match("/^[a-z ']*$/",$nomAValidar)) {
            $esNom = true;
        } else {
            $esNom = false;
        }
        return $esNom;
    }
    
    function esCodiPostal($codiPostalAVerificar) {
        if ((strlen($codiPostalAVerificar) == 5) && (is_numeric($codiPostalAVerificar))) {
            $esCP = true;
        } else {
            $esCP = false;
        }
        return $esCP;
    }
    
    function esProvincia($provinciaAVerificar) {
        $provincias = array('alava', 'arava','albacete','alacant','alicante','almería','asturias','avila','badajoz','barcelona','burgos','cáceres',
            'cádiz','cantabria','castelló','castellón','ciudad real','córdoba','la coruña','cuenca','girona','gerona','granada','guadalajara',
            'guipuzkoa','guipúzcoa','huelva','huesca','illes balears','islas baleares','jaén','león','lleida','lérida','lugo','madrid','málaga','murcia','navarra',
            'orense','palencia','las palmas','pontevedra','la rioja','salamanca','segovia','sevilla','soria','tarragona',
            'santa cruz de tenerife','teruel','toledo','valència','valencia','valladolid','bizkaia','vizcaya','zamora','zaragoza');
        if (in_array($provinciaAVerificar,$provincias)) {
            $esUnProvincia = true;
        } else {
            $esUnProvincia = false;
        }
        return $esUnProvincia;
    }
    
    function esTelefon($telefonAVerificar) {
        if ((strlen($telefonAVerificar)== 9) && (is_numeric($telefonAVerificar)) ) {
            $esTelefon = true;
        } else {
            $esTelefon = false;
        }
        return $esTelefon;
    }
}


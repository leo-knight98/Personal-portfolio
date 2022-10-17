<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if(isset($_POST['pass'])) {
    $password = $_POST['pass'];
    $puntos = calcular($password);
    echo $puntos;
}

?>

<form method="post" action="#">
    <label for="pass">Contraseña:</label><br>
    <input type="password" name="pass" />
    <button type="submit">Enviar</button>
</form>
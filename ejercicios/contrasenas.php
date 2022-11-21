<?php 
require('functions.php');

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
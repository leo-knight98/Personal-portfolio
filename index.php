<?php
$lang = '';

if(isset($_GET['lang'])) {
    setcookie("lang", $_GET['lang'], time()+36000);
    $lang = $_GET['lang'];
} else if(isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
}

if($lang != '') {
    switch($lang) {
        case 'cat':
            require_once('idiomas/cat.php');
            break;
        case 'es':
            require_once('idiomas/es.php');
            break;
        case 'en':
            require_once('idiomas/eng.php');
            break;
        default:
            require_once('idiomas/cat.php');
            break;
    }
} else {
    require_once('idiomas/cat.php');
}

function build_url($lang) {
    $data['lang'] = $lang;
    if(isset($_GET['pagina'])) {
        $data['pagina'] = $_GET['pagina'];
        return http_build_query($data);
    }
    return http_build_query($data);
}

require_once('template/nav.php'); 
require_once('template/header.php');

$get = $_GET['pagina']; ?>
<div class="main-section">
    <?php
        if($get == 'imagenes') {
            require_once('ejercicios/captura_imatges.php');
        } else if($get == 'elementos-html') {
            require_once('ejercicios/elementos_html.php');
        } else if($get == 'complejidad-contrasenas') {
            require_once('ejercicios/contrasenas.php');
        } else if($get == 'cotizaciones') {
            require_once('ejercicios/cotizaciones.php');
        } else if($get == 'contact-me') {
            require_once('ejercicios/contact.php');
        } else if($get == 'register') {
            require_once('ejercicios/registro.php');
        } else {
            require_once('template/main.php');
        }
    ?>
</div>

<?php require_once('template/footer.php'); ?>
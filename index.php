<?php
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
        } else {
            require_once('template/main.php');
        }
    ?>
</div>

<?php require_once('template/footer.php'); ?>
                
                
<?php
require_once('template/nav.php'); 
require_once('template/header.php');

$get = $_GET['pagina']; ?>
<div class="main-section">
    <?php
        if($get == 'imagenes') {
            require_once('ejercicios/captura_imatges.php');
        } else {
            require_once('template/main.php');
        }
    ?>
</div>

<?php require_once('template/footer.php'); ?>
                
                
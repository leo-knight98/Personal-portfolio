<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../styles.css" rel="stylesheet">
</head>
<body>
    <div class="title"><h1>Captura de imágenes</h1></div>
<?php

$codi = file_get_contents('https://www.freepik.es/search?format=search&query=coche');
$pos_inici = strpos($codi, '<figure');
//$pos_final = strpos($codi, '/>', $pos_inici);
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
} ?>

<table>
    <tr>
    <?php
        $i = 1;
        foreach($images as $key => $img) {
            echo "<td class='img'>$img</td>";

            if($i % 4 == 0) {
                echo "</tr><tr>";
            }

            $i++;
        }
    ?>
    </tr>
</table>


</body>
</html>





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
        <div class="title"><h1><?php echo $captura ?></h1></div>
        <?php
        require('functions.php');
        $images = extract_images('https://www.freepik.es/search?format=search&query=coche');
        ?>

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





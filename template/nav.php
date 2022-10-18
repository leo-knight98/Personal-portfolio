<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet">
        <title>Leo Mañach</title>
        <link rel="icon" type="image/x-icon" href="img/favicon.svg">
    </head>
    <body>
        <div class="container">
            <nav id="nav-bar">
                <span class="name"><a href="?pagina=home">Leo Mañach</a></span>
                <div class="icon-menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <ul class="links">
                    <li class="menu"><?php echo $trabajos ?>
                        <div class="submenu">
                            <ul>
                                <li><a href="?pagina=imagenes"><?php echo $captura ?></a></li>
                                <li><a href="?pagina=elementos-html"><?php echo $generador ?></a></li>
                                <li><a href="?pagina=complejidad-contrasenas"><?php echo $password ?></a></li>
                                <li><a href="?pagina=cotizaciones"><?php echo $ibex ?></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu"><?php echo $idiomas ?></li>
                </ul>
            </nav>

    <body>
        <div class="container">
            <nav id="nav-bar">
                <span class="name"><a href="?home/show">Leo Mañach</a></span>
                <div class="icon-menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <ul class="links">
                    <li class="menu"><?php echo $trabajos ?>
                        <div class="submenu">
                            <ul>
                                <li><a href="?cotis/show"><?php echo $ibex ?></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu"><?php echo $idiomas ?>
                        <div class="submenu">
                            <ul>
                                <li><a href="?language/set/cat"><?php echo $catalan ?></a></li>
                                <li><a href="?language/set/es"><?php echo $spanish ?></a></li>
                                <li><a href="?language/set/en"><?php echo $english ?></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu"><a href="?contact/show"><?php echo $contact ?></a></li>
                    <li class="menu"><a href="?user/registre"><?php echo $register ?></a></li>
                </ul>
            </nav>
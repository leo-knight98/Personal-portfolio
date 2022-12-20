<?php
class HomeView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        require_once $this->getFitxer();
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main.php";
        include "templates/footer.php";
    }
    
}
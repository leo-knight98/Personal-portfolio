<?php
class ErrorView extends View {
    private $exception;
    
    public function __construct(Exception $ex=null) {
        parent::__construct();
        $this->exception = $ex;
    }
    
    public function show($param=null) {
        require_once $this->getFitxer();
        $lang = $this->lang;
        $html_opacityLang[$lang]="style=\"opacity:1;\"";
       
        $titol = "UNEXPECTED ERROR";
        $missatge = (is_null($this->exception)) 
            ? ((is_null($param)) ? "Ha ocorregut un error no definit" : $param) 
            : $this->exception->getMessage();
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/error.php";
        include "templates/footer.php";        
    }
    
    public function ok($titol, $missatge) {
        require_once $this->getFitxer();
        $lang = $this->lang;
        $html_opacityLang[$lang]="style=\"opacity:1;\"";
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/tpl_ok.php";
        include "templates/footer.php";
    }
}
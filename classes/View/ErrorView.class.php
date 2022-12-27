<?php
class ErrorView extends View {
    private $exception;
    
    public function __construct(Exception $ex=null) {
        parent::__construct();
        $this->exception = $ex;
    }
    
    public function show($param=null) {
        require_once $this->getFitxer();
       
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
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/ok.php";
        include "templates/footer.php";
    }
}
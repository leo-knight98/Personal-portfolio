<?php
class LanguageController extends Controller{

    public function __construct() {
    }
    
    public function set($param) {
        $idiomesPermesos = array("cat", "es", "eng");
        if (in_array($param[0], $idiomesPermesos)) {        
           setcookie("lang",$param[0],time()+3600);
           $_COOKIE["lang"]=$param[0];
        }
        HomeController::show();
    }
    

}


<?php
class ContactController extends Controller{
    private $contacte;

    public function __construct() {
        $this->contacte = new Contact("","","");
    }
    
    public function show() {
        $errors = '';
        if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST["boto"]))) {
            $frmNom = $this->sanitize($_POST["nom"],4);
            $frmMail = $this->sanitize($_POST["email"],1);
            $frmMsg = $this->sanitize($_POST["missatge"],3);
            
            if (strlen($frmNom)==0) {
                $errors["nom"] = "Has d'informar un nom";
            }
            if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
                $errors["mail"] = "L'adreça de correu no és vàlida";
                $frmMail="";
            }
            if (strlen($frmMsg)==0) {
                $errors["missatge"] = "Has d'escriure el comentari que vols enviar";
            }
            
            $this->contacte = new Contact($frmNom, $frmMail, $frmMsg);
            
            if (!isset($errors) && $errors != '') {
                if (ContactModel::create($this->contacte)) {
                    $errors["ok"]="El comentari s'ha enviat correctament";
                    $this->contacte = new Contact("","","");
                }
            }
        }
       
        
        $vista = new ContactView($this->contacte);
        $vista->show($errors);
    }
    
    public function read() {
        $this->contacte = ContactModel::read();
        
        if ($this->contacte!=null) {
            $this->contacte = array_reverse($this->contacte);
        }
        
        $vista = new ContactView($this->contacte);
        $vista->showMaintenance();
     }
     
     public function delete($params) {
         ContactModel::delete($params[0]);
         
         $this->read();
     }
     
     
}


<?php
class ComentController extends Controller{
    private $comentari;

    public function __construct() {
        $this->comentari = new Comentari("","","","");
    }
    
    public function show() {
        $opcionsExperiencia = [
            "MB" => "Molt bona",
            "B" => "Bona",
            "R" => "Regular",
            "D" => "Dolenta",
            "MD" => "Molt dolenta"
        ];
        
        if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST["boto"]))) {
            $frmNom = $this->sanitize($_POST["nom"],4);
            $frmMail = $this->sanitize($_POST["email"],1);
            $frmExperiencia = $this->sanitize($_POST["experiencia"],0);
            $frmMsg = $this->sanitize($_POST["missatge"],3);
            
            if (strlen($frmNom)==0) {
                $errorsDetectats["nom"] = "Has d'informar un nom";
            }
            if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
                $errorsDetectats["mail"] = "L'adreça de correu no és vàlida";
            }
            if (!in_array($frmExperiencia, array_keys($opcionsExperiencia))) {
                $errorsDetectats["missatge"] = "Error en selecció experiencia";
            }
            if (strlen($frmMsg)==0) {
                $errorsDetectats["missatge"] = "Has d'escriure el comentari que vols enviar";
            }
            
            $this->comentari = new Comentari($frmNom, $frmMail, $frmExperiencia, $frmMsg);
            
            if (!isset($errorsDetectats)) {
                if (ComentariModel::create(new Comentari($frmNom, $frmMail, $frmExperiencia, $frmMsg))) {
                    $errorsDetectats["ok"];
                    $this->comentari = new Comentari("","","","");
                }
                
            }
        }
        
        $comentaris = ComentariModel::read();
         
        if ($comentaris!=null) {
            $comentaris = array_reverse($comentaris);
        }
     
        $vista = new ComentView($this->comentari);
        $vista->comentaris = $comentaris;
        $vista->show($errorsDetectats);
    }
    
    public function read() {
        $this->contactes = ContactModel::read();
        
        $vista = new ContactView($this->contactes);
        $vista->showMaintenance();
     }
     
     public function delete($params) {
         ContactModel::delete($params[0]);
         
         $this->read();
     }
     
     
}


<?php
class ContactView extends View{
    private $contacte;
    
    public function __construct($contacte) {
        parent::__construct();
        $this->contacte = $contacte;
    }
    
    public function show($errors=null) {
        require_once $this->getFitxer();

        $optionsInputNom = ['required' => true, 'type' => 'text', 'id' => 'nom', 'name' => 'nom'];
        $inputNom = $this->html_generateInput($optionsInputNom);
        $optionsInputMail = ['required' => true, 'type' => 'text', 'id' => 'email', 'name' => 'email'];
        $inputMail = $this->html_generateInput($optionsInputMail);
        $textarea = "<textarea rows='10' cols='50'></textarea>";
        $optionsSubmit = ['type' => 'submit', 'name' => 'envia', 'id' => 'submit', 'value' => $submit];
        $inputSubmit = $this->html_generateInput($optionsSubmit);

        $form = "<form action='' method='post'><label>$name</label><br>$inputNom<br><label>$email</label><br>$inputMail<br>$textarea<br>$inputSubmit</form>";
     
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_contact.php";
        include "templates/footer.php";
    }
    
    public function showMaintenance() {
        require_once $this->getFitxer();
        
        $capcelera = "<tr><th>Missatge</th><th>Nom</th><th>Mail</th><th>Data</th><th></th></th>\n";
        
        foreach ($this->contacte as $key => $value) {
            $cos .= "<tr><td>{$value->getMissatge()}</td><td>{$value->getNom()}</td><td>{$value->getEmail()}</td><td>{$value->getData()}</td><td><a href='?contact/delete/$key'><img src='img/delete.png' width='30px'></a></td></tr>\n";
        }
        
        $resultat = "<table><thead>$capcelera</thead><tbody>$cos</tbody></table>";
        
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_contact_mant.php";
        include "templates/footer.php";
    }
    
    
}
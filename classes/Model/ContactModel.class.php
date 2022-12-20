<?php

class ContactModel {
    const FILE = "missatgesDeContacte.xml";

    public function __construct() {}
    
    public static function create(Contact $contact) {
        if ($sFile = file_get_contents(self::FILE)) {
            $sLlibre = substr($sFile,0,-13);
            $sLlibre .= "\n    <REGISTRE>\n        <DATA>{$contact->getData()}</DATA>\n";
            $sLlibre .="        <NOM>{$contact->getNom()}</NOM>\n        <MAIL>{$contact->getEmail()}</MAIL>\n";
            $sLlibre .= "        <COMENTARI>{$contact->getMissatge()}</COMENTARI>\n    </REGISTRE> \n";
            $sLlibre .= "</REGISTRES>";
            if ($file = fopen(self::FILE, "w")) {
                if (!fputs($file,$sLlibre)) {
                    throw new Exception("El fitxer no deixa escriure");
                }
                fclose($file);
            } else {
                throw new Exception("No s'ha pogut obrir el fitxer per emmagatzemar informació");
            }
            return true;
        } else {
            throw new Exception("No s'ha pogut obrir el fitxer ".self::FILE);
        }
        
    }
    
    public static function read() {
        if ($fitxer = simplexml_load_file(self::FILE)) {
            foreach ($fitxer->children() as $child) {
                $data = $child->DATA->__toString();
                $nom = $child->NOM->__toString();
                $mail = $child->MAIL->__ToString();
                $comentari = $child->COMENTARI->__toString();
                $contactes[] = new Contact($nom, $mail,$comentari, $data);
            }
        } else {
            throw new Exception("No s'ha pobut obrir el fitxer");
        }
        return $contactes;
    }
    
    public static function update($contact) {
        
    }
    
    public static function delete($clauAEsborrar) {
        $contactes = self::read();
        
        if (in_array($clauAEsborrar, array_keys($contactes))) {
            unset($contactes[$clauAEsborrar]);
        }
        
        $arrel = new SimpleXMLElement("<REGISTRES></REGISTRES>");
        foreach ($contactes as $contacte) {
            $child = $arrel->addChild("REGISTRE");
            $child->addChild("DATA",$contacte->getData());
            $child->addChild("NOM",$contacte->getNom());
            $child->addChild("MAIL",$contacte->getEmail());
            $child->addChild("COMENTARI",$contacte->getMissatge());
            
        }
        $arrel->asXML(self::FILE);
    }
}


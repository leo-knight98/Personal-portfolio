<?php
class ComentariModel {
    const FILE = "contact.xml";

    public function __construct() {}
    
    public static function create(Comentari $comentari) {
        if ($sFile = file_get_contents(self::FILE)) {
            $sLlibre = substr($sFile,0,-12);
            $sLlibre .= "<REGISTRE><DATA>{$comentari->getData()}</DATA>";
            $sLlibre .= "<NOM>{$comentari->getNom()}</NOM><MAIL>{$comentari->getMail()}</MAIL>";
            $sLlibre .= "<EXPERIENCIA>{$comentari->getExperiencia()}</EXPERIENCIA>";
            $sLlibre .= "<COMENTARI>{$comentari->getMissatge()}</COMENTARI></REGISTRE></REGISTRES>";
            if ($file = fopen(self::FILE, "w")) {
                if (!fputs($file,$sLlibre)) {
                    throw new Exception("El fitxer no deixa escriure");
                }
                fclose($file);
                return true;
            } else {
                throw new Exception('No s\'ha pogut obrir el fitxer per emmagatzemar informació');
            }
        } else {
            throw new Exception('No s\'ha pogut llegir el fitxer');
        }
        return false;
    }
    
    public static function read() {
        if ($fitxer = simplexml_load_file(self::FILE)) {;
            foreach ($fitxer->children() as $child) {
                $data = $child->DATA->__toString();
                $nom = $child->NOM->__toString();
                $mail = $child->MAIL->__ToString();
                $experiencia = $child->EXPERIENCIA->__ToString();
                $comentari = $child->COMENTARI->__toString();   
                $comentaris[] = new Comentari($nom, $mail, $experiencia, $comentari, $data);
            }
        } else {
            throw new Exception('No es pot obrir el fitxer '. self::FILE);
        }
        return $comentaris;
    }
    
    public static function update($comentari) {
        
    }
    
    public static function delete($clauAEsborrar) {

    }
}


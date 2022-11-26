<?php
    class GuestBookModel {
        private $xml;
        private $doc;

        public function __construct() {
            $this->xml = 'ficheros/contact.xml';
            $this->doc = simplexml_load_file('ficheros/contact.xml');
        }

        public function create($guestBook) {
            if ($sFile = file_get_contents($this->xml)) {
                $sLlibre = substr($sFile,0,-13);
                $sLlibre .= "\n<REGISTRE> \n<DATA>".$guestBook->getDate()."</DATA>\n";
                $sLlibre .= "<NOM>".$guestBook->getName()."</NOM> \n<MAIL>".$guestBook->getMail()."</MAIL>\n";
                $sLlibre .= "<COMENTARI>".$guestBook->getMsg()."</COMENTARI> \n</REGISTRE> \n";
                $sLlibre .= "</REGISTRES>";
                if ($file = fopen("ficheros/contact.xml", "w")) {
                    if (!fputs($file,$sLlibre)) {
                        die ("El fitxer no deixa escriure");
                    }
                    fclose($file);
                } else {
                    die ("No s'ha pogut obrir el fitxer per emmagatzemar informació");
                }
            }
        }

        public function read() {
            $comments = [];
            $count = 0;
            
            for($i = count($this->doc->REGISTRE) - 1; $i >= 0; $i--) {
                foreach($this->doc->REGISTRE[$i] as $key => $value) {
                    $comments[$count][$key] = $value;
                }

                $count++;
            }
            return $comments;
        }
    }
?>
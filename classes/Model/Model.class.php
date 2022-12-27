<?php
    class Model {
        public $read;
        public $write;

        public function __construct() {
            $this->read = $this->getRead();
            $this->write = $this->getWrite();
        }

        private function getRead() {
            if($this->read != null) {
                return $this->read;
            } else {
                $this->read = mysqli_connect("localhost", "usr_consulta", "2022@Thos", "personal_page") or die("No s'ha pogut connectar");
                return $this->read;
            }
        }

        private function getWrite() {
            if($this->write != null) {
                return $this->write;
            } else {
                $this->write = mysqli_connect("localhost", "usr_generic", "2022@Thos", "personal_page") or die("No s'ha pogut connectar");
                return $this->write;
            }
        }

        public function disconnect() {
            mysqli_close($this->read);
            mysqli_close($this->write);
        }
    }
?>
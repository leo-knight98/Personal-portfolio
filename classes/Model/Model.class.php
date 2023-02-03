<?php
    class Model {
        public static $instance;

        public function __construct() {}

        public static function getInstance() {
            if(self::$instance != null) {
                return self::$instance;
            } else {
                try {
                    self::$instance = new PDO('mysql:host=localhost;dbname=myweb', 'usr_generic', '2022@Thos');
                    return self::$instance;
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                
            }
        }

        public static function disconnect() {
            self::$instance = null;
        }

        private function clone(){}
    }
?>

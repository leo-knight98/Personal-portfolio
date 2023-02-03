<?php
    class Accio {
        public $id;
        public $nom;
        public $ticker;
        public $mercat_id;
        public $imatge;
        public $isin;
        public $sector_id;

        public function __construct() {}

        public function getId(){return $this->id;}
        public function getNom() {return $this->nom;}
        public function getTicker() {return $this->ticker;}
        public function getMercatId(){return $this->mercat_id;}
        public function getImatge() {return $this->imatge;}
        public function getIsin() {return $this->isin;}
        public function getSectorId() {return $this->sector_id;}
    }
?>
<?php
    class SectorModel {
        public function __construct() {}

        public function getAll() {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_sectors";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sectors = [];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                $sectors[] = $result;
            }
            return $sectors;
            Model::disconnect();
        }

        public function insert($sector) {
            $conn = Model::getInstance();
            $sql = "INSERT INTO tbl_sectors VALUE :sector";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':sector' => $sector->sector
            ));
            Model::disconnect();
        }

        public function getOne($sector) {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_sectors WHERE sector = :sector";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':sector' => $sector->sector
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function delete($sector) {
            $conn = Model::getInstance();
            $accionsModel = new AccioModel();
            $accions = $accionsModel->getAllBySector($sector);
            foreach($accions as $accio) {
                $accionsModel->delete($accio);
            }

            $sql = "DELETE FROM tbl_sectors WHERE sector = :sector";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':sector' => $sector->sector));
        }
    }
?>
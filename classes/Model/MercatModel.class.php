<?php
    class MercatModel {
        public function __construct() {}

        public function getAll() {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_mercats";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
            Model::disconnect();
        }

        public function getOne($mercat) {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_mercats WHERE mercat = :mercat";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mercat', $mercat);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
            Model::disconnect();
        }

        public function delete($mercat) {
            $conn = Model::getInstance();
            $accionsModel = new AccioModel();
            $accions = $accionsModel->getAllByMercat($mercat);
            foreach($accions as $key => $value) {
                $accionsModel->delete($value);
            }

            $sql = "DELETE * FROM tbl_mercats WHERE mercat = :mercat";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':mercat' => $mercat->mercat
            ));
            Model::disconnect();
        }

        public function insert($mercat) {
            $conn = Model::getInstance();
            $sql = "INSERT INTO tbl_mercats VALUES :mercat, :pais, :moneda";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':mercat' => $mercat->mercat,
                ':pais' => $mercat->pais,
                ':moneda' => $mercat->moneda
            ));

            Model::disconnect();
        }

        public function update($mercat, $mercatOld) {
            $conn = Model::getInstance();
            $sql = "UPDATE tbl_mercats SET mercat = :mercat, pais = :pais, moneda = :moneda WHERE mercat = :mercatId";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':mercat' => $mercat->mercat,
                ':pais' => $mercat->pais,
                ':moneda' => $mercat->moneda,
                ':mercatId' => $mercatOld->mercat
            ));

            Model::disconnect();
        }
    }
?>
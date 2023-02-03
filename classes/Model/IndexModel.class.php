<?php
    class IndexModel {
        public function getAll() {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_index";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            Model::disconnect();
            return $result;
        }

        public function getOneByIndice($indice) {
            $conn = Model::getInstance();
            $sql = "SELECT * FROM tbl_index WHERE indice = :indice";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':indice' => $indice
            ));

            $result = $stmt->fetch(PDO::FETCH_OBJ);
            Model::disconnect();
            return $result;
        }

        public function insert($index) {
            $conn = Model::getInstance();
            $sql = "INSERT INTO tbl_index VALUES :indice, :descripcio";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':indice' => $index->indice,
                ':descripcio' => $index->descripcio
            ));
        }

        public function delete($index) {}

        public function update($index) {
            $conn = Model::getInstance();
            $sql = "UPDATE tbl_index SET descripcio = :descripcio WHERE indice = :indice";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':descripcio' => $index->descripcio,
                ':indice' => $index->indice
            ));
        }
    }
?>
<?php
    class AccioModel {
        public function __construct(){}

        public function insert($accioAInserir) {

            $connection = Model::getInstance();
            $sql = "INSERT INTO tbl_accions(id, nom, ticker, mercat_id, imatge, isin, sector_id) VALUES (:id, :nom, :ticker, :mercat_id, :imatge, :isin, :sector_id)";
            $stmt = $connection->prepare($sql);
            
            try {
                $stmt->bindParam(':id', $accioAInserir->id);
                $stmt->bindParam(':nom', $accioAInserir->nom);
                $stmt->bindParam(':ticker', $accioAInserir->ticker);
                $stmt->bindParam(':mercat_id', $accioAInserir->mercat_id);
                $stmt->bindParam(':imatge', $accioAInserir->imatge);
                $stmt->bindParam(':isin', $accioAInserir->isin);
                $stmt->bindParam(':sector_id', $accioAInserir->sector_id);
                $stmt->execute();
            } catch(PDOException $e) {
                echo "Error:" . $e->getMessage();
            }
            
            Model::disconnect();
        }

        public function getAll() {
            $connection = Model::getInstance();
            $sql = "SELECT * FROM tbl_accions";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            Model::disconnect();
            return $result;
        }

        public function getOneById($id) {
            $params = [$id];
            $connection = Model::getInstance();
            $sql = "SELECT * FROM tbl_accions WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo "<pre>";
            var_dump($result);
            echo "</pre>";
            Model::disconnect();
        }

        public function getAllBySector($sector) {
            $params = [$sector->sector];
            $connection = Model::getInstance();
            $sql = "SELECT * FROM tbl_accions WHERE sector = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            Model::disconnect();
            return $result;
        }
    
        public function getAllByMercat($mercat) {
            $params = [$mercat->mercat];
            $connection = Model::getInstance();
            $sql = "SELECT * FROM tbl_accions WHERE mercat = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            Model::disconnect();
            return $result;
        }

        public function update($accioAModificar) {
            $connection = Model::getInstance();
            //nom, ticker, mercat_id, imatge, isin, sector_id)
            $sql = "UPDATE tbl_accions SET nom=:nom, ticker=:ticker, mercat_id=:mercat_id, imatge=:imatge, isin=:isin, sector_id=:sector_id WHERE id=:id";
            $stmt = $connection->prepare($sql);
            try {
                $stmt->execute(array(
                    ':nom' => $accioAModificar->nom,
                    ':ticker' => $accioAModificar->ticker,
                    ':mercat_id' => $accioAModificar->mercat_id,
                    ':imatge' => $accioAModificar->imatge,
                    ':isin' => $accioAModificar->isin,
                    ':sector_id' => $accioAModificar->sector_id,
                    ':id' => $accioAModificar->id
                ));
            } catch(PDOException $e) {
                echo "Error:" . $e->getMessage();
            }
                
            Model::disconnect();
        }

        public function delete($accioAEsborrar) {
            $connection = Model::getInstance();
            $sql = "DELETE FROM tbl_accions WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->execute($accioAEsborrar->id);
            Model::disconnect();
        }
    }
?>
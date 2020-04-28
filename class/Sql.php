<?php
    class Sql extends PDO {
        private $conn;

        public function __construct()
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=db_php_7", "G_Issamu", "Gabes-311001");
        }

        private function setParams($statmets, $parameters = array())
        {
            foreach($parameters as $key => $value){
                $this->setParam($key, $value);
            }
        }

        private function setParam($statmets, $key, $value)
        {
            $statmets->bindParam($key, $value);
        }

        public function query($rawQuery, $params = array())
        {
            $stmt = $this->conn->prepare($rawQuery);

            $this->setParams($stmt, $params);

            $stmt->execute();

            return $stmt;
        }

        public function select($rawQuery, $params = array()):array 
        {
            $stmt = $this->query($rawQuery, $params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>
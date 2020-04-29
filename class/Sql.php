<?php
    class Sql extends PDO {
        private $conn;

        public function __construct()
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=db_php_7", "root", "192837_AbCdEf");
        }

        private function setParams($statemets, $parameters = array())
        {
            foreach($parameters as $key => $value){
                $this->setParam($statemets, $key, $value);
            }
        }

        private function setParam($statemets, $key, $value)
        {
            $statemets->bindParam($key, $value);
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
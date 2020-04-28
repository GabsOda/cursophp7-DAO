<?php
    class Usuario {
        private $idusuario;
        private $desloguin;
        private $dessenha;
        private $dtcadastro; 

        public function getIdusuario(){
            return $this->idusuario;
        }
        public function setIdusuario($value){
            $this->idusuario = $value;
        }

        
        public function getDesloguin(){
            return $this->desloguin;
        }
        public function setDesloguin($value){
            $this->desloguin = $value;
        }

        
        public function getDessenha(){
            return $this->dessenha;
        }
        public function setDessenha($value){
            $this->dessenha = $value;
        }

        
        public function getDtcadastro(){
            return $this->dtcadastro;
        }
        public function setDtcadastro($value){
            $this->dtcadastro = $value;
        }

        public function loadById($id){
            $sql = new Sql();

            $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$id
            ));

            if(isset($result[0]))
            {
                $row = $result[0];

                $this->setIdusuario($row['idusuario']);
                $this->setDesloguin($row['desloguin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row['dtcadastro']));
            }
        }
        public function __toString(){
            return json_encode(array(
                "idusuario"=>$this->getIdusuario(),
                "desloguin"=>$this->getDesloguin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }
    }
?>
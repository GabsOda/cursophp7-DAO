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

        public function getList(){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios ORDER BY desloguin");
        }

        public static function search($login){
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios WHERE desloguin LIKE :SEARCH ORDER BY desloguin", array(
                ':SEARCH'=>"%".$login."%"
            ));
        }

        public function login($login, $password){
            $sql = new Sql();

            $result = $sql->select("SELECT * FROM tb_usuarios WHERE desloguin = :LOG AND dessenha = :PASSW", array(
                ":LOG"=>$login,
                ":PASSW"=>$password
            ));

            if(count($result) > 0)
            {
                $this->setData($result[0]);
            } 
            else
            {
                throw new Exception("Login e/ou senha inválidos.");
            }
        }

        public function setData($data){
            $this->setIdusuario($data['idusuario']);
            $this->setDesloguin($data['desloguin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));
        }

        public function insert(){
            $sql = new Sql();

            $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ":LOGIN"=>$this->getDesloguin(),
                ":PASSWORD"=>$this->getDessenha()
            ));

            if(count($result) > 0){
                $this->setData($result[0]);
            }
        }

        public function update($login, $password){
            $this->setDesloguin($login);
            $this->setDessenha($password);

            $sql = new Sql();

            $sql->query("UPDATE tb_usuarios SET desloguin = :LOG, dessenha = :PASSW WHERE idusuario = :ID", array(
                ":LOG"=>$this->getDesloguin(),
                ":PASSW"=>$this->getDessenha(),
                ":ID"=>$this->getIdusuario()
            ));
        }

        public function delete(){
            $sql = new Sql();

            $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$this->getIdusuario()
            ));

            $this->setIdusuario(0);
            $this->setDesloguin(0);
            $this->setDessenha(0);
            $this->setDtcadastro(new DateTime());
        }

        public function __construct($login = "", $password = ""){
            $this->setDesloguin($login);
            $this->setDessenha($password);
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
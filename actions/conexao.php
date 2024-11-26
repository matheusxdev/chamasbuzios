<?php
    Class Conexao{
        private $server = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "destinotour"; 

        public function conectar(){
            try{
                $conexao = new PDO("mysql:host=$this->server;dbname=$this->db", $this->user, $this->pass);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $err){
                $conexao = null;
            }

            return $conexao;
        }
    }
?>
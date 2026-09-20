<?php
    require_once __DIR__ . '/../config/conexao.php';

    class Usuario {

        private $id;
        private $username;
        private $senha;

        public function __construct($username, $senha){
            $this->username = $username;
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $this->senha = $senha;
        }

        public function getId(){
            return $this->id;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getSenha(){
            return $this->senha;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setUsername($username){
            $this->username = $username;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO usuario (username, senha) VALUES (:u, :s);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':u' => $this->username, ':s' => $this->senha]);
        }

        public function atualizar($id){
            $this->setId($id);
            $db = getConnection();
            $sql = "UPDATE usuario SET username = :u, senha = :s WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':u' => $this->username, ':s' => $this->senha, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM usuario WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM usuario;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id, $all = false){
            $db = getConnection();
            $sql = "SELECT * FROM usuario WHERE id = :id;";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);
            if($all){
                return $stmt->fetchAll();
            }
            else{
                return $stmt->fetch();
            }
        }
    }
?>
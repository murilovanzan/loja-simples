<?php
    require_once __DIR__ . '/../config/conexao.php';

    class Endereco {

        private $ID;
        private $ID_user;
        private $nome;
        private $CEP;

        public function __construct($ID_user, $nome, $CEP){
            $this->ID_user = $ID_user;
            $this->nome = $nome;
            $this->CEP = $CEP;
        }

        public function getId(){
            return $this->id;
        }
        public function getId_user() {
            return $this->ID_user;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getCep() {
            return $this->CEP;
        }
        
        public function setId($id){
            $this->id = $id;
        }
        public function setId_user($ID_user) {
            $this->ID_user = $ID_user;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setCep($CEP) {
            $this->CEP = $CEP;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO endereco (ID_user, nome, CEP) VALUES (:id_u, :n, :c);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id_u' => $this->ID_user, ':n' => $this->nome, ':c' => $this->CEP]);
        }

        public function atualizar($id){
            $db = getConnection();
            $sql = "UPDATE endereco SET nome = :n, CEP = :c WHERE id = :id AND ID_user = :id_u;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':c' => $this->CEP, ':id' => $id, ':id_u' => $this->ID_user]);
        }

        public static function delete($id,$id_user){
            $db = getConnection();
            $sql = "DELETE FROM endereco WHERE id = :id AND ID_user = :id_u;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id, 'id_u' => $id_user]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM endereco;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getByUserId($id_user, $all = false){
            $db = getConnection();
            $sql = "SELECT * FROM endereco WHERE ID_user = :id;";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id_user]);
            if($all){
                return $stmt->fetchAll();
            }
            else{
                return $stmt->fetch();
            }
        }

        public static function getAddress($id_user, $id){
            $db = getConnection();
            $sql = 'SELECT * FROM endereco WHERE ID_user = :ID_user AND id = :id';
            $stmt = $db->prepare($sql);
            $stmt->execute([":ID_user" => $id_user,":id" => $id]);
            return $stmt->fetch();
        }
    }
?>
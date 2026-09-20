<?php
    require_once __DIR__ . '/../config/conexao.php';

    class Marca {
        
        private $id;
        private $nome;
        private $imagem;
        private $CNPJ;

        public function __construct($nome, $imagem, $CNPJ){
            $this->nome = $nome;
            $this->imagem = $imagem;
            $this->CNPJ = $CNPJ;
        }

        public function getId(){
            return $this->id;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getImagem() {
            return $this->imagem;
        }
        public function getCnpj() {
            return $this->CNPJ;
        }
        
        public function setId($id){
            $this->id = $id;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setImagem($imagem) {
            $this->imagem = $imagem;
        }
        public function setCnpj($CNPJ) {
            $this->CNPJ = $CNPJ;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO marca (nome, imagem, CNPJ) VALUES (:n, :i, :c);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':i' => $this->imagem, ':c' => $this->CNPJ]);
        }

        public function atualizar(){
            $db = getConnection();
            $sql = "UPDATE marca SET nome = :n, imagem = :i, CPNJ = :c WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':i' => $this->imagem, ':c' => $this->CNPJ, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM marca WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM marca;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id, $all = false){
            $db = getConnection();
            $sql = "SELECT * FROM marca WHERE id = :id;";
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
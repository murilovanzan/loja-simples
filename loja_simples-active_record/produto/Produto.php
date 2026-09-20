<?php
    require_once __DIR__ . '/../config/conexao.php';

    class Produto {

        private $id;
        private $nome;
        private $descricao;
        private $quantidade;
        private $preco_unitario;
        private $ID_marca;

        public function __construct($nome, $descricao, $quantidade, $preco_unitario, $ID_marca){
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->quantidade = $quantidade;
            $this->preco_unitario = $preco_unitario;
            $this->ID_marca = $ID_marca;
        }

        public function getId(){
            return $this->id;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getDescricao() {
            return $this->descricao;
        }
        public function getQuantidade() {
            return $this->quantidade;
        }
        public function getPreco_unitario() {
            return $this->preco_unitario;
        }
        public function getId_marca() {
            return $this->ID_marca;
        }
        
        public function setId($id){
            $this->id = $id;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }
        public function setPreco_unitario($preco_unitario) {
            $this->preco_unitario = $preco_unitario;
        }
        public function setId_marca($ID_marca) {
            $this->ID_marca = $ID_marca;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO produto (nome, descricao, quantidade, preco_unitario, ID_marca) VALUES (:n, :d, :q, :p, :id_m);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':d' => $this->descricao, ':q' => $this->quantidade, ':p' => $this->preco_unitario, ':id_m' => $this->ID_marca]);
        }

        public function atualizar(){
            $db = getConnection();
            $sql = "UPDATE produto SET nome = :n, descricao = :d, quantidade = :q, preco_unitario = :p, ID_marca = :id_m WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':d' => $this->descricao, ':q' => $this->quantidade, ':p' => $this->preco_unitario, ':id_m' => $this->ID_marca, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM produto WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM produto;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id, $all = false){
            $db = getConnection();
            $sql = "SELECT * FROM produto WHERE id = :id;";
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
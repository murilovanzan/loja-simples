<?php
    class Produto {
        private $ID;
        private $nome;
        private $descricao;
        private $quantidade;
        private $preco_unitario;
        private $ID_marca;

        private $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        // ==========================================
        // Getters
        // ==========================================
        public function getId() {
            return $this->ID;
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

        // ==========================================
        // Setters
        // ==========================================
        public function setId($ID) {
            $this->ID = $ID;
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

        // ==========================================
        // Operações CRUD
        // ==========================================
        public function save() {
            if ($this->ID) {
                $sql = "UPDATE Produto SET nome = :n, descricao = :d, quantidade = :q, preco_unitario = :p, ID_marca = :id_m WHERE ID = :id";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([
                    ':n'  => $this->nome,
                    ':d'  => $this->descricao,
                    ':q'  => $this->quantidade,
                    ':p'  => $this->preco_unitario,
                    ':id_m'  => $this->ID_marca,
                    ':id' => $this->ID
                ]);
            } else {
                $sql = "INSERT INTO Produto (nome, descricao, quantidade, preco_unitario, ID_marca) VALUES (:n, :d, :q, :p, :id_m)";
                $stmt = $this->pdo->prepare($sql);
                $ok = $stmt->execute([
                    ':n' => $this->nome,
                    ':d' => $this->descricao,
                    ':q' => $this->quantidade,
                    ':p' => $this->preco_unitario,
                    ':id_m' => $this->ID_marca,
                ]);
                
                if ($ok) {
                    $this->ID = $this->pdo->lastInsertId();
                }
                return $ok;
            }
        }

        public function load($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Produto WHERE ID = :id");
            $stmt->execute([':id' => $id]);
            
            if ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->ID = $dados['ID'];
                $this->nome = $dados['nome'];
                $this->descricao = $dados['descricao'];
                $this->quantidade = $dados['quantidade'];
                $this->preco_unitario = $dados['preco_unitario'];
                $this->ID_marca = $dados['ID_marca'];
                return true;
            }
            return false;
        }

        public function delete() {
            if (!$this->ID) return false;
            $stmt = $this->pdo->prepare("DELETE FROM Produto WHERE ID = :id");
            return $stmt->execute([':id' => $this->ID]);
        }

        public static function all(PDO $pdo) {
            $stmt = $pdo->query("SELECT * FROM Produto");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
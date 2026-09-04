<?php
    class Marca {
        private $ID;
        private $nome;
        private $imagem;
        private $CNPJ;

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
        public function getImagem() {
            return $this->imagem;
        }
        public function getCnpj() {
            return $this->CNPJ;
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
        public function setImagem($imagem) {
            $this->imagem = $imagem;
        }
        public function setCnpj($CNPJ) {
            $this->CNPJ = $CNPJ;
        }

        // ==========================================
        // Operações CRUD
        // ==========================================
        public function save() {
            if ($this->ID) {
                $sql = "UPDATE Marca SET nome = :n, imagem = :i, CNPJ = :cnpj WHERE ID = :id";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([
                    ':n'  => $this->nome,
                    ':i'  => $this->imagem,
                    ':cnpj'  => $this->CNPJ
                    ':id' => $this->ID
                ]);
            } else {
                $sql = "INSERT INTO Marca (nome, imagem, CNPJ) VALUES (:n, :i, :cnpj)";
                $stmt = $this->pdo->prepare($sql);
                $ok = $stmt->execute([
                    ':n' => $this->nome,
                    ':i' => $this->imagem,
                    ':cnpj' => $this->CNPJ,
                ]);
                
                if ($ok) {
                    $this->ID = $this->pdo->lastInsertId();
                }
                return $ok;
            }
        }

        public function load($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Marca WHERE ID = :id");
            $stmt->execute([':id' => $id]);
            
            if ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->ID = $dados['ID'];
                $this->nome = $dados['nome'];
                $this->imagem = $dados['imagem'];
                $this->CNPJ = $dados['CPNJ'];
                return true;
            }
            return false;
        }

        public function delete() {
            if (!$this->ID) return false;
            $stmt = $this->pdo->prepare("DELETE FROM Marca WHERE ID = :id");
            return $stmt->execute([':id' => $this->ID]);
        }

        public static function all(PDO $pdo) {
            $stmt = $pdo->query("SELECT * FROM Marca");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
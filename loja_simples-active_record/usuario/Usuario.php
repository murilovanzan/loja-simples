<?php
    class Usuario {
        private $ID;
        private $username;
        private $senha;

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
        public function getUsername() {
            return $this->username;
        }
        public function getSenha() {
            return $this->senha;
        }

        // ==========================================
        // Setters
        // ==========================================
        public function setId($ID) {
            $this->ID = $ID;
        }
        public function setUsername($username) {
            $this->username = $username;
        }
        public function setSenha($senha) {
            $this->senha = $senha;
        }

        // ==========================================
        // Operações CRUD
        // ==========================================
        public function save() {
            if ($this->ID) {
                $sql = "UPDATE Usuario SET username = :u, senha = :s WHERE ID = :id";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([
                    ':u'  => $this->username,
                    ':s'  => $this->senha,
                    ':id' => $this->ID
                ]);
            } else {
                $sql = "INSERT INTO Usuario (username, senha) VALUES (:u, :s)";
                $stmt = $this->pdo->prepare($sql);
                $ok = $stmt->execute([
                    ':u' => $this->username,
                    ':s' => $this->senha
                ]);
                
                if ($ok) {
                    $this->ID = $this->pdo->lastInsertId();
                }
                return $ok;
            }
        }

        public function load($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Usuario WHERE ID = :id");
            $stmt->execute([':id' => $id]);
            
            if ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->ID = $dados['ID'];
                $this->username = $dados['username'];
                $this->senha = $dados['senha'];
                return true;
            }
            return false;
        }

        public function delete() {
            if (!$this->ID) return false;
            $stmt = $this->pdo->prepare("DELETE FROM Usuario WHERE ID = :id");
            return $stmt->execute([':id' => $this->ID]);
        }

        public static function all(PDO $pdo) {
            $stmt = $pdo->query("SELECT * FROM Usuario");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
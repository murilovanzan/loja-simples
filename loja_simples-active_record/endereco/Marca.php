<?php
    class Endereco {
        private $ID;
        private $ID_user;
        private $nome;
        private $CEP;

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
        public function getId_user() {
            return $this->ID_user;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getCep() {
            return $this->CEP;
        }

        // ==========================================
        // Setters
        // ==========================================
        public function setId($ID) {
            $this->ID = $ID;
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

        // ==========================================
        // Operações CRUD
        // ==========================================
        public function save() {
            if ($this->ID) {
                $sql = "UPDATE Endereco SET ID_user = :id_u, nome = :n, CEP = :cep WHERE ID = :id";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([
                    ':id_u'  => $this->ID_user,
                    ':n'  => $this->nome,
                    ':cep'  => $this->CEP
                    ':id' => $this->ID
                ]);
            } else {
                $sql = "INSERT INTO Endereco (ID_user, nome, CEP) VALUES (:id_u, :n, :cep)";
                $stmt = $this->pdo->prepare($sql);
                $ok = $stmt->execute([
                    ':id_U' => $this->ID_user,
                    ':n' => $this->nome,
                    ':cep' => $this->CEP,
                ]);
                
                if ($ok) {
                    $this->ID = $this->pdo->lastInsertId();
                }
                return $ok;
            }
        }

        public function load($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Endereco WHERE ID = :id");
            $stmt->execute([':id' => $id]);
            
            if ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->ID = $dados['ID'];
                $this->ID_user = $dados['ID_user'];
                $this->nome = $dados['nome'];
                $this->CEP = $dados['CEP'];
                return true;
            }
            return false;
        }

        public function delete() {
            if (!$this->ID) return false;
            $stmt = $this->pdo->prepare("DELETE FROM Endereco WHERE ID = :id");
            return $stmt->execute([':id' => $this->ID]);
        }

        public static function all(PDO $pdo) {
            $stmt = $pdo->query("SELECT * FROM Endereco");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
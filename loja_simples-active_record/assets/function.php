<?php

    function isAdmin(){
        require_once __DIR__ . '/../usuario/Usuario.php';
        if(isset($_SESSION['logado']) && $_SESSION['logado']){
        
            $users = Usuario::getTodos();

            foreach ($users as $user){
                if($user['username'] == 'admin' && $_SESSION['ID_login'] == $user['ID']){
                    return true;
                }
            }

        }
        return false;
    }

    //==================================
    //Funções antigas - pré Active Records
    //==================================
    function getTable($pdo, $tableName){

        try{

            $sql = "SELECT * FROM $tableName;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $query = $stmt->fetchAll();
            return $query;

        }
        catch(PDOException $e){
            return "Erro buscar tabela - $tableName - " . $e->getMessage();
        }

    }

    function findRow($pdo, $tableName, $id, $all = false){

        try{

            $sql = "SELECT * FROM $tableName WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                ":id" => $id
                ]
            );

            if($all){
                $query = $stmt->fetchAll();
            }
            else{
                $query = $stmt->fetch();
            }
            
            return $query;

        }
        catch(PDOException $e){
            return "Erro ao achar ID - $id na tabela $tableName - " . $e->getMessage();
        }

    }

?>
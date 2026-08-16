<?php

    function isAdmin($pdo){

        if(isset($_SESSION['logado']) && $_SESSION['logado']){
            try{

                $sql = "SELECT * FROM user;";
                $stmt = $pdo->prepare($sql);

                $stmt->execute();

                $users = $stmt->fetchAll();
                foreach ($users as $user){
                    if($user['username'] == 'admin' && $_SESSION['ID_login'] == $user['ID']){
                        return true;
                    }
                }

            }
            catch(PDOException $e){
                echo "Erro ao verificar ADM - " . $e->getMessage();
            }
        }
        
        return false;
    }

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

    function findRow($pdo, $tableName, $id){

        try{

            $sql = "SELECT * FROM $tableName WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                ":id" => $id
                ]
            );

            $query = $stmt->fetch();
            return $query;

        }
        catch(PDOException $e){
            return "Erro ao achar ID - $id na tabela $tableName - " . $e->getMessage();
        }

    }

?>
<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_GET['id'])){
        
        extract($_GET);

        try{

            $sql = "DELETE FROM endereco WHERE id = :id AND ID_user = :ID_user;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ":ID_user" => $_SESSION['ID_login'],
                ':id' => $id
            ]);

        }
        catch(PDOException $e){
            echo "Erro ao deletar endereco - " . $e->getMessage();
        }

        header('location: index.php');
    }
    else{
        header('location: index.php');
    }
?>
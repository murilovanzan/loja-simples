<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_GET['id'])){
        
        extract($_GET);

        try{

            $sql = "DELETE FROM user WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

        }
        catch(PDOException $e){
            echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
        }

        header('location: ../logado.php');
    }
    else{
        header('location: index.php');
    }
?>
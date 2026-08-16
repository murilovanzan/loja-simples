<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_POST['username']) && isset($_POST['senha']) && isset($_GET['id'])){
        
    extract($_POST);
    extract($_GET);

    $senha = password_hash($senha, PASSWORD_DEFAULT);

        try{

            $sql = "UPDATE user SET username = :username, senha = :senha WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":username" => $username,
                    ":senha" => $senha,
                    "id" => $id
                ]
            );

            header('location: ../logado.php');

        }
        catch(PDOException $e){
            echo "Erro ao atualizar usuário - " . $e->getMessage();
        }

    }

?>
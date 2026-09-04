<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['CEP']) && isset($_GET['id'])){
            
        extract($_POST);
        extract($_GET);

        try{

            $sql = "UPDATE endereco SET nome = :nome, CEP = :CEP WHERE id = :id AND ID_user = :ID_user;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome,
                    ":CEP" => $CEP,
                    "id" => $id,
                    ":ID_user" => $_SESSION['ID_login']
                ]
            );

            header('location: index.php');

        }
        catch(PDOException $e){
            echo "Erro ao atualizar endereco - " . $e->getMessage();
        }

    }
    else{
        header('location: index.php');
    }

?>
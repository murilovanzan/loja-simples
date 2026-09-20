<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['CEP'])){

        extract($_POST);

        try{

            $sql = 'INSERT INTO endereco (nome, CEP, ID_user) VALUES (:nome, :CEP, :ID_user);';
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    "nome" => $nome,
                    "CEP" => $CEP,
                    ":ID_user" => $_SESSION['ID_login']
                ]
            );

        }
        catch(PDOException $e){
            echo 'Erro ao registrar um endereço - ' . $e->getMessage();
        }
    
        header('location: index.php');

    }
    else{
        header('location: index.php');
    }


?>
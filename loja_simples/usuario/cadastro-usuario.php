<?php

    require_once '../conexao.php';

    session_start();

    if(isset($_POST['username']) && isset($_POST['senha'])){

        extract($_POST);

        $senha = password_hash($senha, PASSWORD_DEFAULT);


        try{

            $sql = "SELECT * FROM user;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $users = $stmt->fetchAll();
        }
        catch(PDOException $e){
            echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
        }

        foreach ($users as $user) {

            if($user['username'] == $username){
                $_SESSION['erroUsername'] = "Este nome de usuário já existe!";
                header('location: index.php');
                exit;
            }

        }

        try{

            $sql = "INSERT INTO user (username, senha) VALUES (:username, :senha);";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":username" => $username,
                    ":senha" => $senha
                ]
            );

            header('location: ../');

        }
        catch(PDOException $e){
            echo "Erro ao cadastrar usuário - " . $e->getMessage();
        }

    }

?>
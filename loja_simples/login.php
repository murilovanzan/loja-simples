<?php

    require_once 'conexao.php';

    session_start();

    if(isset($_POST['username']) && isset($_POST['senha'])){

        extract($_POST);

        try{

            $sql = "SELECT * FROM user;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $users = $stmt->fetchAll();
        }
        catch(PDOException $e){
            echo "Erro na busca ao fazer login - " . $e->getMessage();
        }

        foreach ($users as $user) {

            if($username == $user['username'] && password_verify($senha, $user['senha'])){
                $_SESSION['logado'] = true;
                header('location: logado.php');
                exit;
            }
            else{
                $_SESSION['logado'] = false;
                $_SESSION['erroLogin'] = "O username ou senha estão errados!";
                header('location: index.php');
            }

        }

    }

?>
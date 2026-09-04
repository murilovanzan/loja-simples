<?php

    require_once '../config/conexao.php';
    
    include_once '../assets/function.php';

    session_start();

    if(isset($_POST['username']) && isset($_POST['senha'])){

        extract($_POST);

        $users = getTable($pdo, "user");

        foreach ($users as $user) {

            if($username == $user['username'] && password_verify($senha, $user['senha'])){
                $_SESSION['logado'] = true;
                $_SESSION['ID_login'] = $user['ID'];
                header('location: ../logado.php');
                exit;
            }
            else{
                $_SESSION['logado'] = false;
                $_SESSION['erroLogin'] = "O username ou senha estão errados!";
                header('location: ../');
            }

        }

    }
    else{
        header('location: ../index.php');
    }

?>
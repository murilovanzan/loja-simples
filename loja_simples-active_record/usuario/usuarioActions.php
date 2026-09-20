<?php

    require_once 'Usuario.php';
    
    include_once '../assets/function.php';
    
    session_start();
    
    if(isset($_GET['action'])){

        extract($_GET);
            
        switch ($action){
        
            case "create":
                if(isset($_POST['username']) && isset($_POST['senha'])){
                    extract($_POST);
                    $users = Usuario::getTodos();
                    foreach ($users as $user) {
                        if($user['username'] == $username){
                            $_SESSION['erroUsername'] = "Este nome de usuário já existe!";
                            header('location: index.php');
                            exit;
                        }
                    }       
                    $user = new Usuario($username, $senha);
                    $user->salvar();
                    header('location: ../');
                }
                else{
                    header("location: index.php");
                }
                break;

            case "update":

                if(isset($_POST['username']) && isset($_POST['senha']) && isset($_GET['id'])){
                    extract($_POST);
                    $user = new Usuario($username, $senha);
                    $user->atualizar($id);
                    header('location: ../logado.php');
                }
                else{
                    header("location: index.php");
                }
                break;

            case "delete":

                if(isset($_SESSION['ID_login']) && isset($_GET['id']) && ($_GET['id'] == $_SESSION['ID_login'] || isAdmin())){
                    Usuario::delete($id);
                    if($id == $_SESSION['ID_login']){
                        require_once '../registro/logout.php';
                    }
                    header('location: ../logado.php');
                }
                else{
                    header('location: index.php');
                }
                break;
            default:
                
        }

    }




?>
<?php

    require_once 'Produto.php';
    
    include_once '../assets/function.php';
    
    session_start();

    if(!isAdmin()){
        header('location: ../logado.php');
    }

    if(isset($_GET['action'])){

        extract($_GET);
            
        switch ($action){
        
            case "create":
                if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['marca'])){
                    extract($_POST);
                    $produto = new Produto($nome,$descricao,0,$preco,$marca);
                    $produto->salvar();
                }
                else{
                    header('location: index.php');
                }
                break;

            case "update":
                if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['marca']) && isset($_GET['id'])){
        
                    extract($_POST);
                    $produto = new Produto($nome,$descricao,0,$preco,$marca);
                    $produto->atualizar($id);
                }
                else{
                    header('location: index.php');
                }
                break;

            case "delete":
                if(isset($_GET['id'])){
                    Produto::delete($id);
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
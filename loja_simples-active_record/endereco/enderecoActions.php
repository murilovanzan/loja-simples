<?php

    require_once 'Endereco.php';
    
    include_once '../assets/function.php';
    
    session_start();
    
    if(isset($_GET['action'])){

        extract($_GET);
            
        switch ($action){
        
            case "create":
                if(isset($_POST['nome']) && isset($_POST['CEP'])){
                    extract($_POST);
                    $endereco = new Endereco($_SESSION['ID_login'],$nome,$CEP);
                    $endereco->salvar();
                }
                break;

            case "update":
                if(isset($_POST['nome']) && isset($_POST['CEP']) && isset($_GET['id'])){
                    extract($_POST);
                    $endereco = new Endereco($_SESSION['ID_login'],$nome,$CEP);
                    $endereco->atualizar($id);
                }
                break;

            case "delete":
                if(isset($_GET['id'])){
                    Endereco::delete($id,$_SESSION['ID_login']);
                }
                break;
            default:
                
        }
        header('location: index.php');
    }




?>
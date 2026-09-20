<?php

    require_once 'Marca.php';
    
    include_once '../assets/function.php';
    
    session_start();

    if(!isAdmin()){
        header('location: ../logado.php');
    }

    if(isset($_GET['action'])){

        extract($_GET);
            
        switch ($action){
        
            case "create":
                if(isset($_POST['nome']) && isset($_POST['CNPJ']) && isset($_FILES['logo'])){

                    extract($_POST);

                    $marcas = Marca::getTodos();

                    foreach ($marcas as $marca){

                        if($marca['CNPJ'] == $CNPJ){
                            $_SESSION['erroMarca'] = "Marca já registrada";
                            header('location: index.php');
                            exit;
                        }

                    }

                    if(!is_dir("logos/")){
                        mkdir("logos/", 0755, true);
                    }
                    $dir = "logos/";
                    $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                    $nomeLogo = uniqid('logo_', true);
                    $nomeNovoFile = $nomeLogo . '.' . $extensao;
                    $caminhoFinal = $dir . $nomeNovoFile;
                    move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoFinal);

                    $marca = new Marca($nome,$caminhoFinal,$CNPJ);
                    $marca->salvar();
                    
                    header('location: index.php');
                }
                else{
                    header('location: index.php');
                }
                break;

            case "update":
                if(isset($_POST['nome']) && isset($_POST['CNPJ']) && isset($_FILES['logo']) && isset($_GET['id'])){
                        
                    extract($_POST);
                    
                    $marca = getById($id);
                    
                    if(!is_dir("logos/")){
                        mkdir("logos/", 0755, true);
                    }
                    $dir = "logos/";
                    unlink($marca['imagem']);
                    $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                    $nomeLogo = uniqid('logo_', true);
                    $nomeNovoFile = $nomeLogo . '.' . $extensao;
                    $caminhoFinal = $dir . $nomeNovoFile;
                    move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoFinal);
                        
                    $marca = new Marca($nome,$caminhoFinal,$CNPJ);
                    $marca->atualizar($id);

                    header('location: index.php');
                }
                else{
                    header('location: index.php');
                }
                break;

            case "delete":
                if(isset($_GET['id'])){

                    $marca = getById($id);

                    unlink($marca['imagem']);

                    Marca::delete($id);
                }
                else{
                    header('location: index.php');
                }
                break;
            default:
                
        }

    }




?>
<?php

    require_once '../config/conexao.php';
    
    include_once '../assets/function.php';
    
    session_start();

    if(!isAdmin($pdo)){
        header('location: ../logado.php');
    }

    if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['marca']) && isset($_GET['id'])){
        
        extract($_POST);
        extract($_GET);

        try{

            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco_unitario = :preco, ID_marca = :ID_marca WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome, 
                    ":descricao" => $descricao, 
                    ":preco" => $preco, 
                    ":ID_marca" => $marca,
                    "id" => $id
                ]
            );

            header('location: index.php');

        }
        catch(PDOException $e){
            echo "Erro ao cadastrar produto - " . $e->getMessage();
        }

    }
    else{
        header('location: index.php');
    }

?>
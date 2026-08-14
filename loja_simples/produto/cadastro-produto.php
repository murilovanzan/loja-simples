<?php

    require_once '../conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['marca'])){

        extract($_POST);

        try{

            $sql = "INSERT INTO produto (nome, descricao, preco_unitario, ID_marca) VALUES (:nome, :descricao, :preco, :ID_marca);";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome, 
                    ":descricao" => $descricao, 
                    ":preco" => $preco, 
                    ":ID_marca" => $marca
                ]
            );

            header('location: ../');

        }
        catch(PDOException $e){
            echo "Erro ao cadastrar produto - " . $e->getMessage();
        }

    }

?>
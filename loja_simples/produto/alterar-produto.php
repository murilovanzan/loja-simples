<?php

    require_once '../conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['marca'])){

        extract($_POST);

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

            header('location: ../');

        }
        catch(PDOException $e){
            echo "Erro ao cadastrar produto - " . $e->getMessage();
        }

    }

?>
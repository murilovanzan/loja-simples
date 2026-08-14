<?php

    require_once '../conexao.php';

    session_start();

    extract($_GET);

    try{

        $sql = "DELETE FROM produto WHERE id = :id;";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header('location: index.php');
    }
    catch(PDOException $e){
        echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
    }


?>
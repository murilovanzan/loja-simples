<?php

    require_once '../conexao.php';

    session_start();

    extract($_GET);

    try{

        $sql = "DELETE FROM user WHERE id = :id;";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header('location: ../logado.php');
    }
    catch(PDOException $e){
        echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
    }


?>
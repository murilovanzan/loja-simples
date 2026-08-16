<?php

    require_once '../config/conexao.php';

    session_start();
    
    if(isset($_GET['id'])){
        
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
    }
    else{
        header('location: index.php');
    }
  


?>
<?php

    require_once '../config/conexao.php';

    session_start();
    
    if(isset($_GET['id'])){
        extract($_GET);

        try{

            $sql = "DELETE FROM marca WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            header('location: index.php');
        }
        catch(PDOException $e){
            echo "Erro ao deletar marca - " . $e->getMessage();
        }

    }
    else{
        header('location: index.php');
    }
    


?>
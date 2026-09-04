<?php

    require_once '../config/conexao.php';

    include_once '../assets/function.php';
    
    session_start();

    if(!isAdmin($pdo)){
        header('location: ../logado.php');
    }
    
    if(isset($_GET['id'])){
   
        extract($_GET);

        $marca = findRow($pdo, 'marca', $id);

        unlink($marca['imagem']);

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
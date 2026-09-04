<?php

    require_once '../config/conexao.php';

    include_once '../assets/function.php';

    session_start();

    if(isset($_SESSION['ID_login']) && isset($_GET['id']) && ($_GET['id'] == $_SESSION['ID_login'] || isAdmin($pdo))){
        
        extract($_GET);

        try{

            $sql = "DELETE FROM user WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

        }
        catch(PDOException $e){
            echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
        }

        if($id == $_SESSION['ID_login']){
            require_once '../registro/logout.php';
        }
        
        header('location: ../logado.php');
    }
    else{
        header('location: index.php');
    }
?>
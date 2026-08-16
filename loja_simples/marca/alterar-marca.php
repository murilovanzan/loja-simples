<?php

    require_once '../config/conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['CNPJ']) && isset($_FILES['logo']) && isset($_GET['id'])){
        
    extract($_POST);
    extract($_GET);

        try{

            $sql = "SELECT * FROM marca WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([":id" => $id]);
            $marca = $stmt->fetch();

        }
        catch(PDOException $e){
            echo 'Erro na busca das marcas para alterar marca - ' . $e->getMessage();
        }

        try{

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
            
            $sql = "UPDATE marca SET nome = :nome, CNPJ = :CNPJ, imagem = :logo WHERE id = :id;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome, 
                    ":CNPJ" => $CNPJ, 
                    ":logo" => $caminhoFinal,
                    "id" => $id
                ]
            );

            header('location: index.php');

        }
        catch(PDOException $e){
            echo "Erro ao alterar marca - " . $e->getMessage();
        }

    }

?>
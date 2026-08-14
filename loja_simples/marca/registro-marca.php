<?php

    require_once '../conexao.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['CNPJ']) &&isset($_FILES['logo'])){

        extract($_POST);

        try{

            $sql = "SELECT * FROM marca;";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $marcas = $stmt->fetchAll();

        }
        catch(PDOException $e){
            echo 'Erro na busca ao cadastrar marca - ' . $e->getMessage();
        }

        foreach ($marcas as $marca){

            if($marca['CNPJ'] == $CNPJ){
                $_SESSION['erroMarca'] = "Marca já registrada";
                header('location: index.php');
                exit;
            }

        }

        try{
            
            if(!is_dir("logos/")){
                mkdir("logos/", 0755, true);
            }
            
            $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $nomeLogo = uniqid('logo_', true);
            $nomeNovoFile = $nomeLogo . '.' . $extensao;
            $caminhoFinal = "logos/" . $nomeNovoFile;
            move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoFinal);

            $sql = "INSERT INTO marca (nome, cnpj, imagem) VALUES (:nome, :cnpj, :logo);";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome,
                    ":cnpj" => $CNPJ,
                    ":logo" => $caminhoFinal
                ]
            );

            header('location: ../');


        }
        catch(PDOException $e){
            echo "Erro ao cadastrar marca - " . $e->getMessage();
        }



    }


?>
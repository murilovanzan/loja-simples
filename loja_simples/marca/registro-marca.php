<?php

    require_once '../config/conexao.php';
    
    include_once '../assets/function.php';

    session_start();

    if(isset($_POST['nome']) && isset($_POST['CNPJ']) && isset($_FILES['logo'])){

        extract($_POST);

        $marcas = getTable($pdo, "marca");

        foreach ($marcas as $marca){

            if($marca['CNPJ'] == $CNPJ){
                $_SESSION['erroMarca'] = "Marca já registrada";
                header('location: index.php');
                exit;
            }

        }

        if(!is_dir("logos/")){
            mkdir("logos/", 0755, true);
        }
        $dir = "logos/";
        $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $nomeLogo = uniqid('logo_', true);
        $nomeNovoFile = $nomeLogo . '.' . $extensao;
        $caminhoFinal = $dir . $nomeNovoFile;
        move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoFinal);

        try{
            
            $sql = "INSERT INTO marca (nome, cnpj, imagem) VALUES (:nome, :cnpj, :logo);";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                    ":nome" => $nome,
                    ":cnpj" => $CNPJ,
                    ":logo" => $caminhoFinal
                ]
            );


        }
        catch(PDOException $e){
            echo "Erro ao cadastrar marca - " . $e->getMessage();
        }
        
        header('location: index.php');

    }
    else{
        header('location: index.php');
    }


?>
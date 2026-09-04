<?php

    require_once '../config/conexao.php';

    include_once '../assets/function.php';

    session_start();
    
    if(!isAdmin($pdo)){
        header("location: ../logado.php");
    }
    else{

        $marcas = getTable($pdo, "marca");

    }

    if(isset($_SESSION['erroMarca'])){
        $erro = $_SESSION['erroMarca'];
        unset($_SESSION['erroMarca']);
    }
    else{
        $erro = "";
    }

    if(isset($_GET['id'])){

        extract($_GET);
        
        $acao = "alterar-marca.php?id=".$id;
        $nomeBotao = 'Atualizar marca';

        $marca = findRow($pdo, "marca", $id);

    }
    else{
        
        $acao = 'registro-marca.php';
        $nomeBotao = 'Cadastrar marca';
        $marca = ['nome' => '', 'CNPJ' => '', 'imagem' => ''];
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar marcas</title>
    <style>
        td > img{
            max-width: 15%; /* Scales down if the container is smaller than the image */
            height: auto;     /* Maintains the original aspect ratio */
        }
    </style>
</head>
<body>
    <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">

        <span><?= $erro?></span>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $marca['nome'] ?>">

        <label for="CNPJ">CNPJ:</label>
        <input type="text" name="CNPJ" id="CNPJ" value="<?= $marca['CNPJ'] ?>">

        <label for="logo">Logo:</label>
        <input type="file" name="logo" id="logo" value="<?= $marca['imagem'] ?>">

        <button type="submit"><?= $nomeBotao ?></button>
    </form>

    <table border=1>
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Logo</th>
                <th>Delete</th>
                <th>Alterar</th>
            </thead>
            <tbody>
            <?php
                foreach ($marcas as $marca) :
            ?>
                <tr>
                    <td><?= $marca['ID'] ?></td>
                    <td><?= $marca['nome'] ?></td>
                    <td><?= $marca['CNPJ'] ?></td>
                    <td><img src="<?= $marca['imagem'] ?>" alt="Erro ao carregar imagem"></td>
                    <td><a href="delete-marca.php?id=<?= $marca['ID'] ?>">[X]</a></td>
                    <td><a href="?id=<?= $marca['ID'] ?>">[X]</a></td>
                </tr>
            <?php      
                endforeach;
            ?>
            </tbody>
        </table>
        
    <a href='../logado.php'>
        Logado
    </a>
</body>
</html>
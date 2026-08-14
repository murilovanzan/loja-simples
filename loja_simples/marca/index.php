<?php

    session_start();
    if(isset($_SESSION['erroMarca'])){
        $erro = $_SESSION['erroMarca'];
        unset($_SESSION['erroMarca']);
    }
    else{
        $erro = "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="registro-marca.php" method="post" enctype="multipart/form-data">

        <span><?= $erro?></span>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="CNPJ">CNPJ:</label>
        <input type="text" name="CNPJ" id="CNPJ">

        <label for="logo">Logo:</label>
        <input type="file" name="logo" id="logo">

        <button type="submit">Cadastrar marca</button>
    </form>
</body>
</html>
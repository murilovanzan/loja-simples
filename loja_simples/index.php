<?php

    session_start();
    if(isset($_SESSION['erroLogin'])){
        $erro = $_SESSION['erroLogin'];
        unset($_SESSION['erroLogin']);
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
    <title>Página de início</title>
</head>
<body>

    <form action="login.php" method="post">
        

        <label for="username">Username:</label>
        <input type="text" name="username" id="username">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <button type="submit">Fazer Login</button>
            
        <span><?= $erro?></span>
    </form>

    <a href="usuario/">
        Cadastrar usuário
    </a>
    <br>
    <a href="produto/">
        Cadastrar produtos
    </a>
    <br>
    <a href="marca/">
        Cadastrar marcas
    </a>
    <br>
    <a href="/phpmyadmin" target="_blank">
        PHPMYADMIN
    </a>
    
</body>
</html>
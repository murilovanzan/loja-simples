<?php

    require_once 'assets/verifica-login.php';

    require_once 'config/conexao.php';

    include_once 'assets/function.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logado</title>
</head>
<body>
    <div style="display: <?= $tableDisplay ?>;">
        <a href="produto/">
            Cadastrar produtos
        </a>
        <br>
        <a href="marca/">
            Cadastrar marcas
        </a>
        <br>
        <a href="usuario/">
            Cadastrar usuário
        </a>
        <br>
        <a href="endereco/">
            Cadastrar endereço
        </a>
    </div>
    
    <a href='registro/logout.php'>
        logout
    </a>
</body>
</html>
    

<?php

    session_start();
    if(isset($_SESSION['erroUsername'])){
        $erro = $_SESSION['erroUsername'];
        unset($_SESSION['erroUsername']);
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
    <title>Cadastro de usuários</title>
    <script>

        function mostrarSenha(){

            const input = document.getElementById('senha');

            if(input.type == "password"){
                input.type = "text";
            }
            else if(input.type == "text"){
                input.type = "password";
            }

        }

    </script>
</head>
<body>
    <form action="cadastro-usuario.php" method="post">

        <span><?= $erro?></span>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">
        <button type="button" onclick="mostrarSenha()">Mostrar senha</button>

        <button type="submit">Cadastrar usuário</button>

    </form>
</body>
</html>
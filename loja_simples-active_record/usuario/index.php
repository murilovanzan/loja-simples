<?php

    require_once '../config/conexao.php';

    include_once '../assets/function.php';

    session_start();

    if(isset($_SESSION['erroUsername'])){
        $erro = $_SESSION['erroUsername'];
        unset($_SESSION['erroUsername']);
    }
    else{
        $erro = "";
    }

    if(isset($_SESSION['ID_login']) && isset($_GET['id']) && ($_GET['id'] == $_SESSION['ID_login'] || isAdmin($pdo))){
        
        extract($_GET);    
        
        $acao = "alterar-usuario.php?id=".$id;
        $nomeBotao = 'Alterar usuário';
        $alteraUsername = false;

        $user = findRow($pdo, 'user', $id);

    }
    else{
        $acao = 'cadastro-usuario.php';
        $nomeBotao = 'Cadastrar usuário';
        $alteraUsername = true;
        $user = ['username' => ''];
    }
    
    if(isAdmin($pdo)){
        
        $users = getTable($pdo, 'user');
        $tableDisplay = 'table';
    }
    else if(isset($_SESSION['ID_login'])){
        $tableDisplay = 'table';
        
        $users = findRow($pdo, 'user', $_SESSION['ID_login'], true);
    }
    else{

        $tableDisplay = 'none';
        
        $users = [];
    
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
    <form action="<?= $acao ?>" method="post">

        <span><?= $erro?></span>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= $user['username']?>" <?= !$alteraUsername ? 'readonly' : ''?>>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">
        <button type="button" onclick="mostrarSenha()">Mostrar senha</button>

        <button type="submit"><?= $nomeBotao ?></button>

    </form>

    <table border=1 style="display: <?= $tableDisplay ?>;">
            <thead>
                <th>ID</th>
                <th>Username</th>
                <th>Delete</th>
                <th>Alterar</th>
            </thead>
            <tbody>
            <?php
                foreach ($users as $user) :
            ?>
                <tr>
                    <td><?= $user['ID'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><a href="delete-usuario.php?id=<?= $user['ID'] ?>">[X]</a></td>
                    <td><a href="?id=<?= $user['ID'] ?>">[X]</a></td>
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
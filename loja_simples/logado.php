<?php

    require_once 'verifica-login.php';

    require_once 'conexao.php';

    echo "<h1>LOGADO</h1>";

    echo "<a href='logout.php'>logout</a>";

    try{

        $sql = "SELECT * FROM user;";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $users = $stmt->fetchAll();
    }
    catch(PDOException $e){
        echo "Erro na busca ao cadastrar usuário - " . $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table border=1>
        <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Delete</th>
        </thead>
        <tbody>
    <?php
        foreach ($users as $user) :
    ?>
            <tr>
                <td><?= $user['ID'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><a href="usuario/delete-user.php?id=<?= $user['ID'] ?>">[X]</a></td>
            </tr>
    <?php      
        endforeach;
    ?>
        </tbody>
    </table>
</body>
</html>
    

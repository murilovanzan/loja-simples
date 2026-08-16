<?php

    require_once '../config/conexao.php';

    require_once '../assets/verifica-login.php';

    try{

        $sql = 'SELECT * FROM endereco WHERE ID_user = :ID_user';
        $stmt = $pdo->prepare($sql);

        $stmt->execute(
            [
            ":ID_user" => $_SESSION['ID_login']
            ]
        );

        $enderecos = $stmt->fetchAll();

    }
    catch(PDOException $e){
        echo 'Erro ao procurar endereços - ' . $e->getMessage();
    }

    if(isset($_GET['id'])){
        try{

            $sql = 'SELECT * FROM endereco WHERE ID_user = :ID_user AND id = :id';
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [
                ":ID_user" => $_SESSION['ID_login'],
                ":id" => $id
                ]
            );

            $addrss = $stmt->fetch();

        }
        catch(PDOException $e){
            echo 'Erro ao procurar endereços - ' . $e->getMessage();
        }
    }
    else{
        $addrss = ["nome" => '', "CEP" => ''];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar enderecos</title>
</head>
<body>
    <form action="registrar-endereco.php" method="post">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $addrss['nome']?>">

        <label for="CEP">CEP:</label>
        <input type="text" name="CEP" id="CEP" value="<?= $addrss['CEP']?>">

        <button type="submit">Registrar endereco</button>

    </form>

    <table border=1>
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>CEP</th>
                <th>Delete</th>
                <th>Alterar</th>
            </thead>
            <tbody>
            <?php
                foreach ($enderecos as $endereco) :
            ?>
                <tr>
                    <td><?= $endereco['ID'] ?></td>
                    <td><?= $endereco['nome'] ?></td>
                    <td><?= $endereco['CEP'] ?></td>
                    <td><a href="delete-endereco.php?id=<?= $endereco['ID'] ?>">[X]</a></td>
                    <td><a href="?id=<?= $endereco['ID'] ?>">[X]</a></td>
                </tr>
            <?php      
                endforeach;
            ?>
            </tbody>
        </table>

</body>
</html>
<?php

    require_once 'Endereco.php';

    require_once '../assets/verifica-login.php';
    
    $enderecos = Endereco::getByUserId($_SESSION['ID_login'], true);

    if(isset($_GET['id'])){

        extract($_GET); 
        
        $acao = "update&id=".$id;
        $nomeBotao = "Alterar endereço";

        $addrss = Endereco::getAddress($_SESSION['ID_login'], $id);
    }
    else{
        $acao = "create";
        $nomeBotao = "Registrar endereço";
        $addrss = ["nome" => '', "CEP" => ''];
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar enderecos</title>
</head>
<body>
    <form action="enderecoActions.php?action=<?= $acao ?>" method="post">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $addrss['nome']?>">

        <label for="CEP">CEP:</label>
        <input type="text" name="CEP" id="CEP" value="<?= $addrss['CEP']?>">

        <button type="submit"><?= $nomeBotao ?></button>

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
                    <td><a href="enderecoActions.php?action=delete&id=<?= $endereco['ID'] ?>">[X]</a></td>
                    <td><a href="?id=<?= $endereco['ID'] ?>">[X]</a></td>
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
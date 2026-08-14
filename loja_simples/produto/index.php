<?php

    require_once '../conexao.php';

    try{

        $sql = "SELECT * FROM marca;";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $marcas = $stmt->fetchAll();

    }
    catch(PDOException $e){
        echo 'Erro na busca ao cadastrar marca - ' . $e->getMessage();
    }

    try{

        $sql = "SELECT * FROM produto;";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $produtos = $stmt->fetchAll();

    }
    catch(PDOException $e){
        echo 'Erro na busca ao cadastrar marca - ' . $e->getMessage();
    }

    if(isset($_GET['id'])){

        extract($_GET);
        
        $acao = 'alterar-produto.php';
        $nomeBotao = 'Atualizar produto';

        $sql = "SELECT * FROM produto WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([":id" => $id]);

        $prod = $stmt->fetch();

    }
    else{
        
        $acao = 'cadastro-produto.php';
        $nomeBotao = 'Cadastrar produto';
        $prod = ['nome' => '', 'descricao' => '', 'preco' => '', ];
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produtos</title>
</head>
<body>
    <form action="<?= $acao ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value=<?= $prod['nome']?>>

        <label for="descricao">Descricao:</label>
        <textarea name="descricao" id="descricao" value=<?= $prod['nome']?>></textarea>

        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" value=<?= $prod['nome']?>>

        <label for="marca">Marca:</label>
        <select name="marca" id="marca" required>

            <option value="" disabled selected></option>

            <?php

                foreach ($marcas as $marca):

            ?>
            
            <option value="<?= $marca['ID'] ?>"><?= $marca['nome'] ?></option>

            <?php 
                endforeach;
            ?>
            
        </select>

        <button type="submit"><?= $nomeBotao ?></button>

    </form>

    <table border=1>
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Marca</th>
            <th>Delete</th>
            <th>Alterar</th>
        </thead>
        <tbody>
    <?php
        foreach ($produtos as $produto) :
    ?>
            <tr>
                <td><?= $produto['ID'] ?></td>
                <td><?= $produto['nome'] ?></td>
                <td><?= $produto['descricao'] ?></td>
                <td><?= $produto['quantidade'] ?></td>
                <td><?= $produto['preco_unitario'] ?></td>
                <?php
                    foreach ($marcas as $marca){
                        if($produto['ID_marca'] == $marca['ID']){
                            echo "<td>".$marca['nome']."</td>";
                        }
                    }   
                ?>
                <td><a href="delete-produto.php?id=<?= $produto['ID'] ?>">[X]</a></td>
                <td><a href="?id=<?= $produto['ID'] ?>">[X]</a></td>
            </tr>
    <?php      
        endforeach;
    ?>
        </tbody>
    </table>

</body>
</html>


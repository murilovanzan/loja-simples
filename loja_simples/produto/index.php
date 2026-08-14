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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produtos</title>
</head>
<body>
    <form action="cadastro-produto.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="descricao">Descricao:</label>
        <textarea name="descricao" id="descricao"></textarea>

        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01">

        <label for="marca">Marca:</label>
        <select name="marca" id="marca" required>

            <option value="" disabled></option>

            <?php

                foreach ($marcas as $marca):

            ?>
            
            <option value="<?= $marca['ID'] ?>"><?= $marca['nome'] ?></option>

            <?php 
                endforeach;
            ?>
            
        </select>

        <button type="submit">Cadastrar produto</button>

    </form>
</body>
</html>


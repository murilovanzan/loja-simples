<?php

    $host = 'localhost';
    $db = 'loja_simples';
    $user = 'root';
    $senha = '';

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $senha);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }  
    catch(PDOException $error_PDO){
        echo "Erro de conexão - " . $error_PDO->getMessage();
    }

?>
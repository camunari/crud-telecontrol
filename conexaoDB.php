<?php

//endereco
//nome DB
//usuario
//senha

$endereco = 'localhost';
$banco = 'sistelecontrol';
$usuario = 'postgres';
$senha = 'root';

try {
    $pdo = new PDO("pgsql:host=$endereco;port=5432;dbname=$banco", $usuario, $senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
} catch (\PDOException $e) {

    echo "Falha ao conectar no Banco de Dados :(";
    die($e->getMessage());

}

?>
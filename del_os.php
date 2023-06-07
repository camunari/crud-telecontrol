<?php

require_once 'conexaoDB.php';
session_start();


if (empty($_SESSION)) {
    //significa que as variaveis de sessao nao foram definidas
    //nao poderia acessar
    header("Location: index.php?msgErro=Você precisa se autenticar.");
    die();
}

// echo "Estou logado!";

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// die();

$result = array();

if (!empty($_GET['id'])) {

    $sql = "SELECT * FROM ordem_servico WHERE id = :id";

    try {

        $stmt = $pdo->prepare($sql);

        $stmt->execute(array(':id' => $_GET['id']));

        if ($stmt->rowCount() == 1) {

            $result = $stmt->fetchAll();
            $result = $result[0];


            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';
            // die();

        } else {

            header("Location: index_logado.php?msgErro=Você não tem permissão para acessar esta página");

            die();
        }
    } catch (\PDOException $e) {

        header("Location: index_logado.php?msgErro=Falha ao obter registros do Banco de Dados");

        die($e->getMessage());
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar informações do Ordem de Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <?php include('navbar.php'); ?>
    <script src="bootstrap.min.js"></script>

    <div class="container mt-3">

        <h1>Deletar Ordem de Serviço</h1>

        <form action="processa_ordem_servico.php" class="" method="post">

            <input type="hidden" name="id" id="id" value="<?php echo $result['id'] ?>">
            <div class="col-4">
                <label for="nome">Número Ordem</label>
                <input type="text" name="numero_ordem" id="numero_ordem" class="form-control" value="<?php echo $result['numero_ordem'] ?>" readonly>
            </div></br>

            <div class="col-4">
                <label for="cpf">Data de abertura</label>
                <input type="text" name="data_abertura" id="data_abertura" class="form-control" value="<?php echo $result['data_abertura'] ?>" readonly>
            </div></br>

            <div class="col-4">
                <label for="nome_cliente">Nome Consumidor</label>
                <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" value="<?php echo $result['nome_cliente'] ?>" readonly>
            </div></br>

            <div class="col-4">
                <label for="nome_cliente">Poduto</label>
                <input type="text" name="produto" id="produto" class="form-control" value="<?php echo $result['produto'] ?>" readonly>
            </div></br>

            <div class="col-4">
                <label for="cpf_cliente">CPF</label>
                <input type="text" name="cpf_cliente" id="cpf_cliente" class="form-control" value="<?php echo $result['cpf_cliente'] ?>" readonly>
            </div></br>

            <button type="submit" name="enviarDados" class="btn btn-danger" value="DEL">Deletar</button>
            <a href="/crudTelecontrol/list_ordens_servico_cad.php" class="btn btn-primary">Cancelar</a>

    </div>
    </div>

    </form>
    </div>

</body>

</html>
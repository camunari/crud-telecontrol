<?php

require_once 'conexaoDB.php';

session_start();

if (empty($_SESSION)) {
    //significa que as variaveis de sessao nao foram definidas
    //nao poderia acessar
    header("Location: index.php?msgErro=Você precisa se autenticar.");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Ambiente Logado!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>

    <?php include('navbar.php'); ?>
    <script src="bootstrap.min.js"></script>

    <div class="container">

        <?php if (!empty($_GET['msgErro'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_GET['msgErro']; ?>
            </div>
        <?php } ?>

        <?php if (!empty($_GET['msgSucesso'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_GET['msgSucesso']; ?>
            </div>
        <?php } ?>

    </div>

    <div class="container">
        <div class="col-md-11">
            <h2 class="title mt-5">Olá! <?php echo $_SESSION['nome']; ?>, seja bem vindo(a)!</h2>
        </div>
    </div>

    
</body>

</html>
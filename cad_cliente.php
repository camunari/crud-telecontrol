<?php

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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    
    <?php include('navbar.php'); ?>
    <script src="bootstrap.min.js"></script>

    <div class="container mt-3">

        <h1>Cadastrar Cliente</h1>
        
        <form action="processa_cliente.php" class="" method="post">

            <div class="col-4">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control">
            </div></br>

            <div class="col-4">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control">
            </div></br>

            <div class="col-4">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control">
            </div></br>

            <div class="col-4">
                <label>Status</label>
                <select class="form-select" name="ativo" id="ativo">
                    <option value="true">Ativo</option>
                    <option value="false" disabled>Inativo</option>
                </select>
            </div></br>

            <button type="submit" name="enviarDados" class="btn btn-primary" value="CAD">Cadastrar</button>
            <a href="/crudTelecontrol/index_logado.php" class="btn btn-danger">Cancelar</a>

        </div>
    </div>

    </form>
    </div>

</body>

</html>
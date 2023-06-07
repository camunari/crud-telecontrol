<?php

require_once 'conexaoDB.php';

session_start();

if (empty($_SESSION)) {
    //significa que as variaveis de sessao nao foram definidas
    //nao poderia acessar
    header("Location: index.php?msgErro=Você precisa se autenticar.");
    die();
}

$clientes = array();
$sql = "SELECT * FROM cliente";
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        //execucao da sql deu certo.
        $clientes = $stmt->fetchAll();                //COMO FAZER UM SELECT E LISTAR OS DADOS CADASTRADOS NO BANCO
        // echo '<pre>';
        // print_r($clientes);
        // echo '</pre>';
        // die();
    } else {
        die("Falha ao executar SQL...");
    }
} catch (\Throwable $th) {
    //throw $th;
}


?>

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

    <?php if (!empty($clientes)) { ?>

        <!--Aqui será montada a tabela de listagens-->
        <div class="container">
            
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th> <!--vai ser o id-->
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">CPF</th>
                        <th scope="col" >Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($clientes as $cliente) { ?>

                        <tr>
                            <th scope="row"> <?php echo $cliente['id']; ?> </th>
                            <td> <?php echo $cliente['nome']; ?> </td>
                            <td> <?php echo $cliente['endereco']; ?> </td>
                            <td> <?php echo $cliente['cpf']; ?> </td>
                            <td> <?php echo $cliente['status'] == 'ativo' ? "Ativo" : "Excluído"; ?> </td></td>
                            <td>
                                <a href="alt_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="del_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger">Excluir</a>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>

    <?php } ?>



</body>

</html>
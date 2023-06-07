<?php

require_once 'conexaoDB.php';

session_start();

if (empty($_SESSION)) {
    //significa que as variaveis de sessao nao foram definidas
    //nao poderia acessar
    header("Location: index.php?msgErro=Você precisa se autenticar.");
    die();
}

$ordens_servicos = array();
$sql = "SELECT * FROM ordem_servico";
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        //execucao da sql deu certo.
        $ordens_servicos = $stmt->fetchAll();                //COMO FAZER UM SELECT E LISTAR OS DADOS CADASTRADOS NO BANCO
        // echo '<pre>';
        // print_r($ordens_servicos);
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

    <?php if (!empty($ordens_servicos)) { ?>

        <!--Aqui será montada a tabela de listagens-->
        <div class="container">
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th> <!--vai ser o id-->
                        <th scope="col">Número OS</th>
                        <th scope="col">Data Abertura</th>
                        <th scope="col">Nome Consumidor</th>
                        <th scope="col">CPF Consumidor</th>
                        <th scope="col">Situação</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($ordens_servicos as $os) { ?>

                        <tr>
                            <th scope="row"> <?php echo $os['id']; ?> </th>
                            <td> <?php echo $os['numero_ordem']; ?> </td>
                            <td> <?php echo $os['data_abertura']; ?> </td>
                            <td> <?php echo $os['nome_cliente']; ?> </td>
                            <td> <?php echo $os['cpf_cliente']; ?> </td>
                            <td> <?php echo $os['situacao'] == 'true' ? "Ativo" : "Excluído"; ?> </td></td>
                            <td>
                                <a href="alt_os.php?id=<?php echo $os['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="del_os.php?id=<?php echo $os['id']; ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>

    <?php } ?>



</body>

</html>
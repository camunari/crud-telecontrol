<?php

require_once 'conexaoDB.php';

session_start();

if (empty($_SESSION)) {
    //significa que as variaveis de sessao nao foram definidas
    //nao poderia acessar
    header("Location: index.php?msgErro=Você precisa se autenticar.");
    die();
}

$produtos = array();
$sql = "SELECT * FROM produto";
try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        //execucao da sql deu certo.
        $produtos = $stmt->fetchAll();                //COMO FAZER UM SELECT E LISTAR OS DADOS CADASTRADOS NO BANCO
        // echo '<pre>';
        // print_r($produtos);
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

    <?php if (!empty($produtos)) { ?>

        <!--Aqui será montada a tabela de listagens-->
        <div class="container">
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Tempo de Garantia</th>
                        <th scope="col">Situação</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($produtos as $produto) { ?>

                        <tr>
                            <th scope="row"> <?php echo $produto['id']; ?> </th>
                            <td> <?php echo $produto['produto']; ?> </td>
                            <td> <?php echo $produto['codigo']; ?> </td>
                            <td> <?php echo $produto['descricao']; ?> </td> 
                            <td> <?php echo $produto['tempo_garantia']; ?> </td>
                            <td> <?php echo $produto['situacao'] == 'true' ? "Ativo" : "Excluído"; ?> </td></td>
                            <td>
                                <a href="alt_produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="del_produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>

    <?php } ?>



</body>

</html>
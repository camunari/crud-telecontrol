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

    $sql = "SELECT * FROM produto WHERE id = :id";

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

    <title>Editar informações do Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    
    <?php include('navbar.php'); ?>
    <script src="bootstrap.min.js"></script>

    <div class="container mt-3">

        <h1>Editar Produto</h1>
        
        <form action="processa_produto.php" class="" method="post">

            <input type="hidden" name="id" id="id" value="<?php echo $result['id'] ?>">
            <div class="col-4">
                <label for="produto">Produto</label>
                <input type="text" name="produto" id="produto" class="form-control" value="<?php echo $result['produto'] ?>">
            </div></br>

            <div class="col-4">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $result['codigo'] ?>">
            </div></br>

            <div class="col-4">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $result['descricao'] ?>">
            </div></br>

            <button type="submit" name="enviarDados" class="btn btn-primary" value="ALT">Salvar</button>
            <a href="/crudTelecontrol/list_produtos_cad.php" class="btn btn-danger">Cancelar</a>

        </div>
    </div>

    </form>
    </div>

</body>

</html>
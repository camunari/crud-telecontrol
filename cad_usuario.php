<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar um novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container">

        <h1>Cadastrar Novo(a)- Usuário!</h1>
        
        <form action="processa_usuario.php" class="" method="post">

            <div class="col-4">
                <label for="nome">Nome Completo</label>
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
                <label for="endereco">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div></br>

            <div class="col-4">
                <label for="endereco">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control">
            </div></br>

            <button type="submit" name="enviarDados" class="btn btn-primary">Cadastrar</button>
            <a href="/crudTelecontrol/index.php" class="btn btn-danger">Cancelar</a>

        </div>
    </div>

    </form>
    </div>

</body>

</html>
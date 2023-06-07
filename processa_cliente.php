<?php
require_once 'conexaoDB.php';
// Definir o BD (e a tabela)
// Conectar ao BD (com o PHP)

session_start();

if (empty($_SESSION)) {
    // Significa que as variáveis de SESSAO não foram definidas.
    // Não poderia acessar aqui.
    header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
    die();
}

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
die();
*/

if (!empty($_POST)) {
    // Está chegando dados por POST e então posso tentar inserir no banco
    // Obter as informações do formulário ($_POST)
    // Verificar se estou tentando INSERIR (CAD) / ALTERAR (ALT) / EXCLUIR (DEL)
    if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!
        try {
            // Preparar as informações
            // Montar a SQL (pgsql)
            $sql = "INSERT INTO cliente
                  (nome, endereco, cpf)
                VALUES
                  (:nome, :endereco, :cpf)";

            // Preparar a SQL (pdo)
            $stmt = $pdo->prepare($sql);

            // Definir/organizar os dados p/ SQL
            $dados = array(
                ':nome' => $_POST['nome'],
                ':endereco' => $_POST['endereco'],
                ':cpf' => $_POST['cpf']
            );

            // Tentar Executar a SQL (INSERT)
            // Realizar a inserção das informações no BD (com o PHP)
            if ($stmt->execute($dados)) {
                header("Location: index_logado.php?msgSucesso=Cliente cadastrado com sucesso!");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
            header("Location: index_logado.php?msgErro=Falha ao cadastrar cliente..");
        }
    } elseif ($_POST['enviarDados'] == 'ALT') { // ALTERAR!!!
        /* Implementação do update aqui.. */
        // Construir SQL para update
        try {
          $sql = "UPDATE
                    cliente
                  SET
                    nome = :nome,
                    endereco = :endereco,
                    cpf = :cpf
                  WHERE
                    id = :id";
    
          // Definir dados para SQL
          $dados = array(
            ':id' => (int)$_POST['id'],
            ':nome' => $_POST['nome'],
            ':endereco' => $_POST['endereco'],
            ':cpf' => $_POST['cpf']
          );
    
          $stmt = $pdo->prepare($sql);
    
          // Executar SQL
          if ($stmt->execute($dados)) {
            header("Location: index_logado.php?msgSucesso=Alteração realizada com sucesso!!");
          }
          else {
            header("Location: index_logado.php?msgErro=Falha ao ALTERAR anúncio..");
          }
        } catch (PDOException $e) {
        //   die($e->getMessage());
          header("Location: index_logado.php?msgErro=Falha ao ALTERAR cadastro cliente..");
        }

    } elseif ($_POST['enviarDados'] == 'DEL') { // SOFT DELETE!!!
        /* Implementação do update aqui.. */
        // Construir SQL para update
        try {
          $sql = "UPDATE cliente SET status = 'inativo' WHERE id = :id";
    
          // Definir dados para SQL
          $dados = array(
            ':id' => (int)$_POST['id']
          );
    
          $stmt = $pdo->prepare($sql);
    
          // Executar SQL
          if ($stmt->execute($dados)) {
            header("Location: index_logado.php?msgSucesso=Cliente excluído com sucesso!!");
          }
          else {
            header("Location: index_logado.php?msgErro=Falha ao ALTERAR cadastro cliente...");
          }
        } catch (PDOException $e) {
          die($e->getMessage());
          // header("Location: index_logado.php?msgErro=Falha ao ALTERAR cadastro cliente..");
        }
    } else {
        header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
    }
} else {
    header("Location: index_logado.php?msgErro=Erro de acesso.");
}
die();

// Redirecionar para a página inicial (index_logado) c/ mensagem erro/sucesso

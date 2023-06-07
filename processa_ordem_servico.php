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


  // echo '<pre>';
  // print_r($_POST);
  // echo '</pre>';
  // die();


if (!empty($_POST)) {
  // Está chegando dados por POST e então posso tentar inserir no banco
  // Obter as informações do formulário ($_POST)
  // Verificar se estou tentando INSERIR (CAD) / ALTERAR (ALT) / EXCLUIR (DEL)
  if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!
    try {
      // Preparar as informações
      // Montar a SQL (pgsql)
      $sql = "INSERT INTO ordem_servico
                  (numero_ordem, data_abertura, nome_cliente, cpf_cliente, produto, situacao)
                VALUES
                  (:numero_ordem, :data_abertura, :nome_cliente, :cpf_cliente, :produto, :situacao)";

      // Preparar a SQL (pdo)
      $stmt = $pdo->prepare($sql);

      // Definir/organizar os dados p/ SQL
      $dados = array(
        ':numero_ordem' => $_POST['numero_ordem'],
        ':data_abertura' => $_POST['data_abertura'],
        ':nome_cliente' => $_POST['nome_cliente'],
        ':cpf_cliente' => $_POST['cpf_cliente'],
        ':produto' => $_POST['produto'],
        ':situacao' => $_POST['situacao']

      );

      // Tentar Executar a SQL (INSERT)
      // Realizar a inserção das informações no BD (com o PHP)
      if ($stmt->execute($dados)) {
        header("Location: index_logado.php?msgSucesso=OS cadastrada com sucesso!");
      }
    } catch (PDOException $e) {
      // die($e->getMessage());
      header("Location: index_logado.php?msgErro=Falha ao cadastrar OS...");
    }
  } elseif ($_POST['enviarDados'] == 'ALT') { // ALTERAR!!!
    /* Implementação do update aqui.. */
    // Construir SQL para update
    try {
      $sql = "UPDATE
                    ordem_servico
                  SET
                    numero_ordem = :numero_ordem,
                    data_abertura = :data_abertura,
                    nome_cliente = :nome_cliente,
                    cpf_cliente = :cpf_cliente,
                    produto = :produto
    
                  WHERE
                    id = :id";

      // Definir dados para SQL
      $dados = array(
        ':id' => (int)$_POST['id'],
        ':numero_ordem' => $_POST['numero_ordem'],
        ':data_abertura' => $_POST['data_abertura'],
        ':nome_cliente' => $_POST['nome_cliente'],
        ':cpf_cliente' => $_POST['cpf_cliente'],
        ':produto' => $_POST['produto']
      );

      $stmt = $pdo->prepare($sql);
      echo $sql;
      // Executar SQL
      if ($stmt->execute($dados)) {
        header("Location: list_ordens_servico_cad.php?msgSucesso=Alteração realizada com sucesso!!");
      } else {
        header("Location: list_ordens_servico_cad.php?msgErro=Falha ao ALTERAR OS..");
      }
    } catch (PDOException $e) {
      die($e->getMessage());
      // header("Location: list_produtos_cad.php?msgErro=Falha ao ALTERAR OS...");
    }
  } elseif ($_POST['enviarDados'] == 'DEL') { // SOFT DELETE!!!
    /* Implementação do update aqui.. */
    // Construir SQL para update
    try {
      $sql = "UPDATE ordem_servico SET situacao = 'inativo' WHERE id = :id";

      // Definir dados para SQL
      $dados = array(
        ':id' => (int)$_POST['id']
      );

      $stmt = $pdo->prepare($sql);

      // Executar SQL
      if ($stmt->execute($dados)) {
        header("Location: index_logado.php?msgSucesso=Ordem de serviço excluída com sucesso!!");
      } else {
        header("Location: index_logado.php?msgErro=Falha ao ALTERAR OS...");
      }
    } catch (PDOException $e) {
      // die($e->getMessage());
      // header("Location: index_logado.php?msgErro=Falha ao ALTERAR OS..");
    }
  } else {
    // die($e->getMessage());
    // header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
  }
} else {
  header("Location: index_logado.php?msgErro=Erro de acesso.");
}
die();

// Redirecionar para a página inicial (index_logado) c/ mensagem erro/sucesso

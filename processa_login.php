<?php

require_once 'conexaoDB.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die();

//verificar se está chegando dados POST
if (!empty($_POST)) {
    
    //iniciar sessao
    session_start();
    try {
        //montar sql
        $sql = "SELECT nome, email, cpf, endereco FROM usuario WHERE email = :email AND senha = :senha";

        //preparar sql via pdo
        $stmt = $pdo->prepare($sql);

        $dados = array(
            ':email' => $_POST['email'],
            ':senha' => md5($_POST['senha'])
        );

        $stmt->execute($dados);

        $result = $stmt->fetchAll();

        if ($stmt->rowCount() == 1) { //se o resultado trouxer um registro
            
            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';
            // die();
            
            // autenticacao sucesso

            $result = $result[0];

            //definir variaveis de sessao
            $_SESSION['nome']     = $result['nome'];
            $_SESSION['email']    = $result['email'];
            $_SESSION['cpf']      = $result['cpf'];
            $_SESSION['endereco'] = $result['endereco'];
            
        
            //redirecionar para pagina inicial
            header("Location: index_logado.php");

        } else {

            //die('NADA');  

            session_destroy(); 
            header("Location: index.php?msgErro=E-mail e/ou senha inválido(s)");
            //senao
            //falha autenticacao
            //redirecionar para pagina inicial

        }

        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // die();

    } catch (PDOException $e) {

        die($e->getMessage());

    }

} else {
    header("Location: index.php?msgErro=Você não tem permissão para acessar esta página");
}

die();

?>
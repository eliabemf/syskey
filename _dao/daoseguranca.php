<?php

require_once "conection.php";

function startLogin($login, $senha) {

// session_start inicia a sessão
    session_name(md5("seg" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

  //  session_cache_expire(10);

    session_start();

    
// conectar com o bando de dados.
    $con = conexao();

// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "SELECT * FROM `usuario` WHERE `usuarios` = '" . $login . "' AND `senha`= '" . $senha . "'";
    $result = $con->query($sql);

    /*
     * Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida,
     * ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não, 
     * se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina site.php 
     * ou retornara  para a pagina do formulário inicial para que se possa tentar novamente realizar o login 
     */

    if ($result->num_rows > 0) {
        //Insere os campos do usuario do banco de dados com a variavel $row
        $row = $result->fetch_assoc();
        
        $_SESSION['usuarios'] = $login;
        $_SESSION['senha'] = $senha; 
        $_SESSION['permissao'] = $row['permissao'];
        $_SESSION['nome'] = $row['nome'];

        header('location:../_chaves/chavesMenu.php');
    } else {
        unset($_SESSION['usuarios']);
        unset($_SESSION['senha']);
        unset($_SESSION['permissao']); 
        unset($_SESSION['nome']); 
        
        print("Erro ao se Logar.");
    }
}

function verificarLogin() {

    /*
     * Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida,
     * ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não,
     * se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina site.php
     * ou retornara  para a pagina do formulário inicial para que se possa tentar novamente realizar o login
     */
    session_name(md5("seg" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

 //   session_cache_expire(100);

    session_start();

    if (isset($_SESSION['usuarios']) and isset($_SESSION['senha']) and isset($_SESSION['permissao']) and isset($_SESSION['nome'])) {
        
        return [$_SESSION['usuarios'],$_SESSION['permissao'],$_SESSION['nome']];
        
    } else {
        unset($_SESSION['usuarios']);
        unset($_SESSION['senha']);
        unset($_SESSION['permissao']);
        unset($_SESSION['nome']); 
        
        header('location:../index.php');
    }
}

?>
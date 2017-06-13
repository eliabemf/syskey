<?php

require_once "conection.php";

function startLogin($login, $senha) {

// session_start inicia a sessão
    session_name(md5("seg" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

    session_cache_expire(10);

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
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;        

        header('location:../_chaves/chavesMenu.php');
    } else {

        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        
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

    session_cache_expire(100);

    session_start();

    if (isset($_SESSION['login']) and isset($_SESSION['senha']) and isset($_SESSION['usuario'])) {

        return $_SESSION['login'];
        
    } else {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);

        header('location:../index.php');
    }
}

?>
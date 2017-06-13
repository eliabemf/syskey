<?php

function conexao() {

    $servidor = "localhost";
    $nomebanco = "controlechaves";
    $usuario = "root";
    $senha = "";

// criando conexão com o bd
    $conn = new mysqli($servidor, $usuario, $senha, $nomebanco);

// Check connection
    if ($conn->connect_error) {
        header("location:../_igreja/igrejamenu.php");
    } else
        return $conn;
}


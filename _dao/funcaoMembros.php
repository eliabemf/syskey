<?php
require_once "conection.php";

function quantidadeMembros(){
    // conectar com o bando de dados.
    $conn = conexao();
    
    //faz a seleção no banco de dados de todos os membros existentes
    $sql = "SELECT idmembro FROM membro";
    $result = $conn->query($sql);

    //retorna a quantidade de elementos econtrados na tabela
    return $result->num_rows;
    
}

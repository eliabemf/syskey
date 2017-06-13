<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function locacoesAnteriores($idChav, $con, $status) {

    if ($status == 0) {
        // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
        $sql = "SELECT * FROM locacao where idChave=" . $idChav . " ORDER BY horaDev DESC";
    } else {
        $sql = "SELECT * FROM locacao where idChave=" . $idChav . " ORDER BY horaPeg DESC";
    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        
        // delimita o tamanho maximo do nome da chave q ira apararecer na tela, no caso são 7 charater 
        $e = substr($row["nomeLocador"], 0, 8);
        $e1 = substr($row["usuarioPeg"], 0, 8);
    } else {
        $e = "";
        $e1 = "";
    }

    return "Loc: " . $e . "<br>Usr: " . $e1;
}

<?php

require_once '../_dao/daoseguranca.php';

// conectar com o bando de dados.
$con = conexao();

/* essa variavels esta sendo contruida 
 * no padrão para que possa ser utilizada 
 * como uma matriz para se guadar o "nome" da chave e seu "iid" 
 */
$chaves = array(array());
/* Essa variavel é utilizada para se contar quantos valores 
 * vinheram do formulario do arquivo "chavesLocarDesLocar.php"
 */
$i = 0;

foreach ($_POST as $nome => $id) {

    $chaves[$i][0] = $nome;

    $chaves[$i][1] = $id;



   // echo $chaves[$i][0] . "   " . $chaves[$i][1] . "<br>";

    $i++;
}

/*
 * Este modulo server para que se possa Locar e se Devolver uma chave
 *  
 */

if ($chaves[0][0] == "loc@chave" && $chaves[0][1] == "Locar") {

    /*
     *  percorre todo o vetor que possui os dados das chaves a 
     * serem alteradas o Status de locado e Devolvido
     *  */

    for ($j = 1; $j < $i; $j++) {

        $sql = "SELECT * FROM `chaves` WHERE `idchave` = " . $chaves[$j][1];

        $result = $con->query($sql);

//Verifica se foi devolvido algum resultado do banco de dados
        if ($result->num_rows > 0) {

// Atribui a variavel $row todos os campus da chave selecionada do banco
            $row = $result->fetch_assoc();

            /* Verificação para saber se é para Devolver ou Locar a chave
             * 1 - quer dizer que a chave esta locada e sera devolvida
             * 0 - quer dizer que a chave esta desponivel para ser locada
             * dessa forma alterando o seu 'status' com forme for necessario
             */
            if ($row["status"] == 1) {

                $sql = "UPDATE `chaves` SET status=0 WHERE `idchave` = " . $chaves[$j][1];
            } else if ($row["status"] == 0) {

                $sql = "UPDATE `chaves` SET status=1 WHERE `idchave` = " . $chaves[$j][1];
            }
            $con->query($sql);
        }
    }
    $con->close();
    header('location:chavesMenu.php');
}

//verifica se o que se deseja fazer é Excluir uma chave 
else if ($chaves[0][0] == "excluir@chv" && $chaves[0][1] == "Excluir") {



    /*
     *  percorre todo o vetor que possui os dados das chaves a 
     * serem alteradas o Status de locado e Devolvido
     *  */

    for ($j = 1; $j < $i; $j++) {

        /* Verificação para saber se é para Excluir a chave */

        $sql = "DELETE  FROM `chaves` WHERE `idchave`=" . $chaves[$j][1];

        $con->query($sql);
    }

    $con->close();
    header('location:chavesMenu.php');
}


//codigo cadastrar
else if ($chaves[0][0] == "cadt@chv" && $chaves[0][1] == "Cadastrar") {

    $con->close();
    header('location:cadastrarChaves.php');
}


//ediar os dados efetivamente no bd
else if ($chaves[0][0] == "editar" && $chaves[0][1] == "Editar") {

    $sql = "SELECT * FROM `chaves` WHERE `idchave` = " . $chaves[1][1];

    $result = $con->query($sql);

//Verifica se foi devolvido algum resultado do banco de dados
    if ($result->num_rows > 0) {

// Atribui a variavel $row todos os campus da chave selecionada do banco
        $row = $result->fetch_assoc();

        /* Verificação para saber se é para Devolver ou Locar a chave
         * 1 - quer dizer que a chave esta locada e sera devolvida
         * 0 - quer dizer que a chave esta desponivel para ser locada
         * dessa forma alterando o seu 'status' com forme for necessario
         */



        require_once 'editarChavesI.php';

        echo "Número chave:<br>
            <input type=\"text\" name=\"numero@chave\" value=\"" . $row["chave"] . "\">
            <br>
            Departamento:<br>
            <input type=\"text\" name=\"departamento\" value=\"" . $row["descricao"] . "\">
            <br><br>
            <input name=\"editar@chavesCHV\" type=\"submit\" value=\"Salvar\"> 
            <input type=\"hidden\" value=\"" .$row["idchave"]. "\" name=\"" .$row["idchave"]. "\" />";  

        require_once 'editarChavesII.php';

        $con->close();
    } else {
        $con->close();
        header('location:cadastrarChaves.php');
    }
}

//Cadastrar efetivamente os dados no bd
else if ($chaves[2][0] == "cadastrar@chavesCHV" && $chaves[2][1] == "Salvar") {


// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "INSERT INTO `chaves`(`chave`, `descricao`, `status`) VALUES ('" . $chaves[0][1] . "', '" . $chaves[1][1] . "'," . "0" . ")";
    $result = $con->query($sql);
    $con->close();

    header('location:chavesMenu.php');
}

//Editar efetivamente os dados no bd
else if ($chaves[2][0] == "editar@chavesCHV" && $chaves[2][1] == "Salvar") {

    

    // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "UPDATE `chaves` SET `chave`='".$chaves[0][1] ."', `descricao`='".$chaves[1][1] . "' WHERE `idchave`=".$chaves[3][1];
    
    $result = $con->query($sql);
    $con->close();

    header('location:chavesMenu.php');
}




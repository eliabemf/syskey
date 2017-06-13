<?php

require_once '../_dao/daoseguranca.php';

$usuario = verificarLogin();

/*
 * Na variavel 
 * $usuario[0] -> esta o username
 * $usuario[1] -> esta a permissao do usuario
 * $usuario[2] -> nome Do usuario
 *
 * verificação de usuario padrão ou de Admin
 * No campo 'permissao' do bd
 * Admin = 1
 * Usuario normal = 2
 */

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
$tam = 0;

foreach ($_POST as $nome => $id) {

    $chaves[$tam][0] = $nome;

    $chaves[$tam][1] = $id;

//  echo $chaves[$tam][0] . "   " . $chaves[$tam][1] . "<br>";

    $tam++;
}

// Este modulo server para que se possa Locar uma chave   

if ($chaves[0][0] == "loc@chave" && $chaves[0][1] == "Locar") {

    $con->close();

    //Passa um vetor com os dados via URL

    header("location:locarChav.php?" . http_build_query($chaves, '', '&'));
}

// Este modulo server para que se possa Devolver uma chave   

if ($chaves[0][0] == "dev@chave" && $chaves[0][1] == "Devolver") {

    /*
     *  percorre todo o vetor que possui os dados das chaves a 
     *  serem alteradas o Status de locado e Devolvido
     */

    for ($j = 1; $j < $tam; $j++) {

        $sql = "SELECT * FROM `chaves` WHERE `idchave` =" . $chaves[$j][1];

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

            //Pegar a hora de Recife
            date_default_timezone_set('America/Recife');

            if ($row["status"] == 1) {
                
                $data =  date("Y-m-d H:i:s");

                $sql = "UPDATE `chaves` SET status=0 WHERE `idchave` =" . $chaves[$j][1];

                $sql2 = "UPDATE `locacao` SET horaDev='" . $data . "', usuarioDev='" . $usuario[2] . "'  WHERE `idChave`='" . $chaves[$j][1] . "' AND `horaDev`='0000-00-00 00:00:00'";


                //atualizar o loglocacao
                
                $sql3 = "UPDATE `loglocacao` SET horaDev='" . $data . "', nomeUsuarioDev='" . $usuario[2] . "'  
                        WHERE `idChave`='" . $chaves[$j][1] . "' AND `horaDev`='0000-00-00 00:00:00'";
            
                /*
                 * 
                 * //  UPDATE `locacao` SET `horaDev`='2017-02-02 02:02:02'  WHERE `idChave`='21'  AND `horaDev`='0000-00-00 00:00:00'
                 * 
                 * 
                 * 
                 * 
                 * Fazer um procedimoento para que os dados sejam
                 * salvos no Banco de daos na tabela 'loglocacoes'
                 * 
                 * 
                 *  Trabalho de BD
                 * 
                 * 
                 * 
                 */
            }

            $con->query($sql);
            $con->query($sql2);
            $con->query($sql3);
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

    for ($j = 1; $j < $tam; $j++) {

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
            <input type=\"hidden\" value=\"" . $row["idchave"] . "\" name=\"" . $row["idchave"] . "\" />";

        require_once 'editarChavesII.php';

        $con->close();
    } else {
        $con->close();
        header('location:cadastrarChaves.php');
    }
}

// Informação
else if ($chaves[0][0] == "info@chave" && $chaves[0][1] == "Informações") {

    $info = array(array());
    $i = 0;

    foreach ($chaves as $key) {

        if ($key[1] != "Informações") {

            $info[$i][0] = $key[1];
        }
        $i += 1;
    }

    header('location:chavesInformacoes.php?pagina=0&' . http_build_query($info, '', '&'));
}

//Locar efetivamente
else if ($chaves[1][0] == "loc@chaves!!" && $chaves[1][1] == "Locar") {

    date_default_timezone_set("America/Recife");

    for ($j = 2; $j < $tam; $j++) {

        $data = date("Y-m-d H:i:s");

        // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
        $sql = "INSERT INTO `locacao`(`idChave`,`nomeLocador`, `horaPeg`,`usuarioPeg`,`horaDev`) VALUES ('" . $chaves[$j][0] . "', '" . $chaves[0][1] . "','" . $data . "','" . $usuario[2] . "','0000-00-00 00:00:00')";

        //Insere no loglocacao
        $sql2 = "INSERT INTO `loglocacao`(`idChave`,`nomeLoc`, `horaPeg`,`nomeUsuarioDev`,`nomeUsuarioPeg`,`horaDev`) "
                . "VALUES ('" . $chaves[$j][0] . "' ,'" . $chaves[0][1] . "','" . $data . "',' ','" . $usuario[2] . "','0000-00-00 00:00:00')";

        $result = $con->query($sql);

        $sql = "UPDATE `chaves` SET `status`=1  WHERE `idchave`=" . $chaves[$j][0];

        $result = $con->query($sql);


        $result = $con->query($sql2);

        /*
         * 
         * 
         * 
         * 
         * 
         * 
         * Fazer um procedimoento para que os dados sejam
         * salvos no Banco de daos na tabela 'loglocacoes'
         * 
         * 
         *  Trabalho de BD
         * 
         * 
         * 
         */
    }

    $con->close();

    header('location:chavesMenu.php');
}

//Cadastrar efetivamente os dados no bd
else if ($chaves[2][0] == "cadastrar@chavesCHV" && $chaves[2][1] == "Salvar") {


// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios

    $sql = "INSERT INTO `chaves`(`chave`, `descricao`, `status`) VALUES ('" . $chaves[0][1] . "', '" . $chaves[1][1] . "',0)";
    $result = $con->query($sql);
    $con->close();

    header('location:chavesMenu.php');
}

//Editar efetivamente os dados no bd
else if ($chaves[2][0] == "editar@chavesCHV" && $chaves[2][1] == "Salvar") {

    // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "UPDATE `chaves` SET `chave`='" . $chaves[0][1] . "', `descricao`='" . $chaves[1][1] . "' WHERE `idchave`=" . $chaves[3][1];

    $result = $con->query($sql);
    $con->close();

    header('location:chavesMenu.php');
}


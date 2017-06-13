<?php
require_once '../_dao/daoseguranca.php';
require_once './locacoesAnt.php';

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


/*
 * Esta parte serve para pegar as chaves q foram selecionadas na pagina anterios
 * e buscar no banco de dados
 * Esses valores são inserido na tabela de forma a se configurar  como uma 
 * tabela com Paginação
 */

//pega o array que é passado por url
$chaves = $_GET;

/* Aloca um array para que os valores passados pela url possam ser inseridos nesta variavel
 * e assim podendo ser acessada de forma mais simples
 */
$chavesPassadas = array(array());

/* Variavel para a criação de um codigo SQL q será feita a seguir
 * Q tem como pricipal função de pegar os IDs das chaves passadas pela URL
 * organizando-as desta forma
 * 'idChave=1 or idChave=2 or idChave=3'
 */
$codSql = "";
//Contador
$i = 0;
foreach ($chaves as $key) {

    /* Pega apenas o primeiro valor do array que é justamente a pagina que eu estou no momento 
     * (Lembrando que esta pagina 'chavesInformacoes.php' tem a simples função de mostrar
     * os logs das chaves que foram selecionadas)
     */

    if ($i == 0) {
        //pegar a pagina atual
        $pagina = $key[0];
    } else {
        $chavesPassadas[$i][0] = $key[0];
        $idKey = " idChave=" . $key[0];
    }

    //user admin
    if ($usuario[1] = 1) {
        /*
         * Insere o comando SQL 'or' entre duas idChave
         * 'idChave=1 or idChave=2'
         */
        if (($i > 0 ) && $i < (count($chaves) - 1)) {

            $codSql = $idKey ;
        }
        
    } else if ($usuario[1] = 2) {

        if (($i > 0 ) && $i < (count($chaves) - 1)) {
            //Delimita a quantidade de visualizações para as pessoas que pegaram as chaves 

            $codSql = $codSql ." ( " . $idKey . " LIMIT 0,5 ) or ";
        }
        else{
            $codSql = $codSql . $idKey . " LIMIT 0,5 ";
        }
    }
    $i += 1;
}



//definir o numero de Itens por Pagina
$itens_por_pagina = 10;

//Conexao com o banco
$con = conexao();

//puxar produtos do banco de dados
$sql = "SELECT * FROM loglocacao WHERE " . $codSql . " LIMIT " . $pagina * $itens_por_pagina . ", " . $itens_por_pagina;
$sql_result = $con->query($sql) or die($con->error);

$row = $sql_result->fetch_assoc();
$numrows = $sql_result->num_rows;

//pega a quantidade total de objetos no banco de dados
$sql = "SELECT * FROM loglocacao WHERE " . $codSql;
$sql_result2 = $con->query($sql)or die($con->error);


// numero total de quantidade de objetos
$numrowsTotal = $sql_result2->num_rows;

// Definir numero de paginas 
$num_paginas = ceil($numrowsTotal / $itens_por_pagina);
?>

<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chaves-EMCM</title>

        <!-- imports genericos -->
        <link href="../_bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="../_bootstrap-3.3.7-dist/css/chavesMenu.css" rel="stylesheet">

        <!-- imports para se fazer a seleção das chaves por meio do JQuery -->

        <script src="../_jQuery v3.1.0/jQuery v3.1.0.js"></script> 

        <script src="../_bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    </head>

    <body>

        <header>
            <div class="container mainnb ">
                <nav class="navbar navbar-default" >
                    <div class="container-fluid ">
                        <div class="navbar-header ">
                            <a class="navbar-brand">
                                <img style="width: 50%;" src="../_img/logoufrn.png" alt="Syskey"/>
                                <p>Syskey</p>
                            </a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><p class="navbar-text"> <?php echo "Olá, <b> $usuario[2] </b>"; ?></p></li>
                                <li><a href="../_dao/logout.php">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>


        <section >

            <div class="container" >
                <div>
                    <div class="">
                        <div>
                            <h2>Detalhes Sobre as Locações das Chaves</h2>
                        </div>

                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th> Chave </th>
                                    <th> Locador </th>                                        
                                    <th> Usuario Peg </th>                                        
                                    <th> Horario Peg </th>
                                    <th> Usuario Dev </th>
                                    <th> Horario Dev</th>
                                </tr>
                            </thead>
                            <?php if ($numrows > 0) { ?>
                                <tbody>
                                    <?php
                                    do {
                                        /*
                                         * Pega o idChave que esta em loglocacao e pega o nome da chave que esta 
                                         * na tabela chaves
                                         */
                                        $sql = "SELECT * FROM chaves WHERE idChave=" . $row['idChave'];
                                        $sql_result2 = $con->query($sql) or die($con->error);
                                        $row2 = $sql_result2->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td> <?php echo $row2['chave']; ?></td>
                                            <td> <?php echo $row['nomeLoc']; ?></td>
                                            <td> <?php echo $row['nomeUsuarioPeg']; ?></td>
                                            <td> <?php echo $row['horaPeg']; ?></td>
                                            <td> <?php echo $row['nomeUsuarioDev']; ?></td>
                                            <td> <?php echo $row['horaDev']; ?></td>
                                        </tr>

                                        <?php
                                    } while ($row = $sql_result->fetch_assoc());
                                    ?>
                                </tbody>
                            </table>

                            <nav aria-label="Page navigation">
                                <ul class="pagination">

                                    <!-- Botão '<-' mostra a primeira organização da tabela  -->
                                    <li>
                                        <?php echo" <a href=\"chavesInformacoes.php?pagina=0&" . http_build_query($chavesPassadas, '', '&') . "\" aria-label=\"Previous\" > "; ?>
                                        <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    /*
                                     * Botões dinamicos da tabela com paginação
                                     */

                                    if ($numrows > 0) {

                                        if ($pagina - 1 >= 0) {
                                            echo "<li > <a href=\"chavesInformacoes.php?pagina=" . ($pagina - 1) . "&" . http_build_query($chavesPassadas, '', '&') . "\" > ";
                                            echo $pagina;
                                            echo "</a> </li>";
                                        }

                                        if (($pagina == 0) || ($pagina <= $num_paginas)) {

                                            echo "<li class=\"active\" >                                          
                                            <a href=\"chavesInformacoes.php?pagina=" . $pagina . "&" . http_build_query($chavesPassadas, '', '&') . "\" > ";
                                            echo $pagina + 1;
                                            echo "</a> </li>";
                                        }

                                        if ($num_paginas > ($pagina + 1)) {
                                            echo "<li > <a href=\"chavesInformacoes.php?pagina=" . ($pagina + 1) . "&" . http_build_query($chavesPassadas, '', '&') . "\" > ";
                                            echo $pagina + 2;
                                            echo "</a> </li>";
                                        }

                                        if (($num_paginas > ($pagina + 2)) && !(($pagina - 1) >= 0)) {
                                            echo "<li ";
                                            echo " > <a href=\"chavesInformacoes.php?pagina=" . ($pagina + 2) . "&" . http_build_query($chavesPassadas, '', '&') . "\" > ";
                                            echo $pagina + 3;
                                            echo "</a> </li>";
                                        }
                                    }
                                    ?>

                                    <!-- Botão '->' utima organização da table  -->
                                    <li>
                                        <a href = "chavesInformacoes.php?pagina=<?php echo $num_paginas - 1 . "&" . http_build_query($chavesPassadas, '', '&'); ?>"  aria-label = "Next">
                                            <span aria-hidden = "true">
                                                &raquo;
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </section>

    </body>

</html>

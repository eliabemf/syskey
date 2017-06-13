<?php
require_once '../_dao/daoseguranca.php';
require_once '../cabecalho.php';

//verificarLogin();
?>

<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chaves-EMCM</title>

        <!-- imports genericos -->
        <link href="../_bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">


        <!-- imports para se fazer a seleção das chaves por meio do JQuery -->

        <link href="chavesMenu.css" rel="stylesheet">

        <script>
            /* 
             * function loc(id, chave1, selec, stats,edit)
             * 
             * Essa função serve para selecionar a chave q será locada.
             *  
             * ID : identirica a <div> que sera auterada. que é a chave primaria do BD
             * chave1 : nome da chave que aparecera na tela
             * selec : verifica se a chave foi selecionada ou não. valores 1 ou 0
             * stats : determina se a chave esta locada ou não. paramentro passado do BD
             * edit : para regulamentar q apenas uma chave por vez pode ser editada
             * 
             * */

            //Controla a disponibilidade do botão editar
            var editar = 0;

            //Controla a disponibilidade do botão excluir
            var excluir = 0;


            //Controla a disponibilidade do botão excluir e de locar e devolver q eles possuiem o mesmo padrão
            var Locar = 0;

            var Dev = 0;

            //COntrola a disponilidade de cadastrar uma nova chave
            var cadastrar = 0;

            /*
             * O ususario só pode devolver ou locar e não fazer os dois ao mesmo tempo
             * A variavel "quantChavSelec" serve para contar quantas chaves foram selecionadas
             * 
             * A variavel "devLoc" serve para saber se é para devolver ou locar chaves
             * Ela deve iniciar em 0 pois assim sabe-se que nem uma chave foi selecionada 
             * e podendo auterar o seu estado atual para 1 ou 2
             * sendo o estado 1 para devolver
             * e estado 2 para locar
             * Esta variavel só pode ser altarada o valor quando o seu valor atual for 0
             * ele se será 0 quando não houver nenhuam chave selecionada
             * então quando a varial "quantChaveSelec" for 0, não havera nenhuma chave selecionada 
             * e podendo auterar o valor da variavel "devLoc"
             */
            var quantChavSelec = 0;
            var devLoc = 0;

            function loc(id, chave1, selec, stats) {
                var chave = new String(chave1);

                if (stats == 0) {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"1\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',1," + stats + "  )\" class=\"btn btn-primary\" type=\"button\"  >" +
                                "   <div > " +
                                "   <input type=\"hidden\" value=\"" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />" +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " + chave + "   </div> " +
                                " </button> ";



                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',0," + stats + "  )\" class=\"btn btn-success\" type=\"button\"  >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div>" + chave + "   </div> " +
                                " </button> ";

// Controla o botão editar para que se ele se abilite e desabilite

                    }

                    buttonEdit(selec);
                    buttonCadastrar(selec);
                    buttonExcluir(selec);
                    buttonLocar(selec);
                    validarLocarDev();

                } else {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"2\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',1," + stats + "  )\" class=\"btn btn-warning\" type=\"button\"  >" +
                                "   <div >" +
                                "   <input type=\"hidden\" value=\"" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />     " +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";


                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',0," + stats + "  )\" class=\"btn\" type=\"button\"  >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";
                    }


                    buttonDevolv(selec);
                    buttonEdit(selec);
                    buttonExcluir(selec);
                    buttonCadastrar(selec);
                    validarLocarDev();
                }
            }

// Habilitar butões

            function buttonEdit(select) {

                if (select == 0) {
                    if (editar == 0) {
                        editar += 1;
                        document.getElementById("edit").innerHTML = " <input name=\"editar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Editar\"/>";

                    } else {
                        editar += 1;
                        document.getElementById("edit").innerHTML = " <input name=\"editar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Editar\" disabled/>";
                    }
                } else {

                    editar -= 1;
                    if (editar == 1) {
                        document.getElementById("edit").innerHTML = " <input name=\"editar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Editar\"/>";
                    } else {
                        document.getElementById("edit").innerHTML = " <input name=\"editar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Editar\" disabled/>";
                    }
                }
            }

            function buttonExcluir(selec) {

                if (selec == 0) {
                    if (excluir == 0) {

                        excluir += 1;
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\"/>";

                    } else {
                        excluir += 1;
                    }

                } else {

                    excluir -= 1;
                    if (excluir > 0) {
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\"/>";

                    } else {
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\" disabled/>";

                    }
                }
            }

            function buttonLocar(select) {

                if (select == 0) {
                    if (Locar == 0) {
                        Locar += 1;

                        document.getElementById("loc").innerHTML = "  <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\"/>";

                    } else {
                        Locar += 1;
                    }

                } else {

                    Locar -= 1;
                    if (Locar > 0) {

                        document.getElementById("loc").innerHTML = "  <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\" />";
                    } else {

                        document.getElementById("loc").innerHTML = "  <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\" disabled/>";
                    }
                }
            }

            function buttonDevolv(selec) {

                if (selec == 0) {
                    if (Dev == 0) {
                        Dev += 1;

                        document.getElementById("devolv").innerHTML = "  <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\"/>";

                    } else {
                        Dev += 1;
                    }

                } else {

                    Dev -= 1;
                    if (Dev > 0) {

                        document.getElementById("devolv").innerHTML = "  <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\" />";
                    } else {

                        document.getElementById("devolv").innerHTML = "  <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\" disabled/>";
                    }
                }

            }

            function buttonCadastrar(selec) {

                if (selec == 0) {
                    cadastrar += 1;
                    document.getElementById("cadastrar").innerHTML = "  <input name=\"cadt@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Cadastrar\" disabled/>";
                } else {
                    cadastrar -= 1;
                    if (cadastrar == 0) {
                        document.getElementById("cadastrar").innerHTML = "  <input name=\"cadt@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Cadastrar\"/>";
                    }
                }
            }

            function validarLocarDev() {

                if (Dev != 0 && Locar != 0) {
                    document.getElementById("loc").innerHTML = "  <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\" disabled/>";
                    document.getElementById("devolv").innerHTML = "  <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\" disabled/>";
                }

                if (Locar > 0 && Dev == 0) {
                    document.getElementById("loc").innerHTML = "  <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\"/>";

                }
                if (Dev > 0 && Locar == 0) {

                    document.getElementById("devolv").innerHTML = "  <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\" />";
                }

            }


        </script>

    </head>

    <body>

        <header>
            <p>Cabecalho</p>
        </header>

        <nav>
            <p>Menu de navegação</p>
        </nav>

        <section>

            <div class="container">
                <div class="col-xs-12 ">
                    <div>

                        <h2>Chaves</h2>
                        
                    </div>

                    <div class="jumbotron col-xs-12 col-sm-12"> 

                        <form <form method="post" action="chavesLocarDesLocar.php"  >

                                <div class="container" >

                                    <div id="loc" class="btn" >

                                        <input name="loc@chave" class="btn btn-danger chax" type="submit" value="Locar"  disabled/>

                                    </div>

                                    <div id="devolv" class="btn" >

                                        <input name="dev@chave" class="btn btn-danger chax" type="submit" value="Devolver"  disabled/>

                                    </div>


                                    <div id="cadastrar" class="btn" >

                                        <input name="cadt@chv" class="btn btn-danger chax" type="submit" value="Cadastrar"/>

                                    </div>

                                    <div id="edit" class="btn">

                                        <input name="editar" class="btn btn-danger chax" type="submit" value="Editar" disabled/>

                                    </div>

                                    <div id="excluir" class="btn">

                                        <input name="excluir" class="btn btn-danger chax" type="submit" value="Excluir" disabled/>

                                    </div>
                                </div>

                                <fieldset>

                                    <?php chaves(); ?>

                                </fieldset>

                            </form>
                    </div>

                </div>


                <table class="table">
                    <tr>
                        <th> Chave </th>
                        <th> Locador </th>
                        <th> Horario </th>
                    </tr>

                    <?php chaveLocada(); ?>

                </table>

        </section>


    </body>


</html>

<?php

function chaves() {
// conectar com o bando de dados.
    $con = conexao();
// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "SELECT * FROM chaves";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            // delimita o tamanho maximo do nome da chave q ira apararecer na tela, no caso são 7 charater 
            $e = substr($row["chave"], 0, 6);

            if ($row["status"] == 0) {

                echo "      <div id=\"" . $row["idchave"] . "\"  class=\"chaves col-sm-1 col-xs-3\">  
                                <button value=\"0\" name=\"" . $row["idchave"] . "\"  onclick=\"loc(" . $row["idchave"] . ",'" . $e . "',0," . $row["status"] . ")\" class=\"btn btn-success\" type=\"button\"  >
                                
                                    <div>
                                    <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>  
                                    </div>
                                    <div>
                                        " . $e . "
                                    </div>
                                </button>                            
                            </div> ";
            } else {

                echo "      <div id=\"" . $row["idchave"] . "\"  class=\"chaves col-sm-1 col-xs-3 \">  
                                <button value=\"0\" name=\"" . $row["idchave"] . "\" onclick=\"loc(" . $row["idchave"] . ",'" . $e . "',0," . $row["status"] . ")\" class=\"btn\" type=\"button\"  >
                                   
                                    <div>
                                    <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>  
                                    </div>
                                    <div>
                                        " . $e . "
                                    </div>
                                </button>                            
                            </div> ";
            }
        }
    } else {
        echo "0 results";
    }
    $con->close();
}

function chaveLocada() {

// conectar com o bando de dados.
    $con = conexao();
// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "SELECT * FROM locacao";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            // delimita o tamanho maximo do nome da chave q ira apararecer na tela, no caso são 7 charater 
            // $e = substr($row["chave"], 0, 6);

            if ($row["statusLoc"] == 1) {

                $sql = "SELECT * FROM chaves WHERE idchave=" . $row["idChave"];
                $result2 = $con->query($sql);
                $row2 = $result2->fetch_assoc();

                echo " <tr>
                            <td>" . $row2["chave"] . " </td>
                            <td>" . $row["nomeLocador"] . "</td>
                            <td> " . $row["horaPeg"] . "</td>
                        </tr>      ";
            }
        }
    } else {
        echo " ";
    }
    $con->close();
}
?>
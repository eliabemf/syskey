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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> 

        
        <script src="../_jQuery v3.1.0/jQuery v3.1.0.js"></script> 
      
        
        <script src="../_bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>



        <script>

            $(function () {
                $('[data-toggle="tooltip"]').tooltip({html: true})
            });


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
             */


            /*
             * Controla a disponibilidade do botton "Informções"
             * que serve para mostrar informações sobre a locação sobre as 
             * chaves selecionadas
             */
            var info = 0;

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

            function loc(id, chave1, selec, stats, perm, usuario, locacoes1) {

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip({html: true} )
                });

                var chave = new String(chave1);
                var usu = new String(usuario);
                var locacoes = new String(locacoes1);

                if (stats == 0) {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"1\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',1," + stats + "," + perm + ",'" + usu + "','" + locacoes + "')\" class=\"btn btn-primary\" type=\"button\" data-toggle=\"tooltip\" title=\"" + locacoes + "\" data-placement=\"bottom\" >" +
                                "   <div > " +
                                "   <input type=\"hidden\" value=\"" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />" +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " + chave + "</div>" +
                                " </button> ";
                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',0," + stats + "," + perm + ",'" + usu + "','" + locacoes + "' )\" class=\"btn btn-success\" type=\"button\" data-toggle=\"tooltip\" title=\"" + locacoes + "\" data-placement=\"bottom\" >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div>" + chave + "   </div> " +
                                " </button> ";

// Controla o botão editar para que se ele se abilite e desabilite

                    }
                    buttonLocar(selec);

                } else {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"2\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',1," + stats + "," + perm + ",'" + usu + "','" + locacoes + "')\" class=\"btn btn-warning\" type=\"button\"  data-toggle=\"tooltip\" title=\"" + locacoes + "\" data-placement=\"top\" >" +
                                "   <div >" +
                                "   <input type=\"hidden\" value=\"" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />     " +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";


                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',0," + stats + "," + perm + ",'" + usu + "','" + locacoes + "' )\" class=\"btn\" type=\"button\"  data-toggle=\"tooltip\" title=\"" + locacoes + "\" data-placement=\"top\"  >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";
                    }

                    buttonDevolv(selec);

                }

                validarLocarDev();
                validarInformacoes(selec);

                if (perm == 1) {
                    buttonEdit(selec);
                    buttonCadastrar(selec);
                    buttonExcluir(selec);

                }
            }

// Habilitar butões

            //Button Informacoes
            function validarInformacoes(selec) {

                if (selec == 0) {
                    if (info == 0) {

                        info += 1;
                        document.getElementById("info").innerHTML = " <input name=\"info@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Informações\" />";

                    } else {
                        info += 1;
                    }

                } else {

                    info -= 1;
                    if (info > 0) {
                        document.getElementById("info").innerHTML = " <input name=\"info@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Informações\" />";

                    } else {
                        document.getElementById("info").innerHTML = " <input name=\"info@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Informações\" disabled />";

                    }
                }


            }

            // Button Editar
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


        <section>

            <div class="container mainnb ">

                <div>

                    <h2>Chaves</h2>

                </div>

                <form method="post" action="chavesLocarDesLocar.php"  >

                    <?php buttons($usuario); ?>

                    <div class="jumbotron"> 

                        <fieldset>

                            <?php chaves($usuario); ?>

                        </fieldset>

                    </div>
                </form>





                <table class="table">
                    <tr>
                        <th> Chave </th>
                        <th> Locador </th>
                        <th> Horario </th>
                        <th> Usuario </th>
                    </tr>

                    <?php chaveLocada(); ?>

                </table>

            </div>

        </section>

    </body>

</html>

<?php

function buttons($usuario) {

    //Admin
    if ($usuario[1] == 1) {

        echo " 
    <div class=\"butoesC\" >
        <div id=\"loc\" class=\"btn\" >
            <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\"  disabled/>
        </div>
        
        <div id=\"devolv\" class=\"btn\">
            <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\"  disabled/>
        </div>
        
        <div id=\"cadastrar\" class=\"btn\" >
            <input name=\"cadt@chv\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Cadastrar\"/>
        </div>
        
        <div id=\"edit\" class=\"btn\">
            <input name=\"editar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Editar\" disabled/>
        </div>
        
        <div id=\"excluir\" class=\"btn\">
            <input name=\"excluir\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\" disabled/>
        </div>
        
        <div id=\"info\" class=\"btn\">
            <input name=\"info@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Informações\"  disabled/>
        </div> 

    </div>";

        // Usuario normal
    } else if ($usuario[1] == 2) {

        echo "                    

    <div class=\"col-xs-offset-4\" >
        <div id=\"loc\" class=\"btn\" >
            <input name=\"loc@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar\"  disabled/>
        </div>
        
        <div id=\"devolv\" class=\"btn\">
            <input name=\"dev@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Devolver\"  disabled/>
        </div>
        
        <div id=\"info\" class=\"btn\">
            <input name=\"info@chave\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Informações\"  disabled/>
        </div>  
    </div>";
    }
}

function chaves($usuario) {


// conectar com o bando de dados.
    $con = conexao();

// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $sql = "SELECT * FROM chaves ORDER BY chave ASC";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            // delimita o tamanho maximo do nome da chave q ira apararecer na tela, no caso são 7 charater 
            $e = substr($row["chave"], 0, 6);

            /*
             * Se a chave estiver locada a funcao 'locacoesAnteriores' 
             * regata o nome da pessoa que locou a chave e coloca na variavel
             * é mostrado apenas quando a chave for locada
             * quando a cahve não estiver locada o campo fica vazio
             */
           
            $locacoesAnt = locacoesAnteriores($row["idchave"],$con,$row["status"]);
            
            if ($row["status"] == 0) {

                echo "      <div id=\"" . $row["idchave"] . "\"  class=\"chaves col-sm-1 col-xs-3\">  
                                <button value=\"0\" name=\"" . $row["idchave"] . "\"  onclick=\"loc(" . $row["idchave"] . ",'" . $e . "',0," . $row["status"] . "," . $usuario[1] . ",'" . $usuario[2] . "','" . $locacoesAnt . "')\" class=\"btn btn-success\" type=\"button\"  data-toggle=\"tooltip\" title=\"" . $locacoesAnt . "\"  data-placement=\"bottom\"  >
                                
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
                                <button value=\"0\" name=\"" . $row["idchave"] . "\" onclick=\"loc(" . $row["idchave"] . ",'" . $e . "',0," . $row["status"] . "," . $usuario[1] . ",'" . $usuario[2] . "','" . $locacoesAnt . "')\" class=\"btn\" type=\"button\"  data-toggle=\"tooltip\" title=\"" . $locacoesAnt . "\"  data-placement=\"top\"  >
                                   
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
    $sql = "SELECT * FROM locacao WHERE horaDev='0000-00-00 00:00:00' ORDER BY horaPeg ASC ";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            // delimita o tamanho maximo do nome da chave q ira apararecer na tela, no caso são 7 charater 
            // $e = substr($row["chave"], 0, 6);

            $sql = "SELECT * FROM chaves WHERE idchave=" . $row["idChave"];
            $result2 = $con->query($sql);
            $row2 = $result2->fetch_assoc();

            echo " <tr>
                        <td>" . $row2["chave"] . "</td>
                        <td>" . $row["nomeLocador"] . "</td>
                        <td> " . $row["horaPeg"] . "</td>
                        <td> " . $row["usuarioPeg"] . "</td>
                    </tr>";
        }
    } else {
        echo " ";
    }
    $con->close();
}
?>
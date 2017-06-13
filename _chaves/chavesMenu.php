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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">       
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



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

            //Controla a disponibilidade do botão excluir e de locar e devolver q eles possuiem o mesmo padrão
            var excluirLocar = 0;

            //COntrola a disponilidade de cadastrar uma nova chave
            var cadastrar = 0;

            function loc(id, chave1, selec, stats) {
                var chave = new String(chave1);

                if (stats == 0) {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"1\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',1," + stats + "  )\" class=\"btn btn-primary\" type=\"button\"  >" +
                                "   <div > " +
                                "   <input type=\"hidden\" value=\"1-" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />" +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " + chave + "   </div> " +
                                " </button> ";

                        buttonEditAbilitDesabilit(selec);
                        buttonLocarDevolvExcluir(selec);
                        buttonCadastrar(selec);

                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + ",'" + chave + "',0," + stats + "  )\" class=\"btn btn-success\" type=\"button\"  >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div>" + chave + "   </div> " +
                                " </button> ";

// Controla o botão editar para que se ele se abilite e desabilite
                        buttonEditAbilitDesabilit(selec);
                        buttonLocarDevolvExcluir(selec);
                        buttonCadastrar(selec);

                    }
                } else {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"2\" name=\"" + id + "\" onclick=\"loc(" + id + "," + chave + ",1," + stats + "  )\" class=\"btn btn-warning\" type=\"button\"  >" +
                                "   <div >" +
                                "   <input type=\"hidden\" value=\"2-" + id + "\" name=\"" + id + "\" id=\"" + id + "\" />     " +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";

                        buttonEditAbilitDesabilit(selec);
                        buttonLocarDevolvExcluir(selec);
                        buttonCadastrar(selec);

                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\"" + id + "\" onclick=\"loc(" + id + "," + chave + ",0," + stats + "  )\" class=\"btn\" type=\"button\"  >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";

                        buttonEditAbilitDesabilit(selec);
                        buttonLocarDevolvExcluir(selec);
                        buttonCadastrar(selec);
                    }
                }
            }

            function buttonEditAbilitDesabilit(select) {

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

            function buttonLocarDevolvExcluir(select) {

                if (select == 0) {
                    if (excluirLocar == 0) {
                        excluirLocar += 1;
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\"/>";

                        document.getElementById("locDev").innerHTML = "  <input name=\"locDev\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar/Devolver\"/>";

                    } else {
                        excluirLocar += 1;
                    }

                } else {

                    excluirLocar -= 1;
                    if (excluirLocar > 0) {
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\"/>";

                        document.getElementById("locDev").innerHTML = "  <input name=\"locDev\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar/Devolver\"/>";
                    } else {
                        document.getElementById("excluir").innerHTML = " <input name=\"excluir\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Excluir\" disabled/>";

                        document.getElementById("locDev").innerHTML = "  <input name=\"locDev\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Locar/Devolver\" disabled/>";
                    }
                }
            }

            function buttonCadastrar(selec) {
            
                if(selec == 0){
                    cadastrar +=1;
                    document.getElementById("cadastrar").innerHTML = "  <input name=\"cadastrar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Cadastrar\" disabled/>";
                }
                else{
                    cadastrar -=1;
                    if(cadastrar == 0){
                         document.getElementById("cadastrar").innerHTML = "  <input name=\"cadastrar\" class=\"btn btn-danger chax\" type=\"submit\" value=\"Cadastrar\"/>";
                    }
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

                                    <div id="locDev" class="btn" >

                                        <input name="locDev" class="btn btn-danger chax " type="submit" value="Locar/Devolver"  disabled/>

                                    </div>

                                    <div id="cadastrar" class="btn" >

                                        <input name="cadt" class="btn btn-danger chax" type="submit" value="Cadastrar"/>

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
            $e = substr($row["chave"], 0, 7);

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
?>
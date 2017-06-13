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
            function loc(id, chave, selec, stats) {

                if (stats == 0) {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"1\" name=\""+ id +"\" onclick=\"loc(" + id + "," + chave + ",1," + stats + "  )\" class=\"btn btn-primary\" type=\"button\" id=\"" + chave + "\" >" +
                            
                                "   <div > " +
                                "   <input type=\"hidden\" value=\"1-"+chave+"\" name=\""+ id +"\" id=\""+id+"\" />     " +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";

                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\""+ id +"\" onclick=\"loc(" + id + "," + chave + ",0," + stats + "  )\" class=\"btn btn-success\" type=\"button\" id=\"" + chave + "\" >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";
                    }
                } else {

                    if (selec == 0) {

                        document.getElementById(id).innerHTML = "<button value=\"2\" name=\""+ id +"\" onclick=\"loc(" + id + "," + chave + ",1," + stats + "  )\" class=\"btn btn-warning\" type=\"button\" id=\"" + chave + "\" >" +
                                "   <div >"+
                                "   <input type=\"hidden\" value=\"2-"+chave+"\" name=\""+ id +"\" id=\""+id+"\" />     " +
                                "   <img src=\"../_img/chaveLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";

                    } else {

                        document.getElementById(id).innerHTML = "<button value=\"0\" name=\""+ id +"\" onclick=\"loc(" + id + "," + chave + ",0," + stats + "  )\" class=\"btn\" type=\"button\" id=\"" + chave + "\" >" +
                                "   <div > " +
                                "   <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>" +
                                "   </div> " +
                                "   <div> " +
                                chave +
                                "   </div> " +
                                " </button> ";

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

                    <div class="jumbotron row"> 

                        <form <form method="post" action="chavesLocarDesLocar.php"  >

                                <input class="btn btn-danger chax" type="submit" value="Locar/Devolver"/>
                                
                               

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

            if ($row["status"] == 0) {

                echo "      <div id=\"" . $row["idchave"] . "\"  class=\"chaves col-sm-1 col-xs-3\">  
                                <button value=\"0\" name=\"". $row["idchave"] ."\"  onclick=\"loc(" . $row["idchave"] . "," . $row["chave"] . ",0," . $row["status"] . ")\" class=\"btn btn-success\" type=\"button\" id=\"" . $row["chave"] . "\" >
                                
                                    <div>
                                    <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>  
                                    </div>
                                    <div>
                                        " . $row["chave"] . "
                                    </div>
                                </button>                            
                            </div> ";
            } else {

                echo "      <div id=\"" . $row["idchave"] . "\"  class=\"chaves col-sm-1 col-xs-3 \">  
                                <button value=\"0\" name=\"". $row["idchave"] ."\" onclick=\"loc(" . $row["idchave"] . "," . $row["chave"] . ",0," . $row["status"] . ")\" class=\"btn\" type=\"button\" id=\"" . $row["chave"] . "\" >
                                   
                                    <div>
                                    <img src=\"../_img/chaveNaoLocada.png\"  width=\"100%\"/>  
                                    </div>
                                    <div>
                                        " . $row["chave"] . "
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
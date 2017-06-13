<?php
require_once '../_dao/daoseguranca.php';
require_once './locacoesAnt.php';

$usuario = verificarLogin();
?>


<!DOCTYPE html>
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

            <div>
                <h1 style="padding: 0% 0% 1.5% 0%; margin: 5% 35% 0% 35%;">Cadastrar Chave</h1>
                <div class="jumbotron " style="padding: 3% 3% 4% 3%; margin: 0% 35% 3% 35%; " >

                    <form method="post" action="chavesLocarDesLocar.php">
                        <p>Nome/Numero da Chave:</p>  <input type="text" name="numero@chave" value="" class="form-control" required>
                        <br>
                        <p>Departamento:</p>  <input type="text" name="departamento" value="" class="form-control">
                        <br>
                        <br>

                        <div class=" input-group-btn"  style="padding: 0% 0% 0% 0%;">
                            <input name="cadastrar@chavesCHV" type="submit" value="Salvar" class="form-control">
                        </div>
                        <div  class="input-group-btn"   style="padding: 0% 0% 0% 0%; ">
                            <a href="chavesMenu.php" type="submit" class="form-control">
                                <div style="margin: 0% 0% 0% 35%;">   Voltar
                                </div>
                            </a>
                        </div>


                    </form> 

                </div>


            </div>

        </section>




    </body>
</html>



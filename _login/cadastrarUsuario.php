<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Usuario</title>

        <link href="../_bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="loginInicio.css" rel="stylesheet">

        <!-- CSS para o botão do tipo file ficar bonito -->
        <link rel="stylesheet" href="../_jQuery v3.1.0/jquery.fileupload.css">
        <link rel="stylesheet" href="../_jQuery v3.1.0/jquery.fileupload-ui.css">

        <script src="../_jQuery v3.1.0/jQuery v3.1.0.js"></script>
        <script src="../_bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="../_bootboxjs/bootbox.min.js"></script> 

    </head>

    <body>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-md-4 col-md-offset-4 ">
                    <div class="account-wall">
                        
                        
                        <div class="form-group col-md-12">
                            <label>Cadastro de Usuario</label>
                        </div>  
                        

                        <form class="form-group" action="" method="post">

                            <div class="form-group col-md-12">

                                <label for="nome">Nome Usuario</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>  

                            <div class="form-group col-md-6">
                                <label for="senha1">Senha Usuario</label>
                                <input type="password" class="form-control" id="senha1" name="senha1" required  >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="senha2">Confirmação</label>
                                <input type="password" class="form-control" id="senha2" name="senha2" required  >
                            </div>

                            <div class="form-group col-md-12">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control " id="email" name="email" placeholder="exemplo@gmail.com" required>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="cadastro">Senha para Cadastramento</label>
                                <input type="text" class="form-control " id="cadastro" name="cadasro" required>
                            </div>

                            <hr />

                            <div  class="row col-md-offset-0">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary"  value="Salvar" name="salv"> 
                                    <a href="loginInicio.php" class="btn btn-default">Cancelar</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


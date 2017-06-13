<?php
require_once '../_dao/daoseguranca.php';
require_once '../cabecalho.php';


if (isset($_POST['logar'])) {

    startLogin(htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST['senha'], ENT_QUOTES, 'UTF-8'));
}
?>

<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chaves-EMCM</title>

        <?php imports(); ?>

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <div id="my-tab-content" class="tab-content">
                            <div class="tab-pane active" id="login">
                                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                     alt="">
                                <form class="form-signin" action="" method="post">
                                    <input type="usuario" name="usuario" class="form-control"   placeholder="Usuario" required autofocus>
                                    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                                    <input type="submit" name="logar" class="btn btn-lg btn-primary btn-block" value="Entrar" />
                                </form>
                                <div id="tabs" data-tabs="tabs">
                                    <p class="text-center"><a href="cadastrarUsuario.php">Cadastrar</a></p>
                                    <p class="text-center"><a href="#lembrar" data-toggle="tab">Esqueceu a Senha</a></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="lembrar">
                                <div class="col-md-1"></div>
                                <div class=""><p>Esqueceu a Senha</p></div>
                                <form class="form-signin" action="" method="">

                                    <input type="email" class="form-control" placeholder="Endereço do e-mail" required>
                                    <br/>
                                    <input type="submit" name="esqceuSenha" class="btn btn-lg btn-primary btn-block" value="Enviar" />

                                </form>
                                <div id="tabs" data-tabs="tabs">
                                    <p class="text-center"><a href="#login" data-toggle="tab">Voltar</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


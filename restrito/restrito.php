<?php
session_start();

if (isset($_SESSION[md5("user")])) {
    header("location: http://localhost/projeto_airfare/index.php");
}

if (isset($_SESSION[md5("func")])) {
    header("location: http://localhost/projeto_airfare/restrito/inicio.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Área Restrita - Airfare</title>
        <link rel="stylesheet" href="../view/assets/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho"><!-- cabecalho -->
                <div class="col-lg-4"></div>
                <div class="col-lg-4 ">
                    <div class="navbar-header">
                        <a class="navbar-brand"><strong>Projeto AirFare - Área Administrativa</strong></a>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </header>   <!-- fim cabecalho -->
            <section class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4" >
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong style="font-family:arial;">Acesso restrito a funcionários</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($_GET["invalid_login"])){ ?>

                            <div class="alert alert-danger text-center" >
                                <strong> E-mail ou senha inválidos</strong>
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET['logout'])){ ?>
                            <div class="alert alert-success text-center" >
                                <strong>Você foi desconectado do sistema com sucesso</strong>
                            </div>
                        <?php } ?>
                        <form method="POST" action="../controller/logar_func.php" >
                            <input type="email" placeholder="E-mail"  name="email" class="form-control"  required /><br>
                            <input type="password" placeholder="Senha" name="password" class="form-control" required /><br>
                            <button class="btn btn-primary form-control">Entrar</button>
                        </form>
                        <br>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </section>
        </div>
    </body>
</html>
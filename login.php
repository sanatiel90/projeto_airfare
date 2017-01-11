<!DOCTYPE html>
<html>
    <head>
        <title>Login - Airfare</title>
        <link rel="stylesheet" href="view/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho"><!-- cabecalho -->
                <div class="col-lg-8 ">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php"><strong>Projeto AirFare</strong></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="navbar-header navbar-right">
                        <p class="navbar-text"><?php include_once 'view/navbar.php'; ?></p>
                    </div>
                </div>
            </header>	<!-- fim cabecalho -->
            <section class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4" >
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong class="default-font">Login</strong>
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

                        <?php if(isset($_GET["user_created"])){ ?>

                            <div class="alert alert-success text-center" >
                                <strong> Conta criada com sucesso! Faça seu login!</strong>
                            </div>

                        <?php } ?>

                        <form method="POST" action="controller/logar.php" >
                            <input type="email"  name="email" placeholder="Informe o seu e-mail" class="form-control"  required /><br>
                            <input type="password" name="password" placeholder="Informe a sua senha" class="form-control" required /><br>

                            <button class="btn btn-primary form-control">Entrar</button>
                        </form>
                        <br>
                        <h5>Ainda não tem uma conta? Cadastre-se <strong><a href="cadastro.php">Agora!</a></strong></h5>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </section>
        </div>
    </body>
</html>
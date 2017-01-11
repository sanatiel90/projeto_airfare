<?php 
session_start();

if (!isset($_SESSION[md5('func')])) {
    header("location: http://localhost/projeto_airfare/index.php");
} else {
    $func = $_SESSION[md5('func')];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Área Restrita - Airfare</title>
        <link rel="stylesheet" href="../view/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="../view/assets/bootstrap/js/jquery.js"></script>
        <script src="../view/assets/bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho"><!-- cabecalho -->
                <div class="col-lg-8 ">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="inicio.php">
                            <strong>AirFare - Área Adminstrativa</strong>
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar-default">
                        <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="caret"></span></a>

                           <ul class="dropdown-menu">
                               <li><a href="busca_funcionarios.php">Funcionários</a></li>
                              <li><a href="#">Clientes</a></li>
                              <li><a href="listagem_voos.php">Vôos</a></li>
                              <li><a href="#">Pedidos</a></li>
                              
                             
                            </ul>
                        </li>
                        <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listar <span class="caret"></span></a>

                           <ul class="dropdown-menu">
                              <li><a href="#">Funcionários</a></li>
                              <li><a href="#">Clientes</a></li>
                              <li><a href="listagem_voos.php">Vôos</a></li>
                              <li><a href="#">Pedidos</a></li>
                              
                            </ul>
                        </li>
                        <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../controller/logout_func.php">Sair do Sistema</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="navbar-header navbar-right">
                        <p class="navbar-text"> Bem vindo(a), <strong><?php foreach($func as $key){echo $key["nome"];} ?></strong></p>
                    </div>
                </div>
            </header>   <!-- fim cabecalho -->
            <section class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" >
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong style="font-family:arial;">Página Inicial</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    <div class="jumbotron text-center">
                       <strong> Bem vindo, funcionário. </strong>
                    </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </section>
        </div>
    </body>
</html>
<?php
session_start();

include_once("../model/class/Manager.class.php");

if (!isset($_SESSION[md5('func')])) {
    header("location: http://localhost/projeto_airfare/index.php");
} else {
    $func = $_SESSION[md5('func')];
    $manager = new Manager();
    $total_voos = $manager->count_records("voos");
    $filter = "";
    $order = "";

    if (!isset($_POST['order'])) {
        $order = "id";
    } else {
        $order = $_POST['order'];
    }

    $lista_voos = $manager->lista_voos($filter,$order);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial - Airfare</title>
        <link rel="stylesheet" href="../view/assets/bootstrap/css/bootstrap.css">
        <script src="../view/assets/bootstrap/js/jquery.js"></script>
        <script src="../view/assets/bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho"><!-- cabecalho -->
                <div class="col-lg-8 ">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="inicio.php"><strong>AirFare - Área Adminstrativa</strong></a>
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
                        <p class="navbar-text"> Bem vindo(a), <strong><?php foreach($func as $key){echo $key["nome"];} ?></strong> </p>
                    </div>
                </div>
            </header>   <!-- fim cabecalho -->
            <section class="row">
                <div class="col-lg-12" >
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong style="font-family:arial;">Listagem de vôos</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="col-lg-12" style="font-size:15px">
                            <div class="col-lg-4 text-center">
                                <label>Total de vôos encontrados: <?php foreach($total_voos as $key){echo $key;} ?></label>
                            </div>
                            <div class="col-lg-4 text-center">
                                <form action="" method="POST" id="form">
                                    <label>Ordenar por &nbsp; </label >
                                    <select id="order" name="order"  onchange="atualiza()" style="width:50%; border-radius:5px">
                                        <option>Selecione --</option>
                                        <option value="id">Id</option>
                                        <option value="companhia">Companhia</option>
                                        <option value="preco">Menor Preço</option>
                                        <option value="preco DESC">Maior Preço</option>
                                        <option value="data_voo DESC">Data Vôo</option>
                                        <option value="vagas_disponiveis DESC">Vagas Disponíveis</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-lg-4 text-center">
                                <a class="btn btn-warning" href="../controller/relatorio_voos.php?filter=<?php echo base64_encode($filter); ?>&order=<?php echo base64_encode($order); ?>" target="_blank">Gerar Relatório</a>
                            </div>
                        </div>
                        <br><br><br>
                        <table class="table table-bordered table-hover text-center">
                            <tr class="info">
                                <th class="text-center">Id</th>
                                <th class="text-center">Saída</th>
                                <th class="text-center">Destino</th>
                                <th class="text-center">Data Vôo</th>
                                <th class="text-center">Companhia</th>
                                <th class="text-center">Preço</th>
                                <th class="text-center">Total Vagas</th>
                                <th class="text-center">Vagas Disp.</th>
                                
                            </tr>
                            <?php if (isset($lista_voos)) {
                                foreach ($lista_voos as $key) { ?>
                                    <tr>
                                        <td><?php echo $key["id"]; ?></td>
                                        <td><?php echo $key["aeroporto_origem"].' - '.$key["cidade_origem"].'('.$key["estado_origem"].')'; ?></td>
                                        <td><?php echo $key["aeroporto_destino"].' - '.$key["cidade_destino"].'('.$key["estado_destino"].')'; ?></td>
                                        <td><?php echo date("d/m/Y",strtotime($key["data_voo"])) ; ?></td>
                                        <td><?php echo $key["companhia"]; ?></td>
                                        <td><?php echo 'R$ '.$key["preco"]; ?></td>
                                        <td><?php echo $key["total_vagas"]; ?></td>
                                        <td><?php echo $key["vagas_disponiveis"]; ?></td>
                                        
                                    </tr>
                                <?php } } ?>
                        </table>

                    </div>
                </div>
            </section>
        </div>
        <script>
            function atualiza(){
                document.getElementById('form').submit();
            }
        </script>
    </body>
</html>
<?php
session_start();

include_once('model/class/Manager.class.php');

if (!isset($_SESSION[md5("user")])) {
    header("location: index.php");
} else {
    $user = $_SESSION[md5("user")];
    foreach($user as $key){ $id = $key["id_cli"]; }
    $manager = new Manager();
    $search_result = $manager->lista_compras_cliente($id);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial - Airfare</title>
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
                <div class="col-lg-2"></div>
                <div class="col-lg-8" >
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong class="default-font">Minhas Compras</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h3 class="text-center">Histórico de Compras</h3>
                        <?php if ($search_result != null) {
                            foreach ($search_result as $key) { ?>
                                <div class="panel panel-success">
                                    <div class="panel-heading text-center">Compra realizada por <label><?php echo $key["nome_cli"]; ?></label> </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered text-center">
                                            <tr class="success">
                                                <th class="text-center">Código Pedido</th>
                                                <th class="text-center">Data da Compra</th>
                                                <th class="text-center">Quant. de Passagens</th>
                                                <th class="text-center">Preço Total</th>
                                                <th class="text-center">Data do Vôo</th>
                                                <th class="text-center">Hora Saída</th>
                                                <th class="text-center">Hora Chegada</th>
                                                <th class="text-center">Companhia</th>
                                            </tr>

                                            <tr>
                                                <td><?php echo $key["id_pedido"]; ?></td>
                                                <td><?php echo date("d/m/Y H:i:s", strtotime($key["data_pedido"])); ?></td>
                                                <td><?php echo $key["quantidade_pessoas"]; ?></td>
                                                <td>R$ <?php echo $key["preco_total"]; ?></td>
                                                <td><?php echo date("d/m/Y",strtotime($key["data_voo"])); ?></td>
                                                <td><?php echo $key["hora_saida"]; ?></td>
                                                <td><?php echo $key["hora_chegada"]; ?></td>
                                                <td><?php echo $key["companhia"]; ?></td>
                                            </tr>
                                        </table>

                                        <table class="table table-bordered text-center">
                                            <tr class="success">
                                                <th class="text-center">Cidade Saída</th>
                                                <th class="text-center">Aeroporto Saída</th>
                                                <th class="text-center">Cidade Chegada</th>
                                                <th class="text-center">Aeroporto Chegada</th>
                                                <th class="text-center">Comprovante</th>
                                            </tr>

                                            <tr>
                                                <td><?php echo $key["cidade_origem"]; ?> (<?php echo $key["estado_origem"]; ?>)</td>
                                                <td><?php echo $key["aeroporto_origem"]; ?></td>
                                                <td><?php echo $key["cidade_destino"]; ?> (<?php echo $key["estado_destino"]; ?>)</td>
                                                <td><?php echo $key["aeroporto_destino"]; ?></td>
                                                <td><a href="controller/emite_comprovante.php?id=<?php echo $key["id_pedido"]; ?>" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>Emitir</a></td>
                                            </tr>
                                        </table>
                                    </div> <!-- panel body -->
                                </div> <!-- panel success -->
                                <br><br><br>

                            <?php    } /*fim foreach*/  }else{ ?>

                            <h4 class="text-center">
                                <br>
                                <strong> Você ainda não realizou compras.</strong>
                                <br><br><br>
                                <strong><a class="btn btn-primary" href="index.php">Pesquisar um vôo</a></strong>
                            </h4>
                        <?php } ?>
                    </div> <!-- fim panel-body -->
                </div>
                <div class="col-lg-2"></div>
            </section>
        </div>
    </body>
</html>
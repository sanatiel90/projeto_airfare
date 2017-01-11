<?php
session_start();
include_once('model/class/Manager.class.php');

$manager = new Manager();
$search_result = null;

if (isset($_POST['cid_origem']) && isset($_POST['cid_destino']) && isset($_POST['data_voo'])) {
    $search_result = $manager->busca_voo($_POST['cid_origem'], $_POST['cid_destino'], $_POST['data_voo']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pesquisa Vôo</title>
        <link rel="stylesheet" href="view/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho">
                <div class="col-lg-8">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php"><strong>Projeto AirFare</strong></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="navbar-header navbar-right">
                        <p class="navbar-text"><?php include_once('view/navbar.php'); ?></p>
                    </div>
                </div>
            </header>
            <section class="row">
                <div class="col-lg-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><strong>Refine sua busca</strong></h3>
                        </div>
                        <div class="panel-body"></div>
                    </div>
                </div>
                <div class="col-lg-9" >
                    <div class="panel panel-success" >
                        <!-- para as opcoes q nao tem pagina msm, como perfil, verifica se foi mandado algum OPTION pela url e adequa o nome do panel e titulo da pag -->
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title">
                                <span class="glyphicon glyphicon-th">
                                    <strong class="default-font"> Resultado da busca</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($search_result != null){
                            foreach ($search_result as $key) { ?>
                                <div style="background-color:white; height:210px;">
                                    <div class="text-center" style="height:25px; width:49.7%; background-color:#5F9EA0; float:left"><strong>SAÍDA</strong></div>
                                    <div class="text-center" style="height:25px; width:49.7%; background-color:#5F9EA0; float:right"><strong>DESTINO</strong></div>
                                    <div style="background-color:#FFEBCD; height:25px; width:100%; float:left; color:#696969">
                                        <div class="text-center"  style="float:left; width:7%;"><strong>UF</strong></div>
                                        <div class="text-center" style="float:left; width:15%;"><strong>Cidade</strong></div>
                                        <div class="text-center" style="float:left; width:28%;"><strong>Aeroporto</strong></div>
                                        <div class="text-center" style="float:left; width:7%;"><strong>UF</strong></div>
                                        <div class="text-center" style="float:left; width:15%;"><strong>Cidade</strong></div>
                                        <div class="text-center" style="float:left; width:28%;"><strong>Aeroporto</strong></div>
                                    </div>

                                    <div style="background-color:white; height:40px; width:100%; float:left">
                                        <div class="text-center"  style="float:left; width:7%;"><strong><?php echo $key['estado_origem'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:15%;"><strong><?php echo $key['cidade_origem'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:28%;"><strong><?php echo $key['aeroporto_origem'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:7%;"><strong><?php echo $key['estado_destino'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:15%;"><strong><?php echo $key['cidade_destino'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:28%;"><strong><?php echo $key['aeroporto_destino'] ?></strong></div>
                                    </div>

                                    <div class="text-center" style="height:25px; width:100%; background-color:#5F9EA0; float:left"><strong>INFORMAÇÕES DO VÔO</strong></div>

                                    <div style="background-color:#FFEBCD; height:25px; width:100%; float:left; color:#696969">
                                        <div class="text-center"  style="float:left; width:13%;"><strong>Data do Vôo</strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong>Hora Saída</strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong>Hora Chegada</strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong>Duração</strong></div>
                                        <div class="text-center" style="float:left; width:14%;"><strong>Companhia</strong></div>
                                        <div class="text-center" style="float:left; width:6%;"><strong>Vagas</strong></div>
                                        <div class="text-center" style="float:left; width:12%;"><strong>Preço</strong></div>
                                        <div class="text-center" style="float:left; width:16%;"><strong>Ação</strong></div>
                                    </div>

                                    <div style="background-color:white; height:30px; width:100%; float:left">
                                        <div class="text-center"  style="float:left; width:13%;"><strong><?php echo date("d/m/Y",strtotime($key['data_voo']));  ?></strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong><?php echo $key['hora_saida'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong><?php echo $key['hora_chegada'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:13%;"><strong><?php echo $key['duracao_voo'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:14%;"><strong><?php echo $key['companhia'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:6%;"><strong><?php echo $key['vagas_disponiveis'] ?></strong></div>
                                        <div class="text-center" style="float:left; width:12%;"><strong>R$ <?php echo $key['preco'] ?>,00</strong></div>
                                        <div class="text-center" style="float:left; width:16%;"><strong><a href="dados_voo.php?id=<?php echo $key['id'] ?>" class="btn btn-sm btn-primary">Comprar</a></div>
                                    </div>

                                </div>
                                <!-- divisoria -->
                                <div class="col-lg-12" style="background-color:lightgreen; height:10px; border-radius:5px"></div> <br><br>

                            <?php }/*fim foreach*/
                        } else { ?>
                            <h4 class="text-center">
                                <strong> Não foram encontrados vôos para a pesquisa solicitada</strong>
                                <br><br><br>
                                <strong><a class="btn btn-primary" href="index.php">Realizar nova pesquisa</a></strong>
                            </h4>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
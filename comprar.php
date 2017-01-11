<?php
session_start(); 

if (!isset($_SESSION[md5('user')])) {
    header("location: index.php");
} else {
    $user = $_SESSION[md5('user')];
    $dados_voo = $_SESSION['dados_voo'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compra de Passagens - Airfare</title>
        <link rel="stylesheet" href="view/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="view/assets/bootstrap/js/jquery.js"></script>
        <script src="view/assets/bootstrap/js/bootstrap.js"></script>
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
                <div class="col-lg-8">
                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;"><!-- para as opcoes q nao tem pagina msm, como perfil, verifica se foi mandado algum OPTION pela url e adequa o nome do panel e titulo da pag -->
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong class="default-font">Comprar Passagem</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h3 class="text-center">Dados do vôo</h3>
                        <div style="background-color:white; height:220px;">
                            <div class="text-center" style="height:25px; width:49.7%; background-color:#90EE90; float:left"><strong>SAÍDA</strong></div>
                            <div class="text-center" style="height:25px; width:49.7%; background-color:#90EE90; float:right"><strong>DESTINO</strong></div>
                            <div style="background-color:#FFEBCD; height:25px; width:100%; float:left; color:#696969">

                                <div class="text-center" style="float:left; width:22%;"><strong>Cidade</strong></div>
                                <div class="text-center" style="float:left; width:28%;"><strong>Aeroporto</strong></div>

                                <div class="text-center" style="float:left; width:22%;"><strong>Cidade</strong></div>
                                <div class="text-center" style="float:left; width:28%;"><strong>Aeroporto</strong></div>
                            </div>

                            <div style="background-color:white; height:40px; width:100%; float:left;">

                                <div class="text-center" style="float:left; width:22%; color:black"><strong><?php foreach ($dados_voo as $key) {echo $key["cidade_origem"]; }?> (<?php foreach ($dados_voo as $key) {echo $key["estado_origem"]; }?>)</strong></div>
                                <div class="text-center" style="float:left; width:28%; color:black"><strong><?php foreach ($dados_voo as $key) {echo $key["aeroporto_origem"]; }?></strong></div>

                                <div class="text-center" style="float:left; width:22%; color:black"><strong><?php foreach ($dados_voo as $key) {echo $key["cidade_destino"]; }?> (<?php foreach ($dados_voo as $key) {echo $key["estado_destino"]; }?>)</strong></div>
                                <div class="text-center" style="float:left; width:28%; color:black"><strong><?php foreach ($dados_voo as $key) {echo $key["aeroporto_destino"]; }?></strong></div>
                            </div>
                            <br><br><br>
                            <div class="text-center" style="height:25px; width:100%; background-color:#90EE90; float:left"><strong>INFORMAÇÕES DO VÔO</strong></div>

                            <div style="background-color:#FFEBCD; height:25px; width:100%; float:left; color:#696969">
                                <div class="text-center"  style="float:left; width:17%;"><strong>Data do Vôo</strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong>Hora Saída</strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong>Hora Chegada</strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong>Duração</strong></div>
                                <div class="text-center" style="float:left; width:18%;"><strong>Companhia</strong></div>
                                <div class="text-center" style="float:left; width:8%;"><strong>Vagas</strong></div>
                            </div>

                            <div style="background-color:white; height:30px; width:100%; float:left; color:black">
                                <div class="text-center"  style="float:left; width:17%;"><strong><?php foreach ($dados_voo as $key) {echo  date("d/m/Y",strtotime($key["data_voo"])); }?></strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong><?php foreach ($dados_voo as $key) {echo $key["hora_saida"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong><?php foreach ($dados_voo as $key) {echo $key["hora_chegada"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:17%;"><strong><?php foreach ($dados_voo as $key) {echo $key["duracao_voo"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:18%;"><strong><?php foreach ($dados_voo as $key) {echo $key["companhia"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:8%;"><strong><?php foreach ($dados_voo as $key) {echo $key["vagas_disponiveis"]; }?></strong></div>
                            </div>
                        </div>
                        <h3 class="text-center">Dados do solicitante</h3>
                        <div style="background-color:white; height:220px;">
                            <div style="background-color:#90EE90; height:25px; width:100%; float:left; color:#696969">

                                <div class="text-center" style="float:left; width:22%;"><strong>Nome</strong></div>
                                <div class="text-center" style="float:left; width:28%;"><strong>E-mail</strong></div>

                                <div class="text-center" style="float:left; width:22%;"><strong>Telefone</strong></div>
                                <div class="text-center" style="float:left; width:28%;"><strong>Cartão de Crédito</strong></div>
                            </div>

                            <div style="background-color:white; height:40px; width:100%; float:left;">
                                <div class="text-center" style="float:left; width:22%; color:black"><strong><?php foreach ($user as $key) {echo $key["nome_cli"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:28%; color:black"><strong><?php foreach ($user as $key) {echo $key["email"]; }?></strong></div>

                                <div class="text-center" style="float:left; width:22%; color:black"><strong><?php foreach ($user as $key) {echo $key["telefone"]; }?></strong></div>
                                <div class="text-center" style="float:left; width:28%; color:black"><strong><?php foreach ($user as $key) {echo $key["nome_cartao"]; }?></strong></div>
                            </div>
                            <br><br><br><br><br>
                            <div class="text-center" style="background-color:white; height:28px; font-size:16px">
                                <div style="background-color:#B0E0E6; width:49%; float:left; height:28px; border-radius:5px">
                                    <label for="quantidade"><strong>Quantidade de Passagens</strong></label>
                                    <select id="quantidade" onchange="atualizaPreco()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <div style="background-color:#B0E0E6; width:49%; float:right; height:28px; border-radius:5px">
                                    <strong>Percentual Desconto: </strong>
                                    <label id="desconto">0%</label>
                                </div>
                            </div>
                            <br>
                            <div class="text-center" style="background-color:white; height:28px; font-size:16px">
                                <div style="background-color:#B0E0E6; width:49%; float:left; height:28px; border-radius:5px">
                                    <strong>Valor pago por cada Passagem: </strong>
                                    <label>R$</label> <label id="valor_passagem"><?php foreach ($dados_voo as $key) {echo $key["preco"]; }?></label>
                                </div>
                                <div style="background-color:#B0E0E6; width:49%; float:right; height:28px; border-radius:5px; font-size:18px">
                                    <strong>Preço Total</strong>
                                    <label style="color:green">R$</label> <label style="color:green" id="preco"><?php foreach ($dados_voo as $key) {echo $key["preco"]; }?></label>
                                </div>
                            </div>
                            <br><br>
                            <!-- Formulário com os dados do pedido que será enviado ao banco -->
                            <div class="col-lg-12">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <form method="POST" action="controller/confirma_compra.php">
                                        <input id="preco_voo" type="hidden" value="<?php foreach ($dados_voo as $key) {echo $key["preco"]; }?>" >
                                        <input type="hidden" name="cod_cliente" value="<?php foreach ($user as $key) {echo $key["id_cli"]; }?>">
                                        <input type="hidden" name="cod_voo" value="<?php foreach ($dados_voo as $key) {echo $key["id"]; }?>" >
                                        <input id="quantidade_passagens" type="hidden" name="quantidade" value="1">
                                        <input id="preco_total" type="hidden" name="preco_total" value="<?php foreach ($dados_voo as $key) {echo $key["preco"]; }?>">

                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                                <a  class="btn btn-danger form-control" href="index.php" ><strong>Cancelar Pedido</strong></a>
                                            </div>

                                            <div class="col-lg-6">
                                                <button id="btcompra" type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#comprar" ><strong>Comprar</strong></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                            <br><br><br><br>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </section>
        </div>
    </body>
</html>
<script>
    function atualizaPreco(){
        var quantPassagens = document.getElementById("quantidade").value;
        var precoVoo = document.getElementById("preco_voo").value;
        var desconto;
        //var valorPorPassagem;
        //dependendo de quantas passagens o cliente quiser será aplicado um desconto
        if(quantPassagens == 1){
            desconto = "0%";
        }else if (quantPassagens == 2) {
            precoVoo -= precoVoo*0.05;
            desconto = "5%";
        }else if(quantPassagens == 3){
            precoVoo -= precoVoo*0.07;
            desconto = "7%";
        }else if(quantPassagens == 4){
            precoVoo -= precoVoo*0.10;
            desconto = "10%";
        }else if(quantPassagens == 5){
            precoVoo -= precoVoo*0.13;
            desconto = "13%";
        }else if(quantPassagens == 6){
            precoVoo -= precoVoo*0.16;
            desconto = "16%";
        }

        //mostrar valor final com no máximo 2 casas decimais
        var valorPorPassagem = precoVoo; //ESSA LINHA DA PROB
        var x = quantPassagens * precoVoo;
        var result = parseFloat(x.toFixed(2));

        //atribuindo valores
        document.getElementById("valor_passagem").innerHTML = valorPorPassagem;
        document.getElementById("desconto").innerHTML = desconto;
        document.getElementById("preco").innerHTML = result;
        document.getElementById("preco_total").value = result;
        document.getElementById("quantidade_passagens").value = quantPassagens;
    }
</script>

<!-- DIV PARA MODAL -->
<div class="modal fade text-center" id="comprar">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" > Confirma a compra da passagem? </h4>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar </button>
                <button  id="confcompra"  class="btn btn-primary"> Confirmar</button>
            </div>
        </div>
    </div>
</div>
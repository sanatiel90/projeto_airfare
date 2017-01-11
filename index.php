<?php session_start(); ?>
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
                <div class="col-lg-4"></div>
                <div class="col-lg-4" >

                <?php if(isset($_GET['logout'])){ ?>

                    <div class="alert alert-success text-center" >
                         <strong>Você foi desconectado do sistema com sucesso</strong>
                    </div>

                <?php } ?>


                <?php if(isset($_GET['compra_success'])){ ?>

                    <div class="alert alert-success text-center" >
                         <strong>Compra da passagem realizada com sucesso! Acesse suas compras para emitir o comprovante</strong>
                    </div>

                <?php } ?>


                <?php if(isset($_GET['error_compra'])){ ?>

                    <div class="alert alert-danger text-center" >
                         <strong>Ocorreu um erro, compra não efetivada</strong>
                    </div>

                <?php } ?>

                    <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong class="default-font">Faça sua pesquisa por um vôo</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="buscavoo.php" >
                            <input type="text" id="origem" name="cid_origem" placeholder="Informe a cidade de origem" class="form-control"  required /><br>
                            <input type="text" name="cid_destino" placeholder="Informe a cidade de destino" class="form-control" required /><br>

                            <label for="data-voo">Data da saída:</label>
                            <input id="data-voo" type="date" name="data_voo" class="form-control" style="width:170px" required/><br>

                            <button class="btn btn-primary form-control">Pesquisar</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </section>
		</div>
	</body>
</html>
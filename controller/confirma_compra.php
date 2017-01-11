<?php
include_once('../model/class/Manager.class.php');

$manager = new Manager();
$confirm = $manager->insert_pedido($_POST['quantidade'], $_POST['preco_total'], $_POST['cod_voo'], $_POST['cod_cliente']);

if ($confirm != false) {
	header("location: http://localhost/projeto_airfare/index.php?compra_success");
} else{
	header("location: location: http://localhost/projeto_airfare/index.php?error_compra");
}
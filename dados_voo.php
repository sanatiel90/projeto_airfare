<?php
session_start();

include_once('model/class/Manager.class.php');

$manager = new Manager();
$_SESSION['dados_voo'] = $manager->voo_solicitado($_GET['id']);

if (isset($_SESSION[md5('user')])) {
	header("location: comprar.php");
} else {
	header("location: login.php");
}
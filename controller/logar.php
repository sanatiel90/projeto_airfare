<?php
include_once('../model/class/Manager.class.php');

$manager = new Manager();
$user = $manager->login_cliente($_POST['email'],sha1($_POST['password']));

if ($user == false) {
    header("location: http://localhost/projeto_airfare/login.php?invalid_login");
} else {
    session_start();
    $_SESSION[md5('user')] = $user;

    if (isset($_SESSION['dados_voo'])) {
        header("location: http://localhost/projeto_airfare/comprar.php");
    } else {
        header("location: http://localhost/projeto_airfare/index.php");
    }
}
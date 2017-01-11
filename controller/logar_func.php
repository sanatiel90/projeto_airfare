<?php
include_once('../model/class/Manager.class.php');
$manager = new Manager();
$func = $manager->login_func($_POST['email'],sha1($_POST['password']));

if ($func == false) {
    header("location: http://localhost/projeto_airfare/restrito/restrito.php?invalid_login");
} else {
    session_start();
    $_SESSION[md5('func')] = $func;
    header("location: http://localhost/projeto_airfare/restrito/inicio.php");
}
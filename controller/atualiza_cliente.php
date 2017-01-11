<?php

include_once('../model/class/Manager.class.php');

$manager = new Manager();

$confirm = $manager->update_cliente($_POST['id'],$_POST['new_tel']);

if ($confirm != false) {
    session_start();
    foreach($_SESSION[md5("user")] as $user){
        $user["telefone"] = $_POST['new_tel'];
    }
    header("location: http://localhost/projeto_airfare/perfil.php?perfil_updated");
} else {
    header("location: http://localhost/projeto_airfare/perfil.php?perfil_error");
}
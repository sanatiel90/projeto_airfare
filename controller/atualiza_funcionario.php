<?php

include_once('../model/class/Manager.class.php');

$manager = new Manager();


$confirm = $manager->update_funcionario($_POST['id'],$_POST["new_email"],$_POST["new_tel"],$_POST["new_sal"]);

if ($confirm != false) {
   
    header("location: http://localhost/projeto_airfare/restrito/busca_funcionarios.php?func_edited");
} else {
    header("location: http://localhost/projeto_airfare/restrito/busca_funcionarios.php?edit_error");
}
<?php

include_once '../model/class/Manager.class.php';

$manager = new Manager();

$confirm = $manager->delete_funcionario($_POST['id']);

if($confirm != null){

	 header("location: http://localhost/projeto_airfare/restrito/busca_funcionarios.php?func_deleted");

}else{

	 header("location: http://localhost/projeto_airfare/restrito/busca_funcionarios.php?delete_error");

} 


?>
<?php
include_once('model/class/Connection.class.php');
include_once('model/class/Manager.class.php');

try{
    $connection = new PDO("mysql:host=localhost;dbname=aereo", "root", "vertrigo");
    $connection->exec("set names utf8");
}catch(PDOException $e){
    echo "Falha: " . $e->getMessage();
    exit();
}
$sql = "SELECT * FROM aeroportos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
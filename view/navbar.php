<?php
if (isset($_SESSION[md5('user')])) {
    $user = $_SESSION[md5('user')];
?>
    Bem vindo(a), <strong><?php foreach($user as $key){echo $key['nome_cli'];}?></strong>
    <br>
    <a href="perfil.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-user"></span> Perfil</a>
    <a href="minhas_compras.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plane"></span> Minhas Compras</a>
    <a href="controller/logout.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-off"></span> Sair</a>
<?php } else { ?>
    <strong><a href="login.php">Iniciar Sessão</a></strong> ||
    <strong><a href="cadastro.php">Criar Conta</a></strong>
<?php } ?>








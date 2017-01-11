<?php
session_start();
session_destroy();
header("location: http://localhost/projeto_airfare/restrito/restrito.php?logout");
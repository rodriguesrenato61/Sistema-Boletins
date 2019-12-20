<?php

    include_once('Sistema.php');

    $sistema = new Sistema;

    $host = "localhost";
    $dbname = "boletins";
    $user = "root";
    $password = "";

    $sistema->conectar($host, $dbname, $user, $password);

?>

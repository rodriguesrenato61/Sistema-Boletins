<?php

    include_once('Sistema.php');

    $sistema = new Sistema;

    $host = "localhost";
    $dbname = "escola";
    $user = "root";
    $password = "d3s1p6g6";

    $sistema->conectar($host, $dbname, $user, $password);

?>

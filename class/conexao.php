<?php

    include_once('Sistema.php');//importando a classe sistema

    $sistema = new Sistema;

    $host = "localhost";//host do banco
    $dbname = "escola";//nome do banco
    $user = "root";//usuário do banco
    $password = "";//senha do banco

    $sistema->conectar($host, $dbname, $user, $password);//conectando com o banco

?>

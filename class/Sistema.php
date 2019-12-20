<?php


    Class Sistema{

        private $pdo;

        public function conectar($host, $banco, $usuario, $senha){

            global $pdo;

            $pdo = new PDO('mysql:host='.$host.';dbname='.$banco, $usuario, $senha);

        }

        public function getPdo(){

            global $pdo;

            return $pdo;
        }
    }

?>
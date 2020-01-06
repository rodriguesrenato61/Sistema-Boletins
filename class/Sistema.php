<?php


    Class Sistema{

        private $pdo;//variável de conexão com o banco

        //função para conectar com o banco de dados
        public function conectar($host, $banco, $usuario, $senha){

            global $pdo;

            $pdo = new PDO('mysql:host='.$host.';dbname='.$banco, $usuario, $senha);//instanciando objeto da classe pdo de conexão com o banco de dados

        }

        //função que retorna a instância de conexão com o banco de dados
        public function getPdo(){

            global $pdo;

            return $pdo;
        }
    }

?>

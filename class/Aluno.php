<?php

    include_once('conexao.php');
    include_once('Utf8.php');

    class Aluno{

        public static function exibir($matricula, $nome, $aluno, $status_matricula){

            global $sistema;

            $pdo = $sistema->getPdo();

            $query = "SELECT * FROM vw_alunos";

            $clausula = array();
            $i = 0;

            if($nome != null){
                $clausula[$i] = "aluno LIKE '%".Utf8::decode($nome)."%'";
                $i++;
            }

            if($matricula != "0"){
                $matricula = (int) $matricula;
                $status_matricula = (int) $status_matricula;
                if($status_matricula > 0){
                    $clausula[$i] = "matricula = ".$matricula;
                }else{
                    $clausula[$i] = "matricula != ".$matricula;
                }
                $i++;
            }

            if($aluno != null){
                $clausula[$i] = "aluno = '".Utf8::decode($aluno)."'";
                $i++;
            }

            for($cont = 0; $cont < $i; $cont++){
                if($cont == 0){
                    $query .= " WHERE ".$clausula[$cont];
                }else{
                    $query .= " AND ".$clausula[$cont];
                }
            }

            $query .= " ORDER BY aluno";

            $sql = $pdo->prepare($query);

            $sql->execute();

            return $sql;
        }

        public static function inserir($nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL insert_aluno(:nome)");
            $sql->bindValue(":nome", Utf8::decode($nome));
            $sql->execute();
        }

        public static function editar($matricula, $nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL update_aluno(:matricula, :nome)");
            $sql->bindValue(":matricula", (int) $matricula);
            $sql->bindValue(":nome", Utf8::decode($nome));
            $sql->execute();
        }

        public static function excluir($matricula){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL delete_aluno(:matricula)");
            $sql->bindValue(":matricula", (int) $matricula);

            $sql->execute();
        }

    }

?>

<?php

    include_once('conexao.php');

    Class Disciplina{

        public static function exibir($codigo, $nome, $disciplina, $status_codigo){

            global $sistema;

            $pdo = $sistema->getPdo();

            $query = "SELECT * FROM vw_disciplinas";

            $clausula = array();
            $i = 0;

            if($nome != null){
                $clausula[$i] = "disciplina LIKE '%".$nome."%'";
                $i++;
            }

            if($codigo != "0"){
                $codigo = (int) $codigo;
                $status_codigo = (int) $status_codigo;
                if($status_codigo > 0){
                    $clausula[$i] = "codigo = ".$codigo;
                }else{
                    $clausula[$i] = "codigo != ".$codigo;
                }
                $i++;
            }

            if($disciplina != null){
                $clausula[$i] = "disciplina = '".$disciplina."'";
                $i++;
            }

            for($cont = 0; $cont < $i; $cont++){
                if($cont == 0){
                    $query .= " WHERE ".$clausula[$cont];
                }else{
                    $query .= " AND ".$clausula[$cont];
                }
            }

            $query .= " ORDER BY disciplina";

            $sql = $pdo->prepare($query);

            $sql->execute();

            return $sql;
        }

        public static function inserir($nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL insert_disciplina(:nome)");
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        }

        public static function editar($codigo, $nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL update_disciplina(:codigo, :nome)");
            $sql->bindValue(":codigo", (int) $codigo);
            $sql->bindValue(":nome", $nome);

            $sql->execute();
        }

        public static function excluir($codigo){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL delete_disciplina(:codigo)");
            $sql->bindValue(":codigo", (int) $codigo);

            $sql->execute();
        }

        public static function aluno_disciplinas($matricula, $status, $codigo){

            global $sistema;

            $pdo = $sistema->getPdo();

            if($codigo != "0"){
                $sql = $pdo->prepare("SELECT * FROM disciplinas WHERE faz_disciplina(codigo, :matricula) = :s OR codigo = :codigo");
                $sql->bindValue(":matricula", (int) $matricula);
                $sql->bindValue(":s", (int) $status);
                $sql->bindValue(":codigo", (int) $codigo);
            }else{

                $sql = $pdo->prepare("SELECT * FROM disciplinas WHERE faz_disciplina(codigo, :matricula) = :s");
                $sql->bindValue(":matricula", (int) $matricula);
                $sql->bindValue(":s", (int) $status);
            }
            $sql->execute();

            return $sql;
        }

    }

?>

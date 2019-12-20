<?php

    include_once('conexao.php');
    include_once('Utf8.php');

    Class Boletim{

        public static function exibir($id, $aluno, $disciplina, $situacao){

            global $sistema;

            $pdo = $sistema->getPdo();

            $query = "SELECT * FROM vw_boletins";

            $clausula = array();
            $i = 0;

            if($aluno != null){
                $clausula[$i] = "aluno LIKE '%".Utf8::decode($aluno)."%'";
                $i++;
            }
            if($disciplina != null){
                $clausula[$i] = "disciplina LIKE '%".Utf8::decode($disciplina)."%'";
                $i++;
            }
            $id = (int) $id;
            if($id != 0){
                $clausula[$i] = "id = ".$id;
                $i++;
            }
            $situacao = (int) $situacao;
            if($situacao != 0){
                switch($situacao){
                    case 1:
                        $clausula[$i] = "situacao = 'Aprovado'";
                    break;
                    case 2:
                        $clausula[$i] = "situacao = 'Reprovado'";
                    break;
                    case 3:
                        $clausula[$i] = "situacao = '".Utf8::decode('Recuperação')."'";
                    break;
                }
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

        public static function inserir($aluno, $disciplina, $nota1, $nota2, $nota3, $nota4){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL insert_aluno_disciplina(:aluno, :disciplina, :nota1, :nota2, :nota3, :nota4)");
            $sql->bindValue(":aluno", (int) $aluno);
            $sql->bindValue(":disciplina", (int) $disciplina);
            $sql->bindValue(":nota1", (float) $nota1);
            $sql->bindValue(":nota2", (float) $nota2);
            $sql->bindValue(":nota3", (float) $nota3);
            $sql->bindValue(":nota4", (float) $nota4);

            $sql->execute();

        }

        public static function editar($id, $aluno, $disciplina, $nota1, $nota2, $nota3, $nota4){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL update_aluno_disciplina(:id, :aluno, :disciplina, :nota1, :nota2, :nota3, :nota4)");
            $sql->bindValue(":id", (int) $id);
            $sql->bindValue(":aluno", (int) $aluno);
            $sql->bindValue(":disciplina", (int) $disciplina);
            $sql->bindValue(":nota1", (float) $nota1);
            $sql->bindValue(":nota2", (float) $nota2);
            $sql->bindValue(":nota3", (float) $nota3);
            $sql->bindValue(":nota4", (float) $nota4);

            $sql->execute();

        }

        public static function excluir($id){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL delete_aluno_disciplina(:id)");
            $sql->bindValue(":id", (int) $id);

            $sql->execute();
        }

    }

?>
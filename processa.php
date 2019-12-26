<?php

    if(isset($_POST['operacao'])){

        $operacao = (int) $_POST['operacao'];

        switch($operacao){

        case 1:

            if(isset($_POST['matricula'])){

                include_once('class/Aluno.php');

                $matricula = $_POST['matricula'];

                Aluno::excluir($matricula);

                header("Location: index.php");
            }
        break;

        case 2:

            if(isset($_POST['codigo'])){

                include_once('class/Disciplina.php');

                $codigo = $_POST['codigo'];

                Disciplina::excluir($codigo);

                header("Location: disciplinas.php");
            }
        break;

        case 3:

            if(isset($_POST['id'])){

                include_once('class/Boletim.php');

                $id = $_POST['id'];

                Boletim::excluir($id);

                header("Location: boletins.php");
            }
        break;


        }

    }

?>

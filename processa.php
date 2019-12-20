<?php

    if(isset($_POST['operacao'])){

        $operacao = (int) $_POST['operacao'];

        switch($operacao){

            case 1:


                if(isset($_POST['nome'])){

                    include_once('class/Aluno.php');

                    $nome_aluno = $_POST['nome'];
                        
                    Aluno::inserir($nome_aluno);
                    
                    header("Location: index.php");

                }

            break;

            case 2:


                if(isset($_POST['nome'])){

                    include_once('class/Disciplina.php');

                    $nome_disciplina = $_POST['nome'];

                    Disciplina::inserir($nome_disciplina);

                    header("Location: disciplinas.php");
                }
            break;

            case 3:

                if(isset($_POST['aluno']) && isset($_POST['disciplina']) && isset($_POST['nota1']) && isset($_POST['nota2']) && isset($_POST['nota3']) && isset($_POST['nota4'])){

                    include_once('class/Boletim.php');

                    $aluno = $_POST['aluno'];
                    $disciplina = $_POST['disciplina'];
                    $nota1 = $_POST['nota1'];
                    $nota2 = $_POST['nota2'];
                    $nota3 = $_POST['nota3'];
                    $nota4 = $_POST['nota4'];

                    Boletim::inserir($aluno, $disciplina, $nota1, $nota2, $nota3, $nota4);

                    header("Location: boletins.php");
                }

            break;

            case 4:

                if(isset($_POST['matricula']) && isset($_POST['nome'])){

                    include_once('class/Aluno.php');

                    $matricula = $_POST['matricula'];
                    $nome = $_POST['nome'];

                    Aluno::editar($matricula, $nome);

                    header("Location: index.php");
                }

            break;

            case 5:

                if(isset($_POST['codigo']) && isset($_POST['nome'])){

                    include_once('class/Disciplina.php');

                    $codigo = $_POST['codigo'];
                    $nome = $_POST['nome'];

                    Disciplina::editar($codigo, $nome);

                    header("Location: disciplinas.php");
                }
            break;

            case 6:

                if(isset($_POST['id']) && isset($_POST['matricula']) && isset($_POST['codigo']) && isset($_POST['nota1']) && isset($_POST['nota2']) && isset($_POST['nota3']) && isset($_POST['nota4'])){

                    include_once('class/Boletim.php');

                    $id = $_POST['id'];
                    $aluno = $_POST['matricula'];
                    $disciplina = $_POST['codigo'];
                    $nota1 = $_POST['nota1'];
                    $nota2 = $_POST['nota2'];
                    $nota3 = $_POST['nota3'];
                    $nota4 = $_POST['nota4'];

                    Boletim::editar($id, $aluno, $disciplina, $nota1, $nota2, $nota3, $nota4);

                    header("Location: boletins.php");
                }
            break;

        case 7:

            if(isset($_POST['matricula'])){

                include_once('class/Aluno.php');

                $matricula = $_POST['matricula'];

                Aluno::excluir($matricula);

                header("Location: index.php");
            }
        break;

        case 8:

            if(isset($_POST['codigo'])){

                include_once('class/Disciplina.php');

                $codigo = $_POST['codigo'];

                Disciplina::excluir($codigo);

                header("Location: disciplinas.php");
            }
        break;

        case 9:

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

<?php


    if(isset($_GET['operacao'])){

        include_once('../class/Boletim.php');

        $operacao = (int) $_GET['operacao'];

        switch($operacao){

            case 1:

                if(isset($_GET['aluno']) && isset($_GET['disciplina']) && isset($_GET['nota1']) && isset($_GET['nota2']) && isset($_GET['nota3']) && isset($_GET['nota4'])){
                    $aluno = $_GET['aluno'];
                    $disciplina = $_GET['disciplina'];
                    $nota1 = $_GET['nota1'];
                    $nota2 = $_GET['nota2'];
                    $nota3 = $_GET['nota3'];
                    $nota4 = $_GET['nota4'];

                    Boletim::inserir($aluno, $disciplina, $nota1, $nota2, $nota3, $nota4);
                    
                    $boletins[] = array(
						'msg'=>"Boletim inserido com sucesso!"
					);
                    
                    echo json_encode($boletins);

                }

            break;
            
            case 2:

                if(isset($_GET['id']) && isset($_GET['nota1']) && isset($_GET['nota2']) && isset($_GET['nota3']) && isset($_GET['nota4'])){

                    $id = $_GET['id'];
                    $nota1 = $_GET['nota1'];
                    $nota2 = $_GET['nota2'];
                    $nota3 = $_GET['nota3'];
                    $nota4 = $_GET['nota4'];

                    Boletim::editar($id, $nota1, $nota2, $nota3, $nota4);

                    $boletins[] = array(
                        'msg'=>"Boletim atualizado om sucesso!"
                    );
                    
                    echo json_encode($boletins);
                }
            break;
        }
        
    }
?>

<?php


    if(isset($_GET['operacao'])){

        include_once('../class/Aluno.php');

        $operacao = (int) $_GET['operacao'];

        switch($operacao){

            case 1:

                if(isset($_GET['nome'])){
                    $aluno = $_GET['nome'];

                    $registros = Aluno::exibir(0, null, $aluno, 1);

                }else{

                    $registros = Aluno::exibir(0, null, null, 1);

                }

                $alunos[] = array(
                    'linhas'=>$registros->rowCount()
                );

                echo json_encode($alunos);

            break;

            case 2:

                if(isset($_GET['nome']) && isset($_GET['matricula'])){

                    $aluno = $_GET['nome'];

                    $matricula = $_GET['matricula'];

                    $registros = Aluno::exibir($matricula, null, $aluno, 0);

                    $alunos[] = array(
                        'linhas'=>$registros->rowCount()
                    );

                    echo json_encode($alunos);
                }
            break;
            
            case 3:
            
                if(isset($_GET['nome'])){
                    
                    $nome_aluno = $_GET['nome'];
                    
                    $registros = Aluno::exibir(0, null, $nome_aluno, 0);
                    
                    if($registros->rowCount() > 0){
                        
                        $alunos[] = array(
                            'msg'=>0
                        );
                    }else{
                        
                        Aluno::inserir($nome_aluno);
                        
                        $alunos[] = array(
                            'msg'=>1
                        );
                        
                    }
                    
                    echo json_encode($alunos);
                }
            
            break;

        }

    }

?>

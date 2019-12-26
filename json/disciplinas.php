<?php

    include_once('../class/Disciplina.php');

    if(isset($_GET['operacao'])){

        $operacao = (int) $_GET['operacao'];

        switch($operacao){

            case 1:

                if(isset($_GET['nome'])){
                    $disciplina = $_GET['nome'];
        
                    $registros = Disciplina::exibir(0, null, $disciplina, 0);
        
                }else{
        
                    $registros = Disciplina::exibir(0, null, null, 0);
        
                }
        
                $disciplinas[] = array(
                    'linhas'=>$registros->rowCount()
                );
        
                echo json_encode($disciplinas);

            break;

            case 2:

                if(isset($_GET['aluno'])){
                    $aluno = $_GET['aluno'];
    
                    $registros = Disciplina::aluno_disciplinas($aluno, 0, 0);
    
                }

                while($registro = $registros->fetch()){
    
                    $disciplinas[] = array(
                        'codigo'=>$registro['codigo'],
                        'disciplina'=>$registro['nome']
                    );
                }
    
                echo json_encode($disciplinas);

            break;

            case 3:

                if(isset($_GET['nome']) && isset($_GET['codigo'])){

                    $nome = $_GET['nome'];
                    $codigo = $_GET['codigo'];

                    $registros = Disciplina::exibir($codigo, null, $nome, 0);

                    $disciplinas[] = array(
                        'linhas'=>$registros->rowCount()
                    );

                    echo json_encode($disciplinas);
                }
            break;

            case 4:

                if(isset($_GET['aluno']) && isset($_GET['codigo'])){
                    $aluno = $_GET['aluno'];
                    $codigo = $_GET['codigo'];

                    $registros = Disciplina::aluno_disciplinas($aluno, 0, $codigo);

                }

                while($registro = $registros->fetch()){

                    $disciplinas[] = array(
                        'codigo'=>$registro['codigo'],
                        'disciplina'=>$registro['nome']
                    );
                }

                echo json_encode($disciplinas);

            break;
            
            case 5:

                if(isset($_GET['nome'])){
                    $disciplina = $_GET['nome'];
        
                    $registros = Disciplina::exibir(0, null, $disciplina, 0);
                    
                    if($registros->rowCount() > 0){
                        
                        $disciplinas[] = array(
                            'msg'=>0
                        );
                        
                    }else{
                        
                        Disciplina::inserir($disciplina);
                        
                        $disciplinas[] = array(
                            'msg'=>1
                        );
                    }
                    
                    echo json_encode($disciplinas);
                }

            break;
            
            case 6:

                if(isset($_GET['codigo']) && isset($_GET['nome'])){

                    $codigo = $_GET['codigo'];
                    $nome = $_GET['nome'];
                    
                    $registros = Disciplina::exibir($codigo, null, $nome, 0);
                    
                    if($registros->rowCount() > 0){
                        
                        $disciplinas[] = array(
                            'msg'=>"Erro essa disciplina já está cadastrada!"
                        );
                    }else{

                        Disciplina::editar($codigo, $nome);
                        
                        $disciplinas[] = array(
                            'msg'=>"Disciplina atualizada com sucesso!"
                        );

                    }
                    
                    echo json_encode($disciplinas);
                }
            break;

        }
    }


   

?>

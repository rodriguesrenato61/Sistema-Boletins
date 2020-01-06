<?php

    include_once('../class/Disciplina.php');
    
    $d = new Disciplina;

    if(isset($_GET['operacao'])){

        $operacao = (int) $_GET['operacao'];

        switch($operacao){
        
            case 1:

                //se a operação for 1, um json com os dados das disciplinas que determinado aluno não faz será gerado 
                if(isset($_GET['aluno'])){
                    $aluno = $_GET['aluno'];
    
                    $registros = $d->aluno_disciplinas($aluno, 0, 0);//carregando as disciplinas que o aluno não faz
    
                }

                while($registro = $registros->fetch()){
    
                    $disciplinas[] = array(
                        'codigo'=>$registro['codigo'],
                        'disciplina'=>$registro['nome']
                    );//colocando essas disciplinas em um array
                }
    
                echo json_encode($disciplinas);//convertendo o array para um json

            break;
           
        }
    }


   

?>

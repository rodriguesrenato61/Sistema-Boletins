<?php

    include_once('../class/Disciplina.php');
    
    $d = new Disciplina;

    if(isset($_GET['operacao'])){

        $operacao = (int) $_GET['operacao'];

        switch($operacao){
        
            case 1:

                if(isset($_GET['aluno'])){
                    $aluno = $_GET['aluno'];
    
                    $registros = $d->aluno_disciplinas($aluno, 0, 0);
    
                }

                while($registro = $registros->fetch()){
    
                    $disciplinas[] = array(
                        'codigo'=>$registro['codigo'],
                        'disciplina'=>$registro['nome']
                    );
                }
    
                echo json_encode($disciplinas);

            break;
           
        }
    }


   

?>

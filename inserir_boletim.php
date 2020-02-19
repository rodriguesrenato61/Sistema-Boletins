<?php
                //mesmo esquema usado na inserção de um aluno
                if(isset($_POST['aluno']) && isset($_POST['disciplina']) && isset($_POST['nota1']) && isset($_POST['nota2']) && isset($_POST['nota3']) && isset($_POST['nota4'])){
                    
                    $aluno_id = $_POST['aluno'];
                    $disciplina_id = $_POST['disciplina'];
                    $nota1 = $_POST['nota1'];
                    $nota2 = $_POST['nota2'];
                    $nota3 = $_POST['nota3'];
                    $nota4 = $_POST['nota4'];
                    
                    include_once('class/Boletim.php');
                    include_once('class/Mensagem.php');
                    
                    $m = new Mensagem;
                    $b = new Boletim;
                    
                    if($aluno_id != "0" && $disciplina_id != "0" && !empty($nota1) && !empty($nota2) && !empty($nota3) && !empty($nota4)){
                        
                        $msg = $b->valida_boletim($aluno_id, $disciplina_id, $nota1, $nota2, $nota3, $nota4);
                        
                        if($msg == "válido!"){
                        
                            $b->inserir($aluno_id, $disciplina_id, $nota1, $nota2, $nota3, $nota4);
                            $m->setMensagem("Boletim inserido com sucesso!");
                            header("Location: boletins.php");
                        
                        }else{
                            
                            $m->alert($msg);
                            
                        }
                    }else{
                        
                        $m->alert("Preencha todos os campos!");
                        
                    }
                }
            
            ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Inserir Boletim</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/inserir_boletim.css">
            
        </head>
        <body>

            <?php

                include_once('class/Aluno.php');
                include_once('class/Disciplina.php');
                
                $d = new Disciplina;

            ?>

            <!--corpo da página-->
            <a href="boletins.php"><h2><<<<</h2></a>
            <div class="container" id="inserir_boletim">
                <form method="POST">
                    <input type="hidden" name="operacao" value="3">
                    <div id="div_title">
                        Inserir boletim
                    </div>
                    <div id="div_body">
		                <div class="form-group">
                            <select class="form-control" id="aluno" name="aluno">
                                <option value="0">--Aluno--</option>
                                <?php
                                    $a = new Aluno;
                                    $alunos = $a->exibir(0, null, null, 0, 0);//carregando os alunos
                                    //exibindo os alunos em um select
                                    while($aluno = $alunos->fetch()){
                                        if(isset($_POST['aluno'])){
                                            $nome_aluno = $_POST['aluno'];
                                            if($nome_aluno == $aluno['matricula']){
                                                echo('<option selected value='.$aluno['matricula'].'>'.$aluno['aluno'].'</option>');
                                            }else{
                                                echo('<option value='.$aluno['matricula'].'>'.$aluno['aluno'].'</option>');
                                            }
                                        }else{
                                            echo('<option value='.$aluno['matricula'].'>'.$aluno['aluno'].'</option>');
                                        }
                                        
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="disciplina" name="disciplina">
                                <option value="0">--Disciplina--</option>
                                <?php
                                    if(isset($_POST['aluno'])){
                                        if($_POST['aluno'] != "0"){
                                            $registros = $d->aluno_disciplinas($_POST['aluno'], 0, 0);//carregando somente as disciplinas que o aluno ainda não faz
                                            //exibindo as disciplinas em um select
                                            while($registro = $registros->fetch()){
                                                if(isset($_POST['disciplina'])){
                                                    if($_POST['disciplina'] == $registro['codigo']){
                                                        echo("<option selected value='".$registro['codigo']."'>".$registro['nome']."</option>");
                                                    }else{
                                                        echo("<option value='".$registro['codigo']."'>".$registro['nome']."</option>");
                                                    }
                                                }else{
                                                    echo("<option value='".$registro['codigo']."'>".$registro['nome']."</option>");
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota1" name="nota1" placeholder="Nota 1"
                            <?php
                                if(isset($_POST['nota1'])){
                                    echo("value='".$_POST['nota1']."'");
                                }
                            ?>>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota2" name="nota2" placeholder="Nota 2"
                            <?php
                                if(isset($_POST['nota2'])){
                                    echo("value='".$_POST['nota2']."'");
                                }
                            ?>>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota3" name="nota3" placeholder="Nota 3"
                            <?php
                                if(isset($_POST['nota3'])){
                                    echo("value='".$_POST['nota3']."'");
                                }
                            ?>>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota4" name="nota4" placeholder="Nota 4"
                            <?php
                                if(isset($_POST['nota4'])){
                                    echo("value='".$_POST['nota4']."'");
                                }
                            ?>>
                        </div>
                        
		                <button type="submit" class="btn btn-primary mb-2" id="inserir">Inserir</button>
                    </div>                
                </form>
            </div>
            
            
            
            

            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
            <!--importando nosso javascript-->
            <script src="js/inserir_boletim.js"></script>
    
        </body>
    </html>


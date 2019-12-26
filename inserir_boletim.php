
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

            ?>

            <!--corpo da página-->
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
                                    $alunos = Aluno::exibir(0, null, null, 0);
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
                                            $registros = Disciplina::aluno_disciplinas($_POST['aluno'], 0, 0);
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


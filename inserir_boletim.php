
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

            ?>

            <!--corpo da página-->
            <div class="container" id="inserir_boletim">
                <form method="POST" action="processa.php">
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
                                        echo('<option value='.$aluno['matricula'].'>'.Utf8::encode($aluno['aluno']).'</option>');
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="disciplina" name="disciplina">
                                <option value="0">--Disciplina--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota1" name="nota1" placeholder="Nota 1">
                        </div>
                        <div id="n1-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota2" name="nota2" placeholder="Nota 2">
                        </div>
                        <div id="n2-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota3" name="nota3" placeholder="Nota 3">
                        </div>
                        <div id="n3-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota4" name="nota4" placeholder="Nota 4">
                        </div>
                        <div id="n4-msg-erro" class="msg-erro bg-danger text-white">
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


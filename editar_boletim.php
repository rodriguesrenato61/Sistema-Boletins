
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Editar Boletim</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/editar_boletim.css">
            
        </head>
        <body>

            <?php

                include_once('class/Boletim.php');

            ?>

            <!--corpo da página-->
            <div class="container" id="editar_boletim">
                <form method="POST" action="processa.php">
                    <input type="hidden" name="operacao" value="6">
                    <div id="div_title">
                        Editar boletim
                    </div>
                    <div id="div_body">
                        <?php
                        if(isset($_GET['id'])){
                            $id = (int) $_GET['id'];
                            $registros = Boletim::exibir($id, null, null, 0);
                            while($registro = $registros->fetch()){
                                $matricula = $registro['matricula'];
                                $aluno = Utf8::encode($registro['aluno']);
                                $disciplina = Utf8::encode($registro['disciplina']);
                                $codigo = $registro['codigo'];
                                $nota1 = $registro['nota1'];
                                $nota2 = $registro['nota2'];
                                $nota3 = $registro['nota3'];
                                $nota4 = $registro['nota4'];
                            }
                            echo("<input type='hidden' name='id' id='id' value='".$id."'>");
                            echo("<input type='hidden' name='matricula' id='matricula' value='".$matricula."'>");
                            echo("<input type='hidden' name='codigo' id='codigo' value='".$codigo."'>");
                        ?>
		                <div class="form-group">
                            <input class="form-control" id="aluno" name="aluno"value="<?php echo($aluno); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="disciplina" name="disciplina" value="<?php echo($disciplina); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota1" name="nota1" placeholder="Nota 1" <?php echo("value='".$nota1."'"); ?>>
                        </div>
                        <div id="n1-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota2" name="nota2" placeholder="Nota 2" <?php echo("value='".$nota2."'"); ?>>
                        </div>
                        <div id="n2-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota3" name="nota3" placeholder="Nota 3" <?php echo("value='".$nota3."'"); ?>>
                        </div>
                        <div id="n3-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nota4" name="nota4" placeholder="Nota 4" <?php echo("value='".$nota4."'"); ?>>
                        </div>
                        <div id="n4-msg-erro" class="msg-erro bg-danger text-white">
                        </div>
		                <button type="submit" class="btn btn-primary mb-2" id="salvar">Salvar</button>
                    <?php
                        }
                    ?>
                    </div>                
                </form>
            </div>

            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
            <!--importando nosso javascript-->
            <script src="js/editar_boletim.js"></script>
    
        </body>
    </html>


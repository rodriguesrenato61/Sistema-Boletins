
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Editar aluno</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/editar_aluno.css">
            
        </head>
        <body>

            <!--corpo da página-->
            <a href="index.php"><h2><<<<</h2></a>
            <div class="container" id="editar_aluno">
                <form method="POST">
                    <input type="hidden" name="operacao" value="4">
                    <div id="div_title">
                        Editar Aluno
                    </div>
                    <div id="div_body">
		                <div class="form-group">
                            <?php

                                include_once('class/Aluno.php');
                            
                                if(isset($_GET['matricula'])){
                                    $aluno = $_GET['matricula'];
                                    $registros = Aluno::exibir($aluno, null, null, 1);
                                    while($registro = $registros->fetch()){
                                        $nome = $registro['aluno'];
                                    }
                                    echo("<input type='hidden' name='matricula' id='matricula' value='".$aluno."'>");
                                    echo("<input class='form-control' id='nome' name='nome' placeholder='Nome' value='".$nome."'>");
                                }
                                
                            ?>
                        </div>
		                <button type="submit" class="btn btn-primary mb-2" id="salvar">Salvar</button>
                    </div>                
                </form>
            </div>

            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
            <!--importando nosso javascript-->
            <script src="js/editar_aluno.js"></script>
    
        </body>
    </html>


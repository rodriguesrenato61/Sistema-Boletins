<?php
    session_start();
    
    include_once('class/Mensagem.php');
    include_once('class/Disciplina.php');
    
    $d = new Disciplina;
    $m = new Mensagem;
    
    $m->getMensagem();
    
?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Disciplinas</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/disciplinas.css">

            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <!--importando javascript do bootstrap-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    
            
        </head>
        <body>

            <!--corpo da página-->
            
            <?php
                if(isset($_POST['remover'])){
                    $codigo = $_POST['remover'];
                    $d->modalExcluir($codigo);
                }
            ?>


            <div class="container" id="disciplinas">
                <nav class="navbar navbar-light">
                    <h1>Disciplinas</h1>
                    <a class="navbar-brand" href="inserir_disciplina.php">
                        <button class="btn btn-primary">inserir</button>
                    </a>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Alunos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="boletins.php">Boletins</a>
                        </li>
                    </ul>
                </nav>

                <form method="GET" class="form-inline" id="disciplinas_search">   
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="disciplina" id="disciplina" placeholder="disciplina"
                        <?php
                            if(isset($_GET['disciplina'])){
                                $nome = $_GET['disciplina'];
                                echo('value='.$nome);
                            }
                        ?>
                        >
                    </div>
                    <button type="submit" id="pesquisar" class="btn btn-primary mb-2">Pesquisar</button>
                </form>
                <div id="div_tabela">
                <table class="table table-striped" id="table_disciplinas">
                <tr>
                    <th>Código</th>
                    <th>Disciplina</th>
                    <th>Alunos</th>
                    <th>Aprovados</th>
                    <th>Reprovados</th>
                    <th>Recuperação</th>
                    <th colspan="2">Ações</th>
                </tr>
                <?php

                    if(isset($_GET['disciplina'])){

                        $nome = $_GET['disciplina'];
                        $registros = $d->exibir(0, $nome, null, 0);

                    }else{

                        $registros = $d->exibir(0, null, null, 0);

                    }

                    while($registro = $registros->fetch()){

                        echo('<tr>');
                        echo('<td>'.$registro['codigo'].'</td>');
                        echo('<td>'.$registro['disciplina'].'</td>');
                        echo('<td>'.$registro['alunos'].'</td>');
                        echo('<td>'.$registro['aprovados'].'</td>');
                        echo('<td>'.$registro['reprovados'].'</td>');
                        echo('<td>'.$registro['recuperacao'].'</td>');
                        echo('<td>');
                        echo("<form method='GET' action='editar_disciplina.php'>");
                        echo("<input type='hidden' name='codigo' value='".$registro['codigo']."'>");
                        echo("<button type='submit' class='btn btn-primary'>Editar</button>");
                        echo("</form>");
                        echo('</td>');
                        echo('<td>');
                        echo("<form method='POST'>");
                        echo("<input type='hidden' name='remover' value='".$registro['codigo']."'>");
                        echo("<button type='submit' class='btn btn-danger'>Remover</button>");
                        echo("</form>");
                        echo('<td>');
                        echo('</tr>');

                    }

                ?>
                               
                </table>
                </div>
            </div>
    
        </body>
    </html>


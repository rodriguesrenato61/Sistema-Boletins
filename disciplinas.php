
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

        <?php

            include_once('class/Disciplina.php');

        ?>


            <!--corpo da página-->

                        <!-- Modal -->
                        <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <form method="POST" action="processa.php">
                                <input type="hidden" name="operacao" value="2">
                                <input type="hidden" name="codigo" value="<?php echo($_POST['remover']); ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Excluir disciplina</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza de que deseja excluir esta disciplina?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Remover</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php
                        if(isset($_POST['remover'])){
                            ?>
                            <script type="text/javascript">
                    
                                $(document).ready(function(){
            
                                    $('#modal_delete').modal({show:true});
                                });
                    
                            </script>
                            <?php
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
                        $registros = Disciplina::exibir(0, $nome, null, 0);

                    }else{

                        $registros = Disciplina::exibir(0, null, null, 0);

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

            
            <!--importando nosso javascript-->
            <script src="js/disciplinas.js"></script>
    
        </body>
    </html>


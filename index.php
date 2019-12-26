
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Alunos</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/index.css">
            
        </head>
        <body>

            <?php

                include_once('class/Aluno.php');
                

            ?>

            <!--corpo da página-->
            
            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
            <!--importando javascript do bootstrap-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


            
                    <!-- Modal -->
                        <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <form method="POST" action="processa.php">
                                <input type="hidden" name="operacao" value="1">
                                <input type="hidden" name="matricula" value="<?php echo($_POST['remover']); ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Excluir aluno</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza de que deseja excluir este aluno?
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
        


            <div class="container" id="alunos">
                <nav class="navbar navbar-light">
                    <h1>Alunos</h1>
                    <a class="navbar-brand" href="inserir_aluno.php">
                        <button class="btn btn-primary">inserir</button>
                    </a>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="disciplinas.php">Disciplinas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="boletins.php">Boletins</a>
                        </li>
                    </ul>
                </nav>

                <form method="GET" class="form-inline" id="alunos_search">   
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="aluno" id="aluno" placeholder="aluno"
                        <?php

                            if(isset($_GET['aluno'])){
                                $nome = $_GET['aluno'];
                                echo('value='.$nome);
                            }

                        ?>
                        >
                    </div>
                    <button type="submit" id="pesquisar" class="btn btn-primary mb-2">Pesquisar</button>
                </form>
                <div id="div_tabela">
                <table class="table table-striped" id="table_alunos">
                <tr>
                    <th>Matrícula</th>
                    <th>Aluno</th>
                    <th>Disciplinas</th>
                    <th>Aprovações</th>
                    <th>Reprovações</th>
                    <th>Recuperações</th>
                    <th colspan="2">Ações</th>

                </tr>
                    <?php
                    

                        if(isset($_GET['aluno'])){

                            $nome = $_GET['aluno'];
                            $registros = Aluno::exibir(0, $nome, null, 1);

                        }else{

                            $registros = Aluno::exibir(0, null, null, 1);

                        }

                        while($registro = $registros->fetch()){

                            echo('<tr>');
                            echo('<td>'.$registro['matricula'].'</td>');
                            echo('<td>'.$registro['aluno'].'</td>');
                            echo('<td>'.$registro['disciplinas'].'</td>');
                            echo('<td>'.$registro['aprovacoes'].'</td>');
                            echo('<td>'.$registro['reprovacoes'].'</td>');
                            echo('<td>'.$registro['recuperacoes'].'</td>');
                            echo('<td>');
                            echo("<form method='GET' action='editar_aluno.php'>");
                            echo("<input type='hidden' name='matricula' value='".$registro['matricula']."'>");
                            echo("<button type='submit' class='btn btn-primary'>Editar</button>");
                            echo("</form>");
                            echo('</td>');
                            
                            echo('<td>');
                            echo("<form method='POST'>");
                            echo("<input type='hidden' name='remover' value='".$registro['matricula']."'>");
                            echo("<button type='submit' class='btn btn-danger' data-toggle='modal' data-target='#mymodal'>Remover</button>");
                            echo("</form>");
                            echo('</td>');
                            
                            echo('</tr>');

                        }

                    ?>
                    
                </table>
                </div>
            </div>
    
            
    
        </body>
    </html>


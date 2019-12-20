
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Boletins</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/boletins.css">

            <!--importando o jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <!--importando javascript do bootstrap-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            
        </head>
        <body>

            <?php
            

                include_once('class/Boletim.php');
            

            ?>

            <!--corpo da página-->

             <!-- Modal -->
             <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <form method="POST" action="processa.php">
                                <input type="hidden" name="operacao" value="9">
                                <input type="hidden" name="id" value="<?php echo($_POST['remover']); ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Excluir boletim</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza de que deseja excluir este boletim?
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



            <div class="container" id="boletins">
                <nav class="navbar navbar-light">
                    <h1>Boletins</h1>
                    <a class="navbar-brand" href="inserir_boletim.php">
                        <button class="btn btn-primary">inserir</button>
                    </a>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Alunos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="disciplinas.php">Disciplinas</a>
                        </li>
                    </ul>
                </nav>

                <form method="GET" class="form-inline" id="boletins_search">   
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="aluno" id="aluno" placeholder="aluno"
                        <?php
                            if(isset($_GET['aluno'])){

                                $nome_aluno = $_GET['aluno'];
                                echo('value='.$nome_aluno);

                            }
                        ?>
                        >
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="disciplina" id="disciplina" placeholder="disciplina"
                        <?php
                            if(isset($_GET['disciplina'])){

                                $nome_disciplina = $_GET['disciplina'];
                                echo('value='.$nome_disciplina);

                            }
                        ?>
                        >
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select class="form-control" name="situacao" id="situacao">
                            <?php

                                $situacoes = array();
                                $situacoes[0] = "--Situação--";
                                $situacoes[1] = "Aprovado";
                                $situacoes[2] = "Reprovado";
                                $situacoes[3] = "Recuperação";

                                for($i = 0; $i < 4; $i++){
                                    if(isset($_GET['situacao'])){
                                        $situacao = (int) $_GET['situacao'];
                                        if($situacao == $i){
                                            echo('<option selected value='.$i.'>'.$situacoes[$i].'</option>');
                                        }else{
                                            echo('<option value='.$i.'>'.$situacoes[$i].'</option>');
                                        }
                                    }else{
                                        echo('<option value='.$i.'>'.$situacoes[$i].'</option>');
                                    }
                                }

                            ?>
                        </select>
                    </div>
                    <button type="submit" id="pesquisar" class="btn btn-primary mb-2">Pesquisar</button>
                </form>
                <div id="div_tabela">
                <table class="table table-striped" id="table_boletins">
                <tr>
                    <th>Matrícula</th>
                    <th>Aluno</th>
                    <th>Disciplina</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Nota 4</th>
                    <th>Média</th>
                    <th>Situação</th>
                    <th colspan="2">Ações</th>
                </tr>
                <?php
                

                    if(isset($_GET['aluno']) && isset($_GET['disciplina']) && isset($_GET['situacao'])){
                        $aluno = $_GET['aluno'];
                        $disciplina = $_GET['disciplina'];
                        $situacao = $_GET['situacao'];

                        $registros = Boletim::exibir(0, $aluno, $disciplina, $situacao);
                    }else{
                        $registros = Boletim::exibir(0, null, null, 0);
                    }

                    while($registro = $registros->fetch()){

                        echo('<tr>');
                        echo('<td>'.$registro['matricula'].'</td>');
                        echo('<td>'.Utf8::encode($registro['aluno']).'</td>');
                        echo('<td>'.Utf8::encode($registro['disciplina']).'</td>');
                        echo('<td>'.$registro['nota1'].'</td>');
                        echo('<td>'.$registro['nota2'].'</td>');
                        echo('<td>'.$registro['nota3'].'</td>');
                        echo('<td>'.$registro['nota4'].'</td>');
                        echo('<td>'.$registro['media'].'</td>');
                        echo('<td>'.Utf8::encode($registro['situacao']).'</td>');
                        echo('<td>');
                        echo("<form method='GET' action='editar_boletim.php'>");
                        echo("<input type='hidden' name='id' value='".$registro['id']."'>");
                        echo("<button type='submit' class='btn btn-primary'>Editar</button>");
                        echo("</form>");
                        echo('</td>');
                        echo('<td>');
                        echo("<form method='POST'>");
                        echo("<input type='hidden' name='remover' value='".$registro['id']."'>");
                        echo("<button type='submit' class='btn btn-danger'>Remover</button>");
                        echo("</form>");
                        echo('</tr>');

                    }
                    

                ?>
                               
                </table>
                </div>
            </div>

            <!--importando nosso javascript-->
            <script src="js/boletins.js"></script>
    
        </body>
    </html>


<?php

    include_once('class/Aluno.php');
    $a = new Aluno;
            
                if(isset($_POST['matricula']) && isset($_POST['nome'])){//se for clicado em salvar
                    
                    $matricula = $_POST['matricula'];
                    $nome = $_POST['nome'];
                    
                    include_once('class/Mensagem.php');
                    
                    $m = new Mensagem;
                    
                    if(!empty($nome)){//se o campo não for vazio
                        
                        $msg = $a->verificar_disponibilidade($matricula, $nome);//verifica a disponibilidade desse nome
                        
                        if($msg == "Pode atualizar o aluno!"){//se este nome está disponível
                        
                            $a->editar($matricula, $nome);//atualizando os dados do aluno
                            $m->setMensagem("Aluno atualizado com sucesso!");//setando a mensagem a ser exibida ao ser redirecionado para a página com os dados dos alunos
                            header("Location: index.php");//redirecionando para página de alunos
                        
                        }else{//se o nome não está disponível
                            
                            $m->alert($msg);//exibe mensagem de erro
                            
                        }
                    }else{//se o campo for vazio
                        
                        $m->alert("Preencha o nome!");//exibe mensagem para preencher o campo
                        
                    }
                }
            
            ?>
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
                            
                                if(isset($_GET['matricula'])){
                                    $aluno = $_GET['matricula'];
                                    $registros = $a->exibir($aluno, null, null, 1, 1);
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
    
        </body>
    </html>


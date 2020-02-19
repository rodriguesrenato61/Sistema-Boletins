
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Inserir aluno</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/inserir_aluno.css">
            
        </head>
        <body>
            <a href="index.php"><h2><<<<</h2></a>

            <!--corpo da página-->
            <div class="container" id="inserir_aluno">
                <form method="POST">
                    <div id="div_title">
                        Inserir Aluno
                    </div>
                    <div id="div_body">
		                <div class="form-group">
                            <input class="form-control" id="nome" name="nome" placeholder="Nome"
                            <?php
                                if(isset($_POST['nome'])){
                                    echo("value='".$_POST['nome']."'");
                                }
                            ?>
                            >
                        </div>
		                <button type="submit" class="btn btn-primary mb-2" id="inserir">Inserir</button>
                    </div>                
                </form>
            </div>
            
            <?php
            
                if(isset($_POST['nome'])){//se foi clicado em inserir
                    $nome = $_POST['nome'];
                    
                    include_once('class/Aluno.php');
                    include_once('class/Mensagem.php');
                    
                    $m = new Mensagem;
                    $a = new Aluno;
                    
                    if(!empty($nome)){//se o campo não for vazio
                        
                        $msg = $a->valida_aluno($nome);//valida o nome do aluno
                        
                        if($msg == "Pode inserir o aluno!"){//se o nome é válido para ser inserido
                        
                            $a->inserir($nome);//inserindo o novo aluno
                            $m->setMensagem("Aluno inserido com sucesso!");//setando a mensagem a ser exibida quando for redirecionado para página de exibição dos alunos
                            header("Location: index.php");//redirecionando para página de exibição dos alunos
                        
                        }else{//se o nome não é válido para ser inserido
                            
                            $m->alert($msg);//exibe a mensagem de erro permanecendo na página
                            
                        }
                    }else{//se o campo estiver vazio
                        
                        $m->alert("Preencha o nome!");//exibindo mensagem de aviso para preencher o campo
                        
                    }
                }
            
            ?>
    
        </body>
    </html>


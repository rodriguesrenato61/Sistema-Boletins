
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Inserir Disciplina</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/inserir_disciplina.css">
            
        </head>
        <body>

            <!--corpo da página-->
            <a href="disciplinas.php"><h2><<<<</h2></a>
            <div class="container" id="inserir_disciplina">
                <form method="POST">
                <input type="hidden" name="operacao" value="2">
                    <div id="div_title">
                        Inserir disciplina
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
            
                //mesmo esquema usado na inserção de um aluno
                if(isset($_POST['nome'])){
                    $nome = $_POST['nome'];
                    
                    include_once('class/Disciplina.php');
                    include_once('class/Mensagem.php');
                    
                    $m = new Mensagem;
                    $d = new Disciplina;
                    
                    if(!empty($nome)){
                        
                        $msg = $d->valida_disciplina($nome);
                        
                        if($msg == "Pode inserir a disciplina!"){
                        
                            $d->inserir($nome);
                            $m->setMensagem("Disciplina inserida com sucesso!");
                            header("Location: disciplinas.php");
                        
                        }else{
                            
                            $m->alert($msg);
                            
                        }
                    }else{
                        
                        $m->alert("Preencha o nome!");
                        
                    }
                }
            
            ?>
    
        </body>
    </html>


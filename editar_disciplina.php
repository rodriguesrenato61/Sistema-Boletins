<?php
include_once('class/Disciplina.php');
    $d = new Disciplina;
            
                //mesmo esquema usado na atualização de um aluno
                if(isset($_POST['codigo']) && isset($_POST['nome'])){
                    
                    $codigo = $_POST['codigo'];
                    $nome = $_POST['nome'];
                    
                    include_once('class/Mensagem.php');
                    
                    $m = new Mensagem;
                    
                    
                    if(!empty($nome)){
                        
                        $msg = $d->verificar_disponibilidade($codigo, $nome);
                        
                        if($msg == "Pode atualizar a disciplina!"){
                        
                            $d->editar($codigo, $nome);
                            $m->setMensagem("Disciplina atualizada com sucesso!");
                            header("Location: disciplinas.php");
                        
                        }else{
                            
                            $m->alert($msg);
                            
                        }
                    }else{
                        
                        $m->alert("Preencha o nome!");
                        
                    }
                }
            
            ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Editar disciplina</title>
            
            <!--importando a folha de estilos do bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <!--importando nossa folha de estilos-->
            <link rel="stylesheet" href="css/editar_disciplina.css">
            
        </head>
        <body>

            <!--corpo da página-->
            <a href="disciplinas.php"><h2><<<<</h2></a>
            <div class="container" id="editar_disciplina">
                <form method="POST">
                    <input type="hidden" name="operacao" value="5">
                    <div id="div_title">
                        Editar Disciplina
                    </div>
                    <div id="div_body">
		                <div class="form-group">
                            <?php
                                if(isset($_GET['codigo'])){
                                    $disciplina = $_GET['codigo'];
                                    $registros = $d->exibir($disciplina, null, null, 1);
                                    while($registro = $registros->fetch()){
                                        $nome = $registro['disciplina'];
                                    }
                                    echo("<input type='hidden' id='codigo' name='codigo' value='".$disciplina."'>");
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
            <script src="js/editar_disciplina.js"></script>
    
        </body>
    </html>


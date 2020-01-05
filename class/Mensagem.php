<?php

	include_once('conexao.php');

	class Mensagem{
		
		public function alert($msg){
			
			echo("<script type='text/javascript'>");
			echo("alert('".$msg."');");
			echo("</script>");
		}
		
		public function setMensagem($msg){
			if(isset($_SESSION['msg'])){
				$_SESSION['msg'] = $msg;
			}else{
				session_start();
				$_SESSION['msg'] = $msg;
			}
		}
		
		public function getMensagem(){
			
			if(isset($_SESSION['msg'])){
				if($_SESSION['msg'] != "Nenhuma mensagem encontrada!"){ 
					$this->alert($_SESSION['msg']);
					$_SESSION['msg'] = "Nenhuma mensagem encontrada!";
				}
			}
		}
		
		public function modalExcluir($titulo, $msg, $tipo, $valor){
			?>
			<!-- Modal de exclusão de um registro -->
                        <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <form method="POST" <?php echo("action='processos/".$tipo.".php'>"); ?>
                                <input type="hidden" name="operacao" value="1">
                                <input type="hidden" name="excluir" value="<?php echo($valor); ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel"><?php echo($titulo); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo($msg); ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Remover</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <script type="text/javascript">
                    
                                $(document).ready(function(){
            
                                    $('#modal_delete').modal({show:true});
                                });
                    
                        </script>
			<?php
		}
			
	}

?>

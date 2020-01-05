<?php
	
	if(isset($_POST['operacao'])){
		
		include_once('../class/Boletim.php');
		include_once('../class/Mensagem.php');
		
		$operacao = (int) $_POST['operacao'];
		$b = new Boletim;
		$m = new Mensagem;
		
		switch($operacao){
			
			case 1:
			
				if(isset($_POST['excluir'])){

					$id = $_POST['excluir'];

					$b->excluir($id);
					
					$m->setMensagem("Boletim excluído com sucesso!");
					
					header("Location: ../boletins.php");

				}
			break;
		}
	}
?>

<?php
	
	if(isset($_POST['operacao'])){
		
		include_once('../class/Disciplina.php');
		include_once('../class/Mensagem.php');
		
		$operacao = (int) $_POST['operacao'];
		$d = new Disciplina;
		$m = new Mensagem;
		
		switch($operacao){
			
			case 1:
				
				if(isset($_POST['excluir'])){

					$codigo = $_POST['excluir'];

					$d->excluir($codigo);
					
					$m->setMensagem("Disciplina excluído com sucesso!");
					
					header("Location: ../disciplinas.php");

				}
			break;
		}
	}
?>

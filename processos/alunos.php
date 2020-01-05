<?php
	
	if(isset($_POST['operacao'])){
		
		include_once('../class/Aluno.php');
		include_once('../class/Mensagem.php');
		
		$operacao = (int) $_POST['operacao'];
		$a = new Aluno;
		$m = new Mensagem;
		
		switch($operacao){
			
			case 1:
			
				if(isset($_POST['excluir'])){

					$matricula = $_POST['excluir'];
					$a->excluir($matricula);
					$m->setMensagem("Aluno excluído com sucesso!");
					header("Location: ../index.php");

				}
				
			break;
		}
	}
?>

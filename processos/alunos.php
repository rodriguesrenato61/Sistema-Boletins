<?php
	
	if(isset($_POST['operacao'])){
		
		include_once('../class/Aluno.php');
		include_once('../class/Mensagem.php');
		
		$operacao = (int) $_POST['operacao'];
		$a = new Aluno;
		$m = new Mensagem;
		
		switch($operacao){
			
			case 1:
			
				//se a exclusão de um aluno foi confirmada ele será excluído
				if(isset($_POST['excluir'])){

					$matricula = $_POST['excluir'];
					$a->excluir($matricula);//excluindo o aluno
					$m->setMensagem("Aluno excluído com sucesso!");//setando a mensagem de sucesso
					header("Location: ../index.php");//redirecionando para página de alunos

				}
				
			break;
		}
	}
?>

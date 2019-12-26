<?php

	class Mensagem{
		
		public static function alert($msg){
			
			echo("<script type='text/javascript'>");
			echo("alert('".$msg."');");
			echo("</script>");
		}
	}

?>

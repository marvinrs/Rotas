<?php
	// Conexão do Banco de Dados
		$servidor = 'localhost';
		$usuario = 'root';
		$senha = '';
		//$banco = 'geo';

		$conexao = mysqli_connect($servidor, $usuario, $senha);
		
		if ($conexao->connect_error) {
			die("Conexao falhou: " . $conexao->connect_error);
			}
		
		/*if($conexao){
			mysqli_select_db($conexao, $banco);
		}else{
			echo '<h1>Falha na conexão. Erro.</h1>';
		}*/
?>
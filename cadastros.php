<!-- SMARV Informática Marvin (91)98156-5857-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

	<title>Lista de Cadastro de Clientes</title>
	<style type="text/css">
		
			/* Estilo da tabela */
			
			table {
				border-collapse: collapse;
				width: 50%;	
				border: 1px solid black;
			}

			th, td {
				text-align: left;
				padding: 3px;
			}

			tr:nth-child(even){background-color: #f2f2f2}

			th {
				background-color: #ba0000;
				color: white;  
			}

			h2 {
				text-align: center;
				color: red;
			}

			</style>
</head>

<body>
  <div class="container mt-3">
  <table border="0" class="table">
      <tr><div align="center"></div></tr>	  
	  <tr><th colspan="5" align="center" valign="top"><h2>Cadastro de clientes</h2></th>
	  </tr>
  </table>
	<!-- Lista cada usuário com seu nome, email, cpf, data de nascimente, endereco e cep-->		
	<?php
    include("crud/conexao.php");
    mysqli_select_db($conexao, 'geo');
    $query="SELECT * FROM cadastro ORDER BY endereco ASC";
	
	if ($query != null){
		$sql = mysqli_query($conexao, $query);
	
		echo '<table width="100%" border="1" class="table">';
		echo '<thead><tr>';
		echo '<th align="center">Nome</th>';
		echo '<th align="center">Email</th>';
		echo '<th align="center">Data Nascimento</th>';
		echo '<th>CPF</th>';
		echo '<th>Endereco</th>';
		echo '<th>CEP</th>';
		echo '</tr></thead>';
	
		echo '<tbody>';
		while($aux = mysqli_fetch_assoc($sql)) { 
			echo '<tr>';
			echo '<td>'.$aux["nome"].'</td>';
			echo '<td>'.$aux["email"].'</td>';
			echo '<td>'.$aux["datanasc"].'</td>';
			echo '<td>'.$aux["cpf"].'</td>';
			echo '<td>'.$aux["endereco"].'</td>';
			echo '<td>'.$aux["cep"].'</td>';
			
			$redirecionador='localizacao.php?endereco='.$aux["endereco"];
			
			$redirecionador_junto = str_replace(" ", "", $redirecionador);
			echo '<td><a href='.$redirecionador_junto.'>Localizar</a></td>';
			//echo '<div onclick="mobile.changePage(....)" >click here</div>';
			echo '</tr>';
		}
		mysqli_close($conexao);
		echo '<tr>';
		//echo '<td>'.'redirecionador_calcular_rota'.'</td>';
		echo '</tbody></table>';
		echo '<strong>'.'Cacular melhor rota partindo de <font color="#FF0000">Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina</font></strong>';
		?>
		<button onclick='location.href="melhorrota.php?endereco_thiago="' type="button">Calcular</button>
	<?php } ?>
</div>
</body>
</html>
<!-- SMARV Informática Marvin (91)98156-5857-->
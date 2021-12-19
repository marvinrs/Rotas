<!DOCTYPE html>
<html>
  <head>
    <title>Geolocalização</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	</head>
  <body>
  <?php
  include "crud/conexao.php";
  //Parsear: Essa rotina faz a consulta do CSV e printa na tela.
  $row = 1;
  if (($handle = fopen("endereco.csv", "r")) !== FALSE) {
	  while (($dados = fgetcsv($handle, 1000, ";")) !== FALSE) {
		  $num = count($dados);
		  echo "<p>";
		  echo "<p> $num campos na linha $row: <br /></p>\n";
		  $row++;
		  for ($c=0; $c < $num; $c++) {
			  echo $dados[$c] . "<br />\n";
			  }
		}
	fclose($handle);
   }
   //Criar Base de dados
   $nome_base="geo";
   $sql_base_de_dados = 'CREATE DATABASE '.$nome_base;
   if ($conexao->query($sql_base_de_dados) === TRUE) {
	echo "Base de dados criada com sucesso.";
	mysqli_select_db($conexao, $nome_base);
   } else {
    echo "Erro criando base de dados: " . $conexao->error;
   }
   
   //Criar a tabela na base de dados MySQL
   
   $sql = "CREATE TABLE cadastro (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   nome VARCHAR(30) NOT NULL,
   email VARCHAR(30) NOT NULL,
   datanasc DATE,
   cpf VARCHAR(11) NOT NULL,
   endereco VARCHAR(70) NOT NULL
   )";

   if ($conexao->query($sql) === TRUE) {
     echo "Tabela Cadastro criada com sucesso";
   } else {
     echo "Erro criando tabela: " . $conexao->error; 
   }
   ?>
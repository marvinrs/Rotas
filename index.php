<?php
  include "crud/conexao.php";
  
   //Criar Base de dados
   $nome_base="geo";
   $sql_base_de_dados = 'CREATE DATABASE IF NOT EXISTS '.$nome_base;
    if ($conexao->query($sql_base_de_dados) === TRUE) {
	echo "Base de dados criada com sucesso.";
   } else {
    echo "Erro criando base de dados: " . $conexao->error;
   }
   mysqli_select_db($conexao, $nome_base);
   
   //Criar a tabela na base de dados MySQL
   
   $sql = "CREATE TABLE IF NOT EXISTS cadastro (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   nome VARCHAR(30) NOT NULL,
   email VARCHAR(30) NOT NULL,
   datanasc DATE,
   cpf VARCHAR(11) NOT NULL,
   endereco VARCHAR(70) NOT NULL,
   cep VARCHAR (9) NOT NULL,
   CONSTRAINT UC_cadastro UNIQUE (nome,email,datanasc,cpf,endereco,cep)
   )";

   if ($conexao->query($sql) === TRUE) {
     echo "Tabela Cadastro criada com sucesso";
   } else {
     echo "Erro criando tabela: " . $conexao->error; 
   }

   //Parsear: Essa rotina faz a consulta do CSV e printa na tela.

   $row = 1;
  if (($handle = fopen("endereco.csv", "r")) !== FALSE) {
	  while (($dados = fgetcsv($handle, 1000, ";")) !== FALSE) {
      if ($row!=1) {
        //$num = count($dados);
        echo "</br>";
        echo $dados[0]." ";
        echo $dados[1]." ";
        echo $dados[2]." ";
        echo $dados[3]." ";
        echo $dados[4]." ";
        echo $dados[5];
        echo "</br>";
        //tira caracteres especiais do CPF
        $cpf_transformado=limpaCPF($dados[3]);
        //transforma data do CSV para o formato DATE do SQL
        echo $data_transformada = implode("-",array_reverse(explode("/",$dados[2])));
        //$inclui="INSERT INTO cadastro(nome, email, datanasc, cpf, endereco, cep) VALUES ('$dados[0]','$dados[1]', '$data_transformada', '$cpf_transformado', '$dados[4]', '$dados[5]')";
        $inclui = "INSERT INTO cadastro(nome, email, datanasc, cpf, endereco, cep) 
          SELECT '$dados[0]', '$dados[1]', '$data_transformada', '$cpf_transformado', '$dados[4]', '$dados[5]'
          FROM DUAL
          WHERE NOT EXISTS(SELECT nome FROM cadastro WHERE nome = '$dados[0]')";
        echo $inclui;
        $sucesso=mysqli_query($conexao,$inclui) or die(mysqli_error($conexao));
      }
      $row++;
          }
	fclose($handle);
   }


function limpaCPF($valor){
  $valor = trim($valor);
  $valor = str_replace(".", "", $valor);
  $valor = str_replace(",", "", $valor);
  $valor = str_replace("-", "", $valor);
  $valor = str_replace("/", "", $valor);
  return $valor;
}

?>
<script>
  window.location.replace("http://localhost/geo/cadastros.php");
</script>
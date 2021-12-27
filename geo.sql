-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Dez-2021 às 19:21
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `geo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(6) UNSIGNED NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `datanasc` date DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` varchar(70) NOT NULL,
  `cep` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `email`, `datanasc`, `cpf`, `endereco`, `cep`) VALUES
(3, 'André', 'andre@uello.com.br', '1988-05-11', '98765432109', 'Rua José Monteiro, 303 - Brás - São Paulo', '03052-010'),
(4, 'Fernando Sartori', 'fernando.sartori@uello.com.br', '1975-03-11', '98765432109', 'Rua Ipanema, 686 Conj 1 - Brás - São Paulo', '03164-200'),
(2, 'Marcelo Cerqueira', 'marcelo.cerqueira@uello.com.br', '1952-07-11', '98765432109', 'Rua Itajaí, 125 Ap 1234 - Mooca - São Paulo', '03162-060'),
(1, 'thiago', 'thiago@uello.com.br', '1911-11-11', '12345678901', 'R Almirante Brasil, 685 - Mooca - São Paulo', '03162-010');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_cadastro` (`nome`,`email`,`datanasc`,`cpf`,`endereco`,`cep`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

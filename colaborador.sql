-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 25/08/2021 às 15:17
-- Versão do servidor: 5.7.32
-- Versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `colaborador`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaborador`
--

CREATE TABLE `colaborador` (
  `id_colaborador` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(9) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `colaborador`
--

INSERT INTO `colaborador` (`id_colaborador`, `nome`, `cpf`, `rg`, `datanascimento`, `cep`, `endereco`, `numero`, `cidade`, `estado`, `email`) VALUES
(1, 'Paulo', '08734421876', '108876654', '1995-08-08', '24110-002', 'rua benjamin constant', 55, 'Niterói', 'Rio de Janeiro', 'teste@teste.com.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `salario`
--

CREATE TABLE `salario` (
  `id_salario` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `salario` decimal(10,0) DEFAULT NULL,
  `data_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `salario`
--

INSERT INTO `salario` (`id_salario`, `id_colaborador`, `salario`, `data_inicio`) VALUES
(1, 1, '8000', '2021-08-25 11:37:23'),
(2, 1, '10000', '2021-08-25 11:37:43');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`id_colaborador`);

--
-- Índices de tabela `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`id_salario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `id_colaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `salario`
--
ALTER TABLE `salario`
  MODIFY `id_salario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

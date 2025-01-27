-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/01/2025 às 20:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Estoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Clientes`
--

CREATE TABLE `Clientes` (
  `idCliente` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `CPF/CNPJ` varchar(14) NOT NULL,
  `Contato` varchar(14) NOT NULL,
  `Endereco` varchar(60) NOT NULL,
  `Numero` int(11) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Complemento` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Produto`
--

CREATE TABLE `Produto` (
  `id` int(11) NOT NULL,
  `Produto` varchar(60) NOT NULL,
  `Tipo` enum('SACO','CAIXA') NOT NULL,
  `Kg` double NOT NULL,
  `Valor_Comprado` double NOT NULL,
  `Valor_Vender` double NOT NULL,
  `Porcentagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Produto`
--

INSERT INTO `Produto` (`id`, `Produto`, `Tipo`, `Kg`, `Valor_Comprado`, `Valor_Vender`, `Porcentagem`) VALUES
(1, 'Batata', 'SACO', 24, 142.29, 184.977, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL,
  `Usuario` varchar(60) NOT NULL,
  `Senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Usuario`
--

INSERT INTO `Usuario` (`id`, `Usuario`, `Senha`) VALUES
(9, '123', '$2y$10$zuPiLRPB8M.169Zg2O6Kwew8SHZegbGGzi0Gu4.jgDrDeWtgD0T0q'),
(10, 'Kleriston', '$2y$10$PuqiRMoNfi4iTTm.hckJwO5rmksQjklw/0P8sfi5jePiU00HXEbIS'),
(11, 'Thigas', '$2y$10$HVhr7VHjehjyj.vzRrHYYekGQlIJfEJ77fmzu3DKd76SQIn6taVqy');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices de tabela `Produto`
--
ALTER TABLE `Produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Produto`
--
ALTER TABLE `Produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

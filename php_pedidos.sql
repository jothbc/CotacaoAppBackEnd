-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Abr-2020 às 21:08
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `php_pedidos`
--
CREATE DATABASE IF NOT EXISTS `php_pedidos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_pedidos`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `cnpj` int(11) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `tel_2` varchar(50) DEFAULT NULL,
  `ultimo_pedido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `pass`, `company_name`, `cnpj`, `tel`, `tel_2`, `ultimo_pedido`) VALUES
(1, 'adm.supercorreia@gmail.com', '4644', 'Supermercado Correia', 2147483647, '33666407', NULL, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotacao_cliente_info`
--

CREATE TABLE `cotacao_cliente_info` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cotacao_cliente_info`
--

INSERT INTO `cotacao_cliente_info` (`id`, `cliente_id`, `pedido`, `status`) VALUES
(4, 1, 1, 1),
(5, 1, 2, 1),
(6, 1, 3, 1),
(7, 1, 4, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cotacao_cliente_info`
--
ALTER TABLE `cotacao_cliente_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cotacao_cliente_info`
--
ALTER TABLE `cotacao_cliente_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

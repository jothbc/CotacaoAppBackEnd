-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Abr-2020 às 22:10
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
(1, 'adm.supercorreia@gmail.com', '4644', 'Supermercado Correia', 2147483647, '33666407', NULL, 6);

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
(6, 1, 3, 1),
(8, 1, 5, 1),
(9, 1, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotacao_cliente_lista`
--

CREATE TABLE `cotacao_cliente_lista` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `descricao`) VALUES
(1, 'amaciante downy 500ml'),
(2, 'sabao em po tixan cx 1kg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_pedido`
--

CREATE TABLE `status_pedido` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `status_pedido`
--

INSERT INTO `status_pedido` (`id`, `descricao`) VALUES
(0, 'Fechado'),
(1, 'Aberto');

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
-- Índices para tabela `cotacao_cliente_lista`
--
ALTER TABLE `cotacao_cliente_lista`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `status_pedido`
--
ALTER TABLE `status_pedido`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `cotacao_cliente_lista`
--
ALTER TABLE `cotacao_cliente_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

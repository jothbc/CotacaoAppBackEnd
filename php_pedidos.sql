-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Abr-2020 às 20:58
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
  `cnpj` bigint(20) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `tel_2` varchar(50) DEFAULT NULL,
  `ultimo_pedido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `pass`, `company_name`, `cnpj`, `tel`, `tel_2`, `ultimo_pedido`) VALUES
(1, 'adm.supercorreia@gmail.com', '4644', 'Supermercado Correia', 20555189000196, '33666407', NULL, 6),
(3, 'jothbc@gmail.com', '5662', 'JCR', 123456789, '+5547997432978', NULL, 0);

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
(4, 1, 1, 0),
(6, 1, 3, 0),
(8, 1, 5, 1);

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

--
-- Extraindo dados da tabela `cotacao_cliente_lista`
--

INSERT INTO `cotacao_cliente_lista` (`id`, `cliente_id`, `pedido_id`, `produto_id`) VALUES
(11, 1, 5, 1),
(25, 1, 5, 2),
(26, 1, 5, 2),
(30, 1, 5, 12),
(31, 1, 5, 13),
(32, 1, 5, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotacao_fornecedor_lista`
--

CREATE TABLE `cotacao_fornecedor_lista` (
  `id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `aprovado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cotacao_fornecedor_lista`
--

INSERT INTO `cotacao_fornecedor_lista` (`id`, `fornecedor_id`, `pedido_id`, `cliente_id`, `produto_id`, `valor`, `aprovado`) VALUES
(16, 1, 5, 1, 1, 1, 0),
(17, 1, 5, 1, 2, 2, 0),
(18, 1, 5, 1, 12, 3, 0),
(19, 1, 5, 1, 13, 4.5, 0),
(20, 1, 5, 1, 14, 5.71, 0),
(21, 2, 5, 1, 2, 20.79, 0),
(22, 2, 5, 1, 12, 13.99, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `cnpj` bigint(20) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `tel_2` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `email`, `pass`, `company_name`, `cnpj`, `tel`, `tel_2`) VALUES
(1, 'jothbc@gmail.com', '5662', 'JCR', 123456789, '+5547997432978', NULL),
(2, 'adm.supercorreia@gmail.com', '4644', 'Supermercado Correia', 20555189000196, '33666407', NULL);

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
(2, 'sabao em po tixan cx 1kg'),
(3, 'milho verde ole vidro 280g'),
(6, 'um teste para um novo produto'),
(7, 'dashjjkasdjdasad'),
(8, 'asdasasdads'),
(9, 'macarrão parati  parafuso 500g'),
(10, 'mais items do que cabe'),
(11, 'tempero pra carne'),
(12, 'Requeijão Tirol 200g'),
(13, 'Milho verde quero lata 320g'),
(14, 'Palmito tolete 540g');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste`
--

CREATE TABLE `teste` (
  `id` int(11) NOT NULL,
  `campo1` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`id`, `campo1`) VALUES
(1, '1'),
(2, '1'),
(3, 'Array'),
(4, NULL),
(5, NULL),
(6, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

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
-- Índices para tabela `cotacao_fornecedor_lista`
--
ALTER TABLE `cotacao_fornecedor_lista`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Índices para tabela `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cotacao_cliente_info`
--
ALTER TABLE `cotacao_cliente_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cotacao_cliente_lista`
--
ALTER TABLE `cotacao_cliente_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `cotacao_fornecedor_lista`
--
ALTER TABLE `cotacao_fornecedor_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `teste`
--
ALTER TABLE `teste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Nov-2018 às 19:56
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emporiodovinho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `condicao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`, `descricao`, `condicao`) VALUES
(2, 'Refrigerante', NULL, 1),
(3, 'Cerveja', NULL, 1),
(4, 'Vinho', NULL, 1),
(5, 'Cachaça', NULL, 1),
(6, 'Alimentos', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_doc` varchar(30) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `tipo_documento`, `num_doc`, `telefone`, `email`, `status`) VALUES
(0, 'venda avulsa', NULL, NULL, NULL, NULL, ''),
(14, 'Francisco da Silva', 'CPF', '112.312.313-13', '(11) 21321-3122', NULL, 'Ativo'),
(15, 'Maria das Dores', 'CPF', '556.564.654-65', '(11) 95846-5646', 'maria@gmail.com', 'Ativo'),
(16, 'Mario de Andrade', 'CPF', '555.887.978-49', '(21) 97874-6546', 'mario@gmail.com', 'Ativo'),
(17, 'Cristiano da Silva', 'CPF', '555.132.131-23', '(11) 32121-2133', 'cristiano123@gmail.com', 'Ativo'),
(18, 'Daniela dos Santos', 'CPF', '554.613.131-32', '(11) 22313-2123', 'danielasantos@gmail.com', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhe_entrada`
--

CREATE TABLE `detalhe_entrada` (
  `id_detalhe_entrada` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhe_entrada`
--

INSERT INTO `detalhe_entrada` (`id_detalhe_entrada`, `id_entrada`, `id_produto`, `quantidade`, `preco_compra`, `preco_venda`) VALUES
(36, 35, 14, 200, '5.00', '7.00'),
(37, 35, 16, 500, '2.50', '5.50'),
(38, 36, 17, 500, '2.50', '4.50'),
(39, 37, 15, 500, '2.50', '4.50'),
(40, 38, 16, 1000, '5.00', '6.00'),
(41, 39, 18, 200, '2.50', '3.00'),
(42, 40, 19, 500, '3.60', '4.50'),
(43, 41, 20, 500, '2.50', '10.00'),
(44, 42, 21, 1000, '4.00', '6.00'),
(45, 43, 22, 300, '5.50', '9.00'),
(46, 44, 14, 500, '4.00', '6.00'),
(47, 45, 23, 500, '5.00', '8.00'),
(48, 46, 24, 100, '25.00', '30.00'),
(49, 47, 25, 200, '20.00', '30.00'),
(50, 48, 26, 500, '12.00', '30.00'),
(51, 49, 27, 300, '2.10', '4.00'),
(52, 50, 28, 200, '5.00', '8.00');

--
-- Acionadores `detalhe_entrada`
--
DELIMITER $$
CREATE TRIGGER `tr_updEstoqueEntrada` AFTER INSERT ON `detalhe_entrada` FOR EACH ROW BEGIN
UPDATE produto SET estoque = estoque + NEW.quantidade, preco_compra = NEW.preco_compra, preco_venda = NEW.preco_venda
WHERE produto.id_produto = NEW.id_produto;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhe_saida`
--

CREATE TABLE `detalhe_saida` (
  `id_detalhe_saida` int(11) NOT NULL,
  `id_saida` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Acionadores `detalhe_saida`
--
DELIMITER $$
CREATE TRIGGER `tr_updEstoqueSaida` AFTER INSERT ON `detalhe_saida` FOR EACH ROW BEGIN 
update produto set estoque = estoque - NEW.quantidade
where produto.id_produto = NEW.id_produto;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhe_venda`
--

CREATE TABLE `detalhe_venda` (
  `id_detalhe_venda` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `desconto` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhe_venda`
--

INSERT INTO `detalhe_venda` (`id_detalhe_venda`, `id_venda`, `id_produto`, `quantidade`, `preco_venda`, `desconto`) VALUES
(46, 51, 14, 100, '6.00', '0.00'),
(47, 52, 15, 200, '4.50', '0.00'),
(48, 53, 15, 100, '4.50', '0.00'),
(49, 54, 14, 200, '6.00', '0.00'),
(50, 55, 14, 133, '6.00', '0.00'),
(51, 56, 19, 200, '4.50', '0.00'),
(52, 57, 21, 210, '6.00', '0.00'),
(53, 58, 23, 200, '8.00', '0.00'),
(54, 59, 20, 100, '10.00', '0.00'),
(55, 60, 21, 150, '6.00', '0.00'),
(56, 61, 22, 100, '9.00', '0.00'),
(57, 62, 14, 266, '6.00', '0.00'),
(58, 63, 19, 150, '4.50', '0.00'),
(59, 64, 23, 111, '8.00', '0.00'),
(60, 65, 15, 2, '4.50', '0.00');

--
-- Acionadores `detalhe_venda`
--
DELIMITER $$
CREATE TRIGGER `tr_updEstoqueVenda` AFTER INSERT ON `detalhe_venda` FOR EACH ROW BEGIN update produto SET estoque = estoque - NEW.quantidade
WHERE produto.id_produto = new.id_produto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `tipo_pagamento` varchar(45) DEFAULT NULL,
  `data_hora` datetime NOT NULL,
  `total_entrada` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_fornecedor`, `tipo_pagamento`, `data_hora`, `total_entrada`) VALUES
(35, 13, 'dinheiro', '2018-10-09 15:52:50', '2250.00'),
(36, 14, 'dinheiro', '2018-10-09 15:53:27', '1250.00'),
(37, 15, 'dinheiro', '2018-09-09 15:53:48', '1250.00'),
(38, 15, 'dinheiro', '2018-09-09 15:54:11', '5000.00'),
(39, 16, 'dinheiro', '2018-11-09 15:54:32', '500.00'),
(40, 13, 'dinheiro', '2018-11-09 15:54:49', '1800.00'),
(41, 15, 'dinheiro', '2018-11-09 15:55:18', '1250.00'),
(42, 13, 'dinheiro', '2018-11-09 15:55:36', '4000.00'),
(43, 13, 'dinheiro', '2018-11-09 15:55:54', '1650.00'),
(44, 15, 'dinheiro', '2018-11-09 15:56:39', '2000.00'),
(45, 13, 'dinheiro', '2018-11-09 15:57:04', '2500.00'),
(46, 13, 'dinheiro', '2018-11-09 16:06:44', '2500.00'),
(47, 13, 'dinheiro', '2018-11-09 16:07:03', '4000.00'),
(48, 13, 'dinheiro', '2018-11-09 16:07:23', '6000.00'),
(49, 13, 'dinheiro', '2018-11-09 16:07:50', '630.00'),
(50, 13, 'dinheiro', '2018-11-09 16:09:11', '1000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_doc` varchar(30) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `complemento` varchar(30) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `tipo_documento`, `num_doc`, `endereco`, `cep`, `numero`, `bairro`, `cidade`, `estado`, `complemento`, `telefone`, `email`, `status`) VALUES
(13, 'Francisco Teixeira', 'CPF', '556.541.321-32', 'Rua São Francisco', '08753-231', '55', 'Tiradentes', 'Tiradentes', 'SP', NULL, '(11) 56451-2133', NULL, 'Ativo'),
(14, 'Pedro Miguel', 'CPF', '884.641.313-21', 'Rua São Miguel', '07713-010', '55', 'Mooca', 'São Paulo', 'SP', NULL, '(55) 13133-1321', 'pedro@gmail.com', 'Ativo'),
(15, 'Paula da Silva Oliveira', 'CPF', '551.313.213-21', 'Rua das flores', '07613-123', '554', 'Serpa', 'Caieiras', 'SP', NULL, '(55) 13212-3132', 'paulasilva@hotmail.com', 'Ativo'),
(16, 'Teobaldo Flores', 'CPF', '223.213.213-21', 'rua santa barbara', '05513-210', '54', 'Vila ramos', 'Jundiai', 'SP', NULL, '(22) 51312-3123', 'teobaldo@gmail.com', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT '0',
  `estoque_minimo` int(11) NOT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `descricao` varchar(512) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_categoria`, `codigo`, `nome`, `estoque`, `estoque_minimo`, `preco_compra`, `preco_venda`, `descricao`, `status`) VALUES
(14, 3, '01', 'Cerveja skol 269ml', 1, 10, '4.00', '6.00', NULL, 'Ativo'),
(15, 3, '02', 'Cerveja Itaipava 269ml', 198, 10, '2.50', '4.50', NULL, 'Ativo'),
(16, 3, '03', 'Cerveja brahma 600ml', 1500, 10, '5.00', '6.00', NULL, 'Ativo'),
(17, 3, '04', 'Cerveja heineken 250ml', 500, 10, '2.50', '4.50', NULL, 'Ativo'),
(18, 2, '010', 'Refrigerante coca cola 600ml', 200, 10, '2.50', '3.00', NULL, 'Ativo'),
(19, 2, '020', 'Refrigerante pepsi cola 600ml', 150, 10, '3.60', '4.50', NULL, 'Ativo'),
(20, 6, '021', 'Queijo meia cura', 400, 10, '2.50', '10.00', NULL, 'Ativo'),
(21, 5, '033', 'Cachaça lua cheia 600ml', 640, 5, '4.00', '6.00', NULL, 'Ativo'),
(22, 4, '050', 'Vinho JP Chenet Cabernet Syrah', 200, 5, '5.50', '9.00', NULL, 'Ativo'),
(23, 4, '077', 'Vinho Piscine Rose', 189, 10, '5.00', '8.00', NULL, 'Ativo'),
(24, 4, '088', 'Vinho do Porto Ferreira Ruby 750ml', 100, 10, '25.00', '30.00', NULL, 'Ativo'),
(25, 4, '099', 'Vinho Chilano Cabernet Sauvignon', 200, 15, '20.00', '30.00', NULL, 'Ativo'),
(26, 2, '101', 'Vinho Yellow Tail Shiraz', 500, 15, '12.00', '30.00', NULL, 'Ativo'),
(27, 3, '105', 'Cerveja Corona Extra Long Neck 355ml', 300, 20, '2.10', '4.00', NULL, 'Ativo'),
(28, 3, '401', 'Cerveja Therezopolis Gold 355ml', 200, 10, '5.00', '8.00', NULL, 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida`
--

CREATE TABLE `saida` (
  `id_saida` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$3q5tSo4hTbxiClTVBpjeee1a/EOmpRzj6OsISnyvkRcAbM4DR111a', 'ehXniNlaZxVginSNRhnwRyAinIChzBSYbey3OaqdI29UfcEKbh4WNceaKIdQ', '2018-09-01 00:41:39', '2018-09-01 00:41:39'),
(3, 'paula', 'paula@gmail.com', '$2y$10$YAoQ6izbSLIIJF70ZmMMA.Vop0.3JLZvTPHrJuXWyFQriCi12tcGe', NULL, '2018-09-01 15:21:10', '2018-09-01 15:34:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo_pagamento` varchar(45) DEFAULT NULL,
  `data_hora` datetime NOT NULL,
  `total_venda` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id_venda`, `id_cliente`, `tipo_pagamento`, `data_hora`, `total_venda`) VALUES
(51, 0, 'dinheiro', '2018-10-09 16:00:51', '600.00'),
(52, 0, 'dinheiro', '2018-11-09 16:01:22', '900.00'),
(53, 14, 'dinheiro', '2018-11-09 16:01:45', '450.00'),
(54, 0, 'dinheiro', '2018-09-09 16:02:07', '1200.00'),
(55, 0, 'dinheiro', '2018-09-09 16:02:29', '798.00'),
(56, 0, 'dinheiro', '2018-09-09 16:02:48', '900.00'),
(57, 0, 'dinheiro', '2018-11-09 16:03:09', '1260.00'),
(58, 0, 'dinheiro', '2018-11-09 16:03:29', '1600.00'),
(59, 0, 'dinheiro', '2018-11-09 16:03:51', '1000.00'),
(60, 0, 'dinheiro', '2018-11-09 16:04:13', '900.00'),
(61, 0, 'dinheiro', '2018-11-09 16:04:48', '900.00'),
(62, 0, 'dinheiro', '2018-11-09 16:09:50', '1596.00'),
(63, 0, 'dinheiro', '2018-11-09 16:18:11', '675.00'),
(64, 0, 'dinheiro', '2018-11-09 16:18:34', '888.00'),
(65, 0, 'dinheiro', '2018-11-09 16:19:19', '9.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `detalhe_entrada`
--
ALTER TABLE `detalhe_entrada`
  ADD PRIMARY KEY (`id_detalhe_entrada`),
  ADD KEY `fk_detalhe_entrada_idx` (`id_entrada`),
  ADD KEY `fk_detalhe_produto_idx` (`id_produto`);

--
-- Indexes for table `detalhe_saida`
--
ALTER TABLE `detalhe_saida`
  ADD PRIMARY KEY (`id_detalhe_saida`),
  ADD KEY `fk_detalhe_saida_idx` (`id_saida`),
  ADD KEY `fk_detalhe_produto_saida_idx` (`id_produto`);

--
-- Indexes for table `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  ADD PRIMARY KEY (`id_detalhe_venda`),
  ADD KEY `fk_detalhe_venda_idx` (`id_venda`),
  ADD KEY `fk_detalhe_produto_idx` (`id_produto`);

--
-- Indexes for table `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entrada_fornecedor_idx` (`id_fornecedor`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produto_categoria_idx` (`id_categoria`);

--
-- Indexes for table `saida`
--
ALTER TABLE `saida`
  ADD PRIMARY KEY (`id_saida`),
  ADD KEY `fk_saida_usuario_idx` (`id_usuario`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `fk_venda_cliente_idx` (`id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detalhe_entrada`
--
ALTER TABLE `detalhe_entrada`
  MODIFY `id_detalhe_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `detalhe_saida`
--
ALTER TABLE `detalhe_saida`
  MODIFY `id_detalhe_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  MODIFY `id_detalhe_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `saida`
--
ALTER TABLE `saida`
  MODIFY `id_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_entrada_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `saida`
--
ALTER TABLE `saida`
  ADD CONSTRAINT `fk_saida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

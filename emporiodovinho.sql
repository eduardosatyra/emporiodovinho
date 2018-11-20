-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Nov-2018 às 18:28
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
  `condicao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`, `condicao`) VALUES
(2, 'Refrigerante', 1),
(3, 'Cerveja', 1),
(5, 'Cachaça', 1),
(6, 'Alimentos', 1),
(9, 'Água', 1),
(46, 'Vinho', 1);

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
(23, 'Francisco dos Santos', 'CPF', '132.132.132-13', '(11) 98547-5211', 'francisco@gmail.com', 'Ativo'),
(24, 'João Ferreira Alves', 'CPF', '361.313.212-13', '(11) 95781-2332', NULL, 'Inativo'),
(25, 'Maria dos Santos Silva', 'CPF', '985.214.521-25', '(11) 98555-2412', 'maria_santos@gmail.com', 'Ativo'),
(26, 'Pedro Alves da Silva', 'CPF', '365.225.122-31', '(11) 98754-2122', 'pedroalves@hotmail.com', 'Ativo'),
(27, 'Rafael do Nascimento', 'CPF', '365.211.325-56', '(11) 95785-4212', 'rafael_nascimento@hotmail.com', 'Ativo'),
(28, 'Juliana Ferreira dos Santos', 'CPF', '366.131.321-32', '(11) 98544-2211', 'juliana_santos@yahoo.com.br', 'Ativo'),
(29, 'Humberto Macieira', 'CPF', '988.555.132-14', '(11) 95784-1321', 'humberto1992@gmail.com', 'Ativo'),
(30, 'Maria de Lourdes Silveira', 'CPF', '955.612.113-21', '(11) 89413-1321', 'maria_lourdes@hotmail.com', 'Ativo'),
(31, 'Francisca Oliveira Matos', 'CPF', '132.231.231-32', '(11) 96655-6123', 'francisca_oliveira@hotmail.com', 'Ativo'),
(32, 'Samuel Nascimento da Silva', 'CPF', '365.631.312-13', '(11) 98551-2312', 'samuel_nascimento@hotmail.com', 'Ativo'),
(33, 'Fernanda Oliveira', 'CPF', '361.132.132-13', '(11) 96655-5221', 'fernanda_oliveira@gmail.com', 'Ativo'),
(34, 'Eliana Pinheiro da Silva', 'CPF', '361.312.231-23', '(11) 96552-2551', 'eliana_pinheiro@hotmail.com', 'Ativo');

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
(56, 54, 47, 100, '4.69', '5.70'),
(57, 55, 48, 200, '3.50', '4.50'),
(58, 56, 49, 50, '5.50', '7.00'),
(59, 57, 50, 70, '4.00', '5.00'),
(60, 58, 51, 50, '2.00', '2.50'),
(61, 59, 53, 100, '2.75', '3.50'),
(62, 60, 54, 120, '2.55', '3.55'),
(63, 61, 55, 80, '2.50', '3.50'),
(64, 62, 56, 120, '2.50', '3.50'),
(65, 63, 57, 120, '3.00', '4.50'),
(66, 64, 58, 100, '7.00', '9.00'),
(67, 65, 59, 50, '14.90', '20.00'),
(68, 66, 60, 50, '32.00', '42.00'),
(69, 67, 61, 40, '23.90', '32.00'),
(70, 68, 46, 30, '24.90', '35.00'),
(71, 69, 63, 20, '29.10', '35.00'),
(72, 69, 64, 30, '25.00', '35.00'),
(73, 69, 65, 30, '35.00', '45.00'),
(74, 70, 66, 30, '23.90', '30.00'),
(75, 70, 67, 20, '55.00', '65.00'),
(76, 70, 68, 10, '39.90', '50.00'),
(77, 71, 46, 100, '4.00', '5.00');

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
  `desconto` decimal(9,2) DEFAULT NULL,
  `faturamento` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhe_venda`
--

INSERT INTO `detalhe_venda` (`id_detalhe_venda`, `id_venda`, `id_produto`, `quantidade`, `preco_venda`, `desconto`, `faturamento`) VALUES
(73, 79, 47, 20, '5.70', '2.00', '112.00'),
(74, 80, 48, 10, '4.50', '0.00', '45.00'),
(75, 81, 57, 2, '4.50', '1.00', '8.00'),
(76, 81, 58, 1, '9.00', '0.00', '9.00'),
(77, 82, 59, 1, '20.00', '0.00', '20.00'),
(78, 83, 65, 1, '45.00', '5.00', '40.00'),
(79, 83, 66, 2, '30.00', '0.00', '60.00'),
(80, 84, 68, 2, '50.00', '0.00', '100.00'),
(81, 85, 63, 2, '35.00', '0.00', '70.00'),
(82, 85, 56, 10, '3.50', '0.00', '35.00'),
(83, 86, 59, 3, '20.00', '0.00', '60.00'),
(84, 86, 54, 13, '3.55', '0.00', '46.15'),
(85, 86, 64, 2, '35.00', '0.00', '70.00'),
(86, 87, 49, 3, '7.00', '0.00', '21.00'),
(87, 88, 48, 4, '4.50', '0.00', '18.00'),
(88, 88, 58, 4, '9.00', '0.00', '36.00'),
(89, 88, 59, 4, '20.00', '0.00', '80.00'),
(90, 89, 47, 7, '5.70', '0.00', '39.90'),
(91, 90, 53, 8, '3.50', '0.00', '28.00');

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
(54, 19, 'dinheiro', '2018-11-20 14:53:06', '469.00'),
(55, 21, 'dinheiro', '2018-11-20 14:53:38', '700.00'),
(56, 22, 'dinheiro', '2018-11-20 14:54:14', '275.00'),
(57, 21, 'dinheiro', '2018-11-20 14:54:42', '280.00'),
(58, 18, 'dinheiro', '2018-11-20 14:55:38', '100.00'),
(59, 19, 'dinheiro', '2018-11-20 14:56:16', '275.00'),
(60, 21, 'dinheiro', '2018-11-20 14:58:52', '306.00'),
(61, 20, 'dinheiro', '2018-11-20 14:59:27', '200.00'),
(62, 18, 'dinheiro', '2018-11-20 14:59:55', '300.00'),
(63, 21, 'dinheiro', '2018-11-20 15:00:29', '360.00'),
(64, 19, 'dinheiro', '2018-11-20 15:01:05', '700.00'),
(65, 18, 'dinheiro', '2018-11-20 15:02:34', '745.00'),
(66, 22, 'dinheiro', '2018-11-20 15:03:31', '1600.00'),
(67, 18, 'dinheiro', '2018-11-20 15:04:29', '956.00'),
(68, 18, 'dinheiro', '2018-11-20 15:05:12', '747.00'),
(69, 18, 'dinheiro', '2018-11-20 15:06:55', '2382.00'),
(70, 20, 'dinheiro', '2018-11-20 15:10:13', '2216.00'),
(71, 18, 'dinheiro', '2018-11-20 15:16:45', '400.00');

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
(18, 'Pedro dos Santos Silveira', 'CNPJ', '26.613.213/2132-13', 'Rua das Oliveiras', '07712-000', '11', 'Jardim Oliveira', 'Perus', 'SP', NULL, '(11) 98855-8522', NULL, 'Ativo'),
(19, 'Francisco de Souza', 'CPF', '132.132.132-12', NULL, NULL, NULL, NULL, NULL, 'AC', NULL, '(11) 95613-2132', 'franciscosouza@gmail.com', 'Ativo'),
(20, 'Maria das Dores', 'CPF', '361.312.311-56', 'Rua das Flores', '07712-000', '22', 'Serpa', 'Francisco Morato', 'SP', NULL, '(11) 95541-1321', 'maria_d@gmail.com', 'Ativo'),
(21, 'Lucas da Silva', 'CPF', '366.613.132-13', NULL, NULL, NULL, NULL, NULL, 'AC', NULL, '(11) 95513-1321', 'lucas_silva@gmail.com', 'Ativo'),
(22, 'Flavio Silveira', 'CPF', '336.113.123-21', 'Rua Chagas de Azevedo', '07712-000', '33', 'Limão', 'São Paulo', 'SP', NULL, '(11) 99552-1321', 'flavio112@gmail.com', 'Ativo');

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
(46, 2, '01', 'Refrigerante Laranja Fanta Garrafa 3L', 100, 10, '4.00', '5.00', NULL, 'Ativo'),
(47, 2, '02', 'Refrigerante Cola Pepsi Twist Zero 2L', 73, 10, '4.69', '5.70', NULL, 'Ativo'),
(48, 2, '03', 'Fanta Guaraná 2 Litros', 186, 10, '3.50', '4.50', NULL, 'Ativo'),
(49, 2, '04', 'Coca-Cola 2 Litros', 47, 10, '5.50', '7.00', NULL, 'Ativo'),
(50, 2, '05', 'Refrigerante Kuat Guaraná 2 Litros', 70, 10, '4.00', '5.00', NULL, 'Ativo'),
(51, 9, '06', 'Água Tônica Dillar\'s Classic 1,5 Litros', 50, 10, '2.00', '2.50', NULL, 'Ativo'),
(52, 3, '07', 'Cerveja Heineken Premium Pilsen Lager 250ml', 0, 20, '4.50', '5.50', NULL, 'Ativo'),
(53, 3, '08', 'Cerveja Amstel Pilsen Lager 269ml', 92, 20, '2.75', '3.50', NULL, 'Ativo'),
(54, 3, '09', 'Cerveja Itaipava Lager 350ml', 107, 20, '2.55', '3.55', NULL, 'Ativo'),
(55, 3, '10', 'Cerveja Skol Pilsen Lager 350ml', 80, 20, '2.50', '3.50', NULL, 'Ativo'),
(56, 3, '11', 'Cerveja Brahma Pilsen Lager 350ml', 110, 20, '2.50', '3.50', NULL, 'Ativo'),
(57, 3, '12', 'Cerveja Budweiser Pilsen Lager 350ml', 118, 10, '3.00', '4.50', NULL, 'Ativo'),
(58, 3, '13', 'Cerveja Original Pale Lager 600ml', 95, 10, '7.00', '9.00', NULL, 'Ativo'),
(59, 46, '14', 'Vinho Tinto Suave Mioranza 750ml', 42, 10, '14.90', '20.00', NULL, 'Ativo'),
(60, 46, '15', 'Vinho Tinto Seco Concha y Toro 2015 Reservado Merlot 750ml', 50, 10, '32.00', '42.00', NULL, 'Ativo'),
(61, 46, '16', 'Vinho Branco Suave Linda Donna Lambrusco 750ml', 40, 10, '23.90', '32.00', NULL, 'Ativo'),
(62, 46, '17', 'Vinho Tinto Tronos Varietal Cabernet Sauvignon 750ml', 0, 10, '24.99', '30.00', NULL, 'Ativo'),
(63, 5, '18', 'Cachaça Salinas Tradicional', 18, 10, '29.10', '35.00', NULL, 'Ativo'),
(64, 5, '19', 'Cachaça Boazinha - 1000ml', 28, 10, '25.00', '35.00', NULL, 'Ativo'),
(65, 5, '20', 'Cachaça Dom Tápparo Amburana', 29, 10, '35.00', '45.00', NULL, 'Ativo'),
(66, 5, '21', 'Cachaça Cabaré Prata', 28, 10, '23.90', '30.00', NULL, 'Ativo'),
(67, 5, '22', 'Cachaça Coqueiro Envelhecida', 20, 10, '55.00', '65.00', NULL, 'Ativo'),
(68, 5, '24', 'Cachaça Vale Verde Prata', 8, 10, '39.90', '50.00', NULL, 'Ativo'),
(69, 5, '25', 'Cachaça Prazer de Minas Fina', 0, 10, '48.00', '65.00', NULL, 'Ativo'),
(70, 9, '26', 'Água Mineral sem Gás MINALBA Garrafa 1,5 Litros', 0, 10, '2.39', '3.00', NULL, 'Ativo');

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
(1, 'admin', 'admin@gmail.com', '$2y$10$3q5tSo4hTbxiClTVBpjeee1a/EOmpRzj6OsISnyvkRcAbM4DR111a', 'GYHXu43Kx7qFT0IIP1Ij7jUNSB047CDwN0bsrgLSOVVUYA6CaZbHfzJ7fO9Q', '2018-09-01 00:41:39', '2018-09-01 00:41:39'),
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
(79, 0, 'dinheiro', '2018-11-20 15:18:30', '112.00'),
(80, 0, 'dinheiro', '2018-11-20 15:19:13', '45.00'),
(81, 23, 'dinheiro', '2018-11-20 15:19:56', '17.00'),
(82, 0, 'dinheiro', '2018-11-20 15:20:41', '20.00'),
(83, 32, 'dinheiro', '2018-11-20 15:21:16', '100.00'),
(84, 0, 'dinheiro', '2018-11-20 15:22:10', '100.00'),
(85, 0, 'dinheiro', '2018-11-20 15:22:47', '105.00'),
(86, 0, 'dinheiro', '2018-11-20 15:23:33', '176.15'),
(87, 0, 'dinheiro', '2018-11-20 15:23:56', '21.00'),
(88, 0, 'dinheiro', '2018-11-20 15:24:33', '134.00'),
(89, 0, 'cartao-debito', '2018-11-20 15:25:15', '39.90'),
(90, 0, 'dinheiro', '2018-11-20 15:25:45', '28.00');

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `detalhe_entrada`
--
ALTER TABLE `detalhe_entrada`
  MODIFY `id_detalhe_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `detalhe_saida`
--
ALTER TABLE `detalhe_saida`
  MODIFY `id_detalhe_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  MODIFY `id_detalhe_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `saida`
--
ALTER TABLE `saida`
  MODIFY `id_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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

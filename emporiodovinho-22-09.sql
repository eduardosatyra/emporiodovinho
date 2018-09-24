-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Set-2018 às 19:23
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
(1, 'vinho', 'vinho seco', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `num_doc` varchar(30) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `tipo_documento`, `sexo`, `num_doc`, `endereco`, `telefone`, `email`, `status`) VALUES
(4, 'Paulo', 'CPF', 'Masculino', '36131397821', 'Rua Bauru', '46053021', 'paulo@gmail.com', 'Ativo'),
(5, 'teste', 'CPF', 'M', '36131397822', 'Caieiras', '22221222', 'teste@gmail.com', 'A');

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
(7, 1, 1, 15, '50.00', '75.00'),
(8, 2, 1, 10, '20.00', '40.00'),
(9, 3, 1, 5, '20.00', '30.00'),
(10, 4, 2, 30, '30.00', '40.00'),
(11, 5, 1, 10, '50.00', '100.00'),
(12, 6, 4, 10, '10.00', '20.00'),
(13, 7, 1, 10, '20.00', '30.00'),
(14, 7, 3, 20, '40.00', '100.00');

--
-- Acionadores `detalhe_entrada`
--
DELIMITER $$
CREATE TRIGGER `tr_updEstoqueEntrada` AFTER INSERT ON `detalhe_entrada` FOR EACH ROW BEGIN
UPDATE produto SET estoque = estoque + NEW.quantidade
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
-- Extraindo dados da tabela `detalhe_saida`
--

INSERT INTO `detalhe_saida` (`id_detalhe_saida`, `id_saida`, `id_produto`, `quantidade`, `motivo`) VALUES
(12, 7, 1, 10, 'teste'),
(13, 8, 3, 10, 'um'),
(14, 9, 3, 20, 'dadas'),
(15, 10, 1, 20, 'apenas um teste'),
(16, 10, 3, 50, 'outro teste'),
(17, 11, 1, 10, 'TESTE'),
(18, 12, 3, 2, 'da');

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
(1, 1, 1, 5, '50.00', '4.00'),
(2, 2, 2, 10, '30.00', NULL),
(3, 3, 2, 20, '30.00', NULL),
(4, 4, 2, 50, '30.00', NULL),
(5, 5, 1, 10, '30.00', NULL),
(6, 5, 3, 20, '30.00', NULL),
(7, 6, 1, 1, '30.00', NULL),
(8, 6, 2, 1, '30.00', NULL),
(9, 7, 1, 10, '30.00', '2.00'),
(10, 8, 3, 10, '30.00', NULL),
(11, 9, 3, 12, '30.00', NULL),
(12, 10, 4, 1, '50.00', NULL),
(13, 11, 4, 10, '50.00', NULL),
(14, 12, 3, 20, '30.00', '2.00'),
(15, 12, 1, 2, '30.00', '3.00'),
(16, 13, 3, 10, '30.00', NULL);

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
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_fornecedor`, `tipo_pagamento`, `data_hora`) VALUES
(5, 4, 'Dinheiro', '2018-09-02 14:58:25'),
(6, 4, 'Dinheiro', '2018-09-14 19:46:13'),
(7, 4, 'Dinheiro', '2018-09-23 13:29:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `num_doc` varchar(30) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `tipo_documento`, `sexo`, `num_doc`, `endereco`, `telefone`, `email`, `status`) VALUES
(4, 'george', 'CPF', 'Masculino', '36131397822', 'Rua das Flores', '46053021', 'george@gmail.com', 'Ativo'),
(5, 'Lucas', 'CPF', 'Masculino', '1231313131', 'Rua do pente', '222123112', 'lucas@gmail.com', 'Ativo');

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
  `estoque` int(11) NOT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `descricao` varchar(512) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_categoria`, `codigo`, `nome`, `estoque`, `preco_compra`, `preco_venda`, `descricao`, `estado`) VALUES
(1, 1, '01', 'vinho do porto', 2, '20.00', '30.00', 'vinho ruim demais', 'Ativo'),
(2, 1, '12', 'Vinho Seco', 19, '20.00', '30.00', 'vinho ruim demais', 'Ativo'),
(3, 1, '10', 'vinho de uva verde', 66, '10.00', '30.00', 'vinho gostoso', 'Ativo'),
(4, 1, '1020', 'cantinho do vale', 99, '10.00', '50.00', 'vinho barato', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida`
--

CREATE TABLE `saida` (
  `id_saida` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `saida`
--

INSERT INTO `saida` (`id_saida`, `id_usuario`, `data_hora`) VALUES
(6, 1, '2018-09-23 12:26:49'),
(7, 1, '2018-09-23 12:27:17'),
(8, 1, '2018-09-23 12:33:27'),
(9, 1, '2018-09-23 13:10:23'),
(10, 1, '2018-09-23 13:28:39'),
(11, 1, '2018-09-23 13:54:28'),
(12, 1, '2018-09-23 14:13:19');

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
(1, 'admin', 'admin@gmail.com', '$2y$10$3q5tSo4hTbxiClTVBpjeee1a/EOmpRzj6OsISnyvkRcAbM4DR111a', 'cWVWHIdpeNWO7Z0q6OwX0tZ5pYHFbPAxWBP9uqmhbeNBlh7B5WFv0Rtt5zOG', '2018-09-01 00:41:39', '2018-09-01 00:41:39'),
(3, 'paula', 'paula@gmail.com', '$2y$10$YAoQ6izbSLIIJF70ZmMMA.Vop0.3JLZvTPHrJuXWyFQriCi12tcGe', NULL, '2018-09-01 15:21:10', '2018-09-01 15:34:21'),
(4, 'faustao', 'faustao@gmail.com', '$2y$10$vK/haj7sJNgiDog6P1ofteEGakBxB1zRLevAeF2xfhSojUoXrZfxa', NULL, '2018-09-02 18:01:25', '2018-09-02 18:01:25');

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
(7, 4, 'Dinheiro', '2018-09-02 15:00:08', '298.00'),
(8, 4, 'Dinheiro', '2018-09-14 19:38:23', '300.00'),
(9, 4, 'Dinheiro', '2018-09-14 19:40:33', '360.00'),
(10, 4, 'Dinheiro', '2018-09-14 20:01:44', '50.00'),
(11, 4, 'Dinheiro', '2018-09-14 20:05:53', '500.00'),
(12, 4, 'Dinheiro', '2018-09-15 14:34:01', '660.00'),
(13, 4, 'Dinheiro', '2018-09-16 09:51:33', '300.00');

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detalhe_entrada`
--
ALTER TABLE `detalhe_entrada`
  MODIFY `id_detalhe_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detalhe_saida`
--
ALTER TABLE `detalhe_saida`
  MODIFY `id_detalhe_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  MODIFY `id_detalhe_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saida`
--
ALTER TABLE `saida`
  MODIFY `id_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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

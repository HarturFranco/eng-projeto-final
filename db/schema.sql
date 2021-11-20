-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 19-Nov-2021 às 22:45
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `toca_dos_instrumentos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Categoria`
--

CREATE TABLE `Categoria` (
  `catCodigo` int(11) NOT NULL,
  `catNome` varchar(50) NOT NULL,
  `catDescricao` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cliente`
--

CREATE TABLE `Cliente` (
  `cliCodigo` int(11) NOT NULL,
  `cliNome` varchar(50) NOT NULL,
  `cliCPF` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Funcionario`
--

CREATE TABLE `Funcionario` (
  `funCodigo` int(11) NOT NULL,
  `funNome` varchar(50) NOT NULL,
  `funEmail` varchar(320) NOT NULL,
  `funUsername` varchar(25) NOT NULL,
  `funSenha` varchar(25) NOT NULL,
  `funIsGerente` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Funcionario`
--

INSERT INTO `Funcionario` (`funCodigo`, `funNome`, `funEmail`, `funUsername`, `funSenha`, `funIsGerente`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ItemVenda`
--

CREATE TABLE `ItemVenda` (
  `itvProCodigo` int(11) NOT NULL,
  `itvVenCodigo` int(11) NOT NULL,
  `itvQtd` int(11) NOT NULL,
  `itvPreco` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Produto`
--

CREATE TABLE `Produto` (
  `proCodigo` int(11) NOT NULL,
  `proNome` varchar(150) NOT NULL,
  `proPreco` decimal(6,2) NOT NULL,
  `proQtdEstoque` int(11) NOT NULL,
  `proDataCadastro` date NOT NULL,
  `proDescricao` varchar(500) DEFAULT NULL,
  `Categoria_catCodigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Venda`
--

CREATE TABLE `Venda` (
  `venCodigo` int(11) NOT NULL,
  `venPrecoTotal` decimal(8,2) NOT NULL,
  `Funcionario_funCodigo` int(11) NOT NULL,
  `Cliente_cliCodigo` int(11) NOT NULL,
  `venStatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`catCodigo`);

--
-- Índices para tabela `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`cliCodigo`),
  ADD UNIQUE KEY `cliCPF_UNIQUE` (`cliCPF`);

--
-- Índices para tabela `Funcionario`
--
ALTER TABLE `Funcionario`
  ADD PRIMARY KEY (`funCodigo`);

--
-- Índices para tabela `ItemVenda`
--
ALTER TABLE `ItemVenda`
  ADD PRIMARY KEY (`itvProCodigo`,`itvVenCodigo`),
  ADD KEY `fk_Produto_has_Venda_Venda1_idx` (`itvVenCodigo`),
  ADD KEY `fk_Produto_has_Venda_Produto1_idx` (`itvProCodigo`);

--
-- Índices para tabela `Produto`
--
ALTER TABLE `Produto`
  ADD PRIMARY KEY (`proCodigo`),
  ADD KEY `fk_Produto_Categoria_idx` (`Categoria_catCodigo`);

--
-- Índices para tabela `Venda`
--
ALTER TABLE `Venda`
  ADD PRIMARY KEY (`venCodigo`,`Funcionario_funCodigo`,`Cliente_cliCodigo`),
  ADD KEY `fk_Venda_Funcionario1_idx` (`Funcionario_funCodigo`),
  ADD KEY `fk_Venda_Cliente1_idx` (`Cliente_cliCodigo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Cliente`
--
ALTER TABLE `Categoria`
  MODIFY `catCodigo` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de tabela `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `cliCodigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Funcionario`
--
ALTER TABLE `Funcionario`
  MODIFY `funCodigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `Produto`
--
ALTER TABLE `Produto`
  MODIFY `proCodigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Venda`
--
ALTER TABLE `Venda`
  MODIFY `venCodigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ItemVenda`
--
ALTER TABLE `ItemVenda`
  ADD CONSTRAINT `fk_Produto_has_Venda_Produto1` FOREIGN KEY (`itvProCodigo`) REFERENCES `Produto` (`proCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produto_has_Venda_Venda1` FOREIGN KEY (`itvVenCodigo`) REFERENCES `Venda` (`venCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Produto`
--
ALTER TABLE `Produto`
  ADD CONSTRAINT `fk_Produto_Categoria` FOREIGN KEY (`Categoria_catCodigo`) REFERENCES `Categoria` (`catCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Venda`
--
ALTER TABLE `Venda`
  ADD CONSTRAINT `fk_Venda_Cliente1` FOREIGN KEY (`Cliente_cliCodigo`) REFERENCES `Cliente` (`cliCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Venda_Funcionario1` FOREIGN KEY (`Funcionario_funCodigo`) REFERENCES `Funcionario` (`funCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `ItemVenda`
--

CREATE TABLE `ItemVenda` (
  `itvProCodigo` int(11) NOT NULL,
  `itvVenCodigo` int(11) NOT NULL,
  `itvQtd` int(11) NOT NULL,
  `itvPreco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Produto`
--

CREATE TABLE `Produto` (
  `proCodigo` int(11) NOT NULL,
  `proNome` varchar(150) NOT NULL,
  `proPreco` decimal(10,2) NOT NULL,
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
  `venPrecoTotal` decimal(10,2) NOT NULL,
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









-- DADOS
-- dados da tabela `Categoria`
--

INSERT INTO `Categoria` (`catCodigo`, `catNome`, `catDescricao`) VALUES
(1, 'ViolÃ£o', 'Instrumentos com cordas'),
(2, 'Violino', 'Instrumentos de 4 cordas, afinaÃ§Ãµes mais agudas'),
(3, 'Flauta', ''),
(4, 'Saxofone', 'Instrumentos fabricado por metal'),
(5, 'Guitarra', ''),
(6, 'Gaita', '');

-- dados da tabela `Cliente`
--

INSERT INTO `Cliente` (`cliCodigo`, `cliNome`, `cliCPF`) VALUES
(1, 'Joao Gomes', '11111111111'),
(2, 'David', '00000000000'),
(3, 'Marcos', '12312312300'),
(4, 'Estela', '12345678901');

--
-- dados da tabela `Funcionario`
--

INSERT INTO `Funcionario` (`funCodigo`, `funNome`, `funEmail`, `funUsername`, `funSenha`, `funIsGerente`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '123456789', 1),
(2, 'Felipe Godoi', 'felipecarvalhogodoi98@gmail.com', 'felipe', '123123123', 0),
(3, 'thiago', 'thiago@gmail.com', 'thiago', '123456789', 1),
(4, 'arthur', 'arthur@gmail.com', 'arthur123', 'arthur123', 1),
(5, 'Antonio Maria', 'antoniomaria@gmail.com', 'antonio', '123456789', 0);


--
-- dados da tabela `Produto`
--

INSERT INTO `Produto` (`proCodigo`, `proNome`, `proPreco`, `proQtdEstoque`, `proDataCadastro`, `proDescricao`, `Categoria_catCodigo`) VALUES
(1, 'Guitarra Woodstock TG-500 Preta TAGIMA', '1020.99', 20, '2021-11-21', 'Modelo: TG-500\r\n\r\nBraÃ§o: Maple\r\n\r\nCaptadores: 03 Tagima single coils\r\n\r\nControles: 01 chave de 5 posiÃ§Ãµes, 01 Volume e 02 tonalidade\r\n\r\nCor: Preta', 5),
(2, 'Guitarra Eletrica Queens 6 Cordas Sonicx 22 Trastes', '563.20', 32, '2021-11-21', 'A guitarra Queens G-100 conta 3 captadores single, ela segue a linha de timbre das antigas Stratocaster, com um timbre exclusivamente brilhante, com agudos gritados e mÃ©dios muito bem definidos.', 5),
(3, 'HarmÃ´nica Hohner Blues Band 559 20 em DÃ³ (C) Gaita de boca', '142.00', 16, '2021-11-21', 'A gaita de boca Blues Band 559/20 em DÃ³ da Hohner possui uma afinaÃ§Ã£o extremamente precisa devido Ã s novas ferramentas utilizadas em sua fabricaÃ§Ã£o. Um som Ãºnico com timbre que Ã© referÃªncia para blues, folk e rock. As geraÃ§Ãµes de iniciantes encontraram sua voz musical com a Hohner Blues Band. Ã‰ fÃ¡cil de tocar e ideal para quem procura uma harmÃ´nica durÃ¡vel com Ã³timo custo-benefÃ­cio.', 6),
(4, 'ViolÃ£o Folk Strinberg SD200C TOS ElÃ©trico AÃ§o Tabaco', '834.94', 15, '2021-11-21', '', 1),
(5, 'ViolÃ£o AcÃºstico AÃ§o Estudo S-14 Preto', '412.00', 20, '2021-11-21', '', 1),
(6, 'ZAD50CE Solid African Mahogany Acoustic Electric', '450.56', 5, '2021-11-21', '', 1),
(7, 'Violino Eagle 1/2 VE421 Classic Series Envernizado', '899.00', 1, '2021-11-21', '', 2),
(8, 'Flauta Transversal Soprano C YFL-212 Prata YAMAHA', '4659.99', 10, '2021-11-21', 'Com todas as liÃ§Ãµes que a Yamaha aprendeu durante o processo de desenvolvimento e aperfeiÃ§oamento das flautas #Handmade# e Profissionais, as flautas IntermediÃ¡rias & Standards carregam em si esta mesma essÃªncia e concepÃ§Ã£o. SÃ£o flautas destinadas aos iniciantes, colaboram com um rÃ¡pido aprendizado, oferecendo uma tocabilidade mais avanÃ§ada e excelentes respostas com qualidades tonais.', 3),
(9, 'Flauta Irlandesa FeadÃ³g Re D Escovada/Bocal Vermelho', '89.90', 15, '2021-11-21', '', 3),
(10, 'Saxofone Alto Yamaha YAS62 II Laqueado Dourado', '9999.72', 0, '2021-11-21', '', 4);

--
-- dados da tabela `Venda`
--

INSERT INTO `Venda` (`venCodigo`, `venPrecoTotal`, `Funcionario_funCodigo`, `Cliente_cliCodigo`, `venStatus`) VALUES
(8, '142.00', 4, 1, 1),
(9, '12041.70', 3, 3, 1),
(10, '1798.00', 5, 4, 1),
(11, '450.56', 2, 3, 1),
(12, '563.20', 4, 3, 1),
(13, '450.56', 3, 1, 1);


--
-- dados da tabela `ItemVenda`
--

INSERT INTO `ItemVenda` (`itvProCodigo`, `itvVenCodigo`, `itvQtd`, `itvPreco`) VALUES
(1, 9, 2, '1020.99'),
(2, 12, 1, '563.20'),
(3, 8, 1, '142.00'),
(6, 11, 1, '450.56'),
(6, 13, 1, '450.56'),
(7, 10, 2, '899.00'),
(10, 9, 1, '9999.72');
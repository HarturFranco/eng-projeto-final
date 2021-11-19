-- MySQL Workbench Synchronization
-- Generated: 2021-11-03 10:02
-- Model: New Model
-- Version: 1.0
-- Project: Toca dos Instrumentos
-- Author: Arthur-Franco

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `toca_dos_instrumentos` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`Produto` (
  `proCodigo` INT(11) NOT NULL AUTO_INCREMENT,
  `proNome` VARCHAR(150) NOT NULL,
  `proPreco` DECIMAL(6,2) NOT NULL,
  `proQtdEstoque` INT(11) NOT NULL,
  `proDataCadastro` DATE NOT NULL,
  `proDescricao` VARCHAR(500) NULL DEFAULT NULL,
  `Categoria_catCodigo` INT(11) NOT NULL,
  PRIMARY KEY (`proCodigo`),
  INDEX `fk_Produto_Categoria_idx` (`Categoria_catCodigo` ASC),
  CONSTRAINT `fk_Produto_Categoria`
    FOREIGN KEY (`Categoria_catCodigo`)
    REFERENCES `toca_dos_instrumentos`.`Categoria` (`catCodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`Categoria` (
  `catCodigo` INT(11) NOT NULL,
  `catNome` VARCHAR(50) NOT NULL,
  `catDescricao` VARCHAR(500) NULL DEFAULT NULL,
  PRIMARY KEY (`catCodigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`Venda` (
  `venCodigo` INT(11) NOT NULL AUTO_INCREMENT,
  `venProcoTotal` DECIMAL(8,2) NOT NULL,
  `Funcionario_funCodigo` INT(11) NOT NULL,
  `Cliente_cliCodigo` INT(11) NOT NULL,
  `venStatus` TINYINT(4) NOT NULL,
  PRIMARY KEY (`venCodigo`, `Funcionario_funCodigo`, `Cliente_cliCodigo`),
  INDEX `fk_Venda_Funcionario1_idx` (`Funcionario_funCodigo` ASC),
  INDEX `fk_Venda_Cliente1_idx` (`Cliente_cliCodigo` ASC),
  CONSTRAINT `fk_Venda_Funcionario1`
    FOREIGN KEY (`Funcionario_funCodigo`)
    REFERENCES `toca_dos_instrumentos`.`Funcionario` (`funCodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_Cliente1`
    FOREIGN KEY (`Cliente_cliCodigo`)
    REFERENCES `toca_dos_instrumentos`.`Cliente` (`cliCodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`Funcionario` (
  `funCodigo` INT(11) NOT NULL AUTO_INCREMENT,
  `funNome` VARCHAR(50) NOT NULL,
  `funEmail` VARCHAR(320) NOT NULL,
  `funUsername` VARCHAR(25) NOT NULL,
  `funSenha` VARCHAR(25) NOT NULL,
  `funIsGerente` TINYINT(4) NOT NULL,
  PRIMARY KEY (`funCodigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`Cliente` (
  `cliCodigo` INT(11) NOT NULL AUTO_INCREMENT,
  `cliNome` VARCHAR(50) NOT NULL,
  `cliCPF` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`cliCodigo`),
  UNIQUE INDEX `cliCPF_UNIQUE` (`cliCPF` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `toca_dos_instrumentos`.`ItemVenda` (
  `itvProCodigo` INT(11) NOT NULL,
  `itvVenCodigo` INT(11) NOT NULL,
  `itvQtd` INT(11) NOT NULL,
  `itvPreco` DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (`itvProCodigo`, `itvVenCodigo`),
  INDEX `fk_Produto_has_Venda_Venda1_idx` (`itvVenCodigo` ASC),
  INDEX `fk_Produto_has_Venda_Produto1_idx` (`itvProCodigo` ASC),
  CONSTRAINT `fk_Produto_has_Venda_Produto1`
    FOREIGN KEY (`itvProCodigo`)
    REFERENCES `toca_dos_instrumentos`.`Produto` (`proCodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_has_Venda_Venda1`
    FOREIGN KEY (`itvVenCodigo`)
    REFERENCES `toca_dos_instrumentos`.`Venda` (`venCodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `Funcionario`(`funNome`, `funEmail`, `funUsername`, `funSenha`, `funIsGerente`) 
VALUES ('admin','admin@gmail.com','admin','admin','1');
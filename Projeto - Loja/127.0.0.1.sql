-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 11/04/2025 às 22h54min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `escola`
--
CREATE DATABASE `escola` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `escola`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `cod_aluno` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` int(10) NOT NULL,
  `cod_curso` int(5) NOT NULL,
  PRIMARY KEY (`cod_aluno`),
  KEY `cod_curso` (`cod_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`cod_aluno`, `nome`, `telefone`, `cod_curso`) VALUES
(1, 'Augusto Zanette', 2147483647, 1),
(2, 'Sabrina de Medeiros', 987654321, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenador`
--

CREATE TABLE IF NOT EXISTS `coordenador` (
  `cod_coordenador` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_coordenador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `coordenador`
--

INSERT INTO `coordenador` (`cod_coordenador`, `nome`) VALUES
(1, 'Albertina Veronez'),
(2, 'Adriana Justh'),
(3, 'Max Steiner');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `cod_curso` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cod_coordenador` int(5) NOT NULL,
  PRIMARY KEY (`cod_curso`),
  KEY `cod_coordenador` (`cod_coordenador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`cod_curso`, `nome`, `cod_coordenador`) VALUES
(1, 'Tecno em Design Grafico', 1),
(2, 'Tecnico em Administrcao', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `email`, `senha`) VALUES
(1, 'cris@gmail.com', '123'),
(2, 'mariane@gmail.com', '1234');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`cod_curso`) REFERENCES `curso` (`cod_curso`);

--
-- Restrições para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`cod_coordenador`) REFERENCES `coordenador` (`cod_coordenador`);
--
-- Banco de Dados: `loja`
--
CREATE DATABASE `loja` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(2, 'Camisetas Dry Fit'),
(3, 'Regatas'),
(4, 'Jaquetas e corta-vento'),
(5, 'CalÃ§as esportivas'),
(6, 'Leggings'),
(7, 'Shorts e bermudas'),
(8, 'Tops esportivos'),
(9, 'MacacÃµes e conjuntos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(2, 'Nike'),
(3, 'Adidas'),
(4, 'Puma'),
(5, 'Under Armour'),
(6, 'Reebok'),
(7, 'New Balance'),
(8, 'Asics'),
(9, 'Columbia'),
(10, 'The North Face'),
(11, 'Decathlon');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `tamanho` varchar(10) NOT NULL,
  `preco` float(10,2) NOT NULL,
  `cod_marca` int(5) NOT NULL,
  `cod_categoria` int(5) NOT NULL,
  `cod_tipo` int(5) NOT NULL,
  `foto_1` varchar(100) NOT NULL,
  `foto_2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `cod_marca` (`cod_marca`),
  KEY `cod_categoria` (`cod_categoria`),
  KEY `cod_tipo` (`cod_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `descricao`, `cor`, `tamanho`, `preco`, `cod_marca`, `cod_categoria`, `cod_tipo`, `foto_1`, `foto_2`) VALUES
(10, 'Camiseta NR001', 'Branco', 'M', 455.90, 2, 2, 2, '07996bebe08e77b75d96bab09261b09f', '7bed45a69bbd3898dc560c1d18f0fbe8'),
(11, 'Camiseta ABC', 'Azul', 'M', 152.00, 5, 3, 3, 'de00f568e27fc2a603374b2bec75992a', '3e84f664323d71d0099d946c08b7e06a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`codigo`, `nome`) VALUES
(2, 'Masculino'),
(3, 'Feminino'),
(4, 'Infantil'),
(5, 'Unissex');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `email`, `senha`) VALUES
(1, 'cris@gmail.com', '1234');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`cod_marca`) REFERENCES `marca` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_3` FOREIGN KEY (`cod_tipo`) REFERENCES `tipo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

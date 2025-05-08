-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 08/05/2025 às 20h37min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(2, 'Camisetas'),
(3, 'Calças'),
(4, 'Jaquetas e Moletons');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(2, 'Nike'),
(3, 'Adidas'),
(4, 'Puma');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `descricao`, `cor`, `tamanho`, `preco`, `cod_marca`, `cod_categoria`, `cod_tipo`, `foto_1`, `foto_2`) VALUES
(12, 'CalÃ§a NK01', 'Preto', 'M', 159.00, 2, 3, 3, 'b270596ae9e6801ce1add9137326e597', '4c31fecceb772e145a5882419ba946a2'),
(13, 'CalÃ§a NK02', 'Preto', 'M', 169.00, 2, 3, 2, '8be06a52e9dc73ce6f0663e4519c4e22', 'cea4876c46361b25d0700f9c55cbb837'),
(14, 'Camiseta NK01', 'Preto', 'M', 179.00, 2, 2, 3, '42ecacbdab7cc62584a5cbf8823af128', 'c0c162336206c8d34d888c33debd1799'),
(15, 'Camiseta NK02', 'Preto', 'M', 189.00, 2, 2, 2, '0c4ce170bea42741c2e1acdacf4d8dab', '036f7a603ca5c48ffe9444f6839199b3'),
(16, 'Jaqueta NK01', 'Preto', 'M', 199.00, 2, 4, 3, 'f888258c078aff8b379ba6300bf4844f', 'e14fa15c14a6bdd5639bce9eead1c94c'),
(17, 'Jaqueta NK02', 'Preto', 'M', 259.00, 2, 4, 2, '85699cf78db680a0243fafdc7527221d', '289a13bb0207d1176712fbe259c638bf'),
(20, 'Camiseta AD01', 'Preto', 'M', 369.00, 3, 2, 2, '0a6e2e3e768cc65bcf81a74fad033d31', '6c50fd77fc5d14cd8a3c221e6db63afd'),
(21, 'Camiseta AD02', 'Preto', 'M', 479.00, 3, 2, 3, 'caaa9bb9bb30552eb658e46db9815fc0', 'd55c505122cc89046322434500d7157f'),
(22, 'CalÃ§a AD01', 'Preto', 'M', 589.00, 3, 3, 2, '7a9c1d1630f9aa0f04ea3e7e06ab2412', '1dacc827e92a2f0298e4bbb7ae412703'),
(23, 'CalÃ§a AD02', 'Preto', 'M', 699.00, 3, 3, 3, '0e844bd60e329709c1149a98fca82498', 'b064c5b5e211f3439a60403ac572b7b9'),
(24, 'Jaqueta AD01', 'Preto', 'M', 729.00, 3, 4, 3, '36b9d1c58a3c4e99bc9fb08afcf1396e', '7332052a25943729fb955d7e360b2efa'),
(25, 'Jaqueta AD02', 'Preto', 'M', 839.00, 3, 4, 2, '81e42489cd74f89436158906e1f0fb93', '1b7fac95a8b5c0385ed14630da22eb05'),
(26, 'Camiseta PM01', 'Preto', 'M', 159.00, 4, 2, 2, '1c881e89bd552894b8b841ba966616ae', '08880037764ea7db84cbce1553ab7851'),
(27, 'Camiseta PM02', 'Preto', 'M', 259.00, 4, 2, 3, '0d0f282e24a57551e96b2d76147c6785', 'f20acd808d8ad8a51b37511edbb683a9');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`codigo`, `nome`) VALUES
(2, 'Masculino'),
(3, 'Feminino');

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

-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 21-Ago-2014 às 16:28
-- Versão do servidor: 5.5.32
-- versão do PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `easylanguage`
--
CREATE DATABASE IF NOT EXISTS `easylanguage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `easylanguage`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE IF NOT EXISTS `itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `nome` text,
  `texto` text,
  `lang` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` text NOT NULL,
  `nome` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `languages`
--

INSERT INTO `languages` (`id`, `cod`, `nome`) VALUES
(1, 'pt_BR', 'português'),
(2, 'en_US', 'english'),
(3, 'es_ES', 'español');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
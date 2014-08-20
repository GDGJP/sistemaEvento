-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2014 at 09:54 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistema_eventos_novo`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE IF NOT EXISTS `agendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_pt` text,
  `texto_en` text,
  `link` varchar(255) DEFAULT NULL,
  `hora_inicial` varchar(10) NOT NULL,
  `hora_final` varchar(10) NOT NULL,
  `dia` date NOT NULL,
  `fkSala` int(11) NOT NULL,
  `fkEvento` int(11) NOT NULL,
  `cor` varchar(10) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `apoios`
--

CREATE TABLE IF NOT EXISTS `apoios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `boletos`
--

CREATE TABLE IF NOT EXISTS `boletos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nossonumero` int(10) unsigned zerofill NOT NULL,
  `cliente` int(11) NOT NULL,
  `valor_total` decimal(12,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `data_pagamento` date NOT NULL,
  `valor_pago` decimal(12,2) NOT NULL,
  `data_processamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categorias_evento`
--

CREATE TABLE IF NOT EXISTS `categorias_evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ceps`
--

CREATE TABLE IF NOT EXISTS `ceps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cep` (`cep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certificados`
--

CREATE TABLE IF NOT EXISTS `certificados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `texto` text COLLATE utf8_bin NOT NULL,
  `fkEvento` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL,
  `excluido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cidade_estado1` (`estado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9715 ;

-- --------------------------------------------------------

--
-- Table structure for table `contas_bancarias`
--

CREATE TABLE IF NOT EXISTS `contas_bancarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banco` enum('banco_do_brasil','caixa_economica','bradesco') COLLATE utf8_unicode_ci DEFAULT NULL,
  `agencia` int(4) DEFAULT NULL,
  `conta` int(11) DEFAULT NULL,
  `favorecido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpfCnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contaPrincipal` tinyint(1) DEFAULT NULL,
  `fkUsuario` int(11) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkUsuario` (`fkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `controle_acesso_banners`
--

CREATE TABLE IF NOT EXISTS `controle_acesso_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_bin NOT NULL,
  `dadosPessoais` text COLLATE utf8_bin NOT NULL,
  `referer` varchar(255) COLLATE utf8_bin NOT NULL,
  `banner` varchar(255) COLLATE utf8_bin NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crachas`
--

CREATE TABLE IF NOT EXISTS `crachas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `fk_participante` int(11) NOT NULL,
  `presente` tinyint(1) NOT NULL DEFAULT '0',
  `fk_formulario` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1702 ;

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uf` varchar(2) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `regiao` varchar(2) DEFAULT NULL,
  `excluido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `imagem` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `categoria` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `programacao` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `privado` tinyint(1) NOT NULL,
  `local` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `bairro` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fkUsuario` int(11) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkUsuario` (`fkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expositores`
--

CREATE TABLE IF NOT EXISTS `expositores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `posicao` tinyint(2) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `formularios`
--

CREATE TABLE IF NOT EXISTS `formularios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fkEvento` int(11) DEFAULT NULL,
  `fkTipoFormulario` int(11) DEFAULT NULL,
  `fkCertificado` int(11) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkEvento` (`fkEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(255) COLLATE utf8_bin NOT NULL,
  `fkPublicidade` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `hoteis`
--

CREATE TABLE IF NOT EXISTS `hoteis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_traducao`
--

CREATE TABLE IF NOT EXISTS `item_traducao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `lista_emails`
--

CREATE TABLE IF NOT EXISTS `lista_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `enviado` tinyint(1) NOT NULL DEFAULT '0',
  `dataEnvio` datetime NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=165060 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkUsuario` int(11) DEFAULT NULL,
  `modulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `acao` varchar(255) COLLATE utf8_bin NOT NULL,
  `mensagem` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkUsuario` (`fkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkCategoria` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumo` text NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT '0',
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkCategoria` (`fkCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizadores`
--

CREATE TABLE IF NOT EXISTS `organizadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `fkEvento` int(11) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkEvento` (`fkEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `painel`
--

CREATE TABLE IF NOT EXISTS `painel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `lang` varchar(2) DEFAULT 'pt',
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) COLLATE utf8_bin NOT NULL,
  `iso3` char(3) COLLATE utf8_bin NOT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=245 ;

-- --------------------------------------------------------

--
-- Table structure for table `palestrantes`
--

CREATE TABLE IF NOT EXISTS `palestrantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `participantes`
--

CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `funcao` enum('participante','palestrante','staff','expositor') NOT NULL,
  `sexo` enum('m','f') NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `orgao_emissor` varchar(10) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `cidade` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(5) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `instituicao` varchar(255) NOT NULL,
  `area_atuacao` enum('terceiro_setor','governamental','empresarial','academica') NOT NULL,
  `profissao` int(11) NOT NULL,
  `outra_profissao` varchar(255) DEFAULT NULL,
  `grau_instrucao` enum('nenhum','fundamental_incompleto','fundamento_completo','medio_incompleto','medio_completo','tecnico_incompleto','tecnico_completo','superior_incompleto','superior_completo','mestrado','doutorado','pos_doutorado') NOT NULL,
  `tamanho_camisa` enum('p','m','g','gg','xgg') NOT NULL,
  `nossonumero` bigint(20) DEFAULT NULL,
  `pago` tinyint(1) NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmou` tinyint(1) NOT NULL DEFAULT '0',
  `voucher` varchar(32) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`,`excluido`),
  UNIQUE KEY `email` (`email`,`excluido`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Table structure for table `profissoes`
--

CREATE TABLE IF NOT EXISTS `profissoes` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=771 ;

-- --------------------------------------------------------

--
-- Table structure for table `publicidades`
--

CREATE TABLE IF NOT EXISTS `publicidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `redes_sociais`
--

CREATE TABLE IF NOT EXISTS `redes_sociais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `imagem` varchar(255) COLLATE utf8_bin NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `salas`
--

CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_pt` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nome_en` varchar(255) DEFAULT NULL,
  `data_cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fkEvento` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `sugestoes`
--

CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `setor` varchar(100) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(100) COLLATE utf8_bin NOT NULL,
  `uf` varchar(255) COLLATE utf8_bin NOT NULL,
  `titulo_tema` varchar(100) COLLATE utf8_bin NOT NULL,
  `justificativa` text COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Table structure for table `template_emails`
--

CREATE TABLE IF NOT EXISTS `template_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mensagem` longtext COLLATE utf8_unicode_ci NOT NULL,
  `assunto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '1',
  `fkEvento` int(11) DEFAULT NULL,
  `fkFormulario` int(11) DEFAULT NULL,
  `fkUsuario` int(11) DEFAULT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fkEvento` (`fkEvento`),
  KEY `fkUsuario` (`fkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `textos`
--

CREATE TABLE IF NOT EXISTS `textos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_agricultura`
--

CREATE TABLE IF NOT EXISTS `tipos_agricultura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_formularios`
--

CREATE TABLE IF NOT EXISTS `tipos_formularios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `certificado` tinyint(1) NOT NULL DEFAULT '0',
  `fkUsuario` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `modulos` text COLLATE utf8_bin NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id`, `nome`, `modulos`, `excluido`) VALUES
(9, 'admin', 'seus_dados|noticias|categorias|categoriasParticipantes|contatos|usuarios|tiposUsuarios|layouts|configuracao', 0);

-- --------------------------------------------------------

--
-- Table structure for table `traducao`
--

CREATE TABLE IF NOT EXISTS `traducao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkItemTraducao` int(11) NOT NULL,
  `valor` varchar(255) COLLATE utf8_bin NOT NULL,
  `lang` varchar(2) COLLATE utf8_bin NOT NULL,
  `excluido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=319 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailNotificacao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fkTipoUsuario` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `sexo`, `senha`, `emailNotificacao`, `fkTipoUsuario`, `excluido`) VALUES
(1, 'admin', 'admin@email.com', 'M', '202cb962ac59075b964b07152d234b70', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `desconto` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `fkEvento` int(11) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usado` tinyint(1) NOT NULL DEFAULT '0',
  `enviado` tinyint(1) NOT NULL DEFAULT '0',
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=401 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contas_bancarias`
--
ALTER TABLE `contas_bancarias`
  ADD CONSTRAINT `contas_bancarias_ibfk_1` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formularios`
--
ALTER TABLE `formularios`
  ADD CONSTRAINT `formularios_ibfk_1` FOREIGN KEY (`fkEvento`) REFERENCES `eventos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`fkCategoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `organizadores`
--
ALTER TABLE `organizadores`
  ADD CONSTRAINT `organizadores_ibfk_1` FOREIGN KEY (`fkEvento`) REFERENCES `organizadores` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `template_emails`
--
ALTER TABLE `template_emails`
  ADD CONSTRAINT `template_emails_ibfk_1` FOREIGN KEY (`fkEvento`) REFERENCES `eventos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `template_emails_ibfk_2` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

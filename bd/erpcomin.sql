-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2016 a las 00:55:06
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erpcomin`
--
CREATE DATABASE IF NOT EXISTS `erpcomin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `erpcomin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bckp_oclocal`
--

DROP TABLE IF EXISTS `bckp_oclocal`;
CREATE TABLE IF NOT EXISTS `bckp_oclocal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoprodserv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descpprodserv` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidadoc` int(11) DEFAULT NULL,
  `valunitarionetoorigen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bckp_ordendecompra`
--

DROP TABLE IF EXISTS `bckp_ordendecompra`;
CREATE TABLE IF NOT EXISTS `bckp_ordendecompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` int(11) DEFAULT NULL,
  `division` int(11) DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `corroc` int(11) DEFAULT NULL,
  `numoc` int(11) DEFAULT NULL,
  `usuarioproc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaprococ` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monedaorigen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monedalocal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rutproveedor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreproveedor` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineaoc` int(11) DEFAULT NULL,
  `codigoprodserv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descpprodserv` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `um` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidadoc` float DEFAULT NULL,
  `cantrecepcionada` float DEFAULT NULL,
  `cantdevuelta` float DEFAULT NULL,
  `cantporrecepcionar` float DEFAULT NULL,
  `usuarioaprobacionoc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaaprobacionoc` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valunitarionetoorigen` int(11) DEFAULT NULL,
  `valtotalnetolocal` int(11) DEFAULT NULL,
  `numpedidocompra` int(11) DEFAULT NULL,
  `lineapedido` int(11) DEFAULT NULL,
  `codigo` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gpo` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oclocal`
--

DROP TABLE IF EXISTS `oclocal`;
CREATE TABLE IF NOT EXISTS `oclocal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoprodserv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descpprodserv` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidadoc` int(11) DEFAULT NULL,
  `valunitarionetoorigen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `oclocal`
--

INSERT INTO `oclocal` (`id`, `codigoprodserv`, `descpprodserv`, `cantidadoc`, `valunitarionetoorigen`) VALUES
(1, '101010006', 'Arnes Paracaidista 4 Argollas', 35, 11235),
(2, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 12119),
(3, '101010006', 'Arnes Paracaidista 4 Argollas', 80, 10984),
(4, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 14867),
(5, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 13967),
(6, '101010006', 'Arnes Paracaidista 4 Argollas', 60, 14675),
(7, '101010006', 'Arnes Paracaidista 4 Argollas', 35, 11235),
(8, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 12119),
(9, '101010006', 'Arnes Paracaidista 4 Argollas', 80, 10984),
(10, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 14867),
(11, '101010006', 'Arnes Paracaidista 4 Argollas', 50, 13967),
(12, '101010006', 'Arnes Paracaidista 4 Argollas', 60, 14675),
(13, '101010008', 'Bloqueador Solar 1kg', 2, 15000),
(14, '101010008', 'Bloqueador Solar 1kg', 3, 9000),
(15, '101010008', 'Bloqueador Solar 1kg', 4, 13567),
(16, '101010008', 'Bloqueador Solar 1kg', 2, 10000),
(17, '107070008', 'Ampolleta Halog.1000 W  220V.189mm', 13, 375),
(18, '107070008', 'Ampolleta Halog.1000 W  220V.189mm', 16, 200),
(19, '107070008', 'Ampolleta Halog.1000 W  220V.189mm', 34, 460),
(20, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 9000, 700),
(21, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 15000, 650),
(22, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 17000, 890),
(23, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 16876, 756),
(24, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 3756, 456),
(25, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 1267, 945),
(26, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 7645, 1080),
(27, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 12845, 689),
(28, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 3453, 376),
(29, '96', 'Servicio Maestranzas / Fabricacion Estructuras', 2687, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL,
  `user` char(32) COLLATE latin1_spanish_ci NOT NULL,
  `pass` char(255) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` char(32) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellido` char(32) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `user`, `pass`, `nombre`, `apellido`, `tipo`) VALUES
(1, 'admin', 'erpcomin2016', 'Admin', 'CMPC', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2016 a las 17:40:12
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
-- Estructura de tabla para la tabla `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(15) NOT NULL,
  `descrpicion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `disciplina` enum('PIPING','ELECTRICO','ADMINISTRACION') COLLATE latin1_spanish_ci DEFAULT NULL,
  `unidad` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `stock` int(15) NOT NULL,
  `valor` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id`, `descrpicion`, `disciplina`, `unidad`, `stock`, `valor`) VALUES
(1, 'Perno Blando de 3" para perforación', NULL, 'Caja 50 un', 6, NULL),
(2, 'Martillo acero grande 80cm con sujetador', 'PIPING', 'c/u', 40, NULL),
(3, 'Tornillo roscalata 5" (para tuberias de 20x10)', 'PIPING', 'Caja 50 un', 20, NULL),
(4, 'Par de guantes soldadura SAFESECURE', 'ELECTRICO', 'c/u', 10, NULL),
(5, 'Par de zapatos de seguridad EDELBROCK numero 43- color café', NULL, 'c/u', 40, NULL),
(6, 'Carpeta ancha para portafolio de documentos RHEIN 300 hojas', 'ADMINISTRACION', 'Caja de 20 un', 10, NULL),
(7, 'Pernos acero para tuberías de 10x15', 'PIPING', 'caja 50 un', 34, NULL),
(8, 'Tester de medición eléctrica 110V hasta 500 OHM ', 'ELECTRICO', 'c/u', 10, NULL),
(9, 'Sierra eléctrica circular 25"', NULL, 'c/u', 4, NULL),
(10, 'Bolígrafos tinta', 'ADMINISTRACION', 'caja 50 un', 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manoobra`
--

DROP TABLE IF EXISTS `manoobra`;
CREATE TABLE IF NOT EXISTS `manoobra` (
  `id` int(10) NOT NULL,
  `cargo` enum('CAPATAZ','MM','M1','M2') COLLATE latin1_spanish_ci NOT NULL,
  `unidad` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'HH',
  `cantidad` float DEFAULT NULL,
  `preciounit` int(40) DEFAULT NULL,
  `preciotothh` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `manoobra`
--

INSERT INTO `manoobra` (`id`, `cargo`, `unidad`, `cantidad`, `preciounit`, `preciotothh`) VALUES
(34725934, 'M2', 'HH', 0.3, 4500, 1350),
(34725935, 'M1', 'HH', 0.6, 5000, 3000),
(34725936, 'MM', 'HH', 0.6, 6000, 3600),
(34725937, 'CAPATAZ', 'HH', 0.3, 7000, 2100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pm`
--

DROP TABLE IF EXISTS `pm`;
CREATE TABLE IF NOT EXISTS `pm` (
  `folio` int(10) NOT NULL,
  `faena` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fechaemision` date NOT NULL,
  `fecharequerida` date NOT NULL,
  `fechaaprobacion` date DEFAULT NULL,
  `tiposolicitud` binary(1) NOT NULL,
  `solicitante` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `jefeterreno` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `jefeproduccion` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `jefeoftec` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `administrador` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fechavalidacion` date DEFAULT NULL,
  `urlsidar` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idpmcont` int(15) DEFAULT NULL,
  PRIMARY KEY (`folio`),
  KEY `idpmcont` (`idpmcont`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pmcont`
--

DROP TABLE IF EXISTS `pmcont`;
CREATE TABLE IF NOT EXISTS `pmcont` (
  `id` int(15) NOT NULL,
  `iditem` int(5) NOT NULL,
  `disciplina` enum('PIPING','ELECTRICO','ADMINISTRACION') COLLATE latin1_spanish_ci NOT NULL,
  `cantidadsolicitada` int(10) DEFAULT NULL,
  `valor` int(10) NOT NULL,
  `ppto` int(15) DEFAULT NULL,
  `ctacargo` int(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iditem` (`iditem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table 7`
--

DROP TABLE IF EXISTS `table 7`;
CREATE TABLE IF NOT EXISTS `table 7` (
  `Empresa` int(1) DEFAULT NULL,
  `N° División` int(4) DEFAULT NULL,
  `N° Unidad` int(1) DEFAULT NULL,
  `Correlativo OC` int(3) DEFAULT NULL,
  `N°Orden de Compra` int(5) DEFAULT NULL,
  `Usuario Proceso` varchar(50) DEFAULT NULL,
  `Fecha Proceso OC` varchar(12) DEFAULT NULL,
  `Moneda Origen` varchar(30) DEFAULT NULL,
  `Moneda Local` varchar(30) DEFAULT NULL,
  `RUT Proveedor` varchar(12) DEFAULT NULL,
  `Nombre Proveedor` varchar(120) DEFAULT NULL,
  `Estado` varchar(30) DEFAULT NULL,
  `Linea OC` int(2) DEFAULT NULL,
  `Código Producto/Servicio` varchar(25) DEFAULT NULL,
  `Descripción Producto/Servicio` varchar(50) DEFAULT NULL,
  `UM` varchar(10) DEFAULT NULL,
  `Cantidad OC` varchar(7) DEFAULT NULL,
  `Cantidad Recepcionada` varchar(8) DEFAULT NULL,
  `Cantidad Devuelta` int(1) DEFAULT NULL,
  `Cantidad por Recepcionar` varchar(8) DEFAULT NULL,
  `Usuario Aprobación OC` varchar(50) DEFAULT NULL,
  `Fecha Aprobación OC` varchar(26) DEFAULT NULL,
  `Valor Unitario Neto Origen` varchar(11) DEFAULT NULL,
  `Valor Total Neto Local` varchar(11) DEFAULT NULL,
  `N° Pedido de Compra` int(4) DEFAULT NULL,
  `Linea Pedido` int(2) DEFAULT NULL,
  `Codigo` int(9) DEFAULT NULL,
  `GPO` varchar(57) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unitario`
--

DROP TABLE IF EXISTS `unitario`;
CREATE TABLE IF NOT EXISTS `unitario` (
  `familia` int(40) NOT NULL,
  `descripcion` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `unidad` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cantidad` int(40) NOT NULL,
  `preciounit` int(40) DEFAULT NULL,
  `preciototalmat` int(40) DEFAULT NULL,
  PRIMARY KEY (`familia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `unitario`
--

INSERT INTO `unitario` (`familia`, `descripcion`, `unidad`, `cantidad`, `preciounit`, `preciototalmat`) VALUES
(98471247, 'Fierro', 'Kg', 90, 1300, 117000),
(98471248, 'Calugas H30', 'c/u', 80, 3000, 240000),
(98471249, 'Hormigón H30', 'm3', 10, 50000, 500000);

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

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pm`
--
ALTER TABLE `pm`
  ADD CONSTRAINT `idpmcont` FOREIGN KEY (`idpmcont`) REFERENCES `pmcont` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pmcont`
--
ALTER TABLE `pmcont`
  ADD CONSTRAINT `pmcont_ibfk_1` FOREIGN KEY (`iditem`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

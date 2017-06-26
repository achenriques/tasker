-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-01-2016 a las 20:24:39
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `taskerbd`
--
CREATE DATABASE IF NOT EXISTS `taskerbd` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `taskerbd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CALENDARIO`
--

CREATE USER 'tasker'@'localhost' IDENTIFIED BY 'tasker';

GRANT ALL ON `taskerbd`.* TO 'tasker'@'localhost';

CREATE TABLE IF NOT EXISTS `CALENDARIO` (
`idCalendario` int(11) NOT NULL,
  `nombreCalendario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CALENDARIO_TAREA`
--

CREATE TABLE IF NOT EXISTS `CALENDARIO_TAREA` (
  `idCalendario` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DOCUMENTO`
--

CREATE TABLE IF NOT EXISTS `DOCUMENTO` (
`idDocumento` int(11) NOT NULL,
  `nombreDoc` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fichero` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tareaId` int(11) DEFAULT NULL,
  `usuarioId` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO`
--

CREATE TABLE IF NOT EXISTS `ESTADO` (
`idEstado` int(11) NOT NULL,
  `codEstado` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreEstado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ESTADO`
--

INSERT INTO `ESTADO` (`idEstado`, `codEstado`, `nombreEstado`) VALUES
(1, 'CRD', 'Creada'),
(2, 'ASG', 'Asignada'),
(3, 'PRC', 'En proceso'),
(4, 'FIN', 'Finalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRUPO`
--

CREATE TABLE IF NOT EXISTS `GRUPO` (
`idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionGrupo` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visibilidad` int(11) NOT NULL DEFAULT '1',
  `calendario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NOTIFICACION`
--

CREATE TABLE IF NOT EXISTS `NOTIFICACION` (
`idNotif` int(11) NOT NULL,
  `textoNotif` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `estadoNotif` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` tinyint(1) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `remitente` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REUNION`
--

CREATE TABLE IF NOT EXISTS `REUNION` (
`idReunion` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `fechaReunion` datetime DEFAULT NULL,
  `acta` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoReunion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA`
--

CREATE TABLE IF NOT EXISTS `TAREA` (
`idTarea` int(11) NOT NULL,
  `codTarea` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreTarea` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionTarea` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tareaPadre` int(11) DEFAULT NULL,
  `estadoTarea` int(11) DEFAULT '1',
  `fechaEstIni` date DEFAULT NULL,
  `fechaEstFin` date DEFAULT NULL,
  `fechaRealIni` date DEFAULT NULL,
  `fechaRealFin` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE IF NOT EXISTS `USUARIO` (
`idUsuario` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` mediumblob,
  `idioma` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'es',
  `borrado` tinyint(1) DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`idUsuario`, `username`, `nombre`, `email`, `password`, `imagen`, `idioma`, `borrado`, `admin`) VALUES
(23, 'admin', 'administrador', 'admin@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', NULL, 'es', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO_CALENDARIO`
--

CREATE TABLE IF NOT EXISTS `USUARIO_CALENDARIO` (
  `idUsuario` int(11) NOT NULL,
  `idCalendario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO_GRUPO`
--

CREATE TABLE IF NOT EXISTS `USUARIO_GRUPO` (
  `idGrupo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `admin` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CALENDARIO`
--
ALTER TABLE `CALENDARIO`
 ADD PRIMARY KEY (`idCalendario`);

--
-- Indices de la tabla `CALENDARIO_TAREA`
--
ALTER TABLE `CALENDARIO_TAREA`
 ADD PRIMARY KEY (`idCalendario`,`idTarea`), ADD KEY `fkTarea_idx` (`idTarea`);

--
-- Indices de la tabla `DOCUMENTO`
--
ALTER TABLE `DOCUMENTO`
 ADD PRIMARY KEY (`idDocumento`);

--
-- Indices de la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
 ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `GRUPO`
--
ALTER TABLE `GRUPO`
 ADD PRIMARY KEY (`idGrupo`), ADD KEY `GRUPO_CALENDARIO_idCalendario_fk` (`calendario`);

--
-- Indices de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
 ADD PRIMARY KEY (`idNotif`);

--
-- Indices de la tabla `REUNION`
--
ALTER TABLE `REUNION`
 ADD PRIMARY KEY (`idReunion`,`idGrupo`), ADD KEY `REUNION_GRUPO_idGrupo_fk` (`idGrupo`), ADD KEY `REUNION_DOCUMENTO_idDocumento_fk` (`acta`);

--
-- Indices de la tabla `TAREA`
--
ALTER TABLE `TAREA`
 ADD PRIMARY KEY (`idTarea`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
 ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `USUARIO_CALENDARIO`
--
ALTER TABLE `USUARIO_CALENDARIO`
 ADD PRIMARY KEY (`idUsuario`,`idCalendario`), ADD KEY `USUARIO_CALENDARIO_CALENDARIO_idCalendario_fk` (`idCalendario`);

--
-- Indices de la tabla `USUARIO_GRUPO`
--
ALTER TABLE `USUARIO_GRUPO`
 ADD PRIMARY KEY (`idGrupo`,`idUsuario`), ADD KEY `USUARIO_GRUPO_USUARIO_idUsuario_fk` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CALENDARIO`
--
ALTER TABLE `CALENDARIO`
MODIFY `idCalendario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT de la tabla `DOCUMENTO`
--
ALTER TABLE `DOCUMENTO`
MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `GRUPO`
--
ALTER TABLE `GRUPO`
MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
MODIFY `idNotif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `REUNION`
--
ALTER TABLE `REUNION`
MODIFY `idReunion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `TAREA`
--
ALTER TABLE `TAREA`
MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CALENDARIO_TAREA`
--
ALTER TABLE `CALENDARIO_TAREA`
ADD CONSTRAINT `fkTareaId` FOREIGN KEY (`idTarea`) REFERENCES `TAREA` (`idTarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `GRUPO`
--
ALTER TABLE `GRUPO`
ADD CONSTRAINT `GRUPO_CALENDARIO_idCalendario_fk` FOREIGN KEY (`calendario`) REFERENCES `CALENDARIO` (`idCalendario`);

--
-- Filtros para la tabla `REUNION`
--
ALTER TABLE `REUNION`
ADD CONSTRAINT `REUNION_GRUPO_idGrupo_fk` FOREIGN KEY (`idGrupo`) REFERENCES `GRUPO` (`idGrupo`);

--
-- Filtros para la tabla `USUARIO_CALENDARIO`
--
ALTER TABLE `USUARIO_CALENDARIO`
ADD CONSTRAINT `USUARIO_CALENDARIO_CALENDARIO_idCalendario_fk` FOREIGN KEY (`idCalendario`) REFERENCES `CALENDARIO` (`idCalendario`);

--
-- Filtros para la tabla `USUARIO_GRUPO`
--
ALTER TABLE `USUARIO_GRUPO`
ADD CONSTRAINT `USUARIO_GRUPO_GRUPO_idGrupo_fk` FOREIGN KEY (`idGrupo`) REFERENCES `GRUPO` (`idGrupo`),
ADD CONSTRAINT `USUARIO_GRUPO_USUARIO_idUsuario_fk` FOREIGN KEY (`idUsuario`) REFERENCES `USUARIO` (`idUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

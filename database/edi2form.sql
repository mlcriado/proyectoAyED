-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para edi2form
CREATE DATABASE IF NOT EXISTS `edi2form` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `edi2form`;

-- Volcando estructura para tabla edi2form.hobbies
CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla edi2form.hobbies: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `hobbies` DISABLE KEYS */;
INSERT INTO `hobbies` (`id`, `detalle`) VALUES
	(1, 'MÚSICA'),
	(2, 'TEATRO'),
	(3, 'DEPORTE'),
	(4, 'ACTIVIDADES AL AIRE LIBRE'),
	(5, 'VIDEOJUEGOS');
/*!40000 ALTER TABLE `hobbies` ENABLE KEYS */;

-- Volcando estructura para tabla edi2form.ocupaciones
CREATE TABLE IF NOT EXISTS `ocupaciones` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla edi2form.ocupaciones: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `ocupaciones` DISABLE KEYS */;
INSERT INTO `ocupaciones` (`id`, `detalle`) VALUES
	(1, 'DESEMPLEADO'),
	(2, 'JUBILADO'),
	(3, 'EMPLEADO AUTÓNOMO A TIEMPO COMPLETO'),
	(4, 'EMPLEADO AUTÓNOMO A TIEMPO PARCIAL'),
	(5, 'EMPLEADO DEPENDIENTE A TIEMPO COMPLETO'),
	(6, 'EMPLEADO DEPENDIENTE A TIEMPO PARCIAL'),
	(7, 'EMPRESARIO'),
	(8, 'ESTUDIANTE'),
	(9, 'INVERSIONISTA'),
	(10, 'MENOR DE EDAD');
/*!40000 ALTER TABLE `ocupaciones` ENABLE KEYS */;

-- Volcando estructura para tabla edi2form.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `dni` char(8) NOT NULL,
  `apyn` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` enum('F','M') NOT NULL,
  `id_ocupacion` int(4) unsigned NOT NULL,
  `sugerencias` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_sexo` (`dni`,`sexo`),
  KEY `personas_ocupaciones` (`id_ocupacion`),
  CONSTRAINT `personas_ocupaciones` FOREIGN KEY (`id_ocupacion`) REFERENCES `ocupaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla edi2form.personas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`, `dni`, `apyn`, `email`, `sexo`, `id_ocupacion`, `sugerencias`) VALUES
	(1, '12345678', 'Armando Paredes', 'armandoparedes@gmail.com', 'M', 1, NULL);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla edi2form.personas_hobbies
CREATE TABLE IF NOT EXISTS `personas_hobbies` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `id_personas` int(4) unsigned NOT NULL,
  `id_hobbies` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hobbies` (`id_hobbies`),
  KEY `personas` (`id_personas`),
  CONSTRAINT `hobbies` FOREIGN KEY (`id_hobbies`) REFERENCES `hobbies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personas` FOREIGN KEY (`id_personas`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla edi2form.personas_hobbies: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personas_hobbies` DISABLE KEYS */;
INSERT INTO `personas_hobbies` (`id`, `id_personas`, `id_hobbies`) VALUES
	(1, 1, 3);
/*!40000 ALTER TABLE `personas_hobbies` ENABLE KEYS */;

-- Volcando estructura para tabla edi2form.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla edi2form.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `usuario`, `email`, `clave`) VALUES
	(1, 'cata', 'catalinango@gmail.com', '0000'),
	(2, 'toto', 'toto@gmail.com', '1111');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
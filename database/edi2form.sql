-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 01:47 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edi2form`
--

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` int(4) unsigned NOT NULL,
  `detalle` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`id`, `detalle`) VALUES
(1, 'MÚSICA'),
(2, 'TEATRO'),
(3, 'DEPORTE'),
(4, 'ACTIVIDADES AL AIRE LIBRE'),
(5, 'VIDEOJUEGOS');

-- --------------------------------------------------------

--
-- Table structure for table `ocupaciones`
--

CREATE TABLE IF NOT EXISTS `ocupaciones` (
  `id` int(4) unsigned NOT NULL,
  `detalle` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ocupaciones`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(4) unsigned NOT NULL,
  `dni` char(8) NOT NULL,
  `apyn` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` enum('F','M') NOT NULL,
  `id_ocupacion` int(4) unsigned NOT NULL,
  `sugerencias` text
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id`, `dni`, `apyn`, `email`, `sexo`, `id_ocupacion`, `sugerencias`) VALUES
(1, '12345678', 'Armando Paredes', 'armandoparedes@gmail.com', 'M', 1, NULL),
(15, '37654795', 'ROSA LINDA', 'prof.rosa@gmail.com', 'F', 1, 'fdgdfgdfgdfg'),
(16, '34876033', 'LAURA CRIADO', 'criadolaura@kindle.com', 'F', 2, 'bcvbvcbcvb'),
(17, '28934657', 'PABLO SANCHEZ', 'pablosan78@gmail.com', 'M', 7, 'jskskjakjasdn');

-- --------------------------------------------------------

--
-- Table structure for table `personas_hobbies`
--

CREATE TABLE IF NOT EXISTS `personas_hobbies` (
  `id` int(4) unsigned NOT NULL,
  `id_personas` int(4) unsigned NOT NULL,
  `id_hobbies` int(4) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas_hobbies`
--

INSERT INTO `personas_hobbies` (`id`, `id_personas`, `id_hobbies`) VALUES
(1, 1, 3),
(2, 15, 1),
(3, 15, 2),
(4, 15, 3),
(8, 17, 4),
(9, 17, 5),
(10, 16, 4),
(11, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) unsigned NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `clave`) VALUES
(1, 'cata', 'catalinango@gmail.com', '0000'),
(2, 'toto', 'toto@gmail.com', '1111'),
(3, 'laura', 'laura@amoalaura.com', 'sarasa'),
(4, 'pablo', 'pablo@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocupaciones`
--
ALTER TABLE `ocupaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni_sexo` (`dni`,`sexo`),
  ADD KEY `personas_ocupaciones` (`id_ocupacion`);

--
-- Indexes for table `personas_hobbies`
--
ALTER TABLE `personas_hobbies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hobbies` (`id_hobbies`),
  ADD KEY `personas` (`id_personas`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ocupaciones`
--
ALTER TABLE `ocupaciones`
  MODIFY `id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `personas_hobbies`
--
ALTER TABLE `personas_hobbies`
  MODIFY `id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ocupaciones` FOREIGN KEY (`id_ocupacion`) REFERENCES `ocupaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personas_hobbies`
--
ALTER TABLE `personas_hobbies`
  ADD CONSTRAINT `hobbies` FOREIGN KEY (`id_hobbies`) REFERENCES `hobbies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas` FOREIGN KEY (`id_personas`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

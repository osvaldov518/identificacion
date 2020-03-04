-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2020 a las 08:44:18
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `identificacion`
--
CREATE DATABASE IF NOT EXISTS `identificacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `identificacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosrandom`
--

DROP TABLE IF EXISTS `datosrandom`;
CREATE TABLE IF NOT EXISTS `datosrandom` (
  `id` int(11) NOT NULL,
  `col1` float DEFAULT NULL,
  `col2` float DEFAULT NULL,
  `col3` float DEFAULT NULL,
  `col4` float DEFAULT NULL,
  `col5` float DEFAULT NULL,
  `col6` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

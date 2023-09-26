-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2023 a las 06:53:27
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goleadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clubes`
--

CREATE TABLE `clubes` (
  `Club_ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Liga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clubes`
--

INSERT INTO `clubes` (`Club_ID`, `Nombre`, `Liga`) VALUES
(1, 'Barcelona', 'LaLiga'),
(2, 'Boca Juniors', 'LPF'),
(3, 'Real Madrid', 'LaLiga'),
(4, 'River Plate', 'LPF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goleadores`
--

CREATE TABLE `goleadores` (
  `Jugador_ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Club` int(11) NOT NULL,
  `Goles` int(11) NOT NULL,
  `PJ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `goleadores`
--

INSERT INTO `goleadores` (`Jugador_ID`, `Nombre`, `Club`, `Goles`, `PJ`) VALUES
(1, 'Joao Felix', 1, 3, 5),
(2, 'Robert Lewandowski', 1, 6, 6),
(3, 'Edinson Cavani', 2, 1, 8),
(4, 'Salomon Rondon', 4, 1, 3),
(5, 'Jude Bellingham', 3, 5, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clubes`
--
ALTER TABLE `clubes`
  ADD PRIMARY KEY (`Club_ID`);

--
-- Indices de la tabla `goleadores`
--
ALTER TABLE `goleadores`
  ADD PRIMARY KEY (`Jugador_ID`),
  ADD KEY `FK_goleadores_clubes` (`Club`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `goleadores`
--
ALTER TABLE `goleadores`
  ADD CONSTRAINT `FK_goleadores_clubes` FOREIGN KEY (`Club`) REFERENCES `clubes` (`Club_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

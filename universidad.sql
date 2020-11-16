-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2020 a las 00:49:26
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `nota_alumno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `id_alumno`, `id_materia`, `nota_alumno`, `created_at`, `updated_at`) VALUES
(1, 11, 4, 9, '2020-11-16 23:27:13', '2020-11-17 03:47:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `materia` varchar(60) NOT NULL,
  `cuatrimestre` int(50) NOT NULL,
  `cupos` int(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `materia`, `cuatrimestre`, `cupos`, `created_at`, `updated_at`) VALUES
(1, 'Matematica', 1, 3, '2020-11-16 23:24:34', '2020-11-16 23:24:34'),
(2, 'Prog3', 3, 5, '2020-11-16 23:24:34', '2020-11-16 23:24:34'),
(3, 'Lab3', 3, 4, '2020-11-16 23:24:34', '2020-11-16 23:24:34'),
(4, 'Legislacion', 4, 8, '2020-11-16 23:24:34', '2020-11-17 03:27:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `tipo`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Maggie', 'mordermucho', 'admin', 'maggierodi@gmail.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(2, 'Luna', 'LtbSRycZYGN', 'profesor', 'lunaroy@hotmail.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(3, 'Perlita', 'L1hLk58z76u', 'admin', 'perlus@outlook.es', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(4, 'Brandice', 'RfZXcspEHx', 'alumno', 'bquin3@ft.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(5, 'Dniren', '6oPm42', 'alumno', 'dsiemens4@ocn.ne.jp', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(6, 'Ryley', 'GI3G3FJqt', 'profesor', 'rgosselin5@ebay.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(7, 'Chev', '3UEjYNiBjo1U', 'alumno', 'ceckhard6@mit.edu', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(8, 'Frederique', 'aFevBiL', 'profesor', 'fgodart7@go.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(9, 'Caleb', 'wnF0IpM9W', 'alumno', 'cmeni8@ibm.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(10, 'Ester', '4jHKgW', 'alumno', 'edirr9@stumbleupon.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11'),
(11, 'pepe', '123456', 'alumno', 'pepe@mail.com', '2020-11-16 23:24:11', '2020-11-16 23:24:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

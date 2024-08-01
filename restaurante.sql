-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2024 a las 05:03:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `rol` enum('administrador','empleado','','') NOT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaActualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `apellidos`, `usuario`, `password`, `rol`, `fechaCreacion`, `fechaActualizacion`) VALUES
(1, 'Administrador', 'Administrador Prueba', 'admin', 'admin', 'administrador', NULL, NULL),
(3, 'Marcos', 'Tus Apellidos', 'marcos', 'marcos', 'administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anulaciones`
--

CREATE TABLE `anulaciones` (
  `id` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `fechaAnulacion` datetime NOT NULL,
  `motivo` text NOT NULL,
  `devolucion` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anulaciones`
--

INSERT INTO `anulaciones` (`id`, `id_reserva`, `fechaAnulacion`, `motivo`, `devolucion`) VALUES
(1, 1, '2024-07-23 08:06:19', 'No asistirá, motivos familiares', 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `numeroMesa` int(11) NOT NULL,
  `fechaQueReservo` datetime NOT NULL,
  `fechaDeReserva` date NOT NULL,
  `pagoReserva` decimal(4,2) NOT NULL,
  `estado` enum('reservado','anulado','finalizado','no asistio') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `dni`, `nombre`, `apellidos`, `celular`, `numeroMesa`, `fechaQueReservo`, `fechaDeReserva`, `pagoReserva`, `estado`) VALUES
(1, '71877865', 'Jhon', 'Alcocer Alcantara', '987654321', 1, '2024-07-22 06:46:40', '2024-07-23', 10.00, 'anulado'),
(4, '87654321', 'Nathaly', 'Espiritu Torres', '874562319', 3, '2024-07-22 07:41:27', '2024-07-22', 30.00, 'no asistio'),
(7, '78451263', 'Almendra', 'Inga Espinoza', '987654321', 1, '2024-07-24 16:19:21', '2024-07-25', 30.00, 'no asistio'),
(8, '71873455', 'Marko', 'Tugyh', '348979887', 3, '2024-07-24 16:27:49', '2024-07-24', 30.00, 'no asistio'),
(9, '78451263', 'Lucho', 'Inga', '576847854', 2, '2024-07-25 10:09:53', '2024-07-25', 30.00, 'no asistio'),
(11, '71873455', 'Marko', 'Sfeg', '877876656', 1, '2024-07-30 22:17:53', '2024-07-30', 30.00, 'no asistio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anulacion_reserva` (`id_reserva`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  ADD CONSTRAINT `fk_anulacion_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

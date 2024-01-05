-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2024 a las 18:51:02
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
-- Base de datos: `university`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_clase` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido`, `ciudad`, `telefono`, `id_clase`) VALUES
(2, 'Allison', 'Guti Cardenas', 'Armenia', '310 5979797', 8),
(4, 'Luisa Fernanda', 'Chávez Rodríguez', 'Pasto', '310 320 3232', 13),
(5, 'Adam', 'Warlock', 'California, USA', '900 645 6645', 6),
(8, 'OmarLane', 'Lane', 'Munchen, GER', '401 5545656', 10),
(10, 'Yuyis', 'Petronila', 'México', '5555 555 55', 1),
(11, 'San', 'Bombin', 'Turquía', '800 455 4545', 2),
(12, 'Luisa María', 'Maribondia', 'King Kong Land', '465 465 4654', 6),
(13, 'Don', 'Omar', 'Rep. Dominicana', '123 1231223', 8),
(14, 'Suso', 'El Paspi', 'Medellín', '310 264 7894', 11),
(15, 'John', 'Wick', 'Louisiana', '467 949 4571', 9),
(16, 'Thanos', 'Pineda', 'Saturno', '**** **** *****', 11),
(17, 'Jairon', 'Man', 'New York', '*** **** *****', 5),
(18, 'Jairo', 'Now', 'Guatemala', '123 3214564', 7),
(19, 'Armando', 'Esto', 'Springfield, USA', '901 978 2143', 12),
(20, 'Tom', 'Huele', 'Metrópolis', '504 000 1247', 11),
(21, 'Kakarotto', 'Gutiérrez', 'Ciudad Central', '647 567 9431', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(20) NOT NULL,
  `clase` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`) VALUES
(1, 'Inglés'),
(2, 'Español'),
(3, 'Física'),
(4, 'Química'),
(5, 'Geografía'),
(6, 'Biología'),
(7, 'Matemáticas'),
(8, 'Astronomía'),
(9, 'Cálculo'),
(10, 'Programación'),
(11, 'Educación Física'),
(12, 'Dibujo Arquitectónic'),
(13, 'Desarrollo Videojueg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `id` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `id_clase` int(10) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `email`, `name`, `lastname`, `direccion`, `fecha`, `id_clase`, `id_rol`, `estado`) VALUES
(1, 'dinoraizel@hotmail.com', 'Omar Junior', 'Osorio León', 'Cra. 19 - Armenia', '2024-01-01', 2, 1, 'Activo'),
(4, 'annielane@gmail.com', 'Annie', 'Osorio', 'Cra. 19 - Armenia', '2023-12-01', 5, 2, 'Activo'),
(5, 'susan@susan', 'Susan Jane', 'Osorio', 'Cra. 19 - Armenia', '2023-12-08', 3, 2, 'Activo'),
(19, 'joysadriana19@hotmail.com', 'Joyssy Adriana', 'Rodríguez P.', 'Carrera 19', '2024-01-19', 4, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(20) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Maestro'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`, `rol_id`) VALUES
(1, 'admin@admin', '$2y$10$64nJ02cFjOoaV6tPh1xegurmL2TzVMcUTuRG9y0qPBUWtilIuzBn.', 1),
(2, 'maestro@maestro', '$2y$10$Q/KxcVPfNFkLJ.aiIWU83uG17i5qEEWfcc91MbZ2km4IcIbXSCZ5W', 2),
(3, 'alumno@alumno', '$2y$10$fBN/hv2ASX9Iwo/mNvmCg.HylK40T5fpu2IQ6Gs.4IhKCG8VAYzy.', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clase_id` (`id_clase`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_roles_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_id_clases` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_clases` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `maestros_rol_id` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `roles_roles_id` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2016 a las 21:38:18
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `changes`
--

CREATE TABLE IF NOT EXISTS `changes` (
  `id` int(10) unsigned NOT NULL,
  `tutorial_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `newDate` date NOT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `finish_hour` int(11) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `start_minute` int(11) NOT NULL,
  `finish_minute` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `changes`
--

INSERT INTO `changes` (`id`, `tutorial_id`, `user_id`, `date`, `newDate`, `start_hour`, `finish_hour`, `place`, `start_minute`, `finish_minute`) VALUES
(23, 9, 27, '2016-02-15', '2016-02-19', 10, 12, 'desp 3.2', 0, 0),
(24, 10, 27, '2016-02-16', '2016-02-19', 14, 15, 'lab 2.1', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imparts`
--

CREATE TABLE IF NOT EXISTS `imparts` (
  `id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imparts`
--

INSERT INTO `imparts` (`id`, `subject_id`, `user_id`) VALUES
(5, 2, 27),
(6, 3, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL,
  `transmitter_id` int(10) unsigned DEFAULT NULL,
  `receiver_id` int(10) unsigned DEFAULT NULL,
  `message` text COLLATE latin1_spanish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studies`
--

CREATE TABLE IF NOT EXISTS `studies` (
  `id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `credits` int(10) unsigned DEFAULT NULL,
  `quarter` enum('1','2') NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `credits`, `quarter`, `code`) VALUES
(2, 'asignatura 1', 6, '2', 'a1_code'),
(3, 'asignatura 2', 6, '1', 'a2_code');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorials`
--

CREATE TABLE IF NOT EXISTS `tutorials` (
  `id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `day` enum('lunes','martes','miercoles','jueves','viernes') DEFAULT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `finish_hour` int(11) DEFAULT NULL,
  `place` int(10) DEFAULT NULL,
  `start_minute` int(11) NOT NULL,
  `finish_minute` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutorials`
--

INSERT INTO `tutorials` (`id`, `subject_id`, `user_id`, `day`, `start_hour`, `finish_hour`, `place`, `start_minute`, `finish_minute`) VALUES
(9, 2, 27, 'lunes', 10, 12, 0, 0, 0),
(10, 3, 27, 'martes', 10, 12, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `type` enum('admin','profesor','alumno','') NOT NULL,
  `email` varchar(50) NOT NULL,
  `authenticated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `username`, `type`, `email`, `authenticated`) VALUES
(25, 'admin', 'admin', '$2a$10$8Tv4eIBfgTGOm2D9c54.NutRrM/zzfXEtSavAdbKuujOdk9Z41Q0C', 'admin', 'admin', 'admin@correo.es', 1),
(26, 'profesor 1', 'profesor 1', '$2a$10$nd148RKBo55FcUe59zvaJO7ocmZgQx9RyNEGbzczkkPKhYHNJtAqu', 'p1', 'profesor', 'p1@correo.com', 1),
(27, 'profesor 2', 'profesor 2', '$2a$10$EniDKT/h3JggG9T7QrbX6uJ7yYAMbMd/O5sJuULtc7W9XxCbWg7YK', 'p2', 'profesor', 'p2@correo.es', 1),
(28, 'user', 'user', '$2a$10$Zg2W9FGsW9hV4oaqMAgFzuKyaDioaTwbXQUSxs4kBYORPQ3nC.hi.', 'user', 'alumno', 'tfgusuario@gmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`id`), ADD KEY `tutorial_id` (`tutorial_id`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `imparts`
--
ALTER TABLE `imparts`
  ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `studies`
--
ALTER TABLE `studies`
  ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `changes`
--
ALTER TABLE `changes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `imparts`
--
ALTER TABLE `imparts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `studies`
--
ALTER TABLE `studies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `changes`
--
ALTER TABLE `changes`
ADD CONSTRAINT `changes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `changess_ibfk_1` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`);

--
-- Filtros para la tabla `imparts`
--
ALTER TABLE `imparts`
ADD CONSTRAINT `imparts_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `imparts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `studies`
--
ALTER TABLE `studies`
ADD CONSTRAINT `studies_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `studies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tutorials`
--
ALTER TABLE `tutorials`
ADD CONSTRAINT `tutorials_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `tutorials_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

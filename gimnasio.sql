-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-10-2017 a las 10:51:13
-- Versión del servidor: 5.5.54-0+deb8u1
-- Versión de PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE IF NOT EXISTS `fichas` (
`id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `sede_id` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `interno` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `puesto` varchar(255) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id`, `firstname`, `lastname`, `sede_id`, `telefono`, `interno`, `celular`, `email`, `puesto`, `activated`, `banned`, `ban_reason`, `created`, `modified`) VALUES
(3, 'Enzo', 'Cardenas', 1, 121212, 0, 0, 'enzo@cardenas.com', '2', 1, 0, NULL, '0000-00-00 00:00:00', '2017-09-17 19:03:39'),
(4, 'Prueba', 'Pirulo', 2, 44444444, 0, 0, 'lalala@codicilabs.com', '3', 1, 0, NULL, '0000-00-00 00:00:00', '2017-09-17 19:03:01'),
(5, 'Esteban', 'Brazilia', 1, 55555555, 0, 0, 'estebanBrasilia@codicilabs.com', '2', 1, 0, NULL, '0000-00-00 00:00:00', '2017-09-17 19:04:18'),
(6, 'test', 'test1', 1, 42123413, 1, 152325434, 'labs@aoc.com', '2', 1, 0, NULL, '0000-00-00 00:00:00', '2017-09-15 20:28:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE IF NOT EXISTS `puestos` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id`, `name`, `code`) VALUES
(2, 'Puesto 1', 'asd122'),
(3, 'Supervisor de area', '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `default` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`, `default`) VALUES
(1, 'sysadmin', 1),
(2, 'admin', 2),
(3, 'user', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE IF NOT EXISTS `sedes` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `contacto` text NOT NULL,
  `mail_list` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `direccion`, `codigo`, `contacto`, `mail_list`) VALUES
(1, 'Caballito', 'Av La Plata 123', 'CA12', 'Se puede contactar por tel al 4444 4444', ''),
(2, 'Banfield', 'laprida 201', '005', 'contactar a pill 48546756!', 'Esta sede queda lejos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `role_id`) VALUES
(10, 'Martin Pan', '$2a$08$k9MpHg7SSJ.z2AEpXJM6f.KVPapaDX/Di7D/.Aqy5bm.Sb6loQhpy', 'martinpan@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '200.115.250.117', '2017-09-05 14:36:40', '2017-08-22 20:36:27', '2017-09-17 19:05:09', 2),
(11, 'admin', '$2a$08$dbJMAlWArnzNdkZHLQOG4eZilDwu9CSIvbxSrhjcmroE7wGm9uwXm', 'admin@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '186.125.37.185', '2017-10-02 17:46:00', '2017-09-04 18:41:04', '2017-10-02 20:46:00', 2),
(12, 'sysadmin', '$2a$08$lWE/2jxkZ06KR1yjKyX3d.0UbIgQVf6.tKCcb5ipM6.00bvpo/ovm', 'sysadmin@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '200.115.251.96', '2017-10-03 10:20:31', '2017-09-06 16:41:24', '2017-10-03 13:20:32', 1),
(14, 'user', '$2a$08$bt.TAJYahxHPZwi27Sg1a.vJzWwbLb8wnHL11GQkY1/nhFhSDVqdm', 'user@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '190.210.134.121', '2017-09-19 18:11:08', '2017-09-07 10:36:19', '2017-09-19 21:11:26', 3),
(18, 'pill', '$2a$08$kFzxZtFxpMHQ3Q/ZV/3DfuwOrpNPIXbrJ91qROrR5/OVkqIWapAJW', 'pill@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '190.210.134.121', '2017-09-19 16:47:52', '2017-09-17 17:38:07', '2017-09-19 19:47:52', 1),
(20, 'nuevouser', '$2a$08$mXyung9v2ZAEEaz7MmUtieQT9RGBSI7H6UoYKA8rY7m.n7WLcUFvS', 'nuevouser@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '181.165.164.59', '0000-00-00 00:00:00', '2017-09-17 17:46:09', '2017-09-17 20:46:09', 3),
(21, 'nuevoadmin', '$2a$08$yBbgdQ21CvBNGJv8vo7Qne0hJilxna5nz0a6HDHfEUI47zR2jxL3a', 'nuevoadmin@codicilabs.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '181.165.164.59', '2017-09-17 18:44:56', '2017-09-17 17:47:02', '2017-09-17 22:03:06', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('219438dd47008f82071420856ba5aa15', 12, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '181.165.164.59', '2017-09-16 17:10:35'),
('f57d4633fe4d1e9d3f160cbfd2d25627', 11, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '181.165.164.59', '2017-09-16 17:11:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook_token` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`, `facebook_id`, `facebook_token`) VALUES
(1, 1, NULL, NULL, NULL, NULL),
(2, 7, NULL, NULL, NULL, NULL),
(3, 7, NULL, NULL, NULL, NULL),
(4, 8, NULL, NULL, NULL, NULL),
(5, 9, NULL, NULL, NULL, NULL),
(6, 10, NULL, NULL, NULL, NULL),
(7, 11, NULL, NULL, NULL, NULL),
(8, 12, NULL, NULL, NULL, NULL),
(9, 13, NULL, NULL, NULL, NULL),
(10, 14, NULL, NULL, NULL, NULL),
(11, 15, NULL, NULL, NULL, NULL),
(12, 16, NULL, NULL, NULL, NULL),
(13, 17, NULL, NULL, NULL, NULL),
(14, 18, NULL, NULL, NULL, NULL),
(15, 19, NULL, NULL, NULL, NULL),
(16, 20, NULL, NULL, NULL, NULL),
(17, 21, NULL, NULL, NULL, NULL),
(18, 22, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_autologin`
--
ALTER TABLE `user_autologin`
 ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Indices de la tabla `user_profiles`
--
ALTER TABLE `user_profiles`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `user_profiles`
--
ALTER TABLE `user_profiles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

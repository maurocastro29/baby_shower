-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2024 a las 19:30:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baby_shower`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 1,
  `imagen` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_maestro_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre`, `detalle`, `cantidad`, `total`, `imagen`, `estado`, `id_usuario`, `id_maestro_usuario`) VALUES
(1, 'Almohada estabilizadora', 'Almohada estabilizadora para bebé de color rojo. Costo Aproximado $350.000', 2, 4, 'ALMOHADA ESTABILIZADORA.jpeg', 1, 3, 2),
(2, 'Baberos tela', 'Baberos de tela de diferentes colores. (A su elección) $25.000', 1, 3, 'BABEROS DE TELA.jpeg', 1, 3, 2),
(3, 'Bodys', 'Bodys blancos. cantidad a su elección', 0, 1, 'BODYS BLANCOS.jpeg', 1, 3, 2),
(4, 'Cobija termica', 'Cobijas termicas', 0, 1, 'COBIJA TERMICA 2.jpeg', 1, 3, 2),
(5, 'botellas de almacenamiento', 'Botellas de almacenamiento grandes', 0, 1, 'BOTELLAS DE ALMACENAMIENTO.jpeg', 1, 3, 2),
(6, 'Bolsas de almacenamiento', 'bolsas de almacenamiento', 0, 1, 'BOLSAS DE ALMACENAMIENTO.jpeg', 1, 3, 2),
(7, 'cobijas burbujeras', 'Cobijas burbujeras', 0, 1, 'COBIJAS BURBUJERAS 2.jpeg', 1, 3, 2),
(8, 'Cuna', 'Cuna colecho', 0, 1, 'CUNA COLECHO.jpeg', 1, 3, 2),
(9, 'Ducha baño', 'Ducha de baño', 0, 1, 'DUCHA DE BAÑO.jpeg', 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_elegidos`
--

CREATE TABLE `articulos_elegidos` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos_elegidos`
--

INSERT INTO `articulos_elegidos` (`id`, `id_articulo`, `id_usuario`, `fecha`) VALUES
(15, 1, 2, '2024-10-06'),
(18, 2, 1, '2024-10-06'),
(19, 1, 1, '2024-10-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro_usuario`
--

CREATE TABLE `maestro_usuario` (
  `id` int(10) NOT NULL,
  `id_tipo_identificacion` int(11) NOT NULL,
  `identificacion` varchar(25) NOT NULL,
  `primer_nombre` varchar(25) NOT NULL,
  `segundo_nombre` varchar(25) DEFAULT NULL,
  `primer_apellido` varchar(25) NOT NULL,
  `segundo_apellido` varchar(25) DEFAULT NULL,
  `nombre_bebe` varchar(50) DEFAULT NULL,
  `sexo_bebe` varchar(1) NOT NULL DEFAULT '3',
  `fecha_evento` date DEFAULT NULL,
  `hora_evento` time DEFAULT NULL,
  `usuario` varchar(25) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `celular` varchar(15) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `maestro_usuario`
--

INSERT INTO `maestro_usuario` (`id`, `id_tipo_identificacion`, `identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `nombre_bebe`, `sexo_bebe`, `fecha_evento`, `hora_evento`, `usuario`, `activo`, `celular`, `correo`, `fecha_registro`, `id_tipo_usuario`) VALUES
(1, 1, '111', 'Usuario', NULL, 'Root', NULL, '', '3', NULL, NULL, 'root', 1, '', '', '2024-08-29 23:49:47', 3),
(2, 1, '123456', 'Athalia', NULL, 'De Alba', NULL, '', '3', NULL, NULL, 'thali', 1, '', '', '2024-08-29 23:50:51', 3),
(3, 1, '1082411177', 'Mauricio', 'Miguel', 'Castro', 'Ahumada', '', '3', NULL, NULL, 'mauro', 1, '3043673451', 'mm.castro.29@gmail.com', '2024-08-31 18:01:11', 3),
(4, 1, '46545412151', 'Selena', 'Maria', 'Peluffo', 'Camacho', '', '3', NULL, NULL, 'selena', 1, '3106041426', 'selena@gmail.com', '2024-08-31 20:32:47', 1),
(9, 1, '1234124412', 'Pablo', '', 'Castro', '', '', '3', NULL, NULL, 'pabloC', 1, '', 'pablo.castro@gmail.com', '0000-00-00 00:00:00', 1),
(10, 1, '10555566115', 'Camilo', '', 'Sanchez', '', '', '3', '2025-02-22', '18:00:00', 'camilo.andrade', 1, '3163211415', 'camilo.sanchez@gmail.com', '2024-10-22 05:00:00', 1),
(11, 1, '1055556612', 'Maria', '', 'Conrado', '', 'Alejandra', '2', '2025-02-04', '16:00:00', 'maria2', 1, '3163211413', 'maria.conrado@gmail.com', '2024-10-22 05:00:00', 1),
(12, 1, '3122115454', 'Alejandra', 'Maria', 'Rios', '', '', '3', '2024-11-23', '18:00:00', 'aleja.rios', 1, '3152141516', 'aleja.rios@gmail.com', '2024-10-22 05:00:00', 1),
(13, 1, '1222544511', 'Jose', '', 'Rivera', '', 'Manuel', '1', '2024-12-04', '18:30:00', 'jose.rivera', 1, '3143121511', 'jose.rivera@gmail.com', '2024-10-22 05:00:00', 1),
(14, 1, '10251511216', 'Luis', 'Miguel', 'Castro', 'Camacho', 'Rosa', '2', '2024-11-29', '18:15:00', 'luis.castro', 1, '3121241516', 'luis.castro@gmail.com', '2024-10-22 05:00:00', 1),
(15, 2, '1055412121', 'Angel', '', 'Romero', '', 'Pedro', '1', '2024-12-27', '17:00:00', 'angel.romero', 1, '3012131512', 'angel.romero@gmail.com', '2024-10-22 05:00:00', 1),
(16, 1, '10221231516', 'Lucia', '', 'Fernandez', '', 'Ricardo', '1', '2024-11-21', '19:00:00', 'lucia.fernandez', 1, '3121215163', 'lucia.fernandez@gmail.com', '2024-10-22 05:00:00', 1),
(17, 1, '16554544511', 'Yahir', '', 'Villegas', '', 'Orlando', '1', '2025-02-20', '18:00:00', 'yair.villegas', 1, '3121521615', 'yahir.villegas@gmail.com', '2024-10-22 05:00:00', 1),
(18, 1, '10555566124', 'Adela', '', 'Cuervo', '', 'Fabiola', '2', '2024-12-26', '16:00:00', 'adela.cuervo', 1, '3163211312', 'adela.cuerco@gmail.com', '2024-10-22 05:00:00', 1),
(19, 1, '1321151516', 'Carla', '', 'Alvarado', '', 'Valentina', '2', '2024-12-26', '17:00:00', 'carla.alvarado', 1, '3151211415', 'carla.alvarado@gmail.com', '2024-10-22 05:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE `tipo_identificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `abreviatura` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_identificacion`
--

INSERT INTO `tipo_identificacion` (`id`, `nombre`, `abreviatura`) VALUES
(1, 'Cédula de Ciudadanía', 'CC'),
(2, 'Tarjeta de Identidad', 'TI'),
(3, 'Registro Civil de Nacimiento', 'RC'),
(4, 'Cédula de Extranjería', 'CE'),
(5, 'Pasaporte', 'P'),
(6, 'Documento Nacional de Identidad', 'DNI'),
(7, 'Permiso Especial de Permanencia', 'PEP'),
(8, 'Salvoconducto de Permanencia', 'SC'),
(9, 'Licencia de Conducción', 'LC'),
(10, 'Carné Diplomático', 'CD'),
(11, 'Permiso por Protección Temporal', 'PPT'),
(12, 'Tarjeta de Residencia', 'TR'),
(13, 'Salvoconducto SC-2', 'SC-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id_tipo`, `tipo`) VALUES
(1, 'ADMIN'),
(2, 'GENERAL'),
(3, 'ROOT'),
(4, 'EDITOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `password` varchar(62) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_maestro_usuario` int(11) NOT NULL,
  `ultimo_ingreso` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `usuario`, `password`, `id_tipo`, `id_estado`, `id_maestro_usuario`, `ultimo_ingreso`) VALUES
(1, 'Mauricio', 'Castro', 'mauricio', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 2, '23/10/2024 07:47:49'),
(2, 'Athalia', 'De Alba', 'thali', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 2, '06/10/2024 18:05:36'),
(3, 'Usuario', 'Anonimo', 'anonimos', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 2, 1, 2, '15/08/2024 19:46:38'),
(4, 'Eudis', 'Castro Cassares', 'kike', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 2, '15/08/2024 19:42:30'),
(5, 'Usuario', 'Prueba', 'prueba', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 2, 1, 2, '06/09/2024 18:50:16'),
(6, 'Mauricio', 'Castro', 'mauro', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 3, '31/08/2024 11:20:06'),
(7, 'Miguel', 'Ahumada', 'miguel', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 4, 1, 3, '31/08/2024 11:54:42'),
(8, 'Selena', 'Peluffo', 'selena', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 4, '06/09/2024 18:26:44'),
(9, 'Martha', 'Peluffo', 'martha', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 4, '31/08/2024 15:13:23'),
(10, 'Windy', 'Peluffo', 'windy', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 1, 1, 4, NULL),
(11, 'Andres', 'Payares', 'andresP', '$2y$12$.Jspsev66NNGnJ6BUF3RseVrNeS22Qb7P08GClCWbyq5dlpdQwzwO', 1, 1, 2, '06/10/2024 15:04:26'),
(12, 'Ricardo', 'Montez', 'ricardoM', '$2y$12$3UORRBk8MVTBXMB1mKtqG.zEOky.UVCpTkTqccZ6OBcrSmXLWYRty', 1, 1, 2, '04/10/2024 20:05:25'),
(13, 'Pablo ', 'Castro ', 'pabloC', '$2y$12$.Jspsev66NNGnJ6BUF3RseVrNeS22Qb7P08GClCWbyq5dlpdQwzwO', 1, 1, 9, '06/10/2024 15:34:43'),
(14, 'Camilo', 'Zarate', 'camiloZ', '$2y$12$OtmQ9KdCMrCFs4y0zQ.tPuIskY6PYZT/xUvQupHlXPb8bZM1MgOyy', 2, 1, 9, '06/10/2024 15:09:10'),
(15, 'Camilo ', 'Sanchez ', 'camilo.andrade', '$2y$12$X5uxO7DxpAUiSn4OpUmTmuGHCZ0lb7/IXHGDfRIYD2NQdKI9P/CUy', 1, 1, 10, '23/10/2024 10:57:33'),
(16, 'Maria ', 'Conrado ', 'maria2', '$2y$12$cL3vV5ThYFBFb3fb/PzTZebTJtRBQ/Yz7YE8dM0XBqhG3KCcl0mty', 1, 1, 11, NULL),
(17, 'Alejandra Maria', 'Rios ', 'aleja.rios', '$2y$12$24twPDHpHQBobuBf5VfeLOHHfZf0DD0hYoOTd5lsV3cmx5RgICCxC', 1, 1, 12, NULL),
(18, 'Jose ', 'Rivera ', 'jose.rivera', '$2y$12$eE9Tn1I30l8olLKls.aAzuOY/wF18SqLqVI8v34GpPcqjLLWjA0rW', 1, 1, 13, NULL),
(19, 'Luis Miguel', 'Castro Camacho', 'luis.castro', '$2y$12$WuOc1BANa3r62NBrYVoX0O0whaWZ5B8OGrVQiuBzaU0dv4BhpG5CO', 1, 1, 14, NULL),
(20, 'Angel ', 'Romero ', 'angel.romero', '$2y$12$uHYMPMg7ZTA.kKite1QHIe31lL75Xf0XpcpPXWZmLCGuonyTTai2u', 1, 1, 15, NULL),
(21, 'Lucia ', 'Fernandez ', 'lucia.fernandez', '$2y$12$rHbpCAp4Ctn1yRKoBje.ZO6zr/OP3zdNJiB5Q054abed28CUHX1am', 1, 1, 16, NULL),
(22, 'Yahir ', 'Villegas ', 'yair.villegas', '$2y$12$9IcZkHA3EllCoHSylTuYiOkVXj/fi.tk6CgojKG5b2At3W4XYN8HC', 1, 1, 17, NULL),
(23, 'Adela ', 'Cuervo ', 'adela.cuervo', '$2y$12$1vWuKaaV9x39qrbVXXRKtOthV2yyh70z/6c4AKQFTt6FcBGlkq1Qa', 1, 1, 18, '22/10/2024 14:05:37'),
(24, 'Carla ', 'Alvarado ', 'carla.alvarado', '$2y$12$1vWuKaaV9x39qrbVXXRKtOthV2yyh70z/6c4AKQFTt6FcBGlkq1Qa', 1, 1, 19, '23/10/2024 08:43:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `fk_articulos_estados1_idx` (`estado`),
  ADD KEY `fk_articulos_usuarios1_idx` (`id_usuario`),
  ADD KEY `fk_maestro_usuario_idx` (`id_maestro_usuario`);

--
-- Indices de la tabla `articulos_elegidos`
--
ALTER TABLE `articulos_elegidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `maestro_usuario`
--
ALTER TABLE `maestro_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `fk_usuarios_estados1_idx` (`activo`),
  ADD KEY `fk_id_tipo_identificacion` (`id_tipo_identificacion`);

--
-- Indices de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_tipo_usuarios_idx` (`id_tipo`),
  ADD KEY `fk_usuarios_estados1_idx` (`id_estado`),
  ADD KEY `fk_maestro_usuario_id` (`id_maestro_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `articulos_elegidos`
--
ALTER TABLE `articulos_elegidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `maestro_usuario`
--
ALTER TABLE `maestro_usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_articulos_estados1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articulos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro_usuario`
--
ALTER TABLE `maestro_usuario`
  ADD CONSTRAINT `fk_id_tipo_identificacion` FOREIGN KEY (`id_tipo_identificacion`) REFERENCES `tipo_identificacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuarios` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_estados1_idx` FOREIGN KEY (`activo`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_maestro_usuario` FOREIGN KEY (`id_maestro_usuario`) REFERENCES `maestro_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_estados1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_tipo_usuarios` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuarios` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql110.infinityfree.com
-- Tiempo de generación: 11-09-2024 a las 21:04:43
-- Versión del servidor: 10.11.9-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_37108021_babyshowerprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_maestro_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre`, `detalle`, `imagen`, `estado`, `id_usuario`, `id_maestro_usuario`) VALUES
(1, 'Almohada estabilizadora', 'Almohada estabilizadora para bebé de color rojo. Costo Aproximado $350.000', 'ALMOHADA ESTABILIZADORA.jpeg', 1, 3, 2),
(2, 'Baberos tela', 'Baberos de tela de diferentes colores. (A su elección) $25.000', 'BABEROS DE TELA.jpeg', 1, 1, 2),
(3, 'Bodys', 'Bodys blancos. cantidad a su elección', 'BODYS BLANCOS.jpeg', 1, 3, 2),
(4, 'Cobija termica', 'Cobijas termicas', 'COBIJA TERMICA 2.jpeg', 1, 5, 2),
(5, 'botellas de almacenamiento', 'Botellas de almacenamiento grandes', 'BOTELLAS DE ALMACENAMIENTO.jpeg', 1, 3, 2),
(6, 'Bolsas de almacenamiento', 'bolsas de almacenamiento', 'BOLSAS DE ALMACENAMIENTO.jpeg', 1, 3, 2),
(7, 'cobijas burbujeras', 'Cobijas burbujeras', 'COBIJAS BURBUJERAS 2.jpeg', 1, 3, 2),
(8, 'Cuna', 'Cuna colecho', 'CUNA COLECHO.jpeg', 1, 3, 2),
(9, 'Ducha baño', 'Ducha de baño', 'DUCHA DE BAÑO.jpeg', 1, 3, 2);

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
  `usuario` varchar(25) NOT NULL,
  `password` varchar(62) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `celular` varchar(15) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_ingreso` date DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `maestro_usuario`
--

INSERT INTO `maestro_usuario` (`id`, `id_tipo_identificacion`, `identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `usuario`, `password`, `activo`, `celular`, `correo`, `fecha_registro`, `ultimo_ingreso`, `id_tipo_usuario`) VALUES
(1, 1, '111', 'Usuario', NULL, 'Root', NULL, 'root', '1f17a3253fa9090f21f48f6aa64909a4', 1, '', '', '2024-08-29 23:49:47', NULL, 3),
(2, 1, '123456', 'Athalia', NULL, 'De Alba', NULL, 'thali', '1f17a3253fa9090f21f48f6aa64909a4', 1, '', '', '2024-08-29 23:50:51', NULL, 3),
(3, 1, '1082411177', 'Mauricio', 'Miguel', 'Castro', 'Ahumada', 'mauro', '1f17a3253fa9090f21f48f6aa64909a4', 1, '3043673451', 'mm.castro.29@gmail.com', '2024-08-31 18:01:11', NULL, 3),
(4, 1, '46545412151', 'Selena', 'Maria', 'Peluffo', 'Camacho', 'selena', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, '3106041426', 'selena@gmail.com', '2024-08-31 20:32:47', NULL, 1);

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
(1, 'Mauricio', 'Castro', 'mauricio', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, 1, 2, '07/09/2024 12:10:18'),
(2, 'Athalia', 'De Alba', 'thali', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, 1, 2, '30/08/2024 08:40:07'),
(3, 'Usuario', 'Anonimo', 'anonimos', '1f17a3253fa9090f21f48f6aa64909a4', 2, 1, 2, '15/08/2024 19:46:38'),
(4, 'Eudis', 'Castro Cassares', 'kike', '1f17a3253fa9090f21f48f6aa64909a4', 1, 1, 2, '15/08/2024 19:42:30'),
(5, 'Usuario', 'Prueba', 'prueba', '1f17a3253fa9090f21f48f6aa64909a4', 2, 1, 2, '06/09/2024 18:50:16'),
(6, 'Mauricio', 'Castro', 'mauro', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, 1, 3, '31/08/2024 11:20:06'),
(7, 'Miguel', 'Ahumada', 'miguel', '1f17a3253fa9090f21f48f6aa64909a4 ', 4, 1, 3, '31/08/2024 11:54:42'),
(8, 'Selena', 'Peluffo', 'selena', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, 1, 4, '06/09/2024 18:26:44'),
(9, 'Martha', 'Peluffo', 'martha', '1f17a3253fa9090f21f48f6aa64909a4 ', 1, 1, 4, '31/08/2024 15:13:23'),
(10, 'Windy', 'Peluffo', 'windy', '1f17a3253fa9090f21f48f6aa64909a4', 1, 1, 4, NULL);

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
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `maestro_usuario`
--
ALTER TABLE `maestro_usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

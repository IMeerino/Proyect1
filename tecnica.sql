-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2022 a las 19:42:44
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `numeroactividad` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombreactividad` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripciona` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enlace` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idsubtema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `aviso` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `idb` int(11) NOT NULL,
  `nombreb` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `correob` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telefonob` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mensajeb` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idgrupo` int(11) NOT NULL,
  `nombregrupo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `turno` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `grado` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idgrupo`, `nombregrupo`, `turno`, `grado`, `grupo`, `idusuario`) VALUES
(62, 'matutino_primer_grado_a', 'matutino', 'primer grado', 'a', 130),
(63, 'matutino_primer_grado_b', 'matutino', 'primer grado', 'b', 132);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idhorario` int(11) NOT NULL,
  `lunes` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `martes` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `miercoles` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `jueves` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `viernes` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idmateria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idmateria` int(11) NOT NULL,
  `nombrem` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtemas`
--

CREATE TABLE `subtemas` (
  `idsubtema` int(11) NOT NULL,
  `numerosubtema` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nombresubtema` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcions` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idtema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `idtema` int(11) NOT NULL,
  `numerotema` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombretema` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripciont` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idmateria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipousuario` int(11) NOT NULL,
  `tipousuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipousuario`, `tipousuario`) VALUES
(1, 'Administrador'),
(2, 'Maestro'),
(3, 'Grupo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombrecompleto` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombreu` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrau` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombrecompleto`, `nombreu`, `contrau`, `idtipousuario`) VALUES
(129, 'admin', 'admin', '123', 1),
(130, 'primero_a_matutino', 'pam', '123', 3),
(131, 'martin', 'martin', '123', 2),
(132, 'primero_b_matutino', 'pbm', '123', 3),
(133, 'maria', 'maria', '123', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsubtema` (`idsubtema`);

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`idb`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idhorario`),
  ADD KEY `idmateria` (`idmateria`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idmateria`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- Indices de la tabla `subtemas`
--
ALTER TABLE `subtemas`
  ADD PRIMARY KEY (`idsubtema`),
  ADD KEY `idtema` (`idtema`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`idtema`),
  ADD KEY `idmateria` (`idmateria`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idtipousuario` (`idtipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `buzon`
--
ALTER TABLE `buzon`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `subtemas`
--
ALTER TABLE `subtemas`
  MODIFY `idsubtema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `idtema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`idsubtema`) REFERENCES `subtemas` (`idsubtema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`idmateria`) REFERENCES `materias` (`idmateria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materias_ibfk_2` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subtemas`
--
ALTER TABLE `subtemas`
  ADD CONSTRAINT `subtemas_ibfk_1` FOREIGN KEY (`idtema`) REFERENCES `temas` (`idtema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`idmateria`) REFERENCES `materias` (`idmateria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipo_usuario` (`idtipousuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

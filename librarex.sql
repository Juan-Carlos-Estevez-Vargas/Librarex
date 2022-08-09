-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2022 a las 21:50:53
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
-- Base de datos: `librarex`
--
CREATE DATABASE IF NOT EXISTS `librarex` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `librarex`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(1000) COLLATE utf8_bin NOT NULL,
  `categoria` varchar(50) COLLATE utf8_bin NOT NULL,
  `libro` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `imagen`, `categoria`, `libro`) VALUES
(35, 'Algoritmia', '1660072387_AlgorithmsGrow.png', 'Programación', '1660072387_AlgorithmsNotesForProfessionals.pdf'),
(36, '.Net Framework', '1660072419_.netFramework.png', 'Programación', '1660072419_DotNETFrameworkNotesForProfessionals.pdf'),
(37, 'Angular 2+', '1660072521_Angular2Grow.png', 'Programación', '1660072521_Angular2NotesForProfessionals.pdf'),
(38, 'Android', '1660072689_AndroidGrow.png', 'Programación', '1660072689_AndroidNotesForProfessionals.pdf'),
(39, 'Angular JS', '1660072708_AngularJSGrow.png', 'Programación', '1660072708_AngularJSNotesForProfessionals.pdf'),
(40, 'Bash', '1660072921_BashGrow.png', 'Programación', '1660072921_BashNotesForProfessionals.pdf'),
(41, 'C', '1660072950_CGrow.png', 'Programación', '1660072950_CNotesForProfessionals.pdf'),
(42, 'CSS', '1660073267_CSSGrow.png', 'Programación', '1660073267_CSSNotesForProfessionals.pdf'),
(43, 'Entity Framework', '1660073378_EntityFrameworkGrow.png', 'Programación', '1660073378_EntityFrameworkNotesForProfessionals.pdf'),
(44, 'C++', '1660073621_CPlusPlusGrow.png', 'Programación', '1660073621_CPlusPlusNotesForProfessionals.pdf'),
(45, 'C#', '1660073755_CSharpGrow.png', 'Programación', '1660073755_CSharpNotesForProfessionals.pdf'),
(46, 'Excel VBA', '1660073846_ExcelVBAGrow.png', 'Programación', '1660073846_ExcelVBANotesForProfessionals.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `email`, `usuario`, `password`, `imagen`) VALUES
(1, 'Juan Carlos Estevez Vargas', 'juank@example.com', 'Juank', '1234', 'profile-img.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2024 a las 01:00:18
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
-- Base de datos: `xube`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos de compras`
--

CREATE TABLE `carritos de compras` (
  `id_Carrito` int(11) NOT NULL,
  `num_Pedido` varchar(30) NOT NULL,
  `subtotal` varchar(20) NOT NULL,
  `impuestos` varchar(50) NOT NULL,
  `total` varchar(20) NOT NULL,
  `estatus` varchar(50) NOT NULL,
  `forma_Pago` varchar(50) DEFAULT NULL,
  `id_Usuario` int(12) DEFAULT NULL,
  `id_Cliente` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carritos de compras`
--

INSERT INTO `carritos de compras` (`id_Carrito`, `num_Pedido`, `subtotal`, `impuestos`, `total`, `estatus`, `forma_Pago`, `id_Usuario`, `id_Cliente`) VALUES
(7, '1', '3000', '480', '3480', '', '004', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_Cliente` int(11) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `razon_Social` varchar(100) NOT NULL,
  `regimen_Fiscal` varchar(3) NOT NULL,
  `forma_Pago` varchar(3) NOT NULL,
  `codigo_PostalFiscal` varchar(5) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `pais` varchar(2) NOT NULL,
  `num_Ext` varchar(8) NOT NULL,
  `num_Int` varchar(8) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_Cliente`, `rfc`, `razon_Social`, `regimen_Fiscal`, `forma_Pago`, `codigo_PostalFiscal`, `calle`, `colonia`, `estado`, `municipio`, `pais`, `num_Ext`, `num_Int`, `id_Usuario`) VALUES
(5, 'GAAP192685', 'pedro abad garcia', '602', '004', '75060', 'venustiano carranza', '3 cruces', '21', 'lomas', 'MX', '22', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones de descuento`
--

CREATE TABLE `cupones de descuento` (
  `id_Cupon` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `descuento` float NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `estatus` bit(8) NOT NULL,
  `vigencia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cupones de descuento`
--

INSERT INTO `cupones de descuento` (`id_Cupon`, `nombre`, `descuento`, `descripcion`, `estatus`, `vigencia`) VALUES
(3, 'cupon feli', 630, 'descuento de felicidad a planes de 1 año', b'00000001', '2024-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles carritos`
--

CREATE TABLE `detalles carritos` (
  `id_Carrito` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `descuento` float NOT NULL,
  `impuestos` float NOT NULL,
  `total` float NOT NULL,
  `id_Plan` int(11) NOT NULL,
  `id_Cupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles carritos`
--

INSERT INTO `detalles carritos` (`id_Carrito`, `subtotal`, `descuento`, `impuestos`, `total`, `id_Plan`, `id_Cupon`) VALUES
(8, 3000, 630, 480, 2850, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_Permiso` int(11) NOT NULL,
  `editar_Usuario` bit(8) NOT NULL,
  `agregar_Usuario` bit(8) NOT NULL,
  `borrar_Usuario` bit(8) NOT NULL,
  `editar_Cupon` bit(8) NOT NULL,
  `agregar_Cupon` bit(8) NOT NULL,
  `borrar_Cupon` bit(8) NOT NULL,
  `editar_Plan` bit(8) NOT NULL,
  `agregar_Plan` bit(8) NOT NULL,
  `borrar_Plan` bit(8) NOT NULL,
  `editar_Precio` bit(8) NOT NULL,
  `editar_Carrito` bit(8) NOT NULL,
  `agregar_Carrito` bit(8) NOT NULL,
  `borrar_Carrito` bit(8) NOT NULL,
  `estatus` bit(8) NOT NULL,
  `id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_Permiso`, `editar_Usuario`, `agregar_Usuario`, `borrar_Usuario`, `editar_Cupon`, `agregar_Cupon`, `borrar_Cupon`, `editar_Plan`, `agregar_Plan`, `borrar_Plan`, `editar_Precio`, `editar_Carrito`, `agregar_Carrito`, `borrar_Carrito`, `estatus`, `id_Usuario`) VALUES
(6, b'00000000', b'00000000', b'00000000', b'00000000', b'00000000', b'00000000', b'00000000', b'00000000', b'00110000', b'00000000', b'00000001', b'00000001', b'00000001', b'00000001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_Plan` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `vigencia` int(11) NOT NULL,
  `precio` float NOT NULL,
  `impuestos` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_Plan`, `nombre`, `descripcion`, `categoria`, `vigencia`, `precio`, `impuestos`) VALUES
(6, 'ww', 'wiwiwiwiwiiwiwiwiwi', 'telefono', 20, 120, 0),
(7, 'ww', 'wiwiwiwiwiiwiwiwiwi', 'telefono', 20, 120, 12),
(8, 'wq', 'wiwiwiwiwiiwiwiwiwi', 'telefono', 20, 130, 233);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id_Suscripcion` int(11) NOT NULL,
  `fecha_Inicio` date NOT NULL,
  `fecha_Renovacion` date NOT NULL,
  `estatus` bit(8) NOT NULL,
  `serie` varchar(80) NOT NULL,
  `codigo` varchar(80) NOT NULL,
  `id_Cliente` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Plan` int(11) NOT NULL,
  `id_Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`id_Suscripcion`, `fecha_Inicio`, `fecha_Renovacion`, `estatus`, `serie`, `codigo`, `id_Cliente`, `id_Usuario`, `id_Plan`, `id_Precio`) VALUES
(9, '2024-11-21', '2024-11-21', b'00000001', '1A2b3C', '123456', 5, 1, 2, 4),
(10, '2024-12-17', '2024-12-31', b'00000001', '098679', '00000', 7, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estatus` bit(8) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `codigo_recuperacion` int(11) DEFAULT NULL,
  `codigo_expira` date DEFAULT NULL,
  `tipo` varchar(1) NOT NULL DEFAULT 'C',
  `clave_Asociado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellidos`, `email`, `estatus`, `telefono`, `password`, `codigo_recuperacion`, `codigo_expira`, `tipo`, `clave_Asociado`) VALUES
(1, 'pedri', 'abad garcia', 'pedro1@gmail.com', b'00000001', '2563211253', '9adcb29710e807607b683f62e555c22dc5659713', 89, '2024-11-22', 'C', NULL),
(10, 'Juan', 'Perez', 'juanperez13@gmail.com', b'00000001', '2212351245', '12', NULL, NULL, 'S', '12'),
(37, 'Aleli', 'peres', 'a@gmail.com', b'00110001', '1234567891', 'ca601a660833959beab93229f5fbea2bee11dbb0', NULL, NULL, 'C', ''),
(38, 'pepe', 'que', 'pepe@gmail.com', b'00110001', '1111123', '2d0c8af807ef45ac17cafb2973d866ba8f38caa9', NULL, NULL, 'C', ''),
(39, 'wawa', 'wa', 'wa@gmail.com', b'00110001', '2233', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, 'C', ''),
(40, 'adeq', 'sed', 'eds@gmail.com', b'00110001', '987654738', '132c9d1b0fd3687a4a7bdd42a7ca596cddd94ca0', NULL, NULL, 'S', ''),
(41, 'qq', 'qe', 'qw@gamil.com', b'00110001', '111', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, 'A', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos de compras`
--
ALTER TABLE `carritos de compras`
  ADD PRIMARY KEY (`id_Carrito`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_Cliente` (`id_Cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_Cliente`);

--
-- Indices de la tabla `cupones de descuento`
--
ALTER TABLE `cupones de descuento`
  ADD PRIMARY KEY (`id_Cupon`);

--
-- Indices de la tabla `detalles carritos`
--
ALTER TABLE `detalles carritos`
  ADD PRIMARY KEY (`id_Carrito`),
  ADD KEY `id_Plan` (`id_Plan`),
  ADD KEY `id_Cupon` (`id_Cupon`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_Permiso`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_Plan`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id_Suscripcion`),
  ADD KEY `id_Cliente` (`id_Cliente`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_Plan` (`id_Plan`),
  ADD KEY `id_Precio` (`id_Precio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos de compras`
--
ALTER TABLE `carritos de compras`
  MODIFY `id_Carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cupones de descuento`
--
ALTER TABLE `cupones de descuento`
  MODIFY `id_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalles carritos`
--
ALTER TABLE `detalles carritos`
  MODIFY `id_Carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_Plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id_Suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos de compras`
--
ALTER TABLE `carritos de compras`
  ADD CONSTRAINT `carritos de compras_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`),
  ADD CONSTRAINT `carritos de compras_ibfk_2` FOREIGN KEY (`id_Cliente`) REFERENCES `clientes` (`id_Cliente`);

--
-- Filtros para la tabla `detalles carritos`
--
ALTER TABLE `detalles carritos`
  ADD CONSTRAINT `detalles carritos_ibfk_2` FOREIGN KEY (`id_Cupon`) REFERENCES `cupones de descuento` (`id_Cupon`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

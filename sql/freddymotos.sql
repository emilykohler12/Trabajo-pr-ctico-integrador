-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2024
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL,
  `nombre_categoria` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion_categoria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre_categoria`, `descripcion_categoria`, `activo`) VALUES
(355, '', '', 1),
(356, 'Bujias', NULL, 1),
(357, 'Aro de Llantas', NULL, 1),
(358, 'Bujias', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetallepedido` int NOT NULL,
  `descuento_porcentual` decimal(5,2) DEFAULT '0.00',
  `descuento_fijo` decimal(10,2) DEFAULT '0.00',
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `idpedido` int DEFAULT NULL,
  `idproducto` int DEFAULT NULL,
  `idinventario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `idenvio` int NOT NULL,
  `fecha_envio` date DEFAULT NULL,
  `fecha_entrega_estimada` date DEFAULT NULL,
  `metodo_envio` varchar(250) DEFAULT NULL,
  `costo_envio` decimal(10,2) DEFAULT NULL,
  `codigo_seguimiento` varchar(250) DEFAULT NULL,
  `contacto_telefono` varchar(100) DEFAULT NULL,
  `observaciones` text,
  `direccion_entrega` varchar(250) DEFAULT NULL,
  `estado_envio` varchar(255) DEFAULT NULL,
  `idpedido` int DEFAULT NULL,
  `idzonaenvio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idinventario` int NOT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `motivo` enum('venta','devolucion','nuevo','ajuste') DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `cantidad_disponible` int DEFAULT NULL,
  `idproducto` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` int NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopago`
--

CREATE TABLE `metodopago` (
  `idmetodopago` int NOT NULL,
  `nombre` enum('transferencia','tarjeta de credito','tarjeta de debito') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int NOT NULL,
  `fecha_realizado` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado_pago` varchar(255) DEFAULT NULL,
  `idusuario` int DEFAULT NULL,
  `idpedido` int DEFAULT NULL,
  `idproveedor` int DEFAULT NULL,
  `idmetodopago` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int NOT NULL,
  `fecha_pedido` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `idusuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `descripcion` text,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1',
  `imagen_producto` text NOT NULL,
  `idcategoria` int DEFAULT NULL,
  `idmarca` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int NOT NULL,
  `nombre_empresa` varchar(100) DEFAULT NULL,
  `nombre_contacto` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `sitio_web` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int NOT NULL,
  `rol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(6, 'administrador'),
(8, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `correo` varchar(250) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `contrasena` text NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) DEFAULT '1',
  `idrol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `telefono`, `token`, `contrasena`, `foto_perfil`, `fecha_creacion`, `estado`, `idrol`) VALUES
(14, 'Tatiana Pipo', 'tatipipo95@gmail.com', '3751447267', NULL, '$2y$10$98nAWxmwxzActF1jLmnreeZSwJVy1QdHkzso76pPxSFcsQF8H19Jy', NULL, '2024-11-11 17:43:29', 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonaenvio`
--

CREATE TABLE `zonaenvio` (
  `idzonaenvio` int NOT NULL,
  `provincia` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `calle` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`iddetallepedido`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idinventario` (`idinventario`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`idenvio`),
  ADD UNIQUE KEY `idpedido` (`idpedido`),
  ADD KEY `idzonaenvio` (`idzonaenvio`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idinventario`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  ADD PRIMARY KEY (`idmetodopago`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `idmetodopago` (`idmetodopago`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idmarca` (`idmarca`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- Indices de la tabla `zonaenvio`
--
ALTER TABLE `zonaenvio`
  ADD PRIMARY KEY (`idzonaenvio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetallepedido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `idenvio` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idinventario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  MODIFY `idmetodopago` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idpago` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `zonaenvio`
--
ALTER TABLE `zonaenvio`
  MODIFY `idzonaenvio` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idinventario`) REFERENCES `inventario` (`idinventario`),
  ADD CONSTRAINT `detallepedido_ibfk_3` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`idzonaenvio`) REFERENCES `zonaenvio` (`idzonaenvio`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idmetodopago`) REFERENCES `metodopago` (`idmetodopago`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `pago_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);
COMMIT;

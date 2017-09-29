-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2017 a las 14:04:11
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `irondata`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` int(11) NOT NULL,
  `fechaauditoria` datetime NOT NULL,
  `descripcionauditoria` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `idusuarioauditoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idauditoria`, `fechaauditoria`, `descripcionauditoria`, `idusuarioauditoria`) VALUES
(1, '2017-01-01 00:00:00', 'Se inserto un usuario', 1),
(2, '2017-01-09 06:40:24', 'Se elimino usuario', 2),
(3, '2017-01-12 08:00:24', 'Se modificaron los datos del usuario', 3),
(4, '2016-06-12 07:27:28', 'Se ingresaron ventas', 4),
(5, '2016-04-02 08:19:42', 'cambio de contraseña ', 5),
(6, '3900-02-01 00:00:00', 'f dsfsdhjfhdsu', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` mediumint(4) NOT NULL,
  `nombrecliente` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefonocliente` int(13) NOT NULL,
  `direccioncliente` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `fecharegistrocliente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombrecliente`, `telefonocliente`, `direccioncliente`, `fecharegistrocliente`) VALUES
(2456, 'Carlos Ruiz', 2147483647, 'Cra 8 No 2-12', '2016-04-05'),
(4532, 'Juan Ra', 2147483647, 'Cra 6 No 5-14', '2013-04-11'),
(5621, 'Gustavo  Ardila', 2147483647, 'Cra 10 No 6-15', '2014-06-25'),
(5874, 'Andrea Bermudez', 321564897, 'Cra 3 No 5-10', '2013-12-13'),
(7423, 'Carmen Garcia', 2147483647, 'Cra 7 No 6-10', '2013-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetallepedido` mediumint(4) NOT NULL,
  `cantidaddepedidodetallepedido` smallint(4) NOT NULL,
  `idpedidodetallepedido` mediumint(4) NOT NULL,
  `iddisenodetallepedido` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`iddetallepedido`, `cantidaddepedidodetallepedido`, `idpedidodetallepedido`, `iddisenodetallepedido`) VALUES
(3, 34, 3, 3),
(4, 65, 4, 4),
(5, 12, 5, 5),
(6, 3, 3, 3),
(8, 78, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseno`
--

CREATE TABLE `diseno` (
  `iddiseno` smallint(4) NOT NULL,
  `rutadiseno` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `idmaterialdiseno` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `diseno`
--

INSERT INTO `diseno` (`iddiseno`, `rutadiseno`, `idmaterialdiseno`) VALUES
(1, 'c://misdocumentos/diseños2016/trabajoAriza/diseñopuerta.png', 1),
(2, 'c://misdocumentos/diseños2016/trabajoVelas/diseñoventana.png', 2),
(3, 'c://misdocumentos/diseños2016/trabajoArdi/diseñobarandas.png', 3),
(4, 'c://misdocumentos/diseños2016/trabajopeña/diseñorejas.png''', 4),
(5, 'c://misdocumentos/diseños2016/trabajovilla/diseñocajase.png''', 5),
(6, 'c://misdocumentos/diseños2016/trabajoArdi/diseñobarandas.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idempleados` smallint(4) NOT NULL,
  `nombreempleados` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefonoempleados` int(13) NOT NULL,
  `direccionempleados` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idempleados`, `nombreempleados`, `telefonoempleados`, `direccionempleados`) VALUES
(563, 'Carlos  Bello', 24455784, 'Cra 3 No 4 -11'),
(4563, 'Ramon Duarte', 45897222, 'Cra 7 No 1-11'),
(5621, 'Luis Torres', 54755889, 'Cra 6 No 1-10'),
(5678, 'Jhon Diaz', 56499852, 'Cra 8 No 4-6'),
(6526, 'Ramiro Paez', 25446954, 'Cra 5 No 9-112');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `idmaterial` tinyint(4) NOT NULL,
  `nombrematerial` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `idproveedormaterial` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`idmaterial`, `nombrematerial`, `idproveedormaterial`) VALUES
(1, 'hierro', 562),
(2, 'Aluminio', 564),
(3, 'cobre', 2563),
(4, 'plastificado', 5647),
(5, 'conrool', 6528),
(6, 'jijij', 5647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` mediumint(4) NOT NULL,
  `fechapedido` date NOT NULL,
  `valorpedido` mediumint(4) NOT NULL,
  `idclientepedido` mediumint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `fechapedido`, `valorpedido`, `idclientepedido`) VALUES
(1, '2017-01-02', 23248, 2456),
(2, '2016-12-04', 68344, 4532),
(3, '2016-12-08', 7865, 5621),
(4, '2016-09-13', 8976, 5874),
(5, '2016-07-12', 988775, 7423);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` smallint(4) NOT NULL,
  `nombreproveedor` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `celularproveedor` int(13) NOT NULL,
  `direccionproveedor` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombreproveedor`, `celularproveedor`, `direccionproveedor`) VALUES
(562, 'Raul Perez', 55468874, 'Cra 10 No 3-5'),
(564, 'Laura Montalbe', 54881224, 'Cra 10 No 6-4'),
(2563, 'Santiago Martinez', 1102110285, 'Cra 8 No 4-5'),
(5647, 'Pedro Suarez', 58872463, 'Cra 2 No 5-6'),
(6528, 'Catalina Lopez', 2468744, 'Cra 7 No 4-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` tinyint(4) NOT NULL,
  `nombrerol` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `clienterol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `proveedorrol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `empleadosrol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `disenorol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `materialrol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `pedidorol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `detallepedidorol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `ventarol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `usuariorol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `auditoriarol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `rolrol` varchar(4) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `clienterol`, `proveedorrol`, `empleadosrol`, `disenorol`, `materialrol`, `pedidorol`, `detallepedidorol`, `ventarol`, `usuariorol`, `auditoriarol`, `rolrol`) VALUES
(1, 'Administrador', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(2, 'Secretaria', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(3, 'Vendedor', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(4, 'Empleado', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(5, 'Cliente', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(6, 'Administrador', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombreusuario` varchar(66) COLLATE utf8_spanish_ci NOT NULL,
  `emailusuario` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `claveusuario` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `fecharegistrousuario` date NOT NULL,
  `fechaultimaclaveusuario` date NOT NULL,
  `idrolusuario` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombreusuario`, `emailusuario`, `claveusuario`, `fecharegistrousuario`, `fechaultimaclaveusuario`, `idrolusuario`) VALUES
(1, 'Tatan Megia', 'tatam@yahoo.es', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2016-02-14', '2016-12-21', 1),
(2, 'Kevin Ardila', 'Kevinar22@outlook.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2015-12-07', '2016-10-11', 2),
(3, 'Fredy Pardo', 'fredyp89@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2016-09-11', '2017-01-02', 3),
(4, 'Camilo Guzman', 'camig8@hotmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2016-09-12', '2017-01-09', 4),
(5, 'Brayan Calderon', 'brayand14@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2017-01-01', '2017-01-18', 5),
(6, 'juan', 'mio@misena.edu.co', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2017-03-22', '2017-03-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` mediumint(4) NOT NULL,
  `fechaventa` date NOT NULL,
  `idempleadosventa` smallint(4) NOT NULL,
  `idpedidoventa` mediumint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `fechaventa`, `idempleadosventa`, `idpedidoventa`) VALUES
(3, '2017-02-24', 5621, 3),
(4, '2017-02-08', 5678, 4),
(5, '2017-02-20', 6526, 5),
(22, '2017-02-23', 4563, 2),
(123, '2017-02-27', 563, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`),
  ADD KEY `idusuarioauditoria` (`idusuarioauditoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`iddetallepedido`),
  ADD KEY `idpedidodetallepedido` (`idpedidodetallepedido`),
  ADD KEY `iddiseñodetallepedido` (`iddisenodetallepedido`),
  ADD KEY `idpedidodetallepedido_2` (`idpedidodetallepedido`);

--
-- Indices de la tabla `diseno`
--
ALTER TABLE `diseno`
  ADD PRIMARY KEY (`iddiseno`),
  ADD KEY `idmaterialdiseño` (`idmaterialdiseno`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idempleados`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idmaterial`),
  ADD KEY `idproveedorMaterial` (`idproveedormaterial`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idclientePedido` (`idclientepedido`),
  ADD KEY `idclientePedido_2` (`idclientepedido`);

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
  ADD KEY `idrolUsuario` (`idrolusuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `idpeddioVenta` (`idpedidoventa`),
  ADD KEY `idpedidoVenta` (`idpedidoventa`),
  ADD KEY `idempleados` (`idempleadosventa`),
  ADD KEY `idpedidoVenta_2` (`idpedidoventa`),
  ADD KEY `idempleados_2` (`idempleadosventa`),
  ADD KEY `idpedidoVenta_3` (`idpedidoventa`),
  ADD KEY `idempleados_3` (`idempleadosventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7424;
--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetallepedido` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `diseno`
--
ALTER TABLE `diseno`
  MODIFY `iddiseno` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idempleados` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6527;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `idmaterial` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6529;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fkusuarioauditoria` FOREIGN KEY (`idusuarioauditoria`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fkdisenodetallepedido` FOREIGN KEY (`iddisenodetallepedido`) REFERENCES `diseno` (`iddiseno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkpedidodetallepedido` FOREIGN KEY (`idpedidodetallepedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `diseno`
--
ALTER TABLE `diseno`
  ADD CONSTRAINT `fkdiseno` FOREIGN KEY (`idmaterialdiseno`) REFERENCES `material` (`idmaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fkproveedormaterial` FOREIGN KEY (`idproveedormaterial`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fkclientepedido` FOREIGN KEY (`idclientepedido`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkrolusuario` FOREIGN KEY (`idrolusuario`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fkempleados` FOREIGN KEY (`idempleadosventa`) REFERENCES `empleados` (`idempleados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

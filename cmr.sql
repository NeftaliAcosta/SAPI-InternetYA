-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2017 a las 00:20:54
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cmr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id` int(11) NOT NULL,
  `NomConcepto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Almacena los detalles de los paquetes vendidos por el cliente';

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `NomConcepto`) VALUES
(1, 'Enero2017'),
(2, 'Febrero2017'),
(3, 'Marzo2017'),
(4, 'Abril2017'),
(5, 'Mayo2017'),
(6, 'Junio2017'),
(7, 'Julio2017'),
(8, 'Agosto2017'),
(9, 'Septiembre2017'),
(10, 'Octubre2017'),
(11, 'Noviembre2017'),
(12, 'Diciembre2017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cortes`
--

CREATE TABLE `cortes` (
  `id` int(11) NOT NULL,
  `FechaCorte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Fechas de cortes';

--
-- Volcado de datos para la tabla `cortes`
--

INSERT INTO `cortes` (`id`, `FechaCorte`) VALUES
(1, '15 Mes'),
(2, '30 Mes'),
(3, '1 Mes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalletickets`
--

CREATE TABLE `detalletickets` (
  `id` int(11) NOT NULL,
  `idticket` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `texto` varchar(1200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `clase` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contiene todos los mensajes o conversacion de un ticket';

--
-- Volcado de datos para la tabla `detalletickets`
--

INSERT INTO `detalletickets` (`id`, `idticket`, `idusuario`, `texto`, `fecha`, `clase`) VALUES
(101, 32, 79, '<p>&iquest;Hola?</p>', '2017-06-16 11:29:30', 0),
(102, 32, 79, '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dignissim nisi vel orci vulputate, at consequat nisi suscipit. Duis feugiat nulla nec erat ultrices sollicitudin. Maecenas vehicula volutpat orci eget ornare. Nullam id lorem eget dolor dictum ultricies et id lectus. Vestibulum vel augue sed magna aliquam suscipit in fringilla orci. Suspendisse potenti. Donec vel nisl ultrices, porttitor sem sit amet, pretium nisi. Nullam molestie dapibus lorem, vulputate consectetur libero posuere eu.</span></p>', '2017-06-16 11:33:22', 0),
(103, 33, 76, '<p>asdasd</p>', '2017-06-20 16:43:17', 0),
(104, 34, 76, '<p>asdas</p>', '2017-06-20 16:43:43', 0),
(105, 35, 76, '<p>asdas</p>', '2017-06-20 16:45:48', 0),
(106, 36, 76, '<p>asdas</p>', '2017-06-20 16:47:48', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopago`
--

CREATE TABLE `estadopago` (
  `id` int(11) NOT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadopago`
--

INSERT INTO `estadopago` (`id`, `Estado`, `Activo`) VALUES
(3, 'Procesando', b'1'),
(4, 'Pagado', b'1'),
(5, 'Cancelado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpagos`
--

CREATE TABLE `historialpagos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `comprobante` text,
  `Referencia` varchar(50) DEFAULT NULL,
  `EstadoPago` int(11) NOT NULL DEFAULT '0',
  `Concepto` varchar(20) NOT NULL DEFAULT '0',
  `Importe` text NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Referencia del pago';

--
-- Volcado de datos para la tabla `historialpagos`
--

INSERT INTO `historialpagos` (`id`, `id_usuario`, `fecha`, `comprobante`, `Referencia`, `EstadoPago`, `Concepto`, `Importe`, `observaciones`, `tipo`) VALUES
(60, 76, '2017-06-14', '6d8363fc-1676-4d74-b3f2-36ca9cb133bb.jpg', 'OXXO:01231', 4, '7', '250', '<p>TESTING</p>', NULL),
(61, 76, '2017-06-14', '1497456020659441695654.jpg', '1277', 5, '4', '456', '<p><em>test</em></p>', NULL),
(62, 76, '2017-06-14', '14974622796531432652172.jpg', 'Oxxo: 1771', 4, '1', '450', '<p>Kajana</p>', NULL),
(63, 77, '2017-06-14', '1497471544496-439130701.jpg', 'Oxxo', 5, '1', '1500', '<p>Hola mundo</p>', NULL),
(64, 76, '2017-06-14', '14974841839081243480628.jpg', 'Oxxo:1765', 5, '8', '350', '<p>Todo bien</p>', NULL),
(65, 80, '2017-06-19', 'mini sectorial.png', '123456', 4, '1', '250', '<p>PO</p>', NULL),
(66, 80, '2017-06-19', 'up ds.png', '123456', 3, '10', '300', '<p>pago pendiernte&nbsp;</p>', NULL),
(67, 76, '2017-06-20', 'default.png', 'TEST', 3, '6', '250', '<p>tes de pago sin foto cargada al sistema.</p>', NULL),
(69, 79, '2017-06-20', 'default.png', 'OXXO:2330', 4, 'Junio 2017', '300', '<p>TEST</p>', NULL),
(70, 79, '2017-06-20', 'default.png', 'test', 5, 'Junio 2017', '300', '<p>test pago pendiente</p>', NULL),
(71, 76, '2017-06-20', 'ticketpago.jpg', 'OXXO:1234', 3, 'Setiembre 2017', '270', '<p>Prueba</p>', NULL),
(72, 76, '2017-06-20', 'ticketpago.jpg', '2334', 3, 'Junio 2017', '300', '<p>asdasdsa</p>', NULL),
(73, 76, '2017-06-20', 'ticketpago.jpg', '666', 4, 'Junio 2017', '400', '<p>test</p>', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(11) NOT NULL,
  `NomLocalidad` varchar(50) NOT NULL DEFAULT '0',
  `Observacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `NomLocalidad`, `Observacion`) VALUES
(2, 'Villa Ursulo Galván', 'Cabecera Municipal'),
(3, 'El bobo', 'Municipio de úrsulo galván'),
(4, 'Barra de chachalacas', 'Minicipio de úsulo galván'),
(5, 'Real del oro', 'Municipio de úsulo galván'),
(6, 'José Cardel', 'José cardel'),
(7, 'Boca del rio', 'no se'),
(8, 'Zempoala', 'Municipio de Úrsulo galván'),
(9, 'El zapotito', 'Mubicipio de Ursulo galván'),
(10, 'Paso de doña Juana', 'Municipio de Ursulo Galván'),
(18, 'Tinajitas', 'Rumbo a laguna verde'),
(19, 'Tinajitas', 'Rumbo a laguna verde'),
(20, 'El tejar', ''),
(21, 'Mozomboa', ''),
(26, 'Cempoala', ''),
(27, 'la barra', ''),
(28, 'Cardel 2', ''),
(31, 'Villa Rica', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema`
--

CREATE TABLE `sistema` (
  `id` int(11) NOT NULL,
  `nTickets` int(11) DEFAULT '1',
  `nPagos` int(11) NOT NULL DEFAULT '1',
  `nClientes` int(11) NOT NULL DEFAULT '1',
  `nAviso` int(11) DEFAULT NULL,
  `eSistema` text,
  `nSistema` text,
  `txtAviso` text,
  `txtBancarios` text,
  `vSistema` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Almacena información general del sistema';

--
-- Volcado de datos para la tabla `sistema`
--

INSERT INTO `sistema` (`id`, `nTickets`, `nPagos`, `nClientes`, `nAviso`, `eSistema`, `nSistema`, `txtAviso`, `txtBancarios`, `vSistema`) VALUES
(1, 1, 1, 1, 1, 'test@hotmail.com', 'Internet YA! S.A. de C.V.', '<p><strong>ATENTO AVISO</strong></p>\r\n<p>A todos nuestros nuestros clientes se les informa que hemos agregado un nuevo m&eacute;todo de pago de bancomer que se ver&aacute; reflejado al momento de enviar un pago, si tiene alguna duda con los detalles no dude en contactarnos.</p>', '<p><strong>BANAMEX:</strong></p>\r\n<p>Cuenta: 923821712981312</p>\r\n<p><strong>Bancomer</strong>:</p>\r\n<p>Cuenta:2423423432</p>\r\n<p><strong><em>Por favor utilice su n&uacute;mero de cliente como referencia.</em></strong></p>\r\n<p>&nbsp;</p>', '3.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `asunto` text NOT NULL,
  `prioridad` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `estado` int(2) NOT NULL DEFAULT '0',
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Aquí se almacenan los tickets de soporte';

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `idusuario`, `asunto`, `prioridad`, `fecha`, `estado`, `mensaje`) VALUES
(32, 79, 'Test', 3, '2017-06-16', 0, ''),
(33, 76, 'test', 3, '2017-06-20', 0, ''),
(34, 76, 'asdsa', 2, '2017-06-20', 0, ''),
(35, 76, 'asdas', 1, '2017-06-20', 0, ''),
(36, 76, 'asdas', 3, '2017-06-20', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Referencia` text,
  `Privilegio` int(2) NOT NULL,
  `Estatus` int(2) NOT NULL,
  `Telefono` text,
  `Correo` text,
  `Localidad` int(11) DEFAULT NULL,
  `FechaCorte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `password`, `Nombre`, `Apellido1`, `Apellido2`, `Direccion`, `Referencia`, `Privilegio`, `Estatus`, `Telefono`, `Correo`, `Localidad`, `FechaCorte`) VALUES
(38, 'admin', 'jSpipEaucA661NKNT0I5u5rG37OF5gaD8LUCgZ2sujk=', 'Neftali', 'Acosta', 'Acosta', 'Maria enriqueta camarillo #263 Frac. Villa Rica', 'Frente a la barda al final del fraccionamiento.', 0, 1, '1006049', 'neftaliacosta@outlook.com', 7, 1),
(76, '001', 'cc/VH1cGtK5jDQa3rlALLUPE85rLjoGpGeXQyHPJRZA=', 'Irma', 'Alvarez', '', 'demo', 'NInguna', 1, 1, '2291669974', 'irma@hotadasds.com', 10, 2),
(77, '002', 'exJUOrdb/iwAt+N8fbUb36GDJpl4yM0K+Z9TJX4BT00=', 'Misael', 'Herrera', 'Reyes', 'Veracruz', 'Ninguna', 1, 1, '1213423421321', 'misa@hotmail.com', 8, 2),
(78, 'cris', '1GwTPyMmuFRI8uYVLhvidFh7laj11pwIG9s0ZgJOfr8=', 'Cristhian Ricardo', 'Vicente', '', 'Zempoala', 'Ninguna', 0, 1, '123456789', 'cris@hotmail.com', 8, 2),
(79, '003', 'GXlFdZD4uzDFrepJ6JUbY4h2HwxlFr8d9pJYMtVAUGU=', 'Hannia', 'Guzmán', 'Acosta', 'Testing', 'ninguna', 1, 1, '2291391667', 'hania@hotmail.com', 2, 3),
(80, '029', '7mNctz6YMGfXCeh3537cnjNrF9+06kmbFj6MT/xZNSY=', 'Cristhian', 'Ruiz', 'Vicente', 'La Posta', 'Casa Azul', 1, 1, '2961076448', 'cristhian_r120@yahoo.com.mx', 19, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `cortes`
--
ALTER TABLE `cortes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `detalletickets`
--
ALTER TABLE `detalletickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_historial_usuarios` (`id_usuario`),
  ADD KEY `EstadoPago` (`EstadoPago`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tickets_usuarios` (`idusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `Localidad` (`Localidad`),
  ADD KEY `FechaCorte` (`FechaCorte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `cortes`
--
ALTER TABLE `cortes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `detalletickets`
--
ALTER TABLE `detalletickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `sistema`
--
ALTER TABLE `sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD CONSTRAINT `FK_historial_estadopago` FOREIGN KEY (`EstadoPago`) REFERENCES `estadopago` (`id`),
  ADD CONSTRAINT `FK_historial_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `FK_tickets_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_cortes` FOREIGN KEY (`FechaCorte`) REFERENCES `cortes` (`id`),
  ADD CONSTRAINT `FK_usuarios_localidades` FOREIGN KEY (`Localidad`) REFERENCES `localidades` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

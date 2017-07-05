-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-07-2017 a las 11:48:31
-- Versión del servidor: 5.6.35-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ndsoluci_siscris`
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
(75, 109, '2017-07-02', '1499044385720-2130176286.jpg', '3536', 5, 'Julio 2017', '300', '<p>Feygt</p>', NULL),
(76, 161, '2017-07-03', 'img001.jpg', '123456', 5, 'Julio 2017', '300', '<p>cristhian djjdjfhdhfdfh</p>', NULL),
(77, 138, '2017-07-04', '1499190738023-2130176286.jpg', '9209243', 4, 'Julio 2017', '300', '<p>Hola</p>', NULL),
(78, 143, '2017-07-04', '14991912478231111711134.jpg', 'oo4177', 4, 'Agosto 2017', '300', '', NULL),
(79, 128, '2017-07-04', '1499198664074.jpg', '1234', 5, 'Julio 2017', '300', '<p>Jhzjz</p>', NULL),
(80, 137, '2017-07-04', '1499199666130-834189079.jpg', '1234', 5, 'Julio 2017', '300', '<p>Ff</p>', NULL),
(81, 133, '2017-07-04', '14992006724161643884971.jpg', '124', 5, 'Julio 2017', '300', '<p>Trrfrd</p>', NULL),
(82, 154, '2017-07-04', '1499207157722936657963.jpg', '004179', 4, 'Julio 2017', '300', '', NULL),
(83, 159, '2017-07-04', 'image.jpg', '1234', 5, 'Julio 2017', '300', '<p>Vhuthh</p>', NULL),
(84, 168, '2017-07-04', '1499212415055-1456748066.jpg', '1235', 5, 'Agosto 2017', '400', '<p>Efffgcv</p>', NULL),
(85, 169, '2017-07-04', '14992148700931567524255.jpg', '1234', 5, 'Julio 2017', '300', '<p>Gdhvgnchh</p>', NULL),
(86, 170, '2017-07-04', '1499215879713820620388.jpg', '1234', 5, 'Julio 2017', '300', '<p style=\"padding-left: 30px;\">Gsjskdjd</p>', NULL),
(87, 150, '2017-07-04', 'FB_IMG_1499022271634.jpg', '1234', 5, 'Julio 2017', '300', '<p>Fdhdhfhh</p>', NULL);

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
(26, 'Zempoala', ''),
(32, 'San Pancho', ''),
(33, 'Tamarindo', 'A lado del Mango'),
(34, 'Crucero', ''),
(35, 'Arroyo Seco', ''),
(36, 'Colonia Madero', ''),
(37, 'El Cedro', ''),
(38, 'La Gloria', ''),
(39, 'Lechuguillas', ''),
(40, 'Paso de Varas 1', ''),
(41, 'Rancho Alegre', ''),
(42, 'Rancho Balderas', ''),
(43, 'Real del Oro', ''),
(44, 'San Isidro', ''),
(45, 'San Jose Chipila', ''),
(46, 'Tabachines', ''),
(47, 'Zapotito', ''),
(48, 'La Antigua', ''),
(49, 'Salmoral', ''),
(50, 'Buena Vista', ''),
(51, 'Carretas', ''),
(52, 'El Mango', ''),
(53, 'El Juile', ''),
(54, 'El Gallito', ''),
(55, 'El Faizan', ''),
(56, 'La Ceiba', ''),
(57, 'Hatillo', ''),
(58, 'Pureza', ''),
(59, 'Loma Iguana', ''),
(60, 'La Vibora', '');

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
  `vSistema` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Almacena información general del sistema';

--
-- Volcado de datos para la tabla `sistema`
--

INSERT INTO `sistema` (`id`, `nTickets`, `nPagos`, `nClientes`, `nAviso`, `eSistema`, `nSistema`, `txtAviso`, `txtBancarios`, `vSistema`) VALUES
(1, 1, 1, 1, 0, 'cristhianricardo@gmail.com', 'Internet YA! S.A. de C.V.', '<p><strong>ATENTO AVISO</strong></p>\r\n<p>No olvides incluir la foto de tu pago.!</p>\r\n<p>Gracias</p>', '<p><strong>SANTANDER:</strong></p>\r\n<p><strong>OXXO</strong></p>\r\n<p># DE TARJETA: 5579 0783 0225 3170</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '3.1.2 Última revisión: 05/07/2017');

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
(38, 'admin', 'jSpipEaucA661NKNT0I5u5rG37OF5gaD8LUCgZ2sujk=', 'Neftali', 'Acosta', 'Acosta', 'Maria enriqueta camarillo #263 Frac. Villa Rica', 'Frente a la barda al final del fraccionamiento.', 0, 1, '2291391667', 'neftaliacosta@outlook.com', 26, 1),
(97, 'administrador', 'yLJb6LjMDMl+dUE3FdQQ8yQ7cgYmMBRV+cIUCI/GqEY=', 'Cristhian Ricardo', 'Ruiz', 'Vicente', 'Zempoala', 'Ninguna', 0, 1, '2961076448', 'cristhianricardo@gmail.com', 26, 3),
(98, '100', '/xZldYAWy9ut0YR3KT4WQQmqCZfZh1gpQax7JdRMG/k=', 'Rafael', 'xdfdfddfdfdfgd', 'dfdfdf', 'jbjhjhjhj', 'dfdfdf', 1, 1, '2961076448', 'jdfjdfkjdfdf@kkddf.com', 26, 2),
(99, '048', 'kDHv5syO1buBH5tmMrgZedRpAXZp7byFJdBUkdmpHBw=', 'Reyna del Carmen', 'Lara', 'Aguirre', 'Conocido San Pancho', 'Casa Amarilla Orilla de Carretera Maestra', 1, 1, '2961076448', 'shdjdhfjd@hotmail.com', 32, 2),
(100, '172', 'HtxgtYWgBHn7gimvnnLtqQTZZKidFNE+aXXLKjBW6lw=', 'Maricruz', 'Rosas', 'Olvera', 'Conocido', 'Esq Tamarindo 2 Pisos Naranja', 1, 1, '2961076448', 'pendiente@hotmail.com', 33, 2),
(101, '056', 'ZZB+A7Qp2ml9X8NZulm6njTIz+IAyA7/uqu6nJT5mOI=', 'Elias', 'Muñoz', 'Trujillo', 'Conocido', 'Taxista Tamarindo', 1, 1, '2961076446', 'pendiente@hotmail.com', 33, 1),
(102, '055', 'EKp3PSnK6s1+3fxdOwYYqIXIWzZ932uXgXiD5AKBUcU=', 'Isabel', 'Rosas', 'Castro', 'Conocido', 'Tamarindo', 1, 1, '2961029651', 'pendiente@hotmail.com', 33, 2),
(103, '165', '/1VQ0Pj9+kOOpR7Zpwmqh6oe1Y6ss/1xWWd8yDIZxeM=', 'Adriana', 'Fuentes', 'Montero', 'Conocido', 'Vecina de moises', 1, 1, '2299360806', 'pendiente@hotmail.com', 34, 1),
(104, '164', 'E4Q5bo+2LSNvGhnapucvFWvL7ZkWXyFFu418wXSfc1E=', 'Moises', 'Caiseros', 'Barragan', 'Conocido', 'Taxista', 1, 1, '2961011265', 'pendiente@hotmail.com', 34, 1),
(105, '169', 'O4V4LjsprKTlSP9DY4CsiU0Qfnk8sFC6YDJHrvqArWk=', 'Dulce', 'Contreras', 'Lopezp', 'Conocido', 'Vecina moises', 1, 1, '2961087311', 'Pendiente@hotmail.com', 34, 2),
(106, '173', 'p2CH3KypiY/KLKM+ZrNsXuj8urjDC+4NNQ18I4FIyDs=', 'Jesus', 'Melchor', 'Cañete', 'conocido', 'Ultima crucero', 1, 1, '2965933635', 'pendiente@hotmail.com', 34, 2),
(107, '170', 'vb6oWVr8Vs+h7rsCUyqVngR9/sMmJHHO8de/r/EC75c=', 'Daniel', 'hdfhdfh', 'sjdbsdhsjdpensdjd', 'dfjdjdfjdfjdfjdf', 'dfdf', 1, 1, '2961076448', 'kfkjdkfd@hdkflkdf.vcom', 34, 2),
(108, '001', 'OTrl02Kk0q4pPHWGqHLMLb6Hm1bBWX5+1huLimTnolI=', 'Miguel', 'Desconocido', 'Desconocido', 'Conocido', 'Ultima casa fondo del cañal', 1, 1, '2961076448', 'Desconocido@Desconocido.com', 35, 2),
(109, '006', 'bHYN5ja1ZYdPrQ7I2BFTIEDHXt5UVxHVO3at/leeDSo=', 'Cesar', 'Desconocido', 'Desconocido', 'Conocido', 'Maestro Mucho arbol al fondo', 1, 1, '2961076448', 'Desconocido@Desconocido.com', 37, 2),
(110, '007', '4Bo8lEq3P6UUspBU42ZO9NKMqzQsBqzjIzvQHW/YCBk=', 'Monica', 'Desconocido', 'Desconocido', 'Conocido', 'A lado de Maestro Cesar', 1, 1, '29610764448', 'desconocido@desconocido.com', 37, 2),
(111, '013', 'PcsmgZ/jS8m9SC8DrD97cekUOpWaOpVxcIdNYRmiOHs=', 'Guadalupe', 'desconocido', 'desconocido', 'Conocido', 'Lechuguilla Rancho Juan Cruz', 1, 1, '2961076448', 'desconocido@desconocido.com', 39, 1),
(112, '014', 'e9AIbsSHjdcbbUK6BC3vg6ReAX4zTIx5Z/zpHX2voNM=', 'Bernado', 'desconocido', 'desconocido', 'Conocido', 'Ultima casa rancho juan cruz hasta el fondo', 1, 1, '2961076448', 'desconocido@desconocido.com', 39, 1),
(113, '016', 'hmmhrZ2aHyEQCwGdrN/KlrqP22nq+1SQN7k+mcuJonY=', 'Alicia', 'desconocido', 'desconocido', 'Conocido', 'Unico Cyber de Paso de Varas', 1, 1, '2961076448', 'desconocido@desconocido.com', 40, 1),
(114, '017', 'To10OXmnuYu+f6/uWAtQOsJ5GivJDgtvk/kIFbIk4sg=', 'Carlos', 'desconocido', 'desconocido', 'Conocido', 'Ultima calle a la derecha paso de varas', 1, 1, '29610764448', 'desconocido@desconocido.com', 40, 1),
(115, '018', 'owCzCXfEFUuG2YKW1XIdNGvlMpoJjfPMLKnUT7CUr+c=', 'Yadira', 'desconocido', 'desconocido', 'Conocido', 'Casa Anaranjada Vecina Isabel', 1, 1, '2961076448', 'desconocido@desconocido', 40, 1),
(116, '019', '2bVORJGomr5t8ly9aryaiAQgL3K8Qxce6eJYulNfj7U=', 'Rosa', 'desconocido', 'desconocido', 'Conocido', 'Vecina Alicia Cyber', 1, 1, '2961076448', 'desconocido@desconocido.com', 40, 2),
(117, '020', 'oiVLjV/8pPM3EDsihLHYkm0NF7uliEYvzoC2ygvq/fI=', 'Isabel', 'desconocido', 'desconocido', 'Conocido', 'Vecina Yadira Casa Blanca A lado del via', 1, 1, '2961076448', 'desconocido@desconocido.com', 40, 1),
(118, '026', 'OOLMLDWZdEZA8YA/VOLTqXpMGpTPjvGeGnLs7ehcOa0=', 'Naty', 'desconocido', 'desconocido', 'Conocido', 'Casa 2 pisos Maestra Primera Calle', 1, 1, '2961076448', 'desconocido@desconocido.com', 44, 1),
(119, '027', 'jOAqq9WogFBjErSSmeayxKZZPQEZ1RPdCVmwjs3or+0=', 'Cyber Nicaim', 'desconocido', 'desconocido', 'Conocido', 'Cyber San Isidro Salon Social', 1, 1, '2961076448', 'desconocido@desconocido.com', 44, 1),
(120, '032', 'jU/W4KXRrqRDJqXV0ogSnZU1wNWH6QdUS/2lvPoULp4=', 'Marisela', 'desconocido', 'desconocido', 'Conocido', 'Tabachines 2 pisos Antena de Parilla', 1, 1, '2961076448', 'desconocido@desconocido.com', 26, 1),
(121, '040', 'T6HOSeCKA/ooDb4LO8zv31EWwqpeQunKimJ4shmGmTI=', 'Nadia', 'desconocido', 'desconocido', 'Conocido', 'Casa 2 Pisos Col. Paraiso', 1, 1, '2961076448', 'desconocido@desconocido.com', 26, 1),
(122, '166', '7jnYX9IlmdAwMdbgrX8j2QOAPiKWkPvNqdiDmyAC7KU=', 'Eloina', 'desconocido', 'desconocido', 'conocido', 'Crucero Frente al Parque', 1, 1, '2961076448', 'desconocido@desconocido.com', 34, 1),
(123, '043', 'pVemzVAc3ceYP5krFl6RLPaYknDzLP5voRbsnCY0IYw=', 'Griselda', 'desconocido', 'desconocido', 'Conocido', 'Col. Paraiso Tiendita', 1, 1, '2961076448', 'desconocido@desconocido.com', 26, 1),
(124, '044', 'r+FKVhmfrN5iAetM23lIIF1B1Ca+cDgEoMjFpxoyQo4=', 'Juani', 'desconocido', 'desconocido', 'Conocido', 'Paraiso Casa Amarilla', 1, 1, '2961076448', 'desconocido@desconocido.com', 26, 1),
(125, '049', 'hGLAQcK/2kcfXV7LCZFwEnc1fKC5f05oo/q3dnEEHJU=', 'Blanca', 'desconocido', 'desconocido', 'Conocido', 'Caseta Primer Cliente', 1, 1, '2961076448', 'desconocido@desconocido.com', 48, 1),
(126, '050', 'kxBWP/QzYYHZkbQRSN+xDpXw8yCMYJDj+D8nmZXUc2w=', 'saturnina', 'desconocido', 'desconocido', 'Conocido', 'Restaurante Cortez Caseta', 1, 1, '2961076448', 'desconocido@desconocido.com', 48, 1),
(127, '138', 'hoBn1VX5MPceIZs98k0YIOPZoFUBZEs1HNWjqRwNtzI=', 'Fidel', 'Vazquez', 'Irala', 'Conocido', 'Primo Ruben Cableado', 1, 1, '2961076448', 'desconocido@desconocido.com', 58, 2),
(128, '057', 'kHxqyX/dJ4/lluWjVAAXl0/BUUVABdkE0jitG5u+Tzw=', 'Alica', 'desconocido', 'desconocido', 'Conocido', 'Buena Vista Frente a Tienda', 1, 1, '2961076448', 'desconocido@desconocido.com', 50, 1),
(129, '058', 'NRJe8IUolUCE+GdLa48N5nLcUJOF6Q6MTYnqV/hssq4=', 'Florinda', 'desconocido', 'desconocido', 'Conocido', 'Tienda Buena Vista', 1, 1, '2961076448', 'desconocido@desconocido.com', 50, 1),
(130, '059', 'YTbuoaWxVx4JWzOk5hqneIJMO8kL0hVhCcrlEM2oSwI=', 'Britzela', 'desconocido', 'desconocido', 'Conocido', 'Carretas Casa Amarilla Tubo se Doblo', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 1),
(131, '060', 'EKj5avWDMeOETgDs8v0x4s/6jZ48mXVh71bcJFbTXwg=', 'Claudia', 'desconocido', 'desconocido', 'Conocido', 'Ultima calle de Carretas', 1, 1, '29610764448', 'desconocido@desconocido.com', 51, 1),
(132, '061', 'hZn7JzHCKvgCTtZuaL5FLehyEe1q6P5O++R2dlLJ0m0=', 'Esperanza', 'desconocido', 'desconocido', 'conocido', 'ultima Casa Carretas', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 2),
(133, '062', 'LunYfeX79VmAySxNPffiMIMnVJnnaEwnbmf7gw4VKU0=', 'Guadalupe', 'desconocido', 'desconocido', 'Conocido', 'Patio Enfrente Cambio antena quemada', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 1),
(134, '063', 'J7pIU+35yCml8RHedR9ClUrkzBgkCdiLT9xvsuiFL+w=', 'Liliana', 'desconocido', 'desconocido', 'conocido', 'Casa Rosada Entrada', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 1),
(135, '064', 'XyV4QN66SrLTG8lvj11Ygdc3akKF7NHBrQFMpg/lXLY=', 'Angela', 'desconocido', 'desconocido', 'conocido', 'Pendiente', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 1),
(136, '065', 'zyRQnOXBMF/c4bL+OhWQjyV9jRxfMNEyLtSuTfQn/5k=', 'Lizeth', 'Morales', 'desconocido', 'Conocido', 'Loma de los Morales', 1, 1, '2961076448', 'desconocido@desconocido.com', 52, 1),
(137, '066', 'ndxsklU9Bcu8CRqz/a0gD9XGmby6U181d3YvgL/3IWc=', 'Leticia', 'desconocido', 'desconocido', 'Conocido', 'Tiene antena de platillo', 1, 1, '2961076448', 'desconocido@desconocido.com', 51, 1),
(138, '067', 'nX9SU3eElmLDN4xrSRo+HoSjm37ndtVLPmsSeT+9ljs=', 'Miguel', 'desconocido', 'desconocido', 'Conocido', 'Tiendita', 1, 1, '2961076448', 'desconocido@desdjsd.com', 52, 1),
(139, '051', 'sUB1jJHa7C+234gnUrBwSB5P+1xmdCuHtpmbgvEU9+s=', 'Saradelia', 'desconocido', 'desconocido', 'la antigua', 'pendiente', 1, 1, '2961071901', 'sara@hotmail.com', 48, 1),
(140, '052', 'hYwcdNpE2Qrz3b7O6R/el/aaHDw7aMwjOSspgc7veBE=', 'victoria', 'desconocido', 'desconocido', 'la antigua', 'desconocido', 1, 1, '2961076448', 'victoria@hotmail.com', 48, 1),
(141, '053', '8UVu/lvaT8y4YDsui0wKAaYyPwFJKmk/X7oYlG+2D/I=', 'Pacheco', 'desconocido', 'desconocido', 'Salmoral', 'desconocido', 1, 1, '2961076448', 'pacheco@hotmai.com', 49, 1),
(142, '054', 'JZ8rIOBtT297Qh9ERQnyioDvjXr8GKQEmmRkDSHMX54=', 'Javier Arrieta', 'desconocido', 'descocido', 'Salmoral', 'desconocida', 1, 1, '2961076448', 'javier@hotmail.com', 49, 1),
(143, '068', '+RH3n0b8IwaJA4NFb83xfv81WiQxRzTRHWrEMwT5wZM=', 'Vicente', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'taller@hotmail.com', 52, 1),
(144, '069', 'UpLZEjKjsR4YQjanldImbk8fWTDdYM1D8QjOzl/qb8w=', 'Rosalba', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'rosalba@hotmail.com', 52, 1),
(145, '070', 'yFSSl1jTMVEe+92iUUiuYseFZRhmZxLQDJHJAj3G/WA=', 'Iliana', 'desconocido', 'desconocido', 'El Mango', 'desconocdo', 1, 1, '2961076448', 'iliana@hotmail.com', 52, 1),
(146, '071', 'KPjgT0NmtO8mFXyDuGOZ/n8hLGT4yyldsReRHARGvrM=', 'Angel', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'angel@hotmail.com', 52, 1),
(147, '0072', 'yF17v1rfg3pe1YVXGl5MCDd308ltzKN8OWkCZsmehSg=', 'primaria', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'primaria@hotmail.com', 52, 1),
(148, '073', '5+V46nV7zsBsIc3PHM1qonUnP5vdJvrlgFPet5ogV2E=', 'Limberth', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'limberth@hotmail.com', 52, 1),
(149, '075', 'Nb5gmZX3zEFQkXIGF2DZmSIkhdY9tP4bcE6ka4s+xHs=', 'Rafael', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'rafael@hotmail.com', 52, 1),
(150, '076', 'T0FWBl46T6FJee87adTMsTh4AFs8izcPkxodipat4kU=', 'Cristian', 'desconocido', 'desconocido', 'El Mango', 'desconocido', 1, 1, '2961076448', 'cristian@hotmail.com', 52, 2),
(151, '077', 'AnOaaqAOrEReLW68dONP1CaAscF/4BaspIhpkiR45gg=', 'Kevin', 'desconocido', 'desconocido', 'El Juile', 'desconcodio', 1, 1, '2971076448', 'kevin@hotmail.com', 53, 1),
(152, '078', 'L9mm7OUu8DrU0Mkm0wS0JT5DUPrmYqot0g2JehC21hI=', 'Leo', 'desconocido', 'desconocido', 'El Gallito', 'desconocido', 1, 1, '2061076448', 'leo@hotmail.com', 54, 1),
(153, '079', 'zhJrMNeV0T6IpXX6k7xjFfY66wWhytTr0FeK+HcZIh4=', 'Edson', 'Partida', 'Desconocido', 'Conocido', 'Junto a la Iglesia', 1, 1, '2961076448', 'desconodio@desconocido.com', 55, 1),
(154, '080', '7Rbo9nUCbhe2CqdL6nCelH4GaS5THBT+1/46UxJTUnA=', 'Erasmo', 'Desconocido', 'Desconocido', 'Conocido', 'Tiendita Faizan Iglesia', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(155, '081', 'JEzuFmPyIHJrjibFxM+uC5Kc0oqx868Ms0HTNXdxQco=', 'Juana', 'Desconocido', 'Desconocido', 'Conocido', 'Junto a Erasmo Maestra Ingles', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(156, '082', 'x1N90ZhMqNmLPXhsoaam6kcXPGGqmAbUO0geJAGPzzw=', 'Marisela', 'desconocido', 'desconocido', 'Conocido', 'En la curva de faizan Dos pisos Naranja', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(157, '083', 'nRpajyU3tCMYGRwX+70iufBmorx61y7Repwd+uCLYjE=', 'Marisela', 'desconocido', 'desconocido', 'Conocido', 'Vecino Marisela', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(158, '085', '0lF0v2KeJgpRn/xIXc7jToStIN1jjU58HTTtA9yfRrs=', 'Armando', 'Desconocido', 'Desconocido', 'conocido', 'Para Faizan Casa Rosada 2pisos', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(159, '086', 'TKh7/Vy1jog7+jIJJPIdt6lS+R/IOH7hloyo208xrAg=', 'Gazos', 'desconocido', 'desconocido', 'Conocido', 'Casa enmedio faizan ceiba carro de caña patio', 1, 1, '2961076448', 'desconocido@desconocido', 55, 1),
(160, '087', '8AQvWcYUdGmzQtyIZkqSJNhq38iqx1VHuSoN3RQ9ImU=', 'Karla', 'desconocido', 'desconocido', 'desconocido', 'ultima casa salida a la vibora', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(161, '088', 'bcxzGLRzj6id/aL5m7Y16KkCwu/09mRD1VG/jnrXGps=', 'Secundaria', 'Desconocido', 'desconocido', 'Conocido', 'Secundaria Faizan', 1, 1, '2961076448', 'desconocido@desconocido.com', 55, 1),
(162, '089', 'zwsAXdUJbvDvBc4ZIBrG7qUby81KYTzct63/sCZpH28=', 'Uriel', 'desconocido', 'desconocido', 'conocido', 'Casa rosada salida de la ceiba', 1, 1, '2961076446', 'desconocido@desconocido.com', 55, 1),
(163, '174', 'lKMEaJ+wowacUZ/MMavLWX6qkKC8fsoQVi940gel2Lg=', 'Esther', 'Hernandez', 'Hernandez', 'Conocido', 'Junto a tienda de liz salida de la ceiba', 1, 1, '2965936153', 'pendiente@pendiente.com', 56, 3),
(164, '175', 'eI35zinLpduCGWonhHCF81VrQy5k5BJfTl3R0Uu+lZQ=', 'Mareli', 'Diaz', 'Marquez', 'Conocido', 'Casa Amarilla Entrada', 1, 1, '2293637876', 'pendiente@pendiente.com', 33, 3),
(165, '176', 'My6byCvoMYzDikAxnCBM3GrAvACKR1LyAbZpFmBu5UI=', 'Leidy', 'Ronzon', 'desconocido', 'Conocido', 'Tienda Salida a Juile ', 1, 1, '2961076448', 'desconocido@desconocido.com', 33, 3),
(166, '093', 'uP8VjTnrsBXZEJy0DttF/9tsxOwvLRR+5Dhxv8tarco=', 'Elizabeth', 'desconocido', 'desconocido', 'Conocido', 'Tienda Carretera Elizabeth Salida Hatillo', 1, 1, '2961076448', 'desconocido@desconocido.com', 56, 3),
(167, '096', 'H2Yw8pkFQLShbcnNTsTiWLCCALa5veBSMn1S1qfLeCI=', 'Norma', 'Murillo', 'Desconocido', 'Conocido', 'Maestra Norma', 1, 1, '2961076448', 'desconocido@desconocido.com', 56, 2),
(168, '177', '6iM8npnabmLDITlst7YDQbgm/zHrokK1Cd0gnplFPyY=', 'Roxana', 'rebolledo', 'Vargas', 'Conocido', 'Frente a Leidy Tienda', 1, 1, '2851004139', 'lalo_chivas_19@hotmail.com', 33, 3),
(169, '161', '2YG/5qRpjBJTJvt3F9SBXjOA6bzcmGc55ivU3rbqXoo=', 'Valeria', 'BAutista', 'Velazquez', 'Conocido', 'Junto al Canal', 1, 1, '2961059965', 'desconnocido@desconocido.com', 60, 1),
(170, '150', 'NUzy3gcn4oKpK+EQcVr80z/18T2Q5l/FmzSLcPgm6X8=', 'Belem', 'Desconocido', 'desconocido', 'Conocido', 'Tienda Belem', 1, 1, '2961076448', 'desconocido@desconocido.com', 60, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `sistema`
--
ALTER TABLE `sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
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

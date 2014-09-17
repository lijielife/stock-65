-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-09-2014 a las 21:52:57
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `condones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `total` int(11) DEFAULT '0',
  `reservado` int(11) DEFAULT '0',
  `vendido` int(11) DEFAULT '0',
  `disponible` int(11) DEFAULT '0',
  `imagen` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `descripcion` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `marca`, `nombre`, `total`, `reservado`, `vendido`, `disponible`, `imagen`, `descripcion`) VALUES
(1, 'lifestyles', 'tuxedo', 208, 0, 208, 0, 'tuxedo.png', 'Un condón negro y elegante, tiene una forma algo más atrevida para mayor sensación y lubricación para reducir fricción'),
(2, 'lifestyles', 'Colores Verde', 0, 0, 0, 0, 'color_verde.png', 'Es un condón de diferentes colores. Ultrasensible, diseñado más delgado para entregar mayor sensibilidad.'),
(3, 'lifestyles', 'ultra delgado', 103, 0, 103, 0, 'delgado.png', 'más delgado que un preservativo de látex standard, otorgando una sensación más natural, más sensibilidad.'),
(4, 'lifestyles', 'Sabores frutilla', 67, 0, 67, 0, 'frambuesa.png', 'Preservativos Nuda con sabor a Frutilla, para una experiencia distinta. También los puedes encontrar en sabor platano y vainilla.                                     '),
(5, 'lifestyles', 'colores amarillo', 1, 0, 0, 1, 'color_verde.png', 'Es un condón de diferentes colores. Ultrasensible, diseñado más delgado para entregar mayor sensibilidad.'),
(6, 'lifestyles', 'colores rojo', 200, 0, 200, 0, 'color_verde.png', 'Es un condón de diferentes colores. Ultrasensible, diseñado más delgado para entregar mayor sensibilidad.'),
(7, 'lifestyles', 'kyng', 3, 0, 3, 0, 'kyng.png', 'Los nuevos Lifestyles Kyng o XL con su diseño mas ancho para entregarte un mayor confort  olvidarte de preocupaciones.'),
(8, 'lifestyles', 'ultra lubricado', 203, 40, 163, 0, 'lubricado.png', 'El preservativo mas popular de Lifestyles, contiene extra lubricación para una mejor sensación.'),
(9, 'lifestyles', 'sabores platano', 65, 0, 65, 0, 'platano.png', 'Preservativos Nuda con sabor a Platano, para una experiencia distinta. También los puedes encontrar en sabor Frutilla y vainilla.                                     '),
(10, 'lifestyles', 'Extra resistente', 200, 0, 200, 0, 'resistente.png', 'Forte, también conocido como Extra Resistente, son más gruesos que un condón de látex lo que brinda mayor protección y seguridad.'),
(11, 'lifestyles', 'ribbed pleasure', 189, 0, 0, 189, 'ribbed.png', 'Los Ribbed Pleasure, más conocidos como Vibra Ribbed, es un condón de látex con rugosidades en su superficie. '),
(12, 'lifestyles', 'ultra sensible', 251, 8, 243, 0, 'sensible.png', 'El condón más típico de Chile. Los NUDA o Ultra Sensible dan una sensación más natural y con mayor sensibilidad para ti y tu pareja.'),
(13, 'lifestyles', 'skyn', 160, 0, 110, 50, 'skyn.png', 'La linea premium de Lifestyles, SIN LATEX, Hipoalergenicos y mas delgados. Una experiencia única.'),
(14, 'lifestyles', 'snugger fit', 209, 17, 192, 0, 'snugger.png', 'El LifeStyles Snugger Fit es un condón ceñido ultra Sensible con una forma única y especial. Estos condones son más anchos a la cabeza para mayor comodidad. Calze perfecto!'),
(15, 'lifestyles', 'studded', 300, 0, 300, 0, 'studded.png', ' preservativo de látex con superficie texturada con microgránulos en relieve. Otorga mayor estimulación a la pareja.'),
(16, 'lifestyles', 'sabores vainilla', 69, 0, 69, 0, 'vainilla.png', 'Preservativos Nuda con sabor a Vainilla, para una experiencia distinta. También los puedes encontrar en sabor Frutilla y Platano.                                     ');

--
-- Disparadores `productos`
--
DROP TRIGGER IF EXISTS `actualizar_disponibilidad`;
DELIMITER //
CREATE TRIGGER `actualizar_disponibilidad` BEFORE UPDATE ON `productos`
 FOR EACH ROW IF (NEW.total - NEW.reservado - NEW.vendido) < 0 THEN
    signal sqlstate '45000' set message_text = "NO HAY SUFICIENTE STOCK PARA RESERVAR";
ELSE
	SET NEW.disponible = NEW.total - NEW.reservado - NEW.vendido;
END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `lugar` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `comentarios` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_ventas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `forge`.`usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` VALUES 
(1,'George','Iulian','2014-10-13 09:56:14','2014-10-13 09:56:14'),
(2,'Paco','Gonzales','2014-10-13 09:56:31','2014-10-13 09:56:31');
--
-- Estructura de tabla para la tabla `carBrands`
--
CREATE TABLE `forge`.`carBrands` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
--
-- Dumping data for table `carBrands`
--
 
INSERT INTO `forge`.`carBrands` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'Toyota cars', '2013-03-11 00:00:00', '2013-03-11 00:00:00'),
(2, 'Honda', 'Honda cars', '2013-03-11 00:00:00', '2013-03-11 00:00:00'),
(3, 'Mercedes', 'Mercedes cars', '2013-03-11 00:00:00', '2013-03-11 00:00:00');


--
-- Table structure for table `carModels`
--
 
CREATE TABLE `forge`.`carModels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `maker_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
 
 
INSERT INTO `forge`.`carModels` (`id`, `maker_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Honda S2000', '', '2013-03-11 22:32:07', '2013-03-11 22:32:07'),
(2, 2, 'Civic', '', '2013-03-11 22:32:46', '2013-03-11 22:32:46'),
(3, 2, 'Fit', '', '2013-03-11 22:34:35', '2013-03-11 22:34:35'),
(4, 1, 'asdf asdf', '', '2013-03-11 22:35:31', '2013-03-11 22:35:31'),
(5, 1, 'Yaris', '', '2013-03-11 22:36:01', '2013-03-11 22:36:01'),
(6, 1, 'Corolla', '', '2013-03-11 22:36:23', '2013-03-11 22:36:23'),
(7, 1, 'Camry', '', '2013-03-11 22:36:31', '2013-03-11 22:36:31'),
(8, 3, 'SLK 500', '', '2013-03-11 22:36:47', '2013-03-11 22:36:47'),
(9, 3, 'C300', '', '2013-03-11 22:36:50', '2013-03-11 22:36:50'),
(10, 2, 'another item', '', '2013-03-11 22:36:52', '2013-03-11 22:36:52');
-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2015 at 03:15 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kfmi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(32) NOT NULL,
  `hash` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salt` varchar(25) NOT NULL,
  `role` enum('Auditor','Admin') NOT NULL,
  `last_login` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `uname`, `hash`, `email`, `salt`, `role`, `last_login`) VALUES
(1, 'kfmiadminuser', '8f50a5280134d71d0c4d1b3afec8a64087c51a8b7b57fb60936cafda0f3a0afc', 'admin@example.com', 'sEUjoYd0evlmuR5bSOHxdJF+', 'Admin', 1424778305),
(2, 'kfmiauditoruser', '29edc7d5392dda781a0237b15cba84bf8ad8640f9afb8ba5d0b8543e9d291dad', 'auditor@example.com', 'bEuEY+qaYas9y/IYwweY7TGD', 'Auditor', 1424778305);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Various Modelingzz'),
(2, 'Air Cleaner Elements'),
(3, 'Ball Bearing'),
(4, 'Bearing Rubber Seal'),
(5, 'Bellamoids'),
(6, 'Oil and Grease'),
(7, 'blower'),
(8, 'bolt oil pipe'),
(9, 'Bushing'),
(10, 'Butterfly'),
(11, 'Capscrew'),
(12, 'Carburators');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0b46fcbaeb8db95163b312e016e88277', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424753097, 'a:5:{s:9:"user_data";s:0:"";s:4:"user";s:13:"kfmiadminuser";s:12:"is_logged_in";i:1;s:4:"role";s:5:"Admin";s:10:"last_login";s:27:"21 February 2015 @ 12:29 pm";}'),
('1b6e63a4a8284530e173ee061045d194', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424487751, 'a:5:{s:9:"user_data";s:0:"";s:4:"user";s:13:"kfmiadminuser";s:12:"is_logged_in";i:1;s:4:"role";s:5:"Admin";s:10:"last_login";s:27:"21 February 2015 @ 11:01 am";}'),
('8e9e3a16cde637ffe4a2b468dadcb35d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424492997, ''),
('c2e89f7ff74928027f361fb46166e156', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424753362, '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(75) NOT NULL,
  `lname` varchar(75) NOT NULL,
  `mi` varchar(5) DEFAULT NULL,
  `home_address` varchar(125) NOT NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE IF NOT EXISTS `orderproducts` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cash_in` decimal(9,2) NOT NULL,
  `cash_change` decimal(9,2) NOT NULL,
  `total_amount` decimal(9,2) NOT NULL,
  `order_key` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `category_id`) VALUES
(1, '2t small', '110.00', 100, 1),
(2, 'absorber rubber', '55.00', 100, 1),
(3, 'accelarator cable', '55.00', 100, 1),
(4, 'accelarator lever china', '55.00', 100, 1),
(5, 'accelarator spring', '41.25', 100, 1),
(6, '178', '391.88', 90, 2),
(7, '186F/186FA/188F', '746.63', 90, 2),
(8, 'EMEI180', '484.00', 90, 2),
(9, 'EMEI180/EMEI190', '484.00', 90, 2),
(10, '178', '391.88', 90, 2),
(11, 'BEARING BALL 6200', '565.73', 90, 3),
(12, 'BEARING BALL 6201', '142.45', 90, 3),
(13, 'BEARING BALL 6202', '687.83', 90, 3),
(14, 'BEARING BALL 6203', '198.00', 90, 3),
(15, 'BEARING BALL 6204', '191.29', 90, 3),
(16, 'BEARING RUBBER SEAL 6201', '49.50', 90, 4),
(17, 'BEARING RUBBER SEAL 6203', '31.63', 90, 4),
(18, 'BEARING RUBBER SEAL 6206', '96.25', 90, 4),
(19, 'BEARING RUBBER SEAL 6205', '72.88', 90, 4),
(20, 'BEARING RUBBER SEAL 6210', '233.75', 90, 4),
(21, 'BELAMOID GASKET 1/16', '110.00', 90, 5),
(22, 'BELAMOID GASKET 132', '53.00', 90, 5),
(23, 'BELLMAC # 40', '137.50', 90, 6),
(24, 'GEAR OIL 140', '130.63', 90, 6),
(25, 'GREASE', '247.50', 90, 6),
(26, 'BLOWER BLADE HOLDER ', '254.00', 90, 7),
(27, 'BLOWER BUSHING', '220.00', 90, 7),
(28, 'BLOWER BLADE LONG', '82.50', 90, 7),
(29, 'BLOWER BLADE SHORT', '68.75', 90, 7),
(30, 'BLOWER HOUSING LONG', '1691.25', 90, 7),
(31, 'KUBOTA 8MM', '110.00', 90, 8),
(32, 'YANMAR 8MM', '50.88', 90, 8),
(33, 'YANMAR 12MM', '70.13', 90, 8),
(34, 'R175/R180 8MM', '16.50', 90, 8),
(35, 'BOLT & NUT F8', '41.25', 90, 8),
(36, 'BUSHING 3/4X1', '158.13', 100, 9),
(37, 'BUSHING 7/8X3/4', '28.88', 100, 9),
(38, 'BUSHING 80X1', '33.00', 100, 9),
(39, 'BUSHING 80X3/4', '34.38', 100, 9),
(40, 'BUSHING ROCKER ARM TS60', '125.13', 100, 9),
(41, 'CAGE WHEEL', '5547.58', 90, 10),
(42, 'CAGE WHEEL HOUSING', '412.50', 90, 10),
(43, 'CAPSCREW 1/2X 3/4', '5.44', 90, 11),
(44, 'CAPSCREW 1/2X1', '5.28', 90, 11),
(45, 'CAPSCREW 1/2X1 1/2', '5.44', 90, 11),
(46, 'CAPSCREW 1/2X2', '5.44', 90, 11),
(47, 'CAPSCREW 1/2X3', '5.44', 90, 11),
(48, 'CARBURATOR KIT ET950', '264.00', 90, 12),
(49, 'CARBURATOR KIT G200', '144.38', 90, 12),
(50, 'CARBURATOR KIT BIG', '1.38', 90, 12),
(51, 'CARBURATOR MITSUBISHI', '1.38', 90, 12);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

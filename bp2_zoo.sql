-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2016 at 04:27 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bp2_zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE IF NOT EXISTS `animals` (
`id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `weight` int(11) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `type_id`, `gender`, `weight`, `age`) VALUES
(1, 1, 1, 234, 3),
(2, 1, 0, 180, 5),
(3, 2, 1, 32, 2),
(4, 2, 1, 43, 1),
(5, 10, 0, 12, 5),
(6, 7, 1, 56, 7),
(7, 9, 0, 24, 4),
(8, 9, 1, 54, 6),
(9, 4, 0, 100, 4),
(10, 4, 0, 120, 2),
(11, 5, 1, 360, 2),
(12, 5, 1, 500, 8),
(13, 10, 1, 16, 10),
(14, 1, 1, 170, 7),
(15, 1, 0, 170, 8),
(16, 7, 0, 45, 1),
(17, 6, 1, 160, 4),
(18, 10, 1, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `animals_habitats_assigned`
--

CREATE TABLE IF NOT EXISTS `animals_habitats_assigned` (
`id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_transfered` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `animals_habitats_assigned`
--

INSERT INTO `animals_habitats_assigned` (`id`, `animal_id`, `habitat_id`, `date_added`, `date_transfered`) VALUES
(1, 1, 2, '2016-01-19 21:18:27', '0000-00-00 00:00:00'),
(2, 2, 2, '2016-01-19 21:20:08', '0000-00-00 00:00:00'),
(3, 14, 2, '2016-01-19 21:20:45', '0000-00-00 00:00:00'),
(4, 15, 2, '2016-01-19 21:21:14', '0000-00-00 00:00:00'),
(5, 3, 3, '2016-01-19 21:21:37', '0000-00-00 00:00:00'),
(6, 4, 3, '2016-01-19 21:21:56', '0000-00-00 00:00:00'),
(7, 6, 4, '2016-01-19 21:22:15', '0000-00-00 00:00:00');

--
-- Triggers `animals_habitats_assigned`
--
DELIMITER //
CREATE TRIGGER `isSafe` BEFORE INSERT ON `animals_habitats_assigned`
 FOR EACH ROW BEGIN
declare cond int default 0;
declare isCarnivore int default 0;
set isCarnivore = (select count(*) from animals a, animals_types at where a.type_id=at.id and a.id=new.animal_id and at.carnivore=1);
IF (isCarnivore = 0) THEN
set cond = (select (select count(*) from animals a, animals_types at, animals_habitats_assigned aha where a.id=aha.animal_id and aha.habitat_id=h.id and at.id=a.type_id and at.carnivore=1) as 'count' from habitats h where h.id=new.habitat_id);
IF(cond != 0) THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This animal will be in danger inside this habitat!!';
END IF;
ELSE
set cond = (select (select count(*) from animals a, animals_types at, animals_habitats_assigned aha where a.id=aha.animal_id and aha.habitat_id=h.id and at.id=a.type_id and a.type_id!=(select type_id from animals a1 where a1.id=new.animal_id)) as 'count' from habitats h where h.id=new.habitat_id);
IF(cond != 0) THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = '!This animal will be in danger inside this habitat!!';
END IF;
END IF;

END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `transferAnimal` AFTER INSERT ON `animals_habitats_assigned`
 FOR EACH ROW BEGIN
declare cond int default 0;
set cond = (select count(*) from animals_habitats_assigned aha where aha.animal_id=new.animal_id and aha.date_transfered='0000-00-00 00:00:00');
IF(cond != 0) THEN
update animals_habitats_assigned set date_transfered=now();
END IF;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `animals_records`
--

CREATE TABLE IF NOT EXISTS `animals_records` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `animals_records`
--

INSERT INTO `animals_records` (`id`, `employee_id`, `title`, `date_added`, `description`) VALUES
(1, 432432543, 'Pokrenuta istraga', '2016-01-19 20:46:50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor tempus ligula ac dignissim. Etiam non mi quis erat eleifend gravida. Suspendisse eros ante, venenatis ac elit non, malesuada pulvinar sem. Nam erat diam, consectetur in sagittis vel, consectetur at augue. Donec at dignissim purus. Cras fringilla augue at pharetra mattis. Cras ultricies ante at ex consequat, eu facilisis nulla posuere. Fusce accumsan nulla quis diam ullamcorper, in eleifend tellus commodo. Phasellus volutpat sed arcu vitae pellentesque. Duis convallis porttitor risus vitae blandit. Donec dictum hendrerit risus quis maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis tincidunt lacus tincidunt, fermentum lorem ut, dapibus ipsum. Aenean sit amet urna mi. Mauris elementum sagittis urna eu tempus. Phasellus quis vulputate ipsum. '),
(2, 432432543, 'Lav radio roštilj', '2016-01-19 20:47:20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor tempus ligula ac dignissim. Etiam non mi quis erat eleifend gravida. Suspendisse eros ante, venenatis ac elit non, malesuada pulvinar sem. Nam erat diam, consectetur in sagittis vel, consectetur at augue. Donec at dignissim purus. Cras fringilla augue at pharetra mattis. Cras ultricies ante at ex consequat, eu facilisis nulla posuere. Fusce accumsan nulla quis diam ullamcorper, in eleifend tellus commodo. Phasellus volutpat sed arcu vitae pellentesque. Duis convallis porttitor risus vitae blandit. Donec dictum hendrerit risus quis maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis tincidunt lacus tincidunt, fermentum lorem ut, dapibus ipsum. Aenean sit amet urna mi. Mauris elementum sagittis urna eu tempus. Phasellus quis vulputate ipsum. '),
(3, 76554, 'Sova napila slona', '2016-01-19 20:51:50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor tempus ligula ac dignissim. Etiam non mi quis erat eleifend gravida. Suspendisse eros ante, venenatis ac elit non, malesuada pulvinar sem. Nam erat diam, consectetur in sagittis vel, consectetur at augue. Donec at dignissim purus. Cras fringilla augue at pharetra mattis. Cras ultricies ante at ex consequat, eu facilisis nulla posuere. Fusce accumsan nulla quis diam ullamcorper, in eleifend tellus commodo. Phasellus volutpat sed arcu vitae pellentesque. Duis convallis porttitor risus vitae blandit. Donec dictum hendrerit risus quis maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis tincidunt lacus tincidunt, fermentum lorem ut, dapibus ipsum. Aenean sit amet urna mi. Mauris elementum sagittis urna eu tempus. Phasellus quis vulputate ipsum. ');

-- --------------------------------------------------------

--
-- Table structure for table `animals_records_assigned`
--

CREATE TABLE IF NOT EXISTS `animals_records_assigned` (
`id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `animals_records_assigned`
--

INSERT INTO `animals_records_assigned` (`id`, `animal_id`, `record_id`) VALUES
(1, 1, 2),
(2, 5, 3),
(3, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `animals_types`
--

CREATE TABLE IF NOT EXISTS `animals_types` (
`id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `carnivore` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `animals_types`
--

INSERT INTO `animals_types` (`id`, `name`, `carnivore`) VALUES
(1, 'Lion', 1),
(2, 'Monkey', 1),
(3, 'Ant', 1),
(4, 'Camel', 0),
(5, 'Elephant', 0),
(6, 'Giraffe', 0),
(7, 'Anaconda', 1),
(8, 'Koala', 0),
(9, 'Kinkajou', 0),
(10, 'Owl', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `oib` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`oib`, `role_id`, `firstname`, `lastname`, `address`, `city`, `postal_code`) VALUES
(76554, 5, 'Arnold', 'Švarc', 'Ill be back 2007', 'Zagreb', 1000),
(1231423, 1, 'Julije', 'Merlić', 'Ladovina 43', 'Varaždin', 42000),
(2144654, 3, 'Indijana', 'Jones', 'Zlatna lubanja 1', 'Afrika', 14343),
(3453525, 4, 'Mara', 'Prodavnica', 'Konzum Veliki kasa 2', 'Zagreb', 10000),
(87686765, 6, 'Pero', 'Erste', 'Dubaji 7', 'Dubaji', 777),
(432432543, 3, 'Mirko', 'Mirić', 'Adresa 56 ', 'Zagreb', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `employees_roles`
--

CREATE TABLE IF NOT EXISTS `employees_roles` (
`id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employees_roles`
--

INSERT INTO `employees_roles` (`id`, `name`) VALUES
(1, 'Doctor'),
(2, 'Cleaner'),
(3, 'Trainer'),
(4, 'Seller'),
(5, 'Guard'),
(6, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `food_stocks`
--

CREATE TABLE IF NOT EXISTS `food_stocks` (
`id` int(11) NOT NULL,
  `animal_type_id` int(11) NOT NULL,
  `date_arrived` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `weight` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `food_stocks`
--

INSERT INTO `food_stocks` (`id`, `animal_type_id`, `date_arrived`, `date_expire`, `weight`) VALUES
(1, 1, '2016-01-19 20:52:46', '2017-01-19 21:22:22', 200),
(2, 5, '2016-01-19 20:54:11', '2017-01-19 21:22:22', 500),
(3, 10, '2016-01-19 20:54:31', '2017-01-19 21:21:22', 700),
(4, 1, '2016-01-19 20:55:12', '2018-01-23 21:22:22', 166),
(5, 6, '2016-01-19 20:55:27', '2017-01-19 21:22:22', 560);

-- --------------------------------------------------------

--
-- Table structure for table `habitats`
--

CREATE TABLE IF NOT EXISTS `habitats` (
`id` int(11) NOT NULL,
  `lenght` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `latitude` float(6,2) NOT NULL,
  `longitude` float(6,2) NOT NULL,
  `open` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `habitats`
--

INSERT INTO `habitats` (`id`, `lenght`, `width`, `height`, `latitude`, `longitude`, `open`) VALUES
(1, 20, 100, 50, 46.12, 46.54, 1),
(2, 56, 20, 10, 46.78, 46.23, 1),
(3, 34, 44, 5, 46.13, 46.32, 0),
(4, 5, 5, 5, 46.10, 46.76, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float(6,2) NOT NULL,
  `cash` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `employee_id`, `date_added`, `date_expire`, `price`, `cash`) VALUES
(1, 3453525, '2016-01-19 20:58:56', '2016-01-19 20:58:56', 45.00, 1),
(2, 3453525, '2016-01-19 21:00:20', '2016-01-19 21:00:20', 45.00, 0),
(3, 3453525, '2016-01-19 21:00:29', '2016-01-19 21:00:29', 45.00, 1),
(4, 3453525, '2016-01-19 21:00:37', '2016-01-19 21:00:37', 45.00, 1),
(5, 3453525, '2016-01-19 21:00:45', '2016-01-19 21:00:45', 45.00, 1),
(6, 3453525, '2016-01-19 21:00:55', '2016-01-19 21:00:55', 45.00, 0),
(7, 3453525, '2016-01-22 02:45:37', '2016-01-22 02:45:37', 43.00, 1);

--
-- Triggers `tickets`
--
DELIMITER //
CREATE TRIGGER `isSeller` BEFORE INSERT ON `tickets`
 FOR EACH ROW BEGIN
declare cond int default 0;
set cond = (select count(*) from employees e where e.oib=new.employee_id and e.role_id=4);

IF(cond = 0) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'You are not authorized to sell tickets!!';
END IF;

END
//
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
 ADD PRIMARY KEY (`id`), ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `animals_habitats_assigned`
--
ALTER TABLE `animals_habitats_assigned`
 ADD PRIMARY KEY (`id`), ADD KEY `animal_id` (`animal_id`,`habitat_id`), ADD KEY `habitat_id` (`habitat_id`);

--
-- Indexes for table `animals_records`
--
ALTER TABLE `animals_records`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `animals_records_assigned`
--
ALTER TABLE `animals_records_assigned`
 ADD PRIMARY KEY (`id`), ADD KEY `animal_id` (`animal_id`), ADD KEY `animal_id_2` (`animal_id`), ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `animals_types`
--
ALTER TABLE `animals_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`oib`), ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `employees_roles`
--
ALTER TABLE `employees_roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_stocks`
--
ALTER TABLE `food_stocks`
 ADD PRIMARY KEY (`id`), ADD KEY `animal_type_id` (`animal_type_id`);

--
-- Indexes for table `habitats`
--
ALTER TABLE `habitats`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `animals_habitats_assigned`
--
ALTER TABLE `animals_habitats_assigned`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `animals_records`
--
ALTER TABLE `animals_records`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `animals_records_assigned`
--
ALTER TABLE `animals_records_assigned`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `animals_types`
--
ALTER TABLE `animals_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `employees_roles`
--
ALTER TABLE `employees_roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `food_stocks`
--
ALTER TABLE `food_stocks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `habitats`
--
ALTER TABLE `habitats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `animals_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `animals_habitats_assigned`
--
ALTER TABLE `animals_habitats_assigned`
ADD CONSTRAINT `animals_habitats_assigned_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `animals_habitats_assigned_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `animals_records`
--
ALTER TABLE `animals_records`
ADD CONSTRAINT `animals_records_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`oib`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `animals_records_assigned`
--
ALTER TABLE `animals_records_assigned`
ADD CONSTRAINT `animals_records_assigned_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `animals_records_assigned_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `animals_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `employees_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food_stocks`
--
ALTER TABLE `food_stocks`
ADD CONSTRAINT `food_stocks_ibfk_1` FOREIGN KEY (`animal_type_id`) REFERENCES `animals_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`oib`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

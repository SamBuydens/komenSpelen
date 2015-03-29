-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:1125
-- Generation Time: Mar 29, 2015 at 08:41 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `komen`
--

-- --------------------------------------------------------

--
-- Table structure for table `kmn_bandbattles`
--

CREATE TABLE `kmn_bandbattles` (
`id` smallint(11) NOT NULL,
  `organiser_id` smallint(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bandbattles`
--

INSERT INTO `kmn_bandbattles` (`id`, `organiser_id`, `name`) VALUES
(4, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `kmn_bandbattle_events`
--

CREATE TABLE `kmn_bandbattle_events` (
`id` smallint(11) NOT NULL,
  `bandbattle_id` smallint(11) NOT NULL,
  `host_id` smallint(11) NOT NULL,
  `gig_date` date NOT NULL,
  `location` varchar(120) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bandbattle_events`
--

INSERT INTO `kmn_bandbattle_events` (`id`, `bandbattle_id`, `host_id`, `gig_date`, `location`, `latitude`, `longitude`) VALUES
(1, 2, 5, '2015-03-30', 'Heldenpark 9900 Eeklo', 51.182846, 3.581908);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_bandmembers`
--

CREATE TABLE `kmn_bandmembers` (
`id` smallint(11) NOT NULL,
  `band_id` smallint(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `instrument` varchar(64) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bandmembers`
--

INSERT INTO `kmn_bandmembers` (`id`, `band_id`, `name`, `instrument`, `image`) VALUES
(1, 4, 'The Admin', 'Keyboard & Banhammer', 'Admin.png'),
(2, 5, 'The Goatmeister', 'A live goat.', 'Goat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kmn_bands`
--

CREATE TABLE `kmn_bands` (
`id` smallint(11) NOT NULL,
  `bandname` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `band_image` varchar(255) NOT NULL,
  `role_id` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bands`
--

INSERT INTO `kmn_bands` (`id`, `bandname`, `email`, `password`, `band_image`, `role_id`) VALUES
(4, 'Admin', 'admin@bandbattles.komenspelen.be', 'f2ee70d4644764d9d2630582f83dfce67a7f02ac', 'Admin.png', 2),
(5, 'GoatDestroyer', 'destroyer@worshipthegoat.be', 'f8c128b8fc829005b9d1d86cfbc43b0b4af1dd94', 'Goat.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_band_images`
--

CREATE TABLE `kmn_band_images` (
`id` smallint(11) NOT NULL,
  `bandbattle_id` smallint(11) NOT NULL,
  `uploader_id` smallint(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `width` smallint(5) NOT NULL,
  `height` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_band_images`
--

INSERT INTO `kmn_band_images` (`id`, `bandbattle_id`, `uploader_id`, `filename`, `width`, `height`) VALUES
(1, 2, 5, 'Goat.jpg', 900, 600);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_invite_keys`
--

CREATE TABLE `kmn_invite_keys` (
`id` smallint(11) NOT NULL,
  `bandbattle_id` smallint(11) NOT NULL,
  `invite_code` varchar(64) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_invite_keys`
--

INSERT INTO `kmn_invite_keys` (`id`, `bandbattle_id`, `invite_code`, `activated`) VALUES
(1, 2, '5515458c90203', 0),
(2, 4, '5517626555633', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_ratings`
--

CREATE TABLE `kmn_ratings` (
`id` smallint(11) NOT NULL,
  `quota_id` smallint(11) NOT NULL,
  `rated_id` smallint(11) NOT NULL,
  `rater_id` smallint(11) NOT NULL,
  `score` float(2,1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_ratings`
--

INSERT INTO `kmn_ratings` (`id`, `quota_id`, `rated_id`, `rater_id`, `score`) VALUES
(2, 1, 5, 4, 8.5),
(3, 2, 5, 4, 8.0);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_rating_quota`
--

CREATE TABLE `kmn_rating_quota` (
`id` smallint(6) NOT NULL,
  `quota` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_rating_quota`
--

INSERT INTO `kmn_rating_quota` (`id`, `quota`) VALUES
(1, 'Instrument Beheersing'),
(2, 'Klank'),
(3, 'Sfeer en Interactie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kmn_bandbattles`
--
ALTER TABLE `kmn_bandbattles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_bandbattle_events`
--
ALTER TABLE `kmn_bandbattle_events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_bandmembers`
--
ALTER TABLE `kmn_bandmembers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_bands`
--
ALTER TABLE `kmn_bands`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_band_images`
--
ALTER TABLE `kmn_band_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_invite_keys`
--
ALTER TABLE `kmn_invite_keys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_ratings`
--
ALTER TABLE `kmn_ratings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmn_rating_quota`
--
ALTER TABLE `kmn_rating_quota`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kmn_bandbattles`
--
ALTER TABLE `kmn_bandbattles`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kmn_bandbattle_events`
--
ALTER TABLE `kmn_bandbattle_events`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kmn_bandmembers`
--
ALTER TABLE `kmn_bandmembers`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kmn_bands`
--
ALTER TABLE `kmn_bands`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kmn_band_images`
--
ALTER TABLE `kmn_band_images`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kmn_invite_keys`
--
ALTER TABLE `kmn_invite_keys`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kmn_ratings`
--
ALTER TABLE `kmn_ratings`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kmn_rating_quota`
--
ALTER TABLE `kmn_rating_quota`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

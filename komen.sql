-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:1125
-- Generation Time: Mar 26, 2015 at 02:55 AM
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
  `band_id` smallint(11) NOT NULL,
  `thedate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bandbattles`
--

INSERT INTO `kmn_bandbattles` (`id`, `band_id`, `thedate`, `location`, `latitude`, `longitude`) VALUES
(2, 1, '2015-03-26', 'Goatsville Belgium', 51.182846, 3.581908);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_bands`
--

CREATE TABLE `kmn_bands` (
`id` smallint(11) NOT NULL,
  `bandname` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `band_image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_bands`
--

INSERT INTO `kmn_bands` (`id`, `bandname`, `email`, `password`, `band_image`) VALUES
(1, 'GoatDestroyer', 'info@destroythegoat.com', 'goat12', 'goat.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_ratings`
--

INSERT INTO `kmn_ratings` (`id`, `quota_id`, `rated_id`, `rater_id`, `score`) VALUES
(1, 1, 1, 1, 9.0);

-- --------------------------------------------------------

--
-- Table structure for table `kmn_rating_quota`
--

CREATE TABLE `kmn_rating_quota` (
`id` smallint(6) NOT NULL,
  `quota` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kmn_rating_quota`
--

INSERT INTO `kmn_rating_quota` (`id`, `quota`) VALUES
(1, 'Instrument Beheersing'),
(2, 'Muziek Niveau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kmn_bandbattles`
--
ALTER TABLE `kmn_bandbattles`
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
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kmn_bands`
--
ALTER TABLE `kmn_bands`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kmn_band_images`
--
ALTER TABLE `kmn_band_images`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kmn_ratings`
--
ALTER TABLE `kmn_ratings`
MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kmn_rating_quota`
--
ALTER TABLE `kmn_rating_quota`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

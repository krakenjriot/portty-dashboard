-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 04:50 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portty`
--
CREATE DATABASE IF NOT EXISTS `db_portty` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_portty`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_boards`
--

CREATE TABLE `tbl_boards` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `board_desc` varchar(128) NOT NULL,
  `board_location` varchar(128) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `com_port` varchar(64) NOT NULL,
  `board_type` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `temp` varchar(24) NOT NULL,
  `hum` varchar(24) NOT NULL,
  `refresh_sec` varchar(2) NOT NULL DEFAULT '3',
  `monitor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dht`
--

CREATE TABLE `tbl_dht` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `temp` float NOT NULL,
  `hum` float NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pins`
--

CREATE TABLE `tbl_pins` (
  `id` int(11) NOT NULL,
  `pin_name` varchar(128) NOT NULL,
  `pin_desc` varchar(128) NOT NULL,
  `pin_num` int(2) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_servers`
--

CREATE TABLE `tbl_servers` (
  `id` int(11) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `server_desc` varchar(128) NOT NULL,
  `server_ip` varchar(16) NOT NULL,
  `server_location` varchar(128) NOT NULL,
  `server_timezone` varchar(128) NOT NULL,
  `htdocs_dir` varchar(128) NOT NULL,
  `conf_dir` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `_default` tinyint(1) NOT NULL,
  `refresh_sec` varchar(2) NOT NULL DEFAULT '3',
  `web_service` tinyint(1) NOT NULL,
  `web_page` tinyint(1) NOT NULL,
  `exe_dir` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_url`
--

CREATE TABLE `tbl_url` (
  `id` int(11) NOT NULL,
  `url` varchar(512) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `server_ip` varchar(64) NOT NULL,
  `response` varchar(128) NOT NULL,
  `pins` varchar(128) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `conf_dir` varchar(128) NOT NULL,
  `htdocs_dir` varchar(128) NOT NULL,
  `server_timezone` varchar(128) NOT NULL,
  `board_refresh_sec` varchar(2) NOT NULL,
  `exe_dir` varchar(128) NOT NULL,
  `server_refresh_sec` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `board_name` (`board_name`);

--
-- Indexes for table `tbl_dht`
--
ALTER TABLE `tbl_dht`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `server_name` (`server_name`),
  ADD UNIQUE KEY `server_ip` (`server_ip`);

--
-- Indexes for table `tbl_url`
--
ALTER TABLE `tbl_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dht`
--
ALTER TABLE `tbl_dht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_url`
--
ALTER TABLE `tbl_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

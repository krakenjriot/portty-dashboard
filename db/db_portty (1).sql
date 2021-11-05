-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 12:41 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_boards`
--

CREATE TABLE `tbl_boards` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `board_desc` varchar(128) NOT NULL,
  `board_location` varchar(128) NOT NULL,
  `monitor_name` varchar(128) NOT NULL,
  `com_port` varchar(64) NOT NULL,
  `board_type` varchar(128) NOT NULL,
  `pins` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `temp` float NOT NULL,
  `hum` float NOT NULL,
  `refresh_sec` varchar(2) NOT NULL DEFAULT '3',
  `monitored` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_boards`
--

INSERT INTO `tbl_boards` (`id`, `board_name`, `board_desc`, `board_location`, `monitor_name`, `com_port`, `board_type`, `pins`, `active`, `temp`, `hum`, `refresh_sec`, `monitored`) VALUES
(2, 'TLPpepPT1kXshdT6', '', '', '2pnlhE1rDIjYUDhh', 'com9', 'uno', '00000000010000000000', 1, 26.7, 40.5, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dht`
--

CREATE TABLE `tbl_dht` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `temp` float NOT NULL,
  `hum` float NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dt_remote` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_limits`
--

CREATE TABLE `tbl_limits` (
  `indx` int(11) NOT NULL,
  `lim_num` int(2) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `lim_low` int(2) NOT NULL,
  `lim_hi` int(2) NOT NULL,
  `lim_trig_low` int(2) NOT NULL,
  `lim_trig_range` int(2) NOT NULL,
  `lim_trig_hi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monitors`
--

CREATE TABLE `tbl_monitors` (
  `id` int(11) NOT NULL,
  `monitor_name` varchar(128) NOT NULL,
  `monitor_type` varchar(128) NOT NULL,
  `monitor_desc` varchar(128) NOT NULL,
  `monitor_location` varchar(128) NOT NULL,
  `monitor_timezone` varchar(128) NOT NULL,
  `passcode` varchar(6) NOT NULL,
  `exe_dir` varchar(128) NOT NULL,
  `refresh_sec` int(2) NOT NULL DEFAULT 3,
  `current_ts` int(11) NOT NULL,
  `last_ts` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_monitors`
--

INSERT INTO `tbl_monitors` (`id`, `monitor_name`, `monitor_type`, `monitor_desc`, `monitor_location`, `monitor_timezone`, `passcode`, `exe_dir`, `refresh_sec`, `current_ts`, `last_ts`, `active`) VALUES
(4, '2pnlhE1rDIjYUDhh', 'porttyweb', '', 'default_location', 'Asia/Riyadh', '123456', 'C:\\xampp\\htdocs\\portty-dashboard\\exe', 3, 1635604773, 1635604770, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pins`
--

CREATE TABLE `tbl_pins` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `pin_num` int(2) NOT NULL,
  `pin_name` varchar(128) NOT NULL,
  `pin_desc` varchar(128) NOT NULL,
  `pin_mode` varchar(64) NOT NULL DEFAULT 'manual',
  `board_name` varchar(128) NOT NULL,
  `startdt` varchar(128) NOT NULL,
  `stopdt` varchar(128) NOT NULL,
  `time_hour` int(2) NOT NULL,
  `time_min` int(2) NOT NULL,
  `time_sec` int(2) NOT NULL,
  `dur_sec` int(2) NOT NULL,
  `dur_min` int(2) NOT NULL,
  `dur_hour` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pins`
--

INSERT INTO `tbl_pins` (`id`, `active`, `pin_num`, `pin_name`, `pin_desc`, `pin_mode`, `board_name`, `startdt`, `stopdt`, `time_hour`, `time_min`, `time_sec`, `dur_sec`, `dur_min`, `dur_hour`) VALUES
(21, 0, 0, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(22, 0, 1, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(23, 0, 2, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(24, 0, 3, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(25, 0, 4, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(26, 0, 5, 'default_name', 'default_desc', 'set_time', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(27, 0, 6, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(28, 0, 7, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(29, 0, 8, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(30, 1, 9, 'xxxx', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '2021-10-29 16:46:0', '2021-10-29 18:46:00', 16, 46, 0, 0, 0, 2),
(31, 0, 10, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(32, 0, 11, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(33, 0, 12, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(34, 0, 13, 'default_name', 'default_desc', 'manual', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(35, 0, 14, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(36, 0, 15, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(37, 0, 16, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(38, 0, 17, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(39, 0, 18, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0),
(40, 0, 19, 'default_name', 'default_desc', '', 'TLPpepPT1kXshdT6', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sensord`
--

CREATE TABLE `tbl_sensord` (
  `board_name` varchar(128) NOT NULL,
  `val1` float NOT NULL,
  `val2` float NOT NULL,
  `val3` float NOT NULL,
  `val4` float NOT NULL,
  `val5` float NOT NULL,
  `val6` float NOT NULL,
  `val7` float NOT NULL,
  `val8` float NOT NULL,
  `val9` float NOT NULL,
  `val10` float NOT NULL,
  `val11` float NOT NULL,
  `val12` float NOT NULL,
  `val13` float NOT NULL,
  `val14` float NOT NULL,
  `val15` float NOT NULL,
  `val16` float NOT NULL,
  `val17` float NOT NULL,
  `val18` float NOT NULL,
  `val19` float NOT NULL,
  `val20` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_mobile` varchar(24) NOT NULL,
  `dashboard_ip` varchar(24) NOT NULL,
  `dashboard_port` int(4) NOT NULL DEFAULT 80,
  `filtered_pins` varchar(32) NOT NULL,
  `filtered_dht` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `user_email`, `user_mobile`, `dashboard_ip`, `dashboard_port`, `filtered_pins`, `filtered_dht`) VALUES
(1, 'rfvillacacan@yahoo.com', '', '192.168.100.4', 80, 'yjYQNL4zDSWetp7f', 'TLPpepPT1kXshdT6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(128) NOT NULL,
  `lname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `mobile_number` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fname`, `lname`, `email`, `pass`, `mobile_number`) VALUES
(1, 'ROLLY', 'VILLACACAN', 'rfvillacacan@yahoo.com', 'c4ca4238a0b923820dcc509a6f75849b', '');

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
-- Indexes for table `tbl_limits`
--
ALTER TABLE `tbl_limits`
  ADD PRIMARY KEY (`indx`);

--
-- Indexes for table `tbl_monitors`
--
ALTER TABLE `tbl_monitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_dht`
--
ALTER TABLE `tbl_dht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_limits`
--
ALTER TABLE `tbl_limits`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_monitors`
--
ALTER TABLE `tbl_monitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

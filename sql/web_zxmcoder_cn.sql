-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2021-01-16 16:25:07
-- 服务器版本： 5.6.49-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_zxmcoder_cn`
--

-- --------------------------------------------------------

--
-- 表的结构 `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL COMMENT 'log自增主键',
  `log_person` varchar(100) NOT NULL COMMENT 'log的用户',
  `log_role` varchar(100) NOT NULL COMMENT 'log的角色',
  `log_time` bigint(20) NOT NULL COMMENT 'log的时间',
  `log_ip` varchar(100) NOT NULL COMMENT 'log的ip',
  `log_url` varchar(100) NOT NULL COMMENT 'log的url'
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `log`
--

INSERT INTO `log` (`log_id`, `log_person`, `log_role`, `log_time`, `log_ip`, `log_url`) VALUES
(2, 'ABCDEFGHIJ', 'superadmin', 1610701896, '115.27.215.84', 'admin/login/index'),
(3, 'abcdefghij', 'worker', 1610701963, '115.27.215.84', 'admin/login/index'),
(4, 'ABCDEFGHIJ', 'superadmin', 1610701990, '115.27.215.84', 'admin/login/index'),
(5, 'ABCDEFGHIJ', 'superadmin', 1610702262, '115.27.215.84', 'admin/log/showlog'),
(6, 'ABCDEFGHIJ', 'superadmin', 1610702264, '115.27.215.84', 'admin/log/showlog'),
(7, 'ABCDEFGHIJ', 'superadmin', 1610702271, '115.27.215.84', 'admin/main/index'),
(8, 'ABCDEFGHIJ', 'superadmin', 1610702272, '115.27.215.84', 'admin/main/index'),
(9, 'ABCDEFGHIJ', 'superadmin', 1610702273, '115.27.215.84', 'admin/log/showlog'),
(10, 'ABCDEFGHIJ', 'superadmin', 1610702308, '115.27.215.84', 'admin/main/index'),
(11, 'ABCDEFGHIJ', 'superadmin', 1610702309, '115.27.215.84', 'admin/log/showlog'),
(12, 'ABCDEFGHIJ', 'superadmin', 1610702820, '115.27.215.84', 'admin/log/showlog'),
(13, 'ABCDEFGHIJ', 'superadmin', 1610702876, '115.27.215.84', 'admin/main/index'),
(14, 'ABCDEFGHIJ', 'superadmin', 1610702877, '115.27.215.84', 'admin/log/showlog'),
(15, 'ABCDEFGHIJ', 'superadmin', 1610702899, '115.27.215.84', 'admin/main/index'),
(16, 'ABCDEFGHIJ', 'superadmin', 1610702901, '115.27.215.84', 'admin/log/showlog'),
(17, 'ABCDEFGHIJ', 'superadmin', 1610702930, '115.27.215.84', 'admin/main/index'),
(18, 'ABCDEFGHIJ', 'superadmin', 1610702931, '115.27.215.84', 'admin/log/showlog'),
(19, 'ABCDEFGHIJ', 'superadmin', 1610702934, '115.27.215.84', 'admin/log/showlog'),
(20, 'ABCDEFGHIJ', 'superadmin', 1610702935, '115.27.215.84', 'admin/log/showlog'),
(21, 'ABCDEFGHIJ', 'superadmin', 1610702989, '115.27.215.84', 'admin/log/showlog'),
(22, 'ABCDEFGHIJ', 'superadmin', 1610702991, '115.27.215.84', 'admin/log/showlog'),
(23, 'ABCDEFGHIJ', 'superadmin', 1610702994, '115.27.215.84', 'admin/log/showlog'),
(24, 'ABCDEFGHIJ', 'superadmin', 1610703009, '115.27.215.84', 'admin/log/showlog'),
(25, 'ABCDEFGHIJ', 'superadmin', 1610703014, '115.27.215.84', 'admin/log/showlog'),
(26, 'ABCDEFGHIJ', 'superadmin', 1610703016, '115.27.215.84', 'admin/log/showlog'),
(27, 'ABCDEFGHIJ', 'superadmin', 1610703018, '115.27.215.84', 'admin/log/showlog'),
(28, 'ABCDEFGHIJ', 'superadmin', 1610703050, '115.27.215.84', 'admin/log/showlog'),
(29, 'ABCDEFGHIJ', 'superadmin', 1610703058, '115.27.215.84', 'admin/log/showlog'),
(30, 'ABCDEFGHIJ', 'superadmin', 1610703059, '115.27.215.84', 'admin/log/showlog'),
(31, 'ABCDEFGHIJ', 'superadmin', 1610703062, '115.27.215.84', 'admin/main/index'),
(32, 'ABCDEFGHIJ', 'superadmin', 1610703063, '115.27.215.84', 'admin/main/index'),
(33, 'ABCDEFGHIJ', 'superadmin', 1610703064, '115.27.215.84', 'admin/main/index'),
(34, 'ABCDEFGHIJ', 'superadmin', 1610703069, '115.27.215.84', 'admin/log/showlog'),
(35, 'ABCDEFGHIJ', 'superadmin', 1610703075, '115.27.215.84', 'admin/log/showlog'),
(36, 'ABCDEFGHIJ', 'superadmin', 1610703079, '115.27.215.84', 'admin/log/showlog'),
(37, 'ABCDEFGHIJ', 'superadmin', 1610703138, '115.27.215.84', 'admin/main/index'),
(38, 'ABCDEFGHIJ', 'superadmin', 1610703140, '115.27.215.84', 'admin/main/index'),
(39, 'ABCDEFGHIJ', 'superadmin', 1610703141, '115.27.215.84', 'admin/log/showlog'),
(40, 'ABCDEFGHIJ', 'superadmin', 1610703159, '115.27.215.84', 'admin/main/index'),
(41, 'ABCDEFGHIJ', 'superadmin', 1610703160, '115.27.215.84', 'admin/worker/showworker'),
(42, 'ABCDEFGHIJ', 'superadmin', 1610703163, '115.27.215.84', 'admin/main/index'),
(43, 'ABCDEFGHIJ', 'superadmin', 1610703164, '115.27.215.84', 'admin/log/showlog'),
(44, 'ABCDEFGHIJ', 'superadmin', 1610703165, '115.27.215.84', 'admin/log/showlog'),
(45, 'ABCDEFGHIJ', 'superadmin', 1610703173, '115.27.215.84', 'admin/log/showlog'),
(46, 'ABCDEFGHIJ', 'superadmin', 1610703184, '115.27.215.84', 'admin/main/logout'),
(47, 'abcdefghij', 'worker', 1610703225, '115.27.215.84', 'admin/login/index'),
(48, 'abcdefghij', 'worker', 1610703226, '115.27.215.84', 'admin/main/index'),
(49, 'abcdefghij', 'worker', 1610703228, '115.27.215.84', 'admin/user/showuser'),
(50, 'abcdefghij', 'worker', 1610703230, '115.27.215.84', 'admin/ticket/showticket'),
(51, 'abcdefghij', 'worker', 1610703232, '115.27.215.84', 'admin/ticket/addticket'),
(52, 'abcdefghij', 'worker', 1610703239, '115.27.215.84', 'admin/ticket/addticket'),
(53, 'abcdefghij', 'worker', 1610703243, '115.27.215.84', 'admin/ticket/addticket'),
(54, 'abcdefghij', 'worker', 1610703248, '115.27.215.84', 'admin/user/showuser'),
(55, 'abcdefghij', 'worker', 1610703250, '115.27.215.84', 'admin/ticket/showticket'),
(56, 'abcdefghij', 'worker', 1610703252, '115.27.215.84', 'admin/main/logout'),
(57, 'ABCDEFGHIJ', 'superadmin', 1610703275, '115.27.215.84', 'admin/login/index'),
(58, 'ABCDEFGHIJ', 'superadmin', 1610703277, '115.27.215.84', 'admin/main/index'),
(59, 'ABCDEFGHIJ', 'superadmin', 1610703279, '115.27.215.84', 'admin/log/showlog'),
(60, 'ABCDEFGHIJ', 'superadmin', 1610703281, '115.27.215.84', 'admin/log/showlog'),
(61, 'ABCDEFGHIJ', 'superadmin', 1610703296, '115.27.215.84', 'admin/main/logout'),
(62, 'rfrfrfrefr', 'worker', 1610703772, '115.27.215.84', 'admin/login/index'),
(63, 'rfrfrfrefr', 'worker', 1610703774, '115.27.215.84', 'admin/main/index'),
(64, 'rfrfrfrefr', 'worker', 1610703776, '115.27.215.84', 'admin/ticket/showticket'),
(65, 'rfrfrfrefr', 'worker', 1610703778, '115.27.215.84', 'admin/user/showuser'),
(66, 'rfrfrfrefr', 'worker', 1610703781, '115.27.215.84', 'admin/main/password'),
(67, 'rfrfrfrefr', 'worker', 1610703783, '115.27.215.84', 'admin/user/showuser'),
(68, 'ABCDEFGHIJ', 'superadmin', 1610712229, '115.27.215.84', 'admin/login/index'),
(69, 'ABCDEFGHIJ', 'superadmin', 1610712232, '115.27.215.84', 'admin/main/index'),
(70, 'ABCDEFGHIJ', 'superadmin', 1610712236, '115.27.215.84', 'admin/worker/showworker'),
(71, 'ABCDEFGHIJ', 'superadmin', 1610712240, '115.27.215.84', 'admin/log/showlog'),
(72, 'ABCDEFGHIJ', 'superadmin', 1610712244, '115.27.215.84', 'admin/log/showlog'),
(73, 'ABCDEFGHIJ', 'superadmin', 1610712255, '115.27.215.84', 'admin/log/showlog'),
(74, 'ABCDEFGHIJ', 'superadmin', 1610712257, '115.27.215.84', 'admin/log/showlog'),
(75, 'ABCDEFGHIJ', 'superadmin', 1610712266, '115.27.215.84', 'admin/main/logout'),
(76, 'abcdefghij', 'worker', 1610712855, '115.27.215.84', 'admin/login/index'),
(77, 'abcdefghij', 'worker', 1610712858, '115.27.215.84', 'admin/main/index'),
(78, 'abcdefghij', 'worker', 1610712860, '115.27.215.84', 'admin/ticket/showticket'),
(79, 'abcdefghij', 'worker', 1610712864, '115.27.215.84', 'admin/ticket/addticket'),
(80, 'abcdefghij', 'worker', 1610712867, '115.27.215.84', 'admin/ticket/addticket'),
(81, 'abcdefghij', 'worker', 1610712876, '115.27.215.84', 'admin/ticket/addticket'),
(82, 'abcdefghij', 'worker', 1610712879, '115.27.215.84', 'admin/ticket/showticket'),
(83, 'abcdefghij', 'worker', 1610712880, '115.27.215.84', 'admin/ticket/addticket'),
(84, 'abcdefghij', 'worker', 1610712886, '115.27.215.84', 'admin/ticket/addticket'),
(85, 'abcdefghij', 'worker', 1610712889, '115.27.215.84', 'admin/ticket/showticket'),
(86, 'abcdefghij', 'worker', 1610712890, '115.27.215.84', 'admin/ticket/addticket'),
(87, 'abcdefghij', 'worker', 1610712900, '115.27.215.84', 'admin/ticket/showticket'),
(88, 'abcdefghij', 'worker', 1610712901, '115.27.215.84', 'admin/user/showuser'),
(89, 'abcdefghij', 'worker', 1610712906, '115.27.215.84', 'admin/user/showuser'),
(90, 'abcdefghij', 'worker', 1610712906, '115.27.215.84', 'admin/main/index'),
(91, 'abcdefghij', 'worker', 1610712907, '115.27.215.84', 'admin/main/index'),
(92, 'abcdefghij', 'worker', 1610712909, '115.27.215.84', 'admin/main/logout'),
(93, 'rfrfrfrefr', 'worker', 1610713617, '115.27.215.84', 'admin/main/index'),
(94, 'rfrfrfrefr', 'worker', 1610713619, '115.27.215.84', 'admin/main/logout');

-- --------------------------------------------------------

--
-- 表的结构 `superadmin`
--

CREATE TABLE IF NOT EXISTS `superadmin` (
  `superadmin_id` varchar(10) NOT NULL COMMENT '10大写字母主键',
  `superadmin_password` varchar(100) NOT NULL COMMENT '密码md5加盐存储',
  `is_change_password` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否修改了默认密码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `superadmin`
--

INSERT INTO `superadmin` (`superadmin_id`, `superadmin_password`, `is_change_password`) VALUES
('ABCDEFGHIJ', 'fc63f2b8b3a866b6196753762577186a', 1),
('BCDEFGHIJK', 'a7dd0d06874edad2c4c6b0e1bcb24bd7', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` varchar(1) NOT NULL COMMENT '某个大写字母代表火车票',
  `ticket_num` int(10) NOT NULL DEFAULT '0' COMMENT '剩余数量>=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `ticket_num`) VALUES
('A', 0),
('B', 0),
('C', 9),
('D', 99),
('E', 59),
('F', 100);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(10) NOT NULL COMMENT '10个数字表示主键id',
  `user_password` varchar(100) NOT NULL COMMENT 'md5salt存储密码',
  `user_ticket` varchar(1) NOT NULL DEFAULT '0' COMMENT '用户只能有某一张票'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_password`, `user_ticket`) VALUES
('2001210723', '901ef00c110340257a0df58de3dd0184', 'C'),
('2001210724', 'c196a5dcaae5e5af51f630c9d51166a6', 'D'),
('2001210725', '0c342a58355dbbc175832e8dbf16c0a5', 'E'),
('2001210726', '99922420c7856a4e2b8857d48289aa3d', '0');

-- --------------------------------------------------------

--
-- 表的结构 `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `worker_id` varchar(10) NOT NULL COMMENT '10小写字母主键',
  `worker_password` varchar(100) NOT NULL COMMENT '密码md5加盐存储',
  `is_change_password` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否修改了默认密码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `worker`
--

INSERT INTO `worker` (`worker_id`, `worker_password`, `is_change_password`) VALUES
('abcdefghij', '281bc104d4062f24ed32a35b87c9a410', 1),
('efefefefef', '07f03f536e3128788f0a69ea772a27b1', 1),
('rfrfrfrefr', '3a4d5db78680ab943c1aac367d5a83e8', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadmin_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'log自增主键',AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

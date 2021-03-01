-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 04:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_setup`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Normal User', '2018-11-14 13:15:28', '2018-11-14 13:15:28'),
(2, 'DS User', '2018-11-14 13:15:28', '2018-11-14 13:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fake_pass` varchar(250) DEFAULT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `login_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `mobile`, `dob`, `email`, `password`, `fake_pass`, `profile_photo`, `status`, `is_verified`, `login_count`, `created`, `modified`) VALUES
(1, 'Stanford Hammes', '+4791216042518', '1953-05-20', 'rhintz@yahoo.com', '$2y$10$iAsv4VFYS4fwW/ALHQjF4.8UjhW56g5Sl2d.2vnOTqnmpUtlbOLqy', 'RKTG`H', '319f4c8a42b0ca8b1f1e07f1d57d2e69.jpg', 1, 1, 21, '2017-07-05 16:41:26', '2017-07-05 16:41:26'),
(2, 'Rashad Torp', '+4988141317291', '1988-09-16', 'zrice@hotmail.com', '$2y$10$LauSg47wdSl351s1fJmeVeC7PK/8/6VaQ6XSfLj1D6or5f3n5UDyi', '4T1&5U*zdl*:Y,', 'f4148fb73c9f7c724af58906961cde12.jpg', 1, 0, 0, '1982-05-27 21:22:24', '1982-05-27 21:22:24'),
(3, 'Emil Schmitt', '+7952674365701', '1957-09-04', 'doconner@kling.com', '$2y$10$GYquEnjleGBdSSVdJo2o2ede8hCI52aU0MNe6TpAg9t/5/vpa1MdK', 'Vr,pq%<n4ReMQQP=d', '6b81bc2182f912b14dd9950851826ddb.jpg', 0, 0, 0, '2005-11-27 02:15:18', '2005-11-27 02:15:18'),
(4, 'Macy Thiel', '+6162016919917', '1944-01-25', 'raynor.vada@white.net', '$2y$10$3l4ayNZdyEv37U9avpGegeaAKR7TQiOZTJWQjjhvRgeaZ7kRcwoLi', 'b`kq)*j*P}!DSx5', '63368dba56fff4a5dc19b2107fe776f9.jpg', 0, 0, 0, '1994-11-15 00:06:25', '1994-11-15 00:06:25'),
(5, 'Christiana Hermann', '+2113954437181', '2002-09-19', 'hahn.afton@hotmail.com', '$2y$10$QM7Ggal2FqpLijrv8yXwAu5svZVYnXLeGrTMw1Lpq5OF1hmEXWSQm', 'oNuwXsGt*1%K]1\\', '695d980f7f9f7065774166e571b47bc5.jpg', 1, 0, 0, '2017-06-04 15:47:20', '2017-06-04 15:47:20'),
(6, 'Gustave Boyer', '+8710192044260', '1942-10-30', 'connor20@kuphal.com', '$2y$10$cfEzJEHjNWDBFU64Ak.Qq.qUu.BnqPFmBin7547qqjrKft/zbebya', 'iQ_m2R:;)4@', '6e086443e12cb38bf524f25e344b119e.jpg', 1, 0, 0, '1975-05-19 12:08:40', '1975-05-19 12:08:40'),
(7, 'Isobel Boehm', '+8265979895538', '1973-09-19', 'randi.erdman@hotmail.com', '$2y$10$4NU0oGES9NzRITQTsY5hZ.ejCWyj1TTAGzWygQYxeBETwnJX160oS', '&(S*HkR', 'cbfbd7c66b7d8e4148f2620ba3484e66.jpg', 0, 0, 0, '2011-01-20 17:47:00', '2011-01-20 17:47:00'),
(8, 'Adan West', '+3871006668669', '1985-06-08', 'annabell66@kunze.biz', '$2y$10$up25a7dyUl4Qk9VgzAbIxequk6wBOOvNSwMS5j0kPCTHwCmEiOkXi', 'a~s\">9;DvSA', '952c55ed835247c789d19696c51b40fa.jpg', 1, 0, 0, '2004-08-18 22:21:15', '2004-08-18 22:21:15'),
(9, 'Vince Ernser', '+8370529491021', '1938-12-24', 'antone48@yahoo.com', '$2y$10$7oOGD4E0ZFBKOWUK4YxvBugWXjOMRJPGslY/vv2/gPuMJN6rhFKlG', '*;[L`|0Y{,X1', '35516f8a335384acbd447e5104149612.jpg', 1, 0, 0, '2012-08-22 14:02:44', '2012-08-22 14:02:44'),
(10, 'Jacquelyn Sipes', '+1360071749259', '1919-06-20', 'han@hotmail.com', '$2y$10$C2p.UdHohCbvAgJcAPRl8.SlPKBuapepcdjJR0.O8s6.Ff79SKTlm', '|N^Wj.F/', '962bc03dee8d2b0a640d539fab27eece.jpg', 0, 0, 0, '2016-10-06 14:31:32', '2018-11-20 06:39:10'),
(14, 'hanum yadav', '', '0000-00-00', 'manu@hotmail.com', '', NULL, '', 0, 0, 0, '2018-11-21 06:22:07', '2018-11-21 07:00:15'),
(15, 'ds', '', '0000-00-00', 'ds@gmail.com', '$2y$10$Ct/QM.2UNfoxNkp/tFgfguWtZAkIuQ99wrjFU1A5vREwNItpQ99ae', NULL, '', 1, 1, 4, '2018-11-21 07:07:17', '2018-11-23 10:34:07'),
(17, 'ramesh', '', '0000-00-00', 'testhanuman@gmail.com', '', NULL, '', 1, 0, 0, '2018-11-23 12:19:19', '2018-11-23 14:28:04'),
(18, 'ss', '', '0000-00-00', 'deepak.vijsssassyvargiya@dotsquares.com', '', NULL, '', 1, 0, 0, '2018-11-23 14:28:48', '2018-11-23 14:28:48'),
(19, 'ss', '', '0000-00-00', 'deepak.vijsssssassyvargiya@dotsquares.com', '', NULL, '', 1, 0, 0, '2018-11-23 14:29:36', '2018-11-23 14:29:36'),
(20, 'sssfdsf', '', '0000-00-00', 'deepak.vijsssssassddyvargiya@dotsquares.com', '', NULL, '', 1, 0, 0, '2018-11-23 14:31:11', '2018-11-23 14:31:11'),
(21, 'sdfesfr', '', '0000-00-00', 'grsssdg@gmail.com', '', NULL, '', 0, 0, 0, '2018-11-23 14:32:56', '2018-11-23 14:55:20'),
(22, 'sdzf dddddd', '', '0000-00-00', 'kamal@gmail.com', '', NULL, '', 1, 0, 0, '2018-11-23 14:34:25', '2018-11-23 15:34:22'),
(23, 'dfersgfsfg sssss', '', '0000-00-00', 'rakeshrr@gmail.com', '', NULL, '', 1, 0, 0, '2018-11-23 15:31:59', '2018-11-23 15:48:04'),
(24, 'fef  ddd', '', '0000-00-00', 'esfews@gmail.com', '', NULL, '', 0, 0, 0, '2018-11-23 15:41:41', '2018-11-23 15:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_roles`
--

CREATE TABLE `admin_users_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(5) NOT NULL,
  `admin_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users_roles`
--

INSERT INTO `admin_users_roles` (`id`, `role_id`, `admin_user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 6),
(7, 2, 7),
(8, 1, 8),
(9, 1, 9),
(10, 2, 10),
(14, 1, 14),
(15, 1, 15),
(18, 1, 17),
(19, 1, 18),
(20, 1, 19),
(21, 1, 20),
(22, 1, 21),
(23, 1, 22),
(24, 2, 23),
(25, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_manager_phinxlog`
--

CREATE TABLE `admin_user_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user_manager_phinxlog`
--

INSERT INTO `admin_user_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171222172507, 'CreateRoles', '2018-11-12 07:10:56', '2018-11-12 07:10:56', 0),
(20171222174928, 'CreateAdminUsers', '2018-11-12 07:10:56', '2018-11-12 07:10:56', 0),
(20171222175250, 'CreateAdminUsersRoles', '2018-11-12 07:10:56', '2018-11-12 07:10:57', 0),
(20171223170901, 'AddFakePassToAdminUsers', '2018-11-12 07:10:57', '2018-11-12 07:10:57', 0),
(20180312140710, 'CreateUserTokens', '2018-11-12 07:10:57', '2018-11-12 07:10:58', 0),
(20180417095907, 'AddIsDefaultToRoles', '2018-11-12 07:10:58', '2018-11-12 07:10:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `loged_id` int(11) NOT NULL,
  `transaction` char(36) NOT NULL,
  `type` varchar(7) NOT NULL,
  `primary_key` int(10) UNSIGNED DEFAULT NULL,
  `source` varchar(255) NOT NULL,
  `parent_source` varchar(255) DEFAULT NULL,
  `original` mediumtext,
  `changed` mediumtext,
  `meta` mediumtext,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `loged_id`, `transaction`, `type`, `primary_key`, `source`, `parent_source`, `original`, `changed`, `meta`, `created`) VALUES
(1, 0, 0, '1fcaa6ac-6725-4b1d-9a6e-f9bcb6b3c020', 'create', 21, 'admin_users', NULL, '{\"id\":21,\"name\":\"sdfesfr\",\"email\":\"grsssdg@gmail.com\",\"status\":true}', '{\"id\":21,\"name\":\"sdfesfr\",\"email\":\"grsssdg@gmail.com\",\"status\":true}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\",\"user\":15}', '2018-11-23 14:32:56'),
(2, 0, 0, '64dc8b46-9fb9-43af-9ac7-4aae2dee5bfe', 'create', 22, 'admin_users', NULL, '{\"id\":22,\"name\":\"kamal\",\"email\":\"kamal@gmail.com\",\"status\":true}', '{\"id\":22,\"name\":\"kamal\",\"email\":\"kamal@gmail.com\",\"status\":true}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\",\"user\":15}', '2018-11-23 14:34:25'),
(3, 0, 0, 'ef9541d1-a266-4f2b-98d3-fb1ece3dd43b', 'update', 21, 'admin_users', NULL, '{\"status\":true}', '{\"status\":false}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/21\",\"user\":15}', '2018-11-23 14:55:20'),
(4, 0, 0, 'bd7a66ee-0bda-4c6a-9b26-84badce34649', 'update', 22, 'admin_users', NULL, '{\"name\":\"kamal\"}', '{\"name\":\"kamaldf s\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/22\",\"user\":15}', '2018-11-23 15:02:38'),
(5, 0, 0, 'c360f5d6-3489-41b4-be1d-5e3479a5c59a', 'update', 22, 'admin_users', NULL, '{\"name\":\"kamald hh d\"}', '{\"name\":\"sdzf\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/22\",\"user\":15}', '2018-11-23 15:24:01'),
(6, 0, 0, '42f8fd02-56c4-43d9-a36d-12db25f8fd44', 'create', 23, 'admin_users', NULL, '{\"id\":23,\"name\":\"dfersgfsfg\",\"email\":\"rakeshrr@gmail.com\",\"status\":true}', '{\"id\":23,\"name\":\"dfersgfsfg\",\"email\":\"rakeshrr@gmail.com\",\"status\":true}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\",\"user\":{\"name\":\"ds\",\"email\":\"ds@gmail.com\",\"mobile\":\"\",\"status\":true,\"login_count\":3,\"profile_photo\":\"\",\"is_verified\":true,\"created\":\"2018-11-21T07:07:17+00:00\",\"roles\":[{\"id\":1,\"title\":\"Administration\",\"is_default\":null,\"created\":\"2018-11-12T12:42:24+00:00\",\"modified\":\"2018-11-12T12:42:24+00:00\",\"_joinData\":{\"id\":15,\"role_id\":1,\"admin_user_id\":15}}]}}', '2018-11-23 15:31:59'),
(7, 0, 0, 'cd12f685-6f09-41c7-8dcf-a8decdfb2bb1', 'update', 22, 'admin_users', NULL, '{\"name\":\"sdzf\"}', '{\"name\":\"sdzf dddddd\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/22\",\"user\":[]}', '2018-11-23 15:34:22'),
(8, 0, 0, '48a9c8b4-ae67-408a-a5e0-fd8bdca3b9d1', 'update', 23, 'admin_users', NULL, '{\"name\":\"dfersgfsfg\"}', '{\"name\":\"dfersgfsfg dddddd\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/23\",\"user\":{\"id\":15}}', '2018-11-23 15:35:50'),
(9, 0, 0, '86b4c1ae-c147-4df6-85d8-b4fe5b4e3a91', 'update', 23, 'admin_users', NULL, '{\"name\":\"dfersgfsfg dddddd\"}', '{\"name\":\"dfersgfsfg\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/23\",\"user\":[]}', '2018-11-23 15:36:56'),
(10, 0, 0, '44b497e4-fc7d-4aa9-a513-6b9b061112db', 'create', 24, 'admin_users', NULL, '{\"id\":24,\"name\":\"fef\",\"email\":\"esfews@gmail.com\",\"status\":false}', '{\"id\":24,\"name\":\"fef\",\"email\":\"esfews@gmail.com\",\"status\":false}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\",\"user\":[]}', '2018-11-23 15:41:41'),
(11, 15, 0, '00e16f98-ed56-4bf6-91cf-0bb8415509d8', 'update', 24, 'admin_users', NULL, '{\"name\":\"fef\"}', '{\"name\":\"fef  ddd\"}', '{\"ip\":\"127.0.0.1\",\"url\":\"\\/admin\\/adminuser\\/add\\/24\",\"user\":[]}', '2018-11-23 15:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `audit_stash_phinxlog`
--

CREATE TABLE `audit_stash_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `audit_stash_phinxlog`
--

INSERT INTO `audit_stash_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171018185609, 'CreateAuditLogs', '2018-11-23 07:38:02', '2018-11-23 07:38:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_manager_phinxlog`
--

CREATE TABLE `cms_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_manager_phinxlog`
--

INSERT INTO `cms_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171223181406, 'CreatePages', '2018-11-14 05:52:23', '2018-11-14 05:52:23', 0),
(20171223181416, 'CreateNavigations', '2018-11-14 05:52:24', '2018-11-14 05:52:24', 0),
(20171223181425, 'CreateModules', '2018-11-14 05:52:24', '2018-11-14 05:52:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_hooks`
--

CREATE TABLE `email_hooks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_hooks`
--

INSERT INTO `email_hooks` (`id`, `title`, `slug`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Welcome Email', 'welcome-email', 'when user has been registered then send welcome email for verify account.', 1, '2018-11-14 09:52:34', '2018-11-14 09:52:34'),
(2, 'Forgot Password Email', 'forgot-password-email', 'when user has forgot password.', 1, '2018-11-14 09:52:34', '2018-11-14 09:52:34'),
(3, 'Contact us', 'contact-us', 'when guest user send inquiry from contact us form.', 1, '2018-11-14 09:52:34', '2018-11-14 09:52:34'),
(4, 'User Welcome Email', 'user-welcome-email', 'User Welcome Email', 1, '2018-11-20 06:14:21', '2018-11-20 06:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `email_manager_phinxlog`
--

CREATE TABLE `email_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_manager_phinxlog`
--

INSERT INTO `email_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171218082425, 'CreateEmailPreferences', '2018-11-14 04:06:21', '2018-11-14 04:06:21', 0),
(20171218082436, 'CreateEmailHooks', '2018-11-14 04:06:21', '2018-11-14 04:06:21', 0),
(20171218083809, 'CreateEmailTemplates', '2018-11-14 04:06:21', '2018-11-14 04:06:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_preferences`
--

CREATE TABLE `email_preferences` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `layout_html` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_preferences`
--

INSERT INTO `email_preferences` (`id`, `title`, `layout_html`, `status`, `created`, `modified`) VALUES
(1, 'Main Email Layout', '<html>\n<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>\n<body><div>\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #dddddd;\" width=\"650\">\n	<tbody>\n		<tr>\n			<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" style=\"background:#ffffff; border-bottom:1px solid #dddddd; padding:15px;\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td><a href=\"##BASE_URL##\" target=\"_blank\"><img alt=\"\" border=\"0\" src=\"##SYSTEM_LOGO##\" /></a></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background:#ffffff; padding:15px;\">\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td style=\"font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#000000; font-size:16px;\">\n							##EMAIL_CONTENT##\n						</td>\n					</tr>\n					<tr>\n						<td style=\"font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#043f8d; font-size:16px; vertical-align:middle; text-align:left; padding-top:20px;\">\n						##EMAIL_FOOTER##\n						</td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background:#043f8d; border-top:1px solid #dddddd; text-align:center; font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#ffffff; padding:12px; font-size:12px; text-transform:uppercase; font-weight:normal;\">##COPYRIGHT_TEXT##</td>\n		</tr>\n	</tbody>\n</table>\n</div>\n</body>\n</head>\n</html>', 1, '2018-11-14 09:52:46', '2018-11-14 09:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `email_queue`
--

CREATE TABLE `email_queue` (
  `id` int(11) NOT NULL,
  `email` varchar(129) NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `config` varchar(30) NOT NULL,
  `template` varchar(50) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `format` varchar(5) NOT NULL,
  `template_vars` text NOT NULL,
  `headers` text,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `send_tries` int(2) NOT NULL DEFAULT '0',
  `send_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `attachments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_queue`
--

INSERT INTO `email_queue` (`id`, `email`, `from_name`, `from_email`, `subject`, `config`, `template`, `layout`, `theme`, `format`, `template_vars`, `headers`, `sent`, `locked`, `send_tries`, `send_at`, `created`, `modified`, `attachments`) VALUES
(11, 'ds@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:2:\"ds\";s:5:\"email\";s:12:\"ds@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:15;s:7:\"role_id\";i:1;s:2:\"id\";i:15;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:15;s:9:\"USER_NAME\";s:2:\"ds\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/71f3cd6e-153b-4541-9a7a-91491dc598d5\";}', 'a:0:{}', 1, 0, 0, '2018-11-21 07:07:17', '2018-11-21 07:07:17', NULL, 'a:0:{}'),
(12, 'hello@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:5:\"hello\";s:5:\"email\";s:15:\"hello@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:16;s:7:\"role_id\";i:1;s:2:\"id\";i:16;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 11:34:20.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 11:34:20.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:16;s:9:\"USER_NAME\";s:5:\"hello\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/5669734e-39f1-4f57-b60e-3d64cabc1006\";}', 'a:0:{}', 1, 0, 0, '2018-11-21 11:34:20', '2018-11-21 11:34:20', NULL, 'a:0:{}'),
(13, 'hello.tango@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:16:{s:2:\"id\";i:16;s:4:\"name\";s:11:\"hello tango\";s:6:\"mobile\";s:0:\"\";s:3:\"dob\";N;s:5:\"email\";s:21:\"hello.tango@gmail.com\";s:9:\"fake_pass\";N;s:13:\"profile_photo\";s:0:\"\";s:6:\"status\";b:0;s:11:\"is_verified\";i:0;s:11:\"login_count\";i:0;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 11:34:20.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 12:05:56.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:5:\"roles\";a:2:{i:0;a:5:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}}i:1;a:5:{s:2:\"id\";i:2;s:5:\"title\";s:5:\"Admin\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}}}s:9:\"USER_NAME\";s:11:\"hello tango\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/746342e7-840b-4a0e-a7cc-9dbb53a925c8\";}', 'a:0:{}', 1, 0, 0, '2018-11-21 12:05:56', '2018-11-21 12:05:56', NULL, 'a:0:{}'),
(14, 'hello.tango@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:16:{s:2:\"id\";i:16;s:4:\"name\";s:11:\"hello tango\";s:6:\"mobile\";s:0:\"\";s:3:\"dob\";N;s:5:\"email\";s:21:\"hello.tango@gmail.com\";s:9:\"fake_pass\";N;s:13:\"profile_photo\";s:0:\"\";s:6:\"status\";b:1;s:11:\"is_verified\";b:0;s:11:\"login_count\";i:0;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 11:34:20.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 12:29:50.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:5:\"roles\";a:2:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:2:\"id\";i:16;s:7:\"role_id\";i:1;s:13:\"admin_user_id\";i:16;}}i:1;a:6:{s:2:\"id\";i:2;s:5:\"title\";s:5:\"Admin\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:2:\"id\";i:17;s:7:\"role_id\";i:2;s:13:\"admin_user_id\";i:16;}}}s:9:\"USER_NAME\";s:11:\"hello tango\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/bcb62af4-187f-47b9-acb8-eccf4b641123\";}', 'a:0:{}', 1, 0, 0, '2018-11-22 05:41:20', '2018-11-22 05:41:20', NULL, 'a:0:{}'),
(16, 'hhh@gmail.com', NULL, NULL, '', 'default', 'user-welcome-email', 'default', '', 'both', 'a:17:{s:10:\"first_name\";s:3:\"hhh\";s:9:\"last_name\";s:3:\"hhh\";s:5:\"email\";s:13:\"hhh@gmail.com\";s:3:\"dob\";O:20:\"Cake\\I18n\\FrozenDate\":3:{s:4:\"date\";s:26:\"2018-11-21 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:6:\"status\";b:1;s:13:\"account_types\";a:1:{i:0;a:5:{s:2:\"id\";i:1;s:5:\"title\";s:11:\"Normal User\";s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-14 13:15:28.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-14 13:15:28.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:7:\"user_id\";i:5;s:15:\"account_type_id\";i:1;s:2:\"id\";i:5;}}}s:13:\"profile_photo\";s:25:\"394455154289363770404.png\";s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-22 13:33:57.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-22 13:33:57.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"photo_dir\";s:36:\"webroot\\img\\uploads\\users\\photos\\11\\\";s:10:\"photo_size\";i:13797;s:10:\"photo_type\";s:9:\"image/png\";s:2:\"id\";i:5;s:10:\"image_path\";s:24:\"uploads/users/photos/11/\";s:9:\"USER_NAME\";s:7:\"hhh hhh\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/9cdcc8a7-a932-4796-b93c-d3a346452b97\";}', 'a:0:{}', 1, 0, 0, '2018-11-22 13:33:58', '2018-11-22 13:33:58', NULL, 'a:0:{}'),
(17, 'ds@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:16:{s:2:\"id\";i:15;s:4:\"name\";s:2:\"ds\";s:6:\"mobile\";s:0:\"\";s:3:\"dob\";N;s:5:\"email\";s:12:\"ds@gmail.com\";s:9:\"fake_pass\";N;s:13:\"profile_photo\";s:0:\"\";s:6:\"status\";b:1;s:11:\"is_verified\";b:0;s:11:\"login_count\";i:0;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:2:\"id\";i:15;s:7:\"role_id\";i:1;s:13:\"admin_user_id\";i:15;}}}s:9:\"USER_NAME\";s:2:\"ds\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/c1504c43-cc39-4935-9573-97a2d3e4bfcb\";}', 'a:0:{}', 1, 0, 0, '2018-11-23 07:12:46', '2018-11-23 07:12:46', NULL, 'a:0:{}'),
(18, 'ds@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:14:{s:2:\"id\";i:15;s:4:\"name\";s:2:\"ds\";s:6:\"mobile\";s:0:\"\";s:3:\"dob\";N;s:5:\"email\";s:12:\"ds@gmail.com\";s:9:\"fake_pass\";N;s:13:\"profile_photo\";s:0:\"\";s:6:\"status\";b:1;s:11:\"is_verified\";b:1;s:11:\"login_count\";i:1;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 08:39:19.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"USER_NAME\";s:2:\"ds\";s:15:\"USER_RESET_LINK\";s:96:\"http://localhost/cake37/setup/admin/adminuser/passwordreset/349c3307-47f1-4dd0-a2c2-f81b936138fc\";}', 'a:0:{}', 1, 0, 0, '2018-11-23 10:29:03', '2018-11-23 10:29:03', NULL, 'a:0:{}'),
(19, 'ds@gmail.com', NULL, NULL, '', 'default', 'forgot-password-email', 'default', '', 'both', 'a:14:{s:2:\"id\";i:15;s:4:\"name\";s:2:\"ds\";s:6:\"mobile\";s:0:\"\";s:3:\"dob\";N;s:5:\"email\";s:12:\"ds@gmail.com\";s:9:\"fake_pass\";N;s:13:\"profile_photo\";s:0:\"\";s:6:\"status\";b:1;s:11:\"is_verified\";b:1;s:11:\"login_count\";i:1;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-21 07:07:17.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 08:39:19.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"USER_NAME\";s:2:\"ds\";s:15:\"USER_RESET_LINK\";s:96:\"http://localhost/cake37/setup/admin/adminuser/passwordreset/d1fd9809-f4f5-41d7-99da-d3a95d10a100\";}', 'a:0:{}', 1, 0, 0, '2018-11-23 10:30:13', '2018-11-23 10:30:13', NULL, 'a:0:{}'),
(20, 'testhanuman@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:5:\"email\";s:5:\"email\";s:21:\"testhanuman@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:17;s:7:\"role_id\";i:1;s:2:\"id\";i:18;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 12:19:19.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 12:19:19.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:17;s:9:\"USER_NAME\";s:5:\"email\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/da34331c-004d-4ab0-bdb0-cb2989c59f78\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 12:19:19', '2018-11-23 12:19:19', NULL, 'a:0:{}'),
(21, 'deepak.vijsssassyvargiya@dotsquares.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:2:\"ss\";s:5:\"email\";s:39:\"deepak.vijsssassyvargiya@dotsquares.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:18;s:7:\"role_id\";i:1;s:2:\"id\";i:19;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:28:48.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:28:48.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:18;s:9:\"USER_NAME\";s:2:\"ss\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/86ffa95f-fd17-4349-b115-c37a4de323ef\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 14:28:49', '2018-11-23 14:28:49', NULL, 'a:0:{}'),
(22, 'deepak.vijsssssassyvargiya@dotsquares.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:2:\"ss\";s:5:\"email\";s:41:\"deepak.vijsssssassyvargiya@dotsquares.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:19;s:7:\"role_id\";i:1;s:2:\"id\";i:20;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:29:36.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:29:36.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:19;s:9:\"USER_NAME\";s:2:\"ss\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/364b1af9-b7e5-4a41-b28d-696a97b60089\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 14:29:36', '2018-11-23 14:29:36', NULL, 'a:0:{}'),
(23, 'deepak.vijsssssassddyvargiya@dotsquares.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:7:\"sssfdsf\";s:5:\"email\";s:43:\"deepak.vijsssssassddyvargiya@dotsquares.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:20;s:7:\"role_id\";i:1;s:2:\"id\";i:21;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:31:11.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:31:11.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:20;s:9:\"USER_NAME\";s:7:\"sssfdsf\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/46d8e8d0-1767-4b8c-b73f-ae7f68b0b7ef\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 14:31:11', '2018-11-23 14:31:11', NULL, 'a:0:{}'),
(24, 'grsssdg@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:7:\"sdfesfr\";s:5:\"email\";s:17:\"grsssdg@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:21;s:7:\"role_id\";i:1;s:2:\"id\";i:22;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:32:56.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:32:56.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:21;s:9:\"USER_NAME\";s:7:\"sdfesfr\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/733cb39e-3503-47a4-8693-cebb86be86e7\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 14:32:56', '2018-11-23 14:32:56', NULL, 'a:0:{}'),
(25, 'kamal@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:5:\"kamal\";s:5:\"email\";s:15:\"kamal@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:22;s:7:\"role_id\";i:1;s:2:\"id\";i:23;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:34:25.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 14:34:25.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:22;s:9:\"USER_NAME\";s:5:\"kamal\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/fa2df5a6-d4e6-46a0-9c7e-2480ed4da3f4\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 14:34:25', '2018-11-23 14:34:25', NULL, 'a:0:{}'),
(26, 'rakeshrr@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:10:\"dfersgfsfg\";s:5:\"email\";s:18:\"rakeshrr@gmail.com\";s:6:\"status\";b:1;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:2;s:5:\"title\";s:5:\"Admin\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:23;s:7:\"role_id\";i:2;s:2:\"id\";i:24;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 15:31:59.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 15:31:59.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:23;s:9:\"USER_NAME\";s:10:\"dfersgfsfg\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/e41a845c-967e-4d75-85e2-9d3afb87568e\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 15:32:00', '2018-11-23 15:32:00', NULL, 'a:0:{}'),
(27, 'esfews@gmail.com', NULL, NULL, '', 'default', 'welcome-email', 'default', '', 'both', 'a:10:{s:4:\"name\";s:3:\"fef\";s:5:\"email\";s:16:\"esfews@gmail.com\";s:6:\"status\";b:0;s:5:\"roles\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:5:\"title\";s:14:\"Administration\";s:10:\"is_default\";N;s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-12 12:42:24.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:9:\"_joinData\";a:3:{s:13:\"admin_user_id\";i:24;s:7:\"role_id\";i:1;s:2:\"id\";i:25;}}}s:7:\"created\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 15:41:41.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:8:\"modified\";O:20:\"Cake\\I18n\\FrozenTime\":3:{s:4:\"date\";s:26:\"2018-11-23 15:41:41.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:2:\"id\";i:24;s:9:\"USER_NAME\";s:3:\"fef\";s:9:\"USER_INFO\";s:0:\"\";s:17:\"verify_n_password\";s:96:\"http://localhost/cake37/setup/admin/adminuser/verifyaccount/8cc8ae9a-0c00-4003-8a88-e716a168673b\";}', 'a:0:{}', 0, 0, 0, '2018-11-23 15:41:41', '2018-11-23 15:41:41', NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `email_queue_phinxlog`
--

CREATE TABLE `email_queue_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_queue_phinxlog`
--

INSERT INTO `email_queue_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20160324054602, 'Initial', '2018-11-16 06:20:18', '2018-11-16 06:20:18', 0),
(20160810121455, 'AddAttachmentsToEmailQueue', '2018-11-16 06:20:18', '2018-11-16 06:20:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_hook_id` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `footer_text` text NOT NULL,
  `email_preference_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_hook_id`, `subject`, `description`, `footer_text`, `email_preference_id`, `status`, `created`, `modified`) VALUES
(1, 1, '##USER_NAME##, a very warm welcome to the ##SYSTEM_APPLICATION_NAME##', '<p>We&rsquo;re so happy to have you with us.</p>\n\n<p>Please click on the button below to confirm we got the right email address.</p>\n\n<p><a href=\"##verify_n_password##\">VERIFY MY EMAIL</a></p>\n\n<p>Or copy and paste the link below.</p>\n\n<p>##verify_n_password##</p>\n\n<p>##USER_INFO##</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-11-14 09:52:59', '2018-11-14 09:52:59'),
(2, 2, '##USER_NAME##, to set your new password…', '<p>You Recently requested to reset your password for your admin account. Click the button below to reset it.</p>\n\n<p><a href=\"##USER_RESET_LINK##\">Reset Password</a></p>\n\n<p>if you ignore this message, your password won&#39;t be changed.</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-11-14 09:52:59', '2018-11-14 09:52:59'),
(3, 3, 'Hello Administrtor, ##USER_NAME## want\'s to contact you', '<p>Hello Administrator,</p>\n\n<p>&nbsp;</p>\n\n<p>Name :&nbsp;##USER_NAME##</p>\n\n<p>Email :&nbsp;##USER_EMAIL##</p>\n\n<p>Phone No. :&nbsp;##USERE_MOBILE##</p>\n\n<p>##MESSAGE##</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-11-14 09:52:59', '2018-11-14 09:52:59'),
(4, 4, '##USER_NAME##, a very warm welcome to the ##SYSTEM_APPLICATION_NAME##', '<p>We&rsquo;re so happy to have you with us.</p>\r\n\r\n<p>Please click on the button below to confirm we got the right email address.</p>\r\n\r\n<p><a href=\"##verify_n_password##\">VERIFY MY EMAIL</a></p>\r\n\r\n<p>Or copy and paste the link below.</p>\r\n\r\n<p>##verify_n_password##</p>\r\n\r\n<p>##USER_INFO##</p>\r\n', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-11-20 06:24:43', '2018-11-20 06:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `plugin` varchar(120) NOT NULL,
  `controller` varchar(120) NOT NULL,
  `action` varchar(100) NOT NULL,
  `json_path` varchar(400) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `is_nav_type` int(2) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `is_top` tinyint(1) DEFAULT NULL,
  `is_bottom` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sub_title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `short_description` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `banner` varchar(200) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `sub_title`, `slug`, `short_description`, `description`, `banner`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created`, `modified`) VALUES
(1, 'About Us', 'About Us', 'about-usss', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n', '', 'About Us', 'About Us', 'About Us', 1, '2018-11-14 11:25:28', '2018-11-14 11:25:28'),
(2, 'How it works', 'How it works', 'how-it-worksss', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<div class=\"mainWpapContainer\">\n                <div class=\"container\">\n                <div class=\"globel-content padding-T-B-40\">\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p>How it works</p>\n                </div>\n                </div>\n                </div>', '', 'How it works', 'How it works', 'How it works', 1, '2018-11-14 11:25:28', '2018-11-14 11:25:28'),
(3, 'Privacy policy', 'Privacy policy', 'privacy-policyss', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<div class=\"mainWpapContainer\">\n                <div class=\"container\">\n                <div class=\"globel-content padding-T-B-40\">\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n\n                <p>How it works</p>\n                </div>\n                </div>\n                </div>', '', 'Privacy policy', 'Privacy policy', 'Privacy policy', 1, '2018-11-14 11:25:28', '2018-11-14 11:25:28'),
(4, 'Terms & Conditions', 'Terms & Conditions', 'terms-conditionsss', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<div class=\"mainWpapContainer\">\n                <div class=\"container\">\n                <div class=\"globel-content padding-T-B-40\">\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p>How it works</p>\n                </div>\n                </div>\n                </div>', '', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 1, '2018-11-14 11:25:28', '2018-11-14 11:25:28'),
(5, 'Disclaimer', 'Disclaimer', 'disclaimerss', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<div class=\"mainWpapContainer\">\n                <div class=\"container\">\n                <div class=\"globel-content padding-T-B-40\">\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\n                <p>How it works</p>\n                </div>\n                </div>\n                </div>', '', 'Disclaimer', 'Disclaimer', 'Disclaimer', 1, '2018-11-14 11:25:28', '2018-11-14 11:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `queued_jobs`
--

CREATE TABLE `queued_jobs` (
  `id` int(11) NOT NULL,
  `job_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `job_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `notbefore` datetime DEFAULT NULL,
  `fetched` datetime DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `progress` float DEFAULT NULL,
  `failed` int(11) NOT NULL DEFAULT '0',
  `failure_message` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `workerkey` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(3) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `queue_phinxlog`
--

CREATE TABLE `queue_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queue_phinxlog`
--

INSERT INTO `queue_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20150425180802, 'Init', '2018-11-15 07:45:33', '2018-11-15 07:45:34', 0),
(20150511062806, 'Fixmissing', '2018-11-15 07:45:34', '2018-11-15 07:45:34', 0),
(20150911132343, 'ImprovementsForMysql', '2018-11-15 07:45:34', '2018-11-15 07:45:34', 0),
(20161319000000, 'IncreaseDataSize', '2018-11-15 07:45:34', '2018-11-15 07:45:35', 0),
(20161319000001, 'Priority', '2018-11-15 07:45:35', '2018-11-15 07:45:35', 0),
(20161319000002, 'Rename', '2018-11-15 07:45:36', '2018-11-15 07:45:36', 0),
(20161319000003, 'Processes', '2018-11-15 07:45:36', '2018-11-15 07:45:36', 0),
(20171013131845, 'AlterQueuedJobs', '2018-11-15 07:45:36', '2018-11-15 07:45:37', 0),
(20171013133145, 'Utf8mb4Fix', '2018-11-15 07:45:37', '2018-11-15 07:45:37', 0),
(20171019083500, 'ColumnLength', '2018-11-15 07:45:37', '2018-11-15 07:45:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `queue_processes`
--

CREATE TABLE `queue_processes` (
  `id` int(11) NOT NULL,
  `pid` varchar(40) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `is_default`, `created`, `modified`) VALUES
(1, 'Administration', NULL, '2018-11-12 12:42:24', '2018-11-12 12:42:24'),
(2, 'Admin', NULL, '2018-11-12 12:42:24', '2018-11-12 12:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `config_value` text NOT NULL,
  `manager` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `slug`, `config_value`, `manager`, `field_type`, `created`, `modified`) VALUES
(1, 'Website Name', 'SYSTEM_APPLICATION_NAME', 'Dotsquares', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(2, 'Admin Email', 'ADMIN_EMAIL', 'hanumanprasad.yadav@dotsquares.com', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(3, 'From Email', 'FROM_EMAIL', 'hanumanprasad.yadav@dotsquares.com', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(4, 'Owner Name', 'WEBSITE_OWNER', 'Hanuman Yadav', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(5, 'Telephone', 'TELEPHONE', '+91-7665880635', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(6, 'Admin Page Limit', 'ADMIN_PAGE_LIMIT', '20', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(7, 'Front Page Limit', 'FRONT_PAGE_LIMIT', '20', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(8, 'Admin Date Format', 'ADMIN_DATE_FORMAT', 'd F, Y', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(9, 'Admin Date Time Format', 'ADMIN_DATE_TIME_FORMAT', 'd F, Y H:i A', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(10, 'Front Date Format', 'FRONT_DATE_FORMAT', 'd F, Y', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(11, 'Front Date Time Format', 'FRONT_DATE_TIME_FORMAT', 'd F, Y', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(12, 'Reset URL expired in hours', 'RESET_URL_EXPIRED', '24', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(13, 'Development Mode', 'DEVELOPMENT_MODE', '1', 'general', 'checkbox', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(14, 'Default currency', 'DEFAULT_CURRENCY', 'USD', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(15, 'Contact us text', 'CONTACT_US_TEXT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(16, 'Google Map Api Key', 'GOOGLE_MAP_KEY', 'AIzaSyD9pg6_fzfgDHJFSW0wkrIcuCOw_V9qOfM', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(17, 'Office Address', 'ADDRESS', '6-Kha-9, Jawahar Nagar, <br> Jaipur, Rajasthan - 302004, India', 'general', 'text', '2018-11-14 09:13:06', '2018-11-14 09:13:06'),
(18, 'Main Logo', 'MAIN_LOGO', 'uploads/ds.jpg', 'theme_images', 'text', '2018-11-14 09:13:06', '2018-11-14 09:48:25'),
(19, 'Main Favicon', 'MAIN_FAVICON', 'uploads/dots-.png', 'theme_images', 'text', '2018-11-14 09:13:06', '2018-11-14 09:48:25'),
(20, 'SMTP Allowed', 'SMTP_ALLOW', '1', 'smtp', 'text', '2018-11-14 09:13:06', '2018-11-20 11:53:06'),
(21, 'Email Host Name', 'SMTP_EMAIL_HOST', 'mail.24livehost.com', 'smtp', 'text', '2018-11-14 09:13:06', '2018-11-20 11:53:06'),
(22, 'SMTP Username', 'SMTP_USERNAME', 'wwwsmtp@24livehost.com', 'smtp', 'text', '2018-11-14 09:13:06', '2018-11-20 11:53:06'),
(23, 'SMTP password', 'SMTP_PASSWORD', 'dsmtp909#', 'smtp', 'text', '2018-11-14 09:13:06', '2018-11-20 11:53:06'),
(24, 'SMTP port', 'SMTP_PORT', '25', 'smtp', 'checkbox', '2018-11-14 09:13:06', '2018-11-20 11:53:06'),
(25, 'SMTP Tls', 'SMTP_TLS', '0', 'smtp', 'text', '2018-11-14 09:13:06', '2018-11-20 11:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `setting_manager_phinxlog`
--

CREATE TABLE `setting_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_manager_phinxlog`
--

INSERT INTO `setting_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171220071130, 'CreateSettings', '2018-11-14 03:41:09', '2018-11-14 03:41:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fake_pass` varchar(250) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `photo_dir` varchar(255) DEFAULT NULL,
  `photo_size` int(11) DEFAULT NULL,
  `photo_type` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `login_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `mobile`, `dob`, `email`, `password`, `fake_pass`, `profile_photo`, `photo_dir`, `photo_size`, `photo_type`, `status`, `is_verified`, `login_count`, `created`, `modified`) VALUES
(3, 'Sunil', 'Yadav', '', '2018-09-04', 'deepak.vijayvargiya@dotsquares.com', '', '', '224745154226529679742.png', 'webroot\\img\\uploads\\users\\photos\\11\\', 34656, 'image/png', 1, 0, 0, '2018-11-15 06:46:23', '2018-11-15 07:01:36'),
(5, 'hhh', 'hhh', '', '2018-11-21', 'hhh@gmail.com', '', '', '394455154289363770404.png', 'webroot\\img\\uploads\\users\\photos\\11\\', 13797, 'image/png', 1, 0, 0, '2018-11-22 13:33:57', '2018-11-22 13:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `users_account_types`
--

CREATE TABLE `users_account_types` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `account_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_account_types`
--

INSERT INTO `users_account_types` (`id`, `user_id`, `account_type_id`) VALUES
(3, 3, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_manager_phinxlog`
--

CREATE TABLE `user_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_manager_phinxlog`
--

INSERT INTO `user_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180109130834, 'CreateUsers', '2018-11-14 07:37:12', '2018-11-14 07:37:13', 0),
(20180109130848, 'CreateAccountTypes', '2018-11-14 07:37:13', '2018-11-14 07:37:13', 0),
(20180109130857, 'CreateUsersAccountTypes', '2018-11-14 07:37:13', '2018-11-14 07:37:13', 0),
(20180109131012, 'AddFakePassToUsers', '2018-11-14 07:37:13', '2018-11-14 07:37:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `token_type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_type`, `token_type`, `token`, `status`, `created`, `modified`) VALUES
(1, 14, 'admin_user', 'account_confirmation', 'ceef1ded-1a87-447b-a35e-9fc0119b35d5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 15, 'admin_user', 'account_confirmation', '71f3cd6e-153b-4541-9a7a-91491dc598d5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 16, 'admin_user', 'account_confirmation', '5669734e-39f1-4f57-b60e-3d64cabc1006', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 16, 'admin_user', 'account_confirmation', '746342e7-840b-4a0e-a7cc-9dbb53a925c8', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 16, 'admin_user', 'account_confirmation', 'bcb62af4-187f-47b9-acb8-eccf4b641123', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 16, 'admin_user', 'account_confirmation', 'e546a32c-9da8-466a-8210-0bfbc7ca869b', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, 'users', 'account_confirmation', '9cdcc8a7-a932-4796-b93c-d3a346452b97', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 15, 'admin_user', 'forgot', '349c3307-47f1-4dd0-a2c2-f81b936138fc', 0, '2018-11-23 10:29:03', '2018-11-23 10:29:03'),
(11, 17, 'admin_user', 'account_confirmation', 'da34331c-004d-4ab0-bdb0-cb2989c59f78', 0, '2018-11-23 12:19:19', '2018-11-23 12:19:19'),
(12, 18, 'admin_user', 'account_confirmation', '86ffa95f-fd17-4349-b115-c37a4de323ef', 0, '2018-11-23 14:28:49', '2018-11-23 14:28:49'),
(13, 19, 'admin_user', 'account_confirmation', '364b1af9-b7e5-4a41-b28d-696a97b60089', 0, '2018-11-23 14:29:36', '2018-11-23 14:29:36'),
(14, 20, 'admin_user', 'account_confirmation', '46d8e8d0-1767-4b8c-b73f-ae7f68b0b7ef', 0, '2018-11-23 14:31:11', '2018-11-23 14:31:11'),
(15, 21, 'admin_user', 'account_confirmation', '733cb39e-3503-47a4-8693-cebb86be86e7', 0, '2018-11-23 14:32:56', '2018-11-23 14:32:56'),
(16, 22, 'admin_user', 'account_confirmation', 'fa2df5a6-d4e6-46a0-9c7e-2480ed4da3f4', 0, '2018-11-23 14:34:25', '2018-11-23 14:34:25'),
(17, 23, 'admin_user', 'account_confirmation', 'e41a845c-967e-4d75-85e2-9d3afb87568e', 0, '2018-11-23 15:31:59', '2018-11-23 15:32:00'),
(18, 24, 'admin_user', 'account_confirmation', '8cc8ae9a-0c00-4003-8a88-e716a168673b', 0, '2018-11-23 15:41:41', '2018-11-23 15:41:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL_INDEX` (`email`);

--
-- Indexes for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_ROLE_ID` (`role_id`),
  ADD KEY `BY_ADMIN_USER_ID` (`admin_user_id`);

--
-- Indexes for table `admin_user_manager_phinxlog`
--
ALTER TABLE `admin_user_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction` (`transaction`),
  ADD KEY `type` (`type`),
  ADD KEY `primary_key` (`primary_key`),
  ADD KEY `source` (`source`),
  ADD KEY `parent_source` (`parent_source`),
  ADD KEY `created` (`created`),
  ADD KEY `loged_id` (`loged_id`);

--
-- Indexes for table `audit_stash_phinxlog`
--
ALTER TABLE `audit_stash_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `cms_manager_phinxlog`
--
ALTER TABLE `cms_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_hooks`
--
ALTER TABLE `email_hooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`);

--
-- Indexes for table `email_manager_phinxlog`
--
ALTER TABLE `email_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_preferences`
--
ALTER TABLE `email_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_queue`
--
ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_queue_phinxlog`
--
ALTER TABLE `email_queue_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_EMAIL_HOOK_ID` (`email_hook_id`),
  ADD KEY `BY_EMAIL_PREFERENCE_ID` (`email_preference_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `BY_PARENT_ID` (`parent_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`);

--
-- Indexes for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_phinxlog`
--
ALTER TABLE `queue_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `queue_processes`
--
ALTER TABLE `queue_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `manager` (`manager`);

--
-- Indexes for table `setting_manager_phinxlog`
--
ALTER TABLE `setting_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL_INDEX` (`email`);

--
-- Indexes for table `users_account_types`
--
ALTER TABLE `users_account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_USER_ID` (`user_id`),
  ADD KEY `BY_ACCOUNT_TYPE_ID` (`account_type_id`);

--
-- Indexes for table `user_manager_phinxlog`
--
ALTER TABLE `user_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `email_hooks`
--
ALTER TABLE `email_hooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_preferences`
--
ALTER TABLE `email_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_queue`
--
ALTER TABLE `email_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_processes`
--
ALTER TABLE `queue_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_account_types`
--
ALTER TABLE `users_account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

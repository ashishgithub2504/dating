-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2019 at 12:09 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.21-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeplibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `slug`, `image`, `banner`, `short_description`, `description`, `sort_order`, `lft`, `rght`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created`, `modified`) VALUES
(1, 0, 'Desktops', 'DESKTOPS', '', '', ' Example of category description text', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>\r\n', 2, 1, 6, 'Title: Desktops', 'Keyword: Desktops', 'Description: Desktops', 1, '2018-02-01 06:56:29', '2018-02-01 06:56:29'),
(2, 1, 'PC', 'PC', '', '', 'PC', '<p>PC</p>\r\n', 1, 2, 3, 'PC', 'PC', 'PC', 1, '2018-02-08 06:31:27', '2018-02-08 06:31:27'),
(3, 1, 'Mac', 'MAC', '', '', 'Mac', '<p>Mac</p>\r\n', 2, 4, 5, 'Mac', 'Mac', 'Mac', 1, '2018-02-08 06:32:00', '2018-02-08 06:32:00'),
(4, 0, 'Laptops & Notebooks', 'LAPTOPS-NOTEBOOKS', '', '', 'Laptops & Notebooks', '<p>Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.</p>\r\n', 3, 7, 12, 'Laptops & Notebooks', 'Laptops & Notebooks', 'Laptops & Notebooks', 1, '2018-02-08 06:34:07', '2018-02-08 06:34:07'),
(5, 4, 'Windows', 'WINDOWS', '', '', 'Windows', '<p>Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Mon</p>\r\n', 2, 8, 9, 'Windows', 'Windows', 'Windows', 1, '2018-02-08 06:34:59', '2018-02-08 06:34:59'),
(6, 4, 'HPL', 'hpl', '', '', 'kjkjn hi test', '<p>dsd</p>\r\n', 2, 10, 11, 'dfsddsd', 'sd\\', 's', 1, '2018-02-19 11:46:04', '2018-02-19 11:47:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `BY_PARENT_ID` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

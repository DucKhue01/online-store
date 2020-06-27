-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 08:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `role_pms`
--

CREATE TABLE `role_pms` (
  `id_role` int(11) NOT NULL,
  `id_pms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_pms`
--

INSERT INTO `role_pms` (`id_role`, `id_pms`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_book`
--

CREATE TABLE `tb_book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `uid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_book`
--

INSERT INTO `tb_book` (`id`, `name`, `price`, `uid`, `cat_id`, `type`) VALUES
(1060, 'khue', 1, 23423434, 0, 'daylung'),
(1062, 'khue', 123, 5555, 0, 'vi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cat`
--

CREATE TABLE `tb_cat` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_cat`
--

INSERT INTO `tb_cat` (`id`, `cat_name`) VALUES
(2, 'Sách CNTT'),
(3, 'Tiểu thuyết'),
(1, 'Truyện tranh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `fullname`, `phone`, `email`, `address`) VALUES
(1, 'Dang Thai Son', '0968902116', 'sonmobi@gmail.com', 'Nam Tu Liem'),
(2, 'Nguyễn Thị Hương', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_oder_detail`
--

CREATE TABLE `tb_oder_detail` (
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_oder_detail`
--

INSERT INTO `tb_oder_detail` (`id_order`, `id_book`, `quantity`, `price`) VALUES
(1, 1, 1, 50000),
(1, 2, 5, 25000),
(2, 3, 7, 300000),
(2, 4, 55, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `time_oder` datetime DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `id_customer`, `time_oder`, `status`) VALUES
(1, 1, '2017-11-27 02:47:39', 1),
(2, 2, '2019-11-19 15:10:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pms`
--

CREATE TABLE `tb_pms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_pms`
--

INSERT INTO `tb_pms` (`id`, `name`) VALUES
(1, 'Index.Logout'),
(2, 'User.ListAll'),
(3, 'User.ViewProfile'),
(4, 'Admin.Admin'),
(5, 'Admin.Index'),
(6, 'Admin.Delete'),
(7, 'Admin.AddProd'),
(8, 'Admin.ProdHanding');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `name`) VALUES
(1, 'Quản trị'),
(2, 'Nhân viên'),
(3, 'Thành viên thường');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `passwd`, `email`, `id_role`) VALUES
(1, 'sondt', '123', 'sondt@gmail.com', 1),
(2, 'nhanvien', '123', 'nhanvien@gmail.com', 2),
(3, 'khachhang', '123', 'khachhang@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role_pms`
--
ALTER TABLE `role_pms`
  ADD PRIMARY KEY (`id_role`,`id_pms`),
  ADD KEY `fk_id_pms` (`id_pms`);

--
-- Indexes for table `tb_book`
--
ALTER TABLE `tb_book`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_cat`
--
ALTER TABLE `tb_cat`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `cat_name` (`cat_name`) USING BTREE;

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `phone` (`phone`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `tb_oder_detail`
--
ALTER TABLE `tb_oder_detail`
  ADD PRIMARY KEY (`id_order`,`id_book`) USING BTREE;

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_pms`
--
ALTER TABLE `tb_pms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `fk_id_role_user` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_book`
--
ALTER TABLE `tb_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1065;

--
-- AUTO_INCREMENT for table `tb_cat`
--
ALTER TABLE `tb_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pms`
--
ALTER TABLE `tb_pms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_pms`
--
ALTER TABLE `role_pms`
  ADD CONSTRAINT `fk_id_pms` FOREIGN KEY (`id_pms`) REFERENCES `tb_pms` (`id`),
  ADD CONSTRAINT `fk_id_role` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `fk_id_role_user` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

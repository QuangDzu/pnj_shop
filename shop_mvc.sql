-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3325
-- Thời gian đã tạo: Th10 24, 2021 lúc 05:47 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'quangdzu', 'vunqps18977@gmail.com', 'dzuadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) UNSIGNED NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Tiffany & Co'),
(2, 'Cartier'),
(3, 'BvLgari'),
(4, 'Harry Winston'),
(5, 'Van Cleef & Arpels'),
(6, 'Chopard'),
(7, 'David Yurman'),
(8, 'Buccellati'),
(9, 'Boucheron'),
(10, 'Hermes'),
(11, 'Chanel'),
(12, 'Dior'),
(13, 'Mikimoto'),
(14, 'H. Stern'),
(15, 'Graff');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `img`) VALUES
(19, 19, 'i022adu9kdlc5lqs9v34vrhtb3', 'Lắc chân 1', '20000000', 3, '9d1f45f5fd.c (2).png'),
(20, 22, 'vb1ocjvp99phtldjv4ieulh54e', 'Cài áo 2', '50000000', 1, '8ea0113ff7.b (12).png'),
(21, 19, 'vb1ocjvp99phtldjv4ieulh54e', 'Lắc chân 1', '20000000', 1, '9d1f45f5fd.c (2).png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) UNSIGNED NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Nhẫn'),
(2, 'Lắc tay'),
(3, 'Vòng đeo tay'),
(4, 'Dây chuyền'),
(5, 'Bông tai'),
(6, 'Lắc chân'),
(7, 'Cài áo'),
(8, 'Đồng hồ'),
(9, 'Kẹp cà vẹt'),
(10, 'Trang sức bộ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `commentId` int(11) NOT NULL,
  `commentName` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `blogId` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`commentId`, `commentName`, `comment`, `productId`, `blogId`, `img`) VALUES
(6, 'dzuz', 'đẹp nha', 25, 0, ''),
(7, 'dzuz', 'đẹp nha', 25, 0, ''),
(8, 'dzuz', 'đẹp nha', 25, 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_compare`
--

INSERT INTO `tbl_compare` (`id`, `customer_id`, `productId`, `productName`, `price`, `img`) VALUES
(5, 4, 23, 'Đồng hồ 1', '60000000', '200507280b.d (11).png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(2, 'Dzu', '123/456 HCM CITY', 'TPHCM', 'AF', '500000', '090900888', 'adminnn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'vana', '123/456 HCM CITY', 'TPHCM', 'AF', '7000000', '033338888', 'vana@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Dzux', '123/456 HCM CITY', 'TPHCM', 'AF', '56990000', '0707008888', 'vunqps18977@gmail.com', '5c971edc0c2cc92fc99b5a3609450cb7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_favoriteslist`
--

CREATE TABLE `tbl_favoriteslist` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `img` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `productName`, `customer_id`, `quantity`, `price`, `img`, `status`, `date_order`) VALUES
(5, 25, 'Kẹp cà vẹt 1', 2, 1, '10000000', '54232c8b1f.b (10).png', 0, '2021-10-24 02:28:15'),
(6, 23, 'Đồng hồ 1', 2, 1, '60000000', '200507280b.d (11).png', 0, '2021-10-24 02:28:15'),
(7, 25, 'Kẹp cà vẹt 1', 2, 1, '10000000', '54232c8b1f.b (10).png', 0, '2021-10-24 11:18:25'),
(8, 24, 'Đồng hồ 2', 2, 1, '70000000', 'eff6ba9c79.g (8).png', 0, '2021-10-24 11:18:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) UNSIGNED NOT NULL,
  `brandId` int(11) UNSIGNED NOT NULL,
  `product_desc` text NOT NULL,
  `kieu` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `product_desc`, `kieu`, `price`, `img`) VALUES
(9, 'Nhẫn 1', 1, 1, '<p>Nhẫn 1Nhẫn 1Nhẫn 1Nhẫn 1</p>', 1, '10000000', 'c28a112678.a (1).png'),
(10, 'Nhẫn 2', 1, 2, '<p>Nhẫn 2Nhẫn 2Nhẫn 2Nhẫn 2Nhẫn 2</p>', 0, '20000000', '68d5795cb5.a (2).png'),
(11, 'Lắc tay 1', 2, 3, '<p>Lắc tay 1Lắc tay 1Lắc tay 1</p>', 0, '30000000', '0773d864fb.c (1).png'),
(12, 'Lắc tay 2', 2, 4, '<p>Lắc tay 2Lắc tay 2Lắc tay 2Lắc tay 2</p>', 1, '40000000', 'b1e49dbb99.c (2).png'),
(13, 'Vòng đeo tay 1', 3, 5, '<p>V&ograve;ng đeo tay 1V&ograve;ng đeo tay 1V&ograve;ng đeo tay 1</p>', 0, '50000000', '0bfb181a61.c (3).png'),
(14, 'Vòng đeo tay 2', 3, 6, '<p>V&ograve;ng đeo tay 2V&ograve;ng đeo tay 2V&ograve;ng đeo tay 2</p>', 1, '60000000', '821f59d914.c (5).png'),
(15, 'Dây chuyền 1', 4, 7, '<p>D&acirc;y chuyền 1D&acirc;y chuyền 1D&acirc;y chuyền 1</p>', 1, '70000000', '2565550b7e.d (1).png'),
(16, 'Dây chuyên 2', 4, 8, '<p>D&acirc;y chuy&ecirc;n 2D&acirc;y chuy&ecirc;n 2D&acirc;y chuy&ecirc;n 2</p>', 0, '80000000', '90e2c9a62b.d (15).png'),
(17, 'Bông tai 1', 5, 9, '<p>B&ocirc;ng tai 1B&ocirc;ng tai 1B&ocirc;ng tai 1</p>', 0, '90000000', '0b768e3a31.b (1).png'),
(18, 'Bông tai 2', 5, 10, '<p>B&ocirc;ng tai 2B&ocirc;ng tai 2B&ocirc;ng tai 2</p>', 1, '10000000', '20279b72a8.b (2).png'),
(19, 'Lắc chân 1', 6, 10, '<p>Lắc ch&acirc;n 1Lắc ch&acirc;n 1Lắc ch&acirc;n 1</p>', 0, '20000000', '9d1f45f5fd.c (2).png'),
(20, 'Lắc chân 2', 6, 11, '<p>Lắc ch&acirc;n 2Lắc ch&acirc;n 2Lắc ch&acirc;n 2</p>', 1, '30000000', 'cd95218dd1.c (8).png'),
(21, 'Cài áo 1', 7, 11, '<p>C&agrave;i &aacute;o 1C&agrave;i &aacute;o 1C&agrave;i &aacute;o 1</p>', 1, '40000000', '3fa9bccea2.b (13).png'),
(22, 'Cài áo 2', 7, 12, '<p>C&agrave;i &aacute;o 2C&agrave;i &aacute;o 2C&agrave;i &aacute;o 2</p>', 0, '50000000', '8ea0113ff7.b (12).png'),
(23, 'Đồng hồ 1', 8, 13, '<p>Đồng hồ 1Đồng hồ 1Đồng hồ 1</p>', 0, '60000000', '200507280b.d (11).png'),
(24, 'Đồng hồ 2', 8, 14, '<p>Đồng hồ 2Đồng hồ 2Đồng hồ 2</p>', 1, '70000000', 'eff6ba9c79.g (8).png'),
(25, 'Kẹp cà vẹt 1', 9, 15, '<p>Kẹp c&agrave; vẹt 1Kẹp c&agrave; vẹt 1Kẹp c&agrave; vẹt 1</p>', 0, '10000000', '54232c8b1f.b (10).png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `sliderImage` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `sliderImage`, `type`) VALUES
(2, 'Slider 2', 'c9060a5ea7.banner_1.jpg', 1),
(3, 'Slider 3', '9c3c49747e.banner_2.jpg', 1),
(7, 'Slider 4', '28a38f0211.banner_3.jpg', 1),
(8, 'Slider 5', 'b373121c79.banner_4.jpg', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `commentName` (`commentName`);

--
-- Chỉ mục cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_compare_ibfk_1` (`productId`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_favoriteslist`
--
ALTER TABLE `tbl_favoriteslist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_favoriteslist_ibfk_1` (`customer_id`),
  ADD KEY `tbl_favoriteslist_ibfk_2` (`productId`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_order_ibfk_1` (`customer_id`),
  ADD KEY `tbl_order_ibfk_2` (`productId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `tbl_product_ibfk_1` (`catId`),
  ADD KEY `tbl_product_ibfk_2` (`brandId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_favoriteslist`
--
ALTER TABLE `tbl_favoriteslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD CONSTRAINT `tbl_compare_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_compare_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_favoriteslist`
--
ALTER TABLE `tbl_favoriteslist`
  ADD CONSTRAINT `tbl_favoriteslist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_favoriteslist_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 03:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct271`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cname`, `img`) VALUES
(1, 'Bán chạy', 'bestsaller.png'),
(2, 'Cao cấp - Sang trọng', 'advance.png'),
(3, 'Học tập - Văn phòng', 'office.png'),
(4, 'Đồ họa - Kỹ Thuật', 'ai.png'),
(5, 'Gaming', 'gaming.png');

-- --------------------------------------------------------

--
-- Table structure for table `evaluate`
--

CREATE TABLE `evaluate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluate`
--

INSERT INTO `evaluate` (`id`, `user_id`, `product_id`, `message`) VALUES
(43, 140, 2, 'ok!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `paid` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `address`, `phone`, `paid`, `status`, `date`) VALUES
(122, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-24 04:20:15'),
(123, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 5, '2023-11-25 05:01:08'),
(124, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 4, '2023-11-27 03:09:32'),
(125, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-27 04:15:56'),
(126, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 4, '2023-11-27 04:19:15'),
(127, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-27 04:30:00'),
(128, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-27 13:55:31'),
(129, 140, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-27 13:56:03'),
(130, 152, 'Cần Thơ', '0901089111', 'Tiền mặt', 5, '2023-11-27 13:59:01'),
(131, 152, 'Vĩnh Long', '0123456789', 'Tiền mặt', 1, '2023-11-27 14:12:16'),
(132, 152, 'Cần Thơ', '123456789', 'Tiền mặt', 1, '2023-11-27 15:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `describe` varchar(400) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `describe`, `name`, `price`, `discount`, `image`, `category_id`) VALUES
(1, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 inch | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN)', 16490000, 3, 'img1.jpg', 1),
(2, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'Acer Aspire 7 Gaming A715 76G 5132 i5 12450H', 18990000, 6, 'img2.jpg', 1),
(3, 'Diện mạo mạnh mẽ, bền \\ Với vỏ kim loại | Nặng 1.86 kg. \\ Đáp ứng tốt nhu cầu giải trí, đồ họa. \\ Intel Core i5 11400H | GTX 1650 Max_Q Design. \\ Thế giới ảo sắc nét, tần số quét cao. \\ 15.6 inch | 144 Hz | Full HD | Wled-backit | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows', 'Asus TUF Gaming F15 FX506HF i5 11400H (HN014W)', 21990000, 6, 'img3.jpg', 1),
(4, 'CPU: i51115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'HP Gaming VICTUS 15 fa0155TX i5 12450H (81P00PA)', 18490000, 6, 'img4.jpg', 1),
(5, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'MSI Gaming GF63 Thin 12VE i5 12450H (460VN)', 22990000, 7, 'img5.png', 2),
(6, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'Gigabyte Gaming G5 i5 12500H (GE-51VN263SH)', 19990000, 12, 'img6.jpg', 2),
(7, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.\r\n', 'Acer Nitro 5 Tiger AN515 58 52SP i5 12500', 27990000, 10, 'img7.jpg', 3),
(8, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'Acer Aspire 3 A315 58 54XF i5 1135G7 (NX.AM0SV.007)', 16490000, 8, 'img8.jpg', 4),
(9, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'Dell Inspiron 16 5620 i7 1255U (N6I7110W1)', 25990000, 12, 'img9.jpg', 4),
(10, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'MSI Modern 14 C11M i7 1115G4 (011VN)', 18990000, 4, 'img10.jpg', 5),
(33, 'CPU:  Apple M2100GB/s | RAM:  8 GB \\ Ổ cứng:  256 GB SSD |  Màn hình:  13.6&#34;Liquid Retina (2560 x 1664) \\  Card màn hình:  Card tích hợp8 nhân GPU \\  Cổng kết nối:  2 x Thunderbolt 3Jack tai nghe 3.5 mmMagSafe 3 \\ Đặc biệt:  Có đèn bàn phím \\  Hệ điều hành:  macOS ', 'Apple MacBook Air 13 inch M2 2022 (MLXY3SA/A)', 27090000, 5, 'img11.jpg', 4),
(34, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 inch | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'Laptop MSI Prestige 13 Evo A13M i7/Win11', 50009000, 4, 'img12.jpg', 4),
(37, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'Acer Aspire 7 Gaming A715 76G 5132 i5 12450H', 18990000, 6, 'img2.jpg', 2),
(42, 'CPU:\r\nApple M3 Max300 GB/s memory bandwidth \\ \r\nRAM: 36 GB | Ổ cứng: 1 TB SSD \\ \r\nMàn hình: 14.2&#34;Liquid Retina XDR display (3024 x 1964)120Hz \\ \r\nCard màn hình: Card tích hợp30 nhân GPU \\ \r\nCổng kết nối: HDMIJack tai nghe 3.5 mmMagSafe 33 x Thunderbolt 4 ( hỗ trợ DisplayPort, Thunderbolt 4 (up to 40Gb/s), USB 4 (up to 40Gb/s)) \\ \r\nĐặc biệt: Có đèn bàn phím \\ \r\nHệ điều hành: macOS Sonoma', 'Laptop Apple MacBook Pro 14 inch M3 Max 2023 14-core', 49990000, 2, 'img13.jpg', 2),
(43, 'CPU: i31115G43GHz \\ \r\nRAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ \r\nỔ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ \r\nMàn hình: 15.6&#34;Full HD (1920 x 1080) \\ \r\nCard màn hình: Card tích hợpIntel UHD \\ \r\nCổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ \r\nHệ điều hành: Wi', 'Laptop Lenovo Ideapad 3 15ITL6 i3', 10500000, 0, 'img14.jpg', 3),
(44, 'CPU: i51235U1.3GHz \\ \r\nRAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)2666 MHz \\ \r\nỔ cứng: 256 GB SSD NVMe PCIeHỗ trợ khe cắm HDD SATA 2.5 inch mở rộng (nâng cấp tối đa 2 TB) \\ \r\nMàn hình: 15.6&#34;Full HD (1920 x 1080) 120Hz \\ \r\nCard màn hình: Card tích hợpIntel UHD \\ \r\nCổng kết nối: HDMI1 x USB 2.02 x USB 3.2Jack tai nghe 3.5 mm \\ \r\nHệ điều hành: Windows 11 Home SL + Office Home & Student vĩnh viễn', 'Laptop Dell Inspiron 15 3520 i5/OfficeHS/Win11', 14990000, 0, 'img15.jpg', 3),
(45, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 inch | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'Laptop Acer Aspire 7 Gaming A715 76G 59MW i5/Win11', 17990000, 0, 'img16.jpg', 3),
(49, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win 11', 'Laptop Asus TUF Gaming F15 FX507ZC4 i5', 23990000, 18, 'img17.jpg', 1),
(50, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win11', 'Laptop Acer Aspire 7 Gaming A715 43G R8GA R5 5625U', 21990000, 20, 'img18.jpg', 1),
(51, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'Laptop Asus Vivobook 15 X1504ZA i3', 13990000, 0, 'img19.jpg', 1),
(52, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'HP Aspire 7 Gaming A715 76G 5132 i5 12450H', 26490000, 6, 'img20.jpg', 1),
(53, 'CPU:  Apple M2100GB/s | RAM:  8 GB \\ Ổ cứng:  256 GB SSD |  Màn hình:  13.6&#34;Liquid Retina (2560 x 1664) \\  Card màn hình:  Card tích hợp8 nhân GPU \\  Cổng kết nối:  2 x Thunderbolt 3Jack tai nghe 3.5 mmMagSafe 3 \\ Đặc biệt:  Có đèn bàn phím \\  Hệ điều hành:  macOS ', 'Apple MacBook Air 13 inch M1 2022 (MLXY3SA/A)', 27090000, 5, 'img21.jpg', 4),
(54, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win11', 'Laptop Asus Aspire 7 Gaming A715 43G R8GA R5 5625U', 19990000, 12, 'img22.jpg', 4),
(55, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win11', 'Laptop MSI Aspire 7 Gaming A715 43G R8GA R5 5625U', 17990000, 8, 'img23.jpg', 4),
(56, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win 11', 'Laptop Acer TUF Gaming F15 FX507ZC4 i5', 26990000, 14, 'img24.jpg', 1),
(57, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tao nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'MSI Modern 14 C11M i3 1115G4 (011VN)', 18990000, 4, 'img25.jpg', 5),
(58, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Wi', 'Laptop Lenovo Ideapad 3 15ITL6 i3', 12500000, 2, 'img26.jpg', 3),
(59, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 inch | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm | Hệ điều hành: Windows 11 Home SL.', 'Laptop Acer Aspire 7 Gaming A715 76G 59MW i7/Win11', 18990000, 0, 'img27.jpg', 3),
(60, 'CPU: i31115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tao nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'MSI Gaming GF63 Thin 12VE i7 12450H (460VN)', 24990000, 7, 'img28.jpg', 2),
(61, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 15.6 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tao nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'HP Aspire 7 Gaming A715 76G 5132 i7 12450H', 22490000, 6, 'img29.jpg', 5),
(62, 'CPU: i31115G43GHz \\ RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz \\ Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB (2280) / 512 GB (2242)) \\ Màn hình: 15.6&#34;Full HD (1920 x 1080) \\ Card màn hình: Card tích hợpIntel UHD \\ Cổng kết nối: 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)HDMI1 x USB 2.01 x USB 3.2Jack tai nghe 3.5 mm \\ Hệ điều hành: Win11', 'Laptop Dell Aspire 7 Gaming A715 43G R8GA R5 5625U', 26990000, 10, 'img29.jpg', 1),
(63, 'CPU: i71115G43GHz \\ RAM: 8 GB | DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống) | 3200 MHz \\ Ổ cứng: Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng | 256 GB SSD NVMe PCIe \\ Màn hình: 14 | Full HD (1920 x 1080) \\ Card màn hình: Card tích hợp | Intel UHD \\ Cổng kết nối: HDMI | 2 x USB 2.0 | USB Type-C1 xUSB 3.2 | Jack tai nghe 3.5 mm \\ Hệ điều hành: Windows 11 Home SL.', 'MSI Aspire 3 A315 58 54XF i7 1135G7 (NX.AM0SV.007)', 18490000, 5, 'img30.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `oid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `pdid` int(11) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `quanlity` int(11) DEFAULT NULL,
  `pname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`oid`, `pid`, `pdid`, `price`, `quanlity`, `pname`) VALUES
(122, 140, 3, 21770600, 2, 'Asus TUF Gaming F15 FX506HF i5 11400H (HN014W) -- [16GB - 256GB]'),
(122, 140, 1, 15995300, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [8GB - 256GB]'),
(123, 140, 5, 22480700, 1, 'MSI Gaming GF63 Thin 12VE i5 12450H (460VN) -- [16GB - 256GB]'),
(123, 140, 3, 22370600, 1, 'Asus TUF Gaming F15 FX506HF i5 11400H (HN014W) -- [16GB - 512GB]'),
(124, 140, 1, 17095300, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [16GB - 256GB]'),
(125, 140, 39, 20130000, 1, 'HP Gaming VICTUS 15 fa0155TX i5 12450H (81P00PA) -- [16GB - 512GB]'),
(126, 140, 3, 21770600, 3, 'Asus TUF Gaming F15 FX506HF i5 11400H (HN014W) -- [16GB - 256GB]'),
(126, 140, 8, 15170800, 1, 'Acer Aspire 3 A315 58 54XF i5 1135G7 (NX.AM0SV.007) -- [8GB - 256GB]'),
(126, 140, 1, 17095300, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [16GB - 256GB]'),
(126, 140, 39, 19530000, 2, 'HP Gaming VICTUS 15 fa0155TX i5 12450H (81P00PA) -- [16GB - 256GB]'),
(126, 140, 2, 18950600, 1, 'Acer Aspire 7 Gaming A715 76G 5132 i5 12450H -- [16GB - 256GB]'),
(126, 140, 38, 16620000, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [16GB - 256GB]'),
(126, 140, 38, 16000000, 2, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [8GB - 256GB]'),
(127, 140, 38, 17700000, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [16GB - 512GB]'),
(128, 140, 2, 18950600, 1, 'Acer Aspire 7 Gaming A715 76G 5132 i5 12450H -- [16GB - 256GB]'),
(129, 140, 1, 17095300, 1, 'MSI Gaming GF63 Thin 11SC i5 11400H (664VN) -- [16GB - 256GB]'),
(130, 152, 3, 20670600, 1, 'Asus TUF Gaming F15 FX506HF i5 11400H (HN014W) -- [8GB - 256GB]'),
(131, 152, 2, 17850600, 1, 'Acer Aspire 7 Gaming A715 76G 5132 i5 12450H -- [8GB - 256GB]'),
(132, 152, 42, 48990200, 1, 'Laptop Apple MacBook Pro 14 inch M3 Max 2023 14-core -- [8GB - 256GB]');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_id` int(11) DEFAULT NULL,
  `images` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_id`, `images`) VALUES
(3, 'img3_1.jpg'),
(3, 'img3_2.jpg'),
(3, 'img3_3.jpg'),
(4, 'img4_1.jpg'),
(4, 'img4_2.jpg'),
(4, 'img4_3.jpg'),
(5, 'img5_1.jpg'),
(5, 'img5_2.jpg'),
(5, 'img5_3.jpg'),
(6, 'img6_1.jpg'),
(6, 'img6_2.jpg'),
(6, 'img6_3.jpg'),
(7, 'img7_1.jpg'),
(7, 'img7_2.jpg'),
(7, 'img7_3.jpg'),
(8, 'img8_1.jpg'),
(8, 'img8_2.jpg'),
(8, 'img8_3.jpg'),
(9, 'img9_1.jpg'),
(9, 'img9_2.jpg'),
(9, 'img9_3.jpg'),
(3, 'img3_4.jpg'),
(4, 'img4_4.jpg'),
(5, 'img5_4.jpg'),
(6, 'img6_4.jpg'),
(7, 'img7_4.jpg'),
(8, 'img8_4.jpg'),
(9, 'img9_4.jpg'),
(10, 'img10_1.jpg'),
(10, 'img10_2.jpg'),
(10, 'img10_3.jpg'),
(10, 'img10_4.jpg'),
(33, 'img12.jpg'),
(33, 'img12_1.jpg'),
(33, 'img12_3.jpg'),
(33, 'img12_4.jpg'),
(2, 'img2_1.jpg'),
(2, 'img2_2.jpg'),
(2, 'img2_3.jpg'),
(2, 'img2_4.jpg'),
(1, 'img1.jpg'),
(1, 'img1_2.jpg'),
(1, 'img1_3.jpg'),
(1, 'img1_4.jpg'),
(34, 'img11.jpg'),
(34, 'img11_1.jpg'),
(34, 'img11_2.jpg'),
(34, 'img11_3.jpg'),
(42, 'img13_1.jpg'),
(42, 'img13_2.jpg'),
(42, 'img13_3.jpg'),
(42, 'img13_4.jpg'),
(43, 'img14_1.jpg'),
(43, 'img14_2.jpg'),
(43, 'img14_3.jpg'),
(43, 'img14_4.jpg'),
(44, 'img15_1.jpg'),
(44, 'img15_2.jpg'),
(44, 'img15_3.jpg'),
(44, 'img15_4.jpg'),
(45, 'img16_1.jpg'),
(45, 'img16_2.jpg'),
(45, 'img16_3.jpg'),
(45, 'img16_4.jpg'),
(49, 'img3_1.jpg'),
(49, 'img3_2.jpg'),
(49, 'img3_3.jpg'),
(49, 'img3_4.jpg'),
(50, 'img4_1.jpg'),
(50, 'img4_2.jpg'),
(50, 'img4_3.jpg'),
(50, 'img4_4.jpg'),
(51, 'img14_1.jpg'),
(51, 'img14_2.jpg'),
(51, 'img14_3.jpg'),
(51, 'img14_4.jpg'),
(52, 'img10_1.jpg'),
(52, 'img10_2.jpg'),
(52, 'img10_3.jpg'),
(52, 'img10_4.jpg'),
(37, 'img1.jpg'),
(37, 'img1_2.jpg'),
(37, 'img1_3.jpg'),
(37, 'img1_4.jpg'),
(63, 'img14_1.jpg'),
(63, 'img14_4.jpg'),
(62, 'img4_1.jpg'),
(62, 'img4_2.jpg'),
(62, 'img4_3.jpg'),
(62, 'img4_4.jpg'),
(61, 'img15_1.jpg'),
(61, 'img15_2.jpg'),
(61, 'img15_3.jpg'),
(61, 'img15_4.jpg'),
(60, 'img3_1.jpg'),
(60, 'img3_2.jpg'),
(60, 'img3_3.jpg'),
(60, 'img3_4.jpg'),
(59, 'img4_1.jpg'),
(59, 'img4_2.jpg'),
(59, 'img4_3.jpg'),
(59, 'img4_4.jpg'),
(58, 'img10_1.jpg'),
(58, 'img10_2.jpg'),
(58, 'img10_3.jpg'),
(58, 'img10_4.jpg'),
(57, 'img11.jpg'),
(57, 'img11_1.jpg'),
(57, 'img11_3.jpg'),
(57, 'img11_4.jpg'),
(56, 'img2_1.jpg'),
(56, 'img2_2.jpg'),
(56, 'img2_3.jpg'),
(56, 'img2_4.jpg'),
(55, 'img6_1.jpg'),
(55, 'img6_2.jpg'),
(55, 'img6_3.jpg'),
(55, 'img6_4.jpg'),
(54, 'img7_1.jpg'),
(54, 'img7_2.jpg'),
(54, 'img7_3.jpg'),
(54, 'img7_4.jpg'),
(53, 'img7_1.jpg'),
(53, 'img7_2.jpg'),
(53, 'img7_3.jpg'),
(53, 'img7_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_code`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Chờ lấy hàng'),
(3, 'Đang giao'),
(4, 'Đã giao hàng'),
(5, 'Đã hủy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(1) DEFAULT 0,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `address`, `email`, `password`, `role`, `image`) VALUES
(1, 'Admin', '0123456789', 'Cần Thơ', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'userB.png'),
(140, 'Lê Thị Nhã Chân', '0901089182', 'Cần Thơ', 'chan@gmail.com', 'd508f6883f11eb19c23d7489f9bbc591', 0, 'userE.png'),
(147, 'Nguyễn Văn An', '123456789', 'Cần Thơ', 'admin2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'userD.png'),
(152, 'Nhã Chân', '0122999991', 'Vĩnh Long', 'nhachan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluate`
--
ALTER TABLE `evaluate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluate_ibfk_1` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD KEY `product_detail_ibfk_1` (`oid`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `evaluate`
--
ALTER TABLE `evaluate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluate`
--
ALTER TABLE `evaluate`
  ADD CONSTRAINT `evaluate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

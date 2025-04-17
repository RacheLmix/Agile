-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 17, 2025 lúc 11:06 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `homestaymanagement`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amenities`
--

CREATE TABLE `amenities` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'WiFi miễn phí', 'Kết nối internet không dây tốc độ cao', 'fas fa-wifi', '2025-03-26 11:00:00', '2025-04-16 22:12:16'),
(2, 'Máy lạnh', 'Phòng được trang bị máy điều hòa nhiệt độ', 'fas fa-snowflake', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(3, 'Lễ tân 24h', 'Dịch vụ hỗ trợ khách hàng 24/7', 'fas fa-concierge-bell', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(4, 'Thang máy', 'Tiện ích di chuyển giữa các tầng', 'fas fa-elevator', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(5, 'Bãi đỗ xe', 'Chỗ đỗ xe miễn phí cho khách', 'fas fa-parking', '2025-03-26 11:00:00', '2025-03-26 11:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `homestay_id` int NOT NULL,
  `room_id` int NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int NOT NULL,
  `amenity` text,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `homestay_id`, `room_id`, `check_in`, `check_out`, `guests`, `amenity`, `total_price`, `status`, `created_at`, `updated_at`, `full_name`, `email`) VALUES
(20, 3, 71, 6, '2025-04-16', '2025-04-17', 1, '', 500000.00, 'confirmed', '2025-04-16 01:02:54', '2025-04-16 01:59:01', 'Lê Văn Đạt', 'admin@gmail.com'),
(21, 3, 71, 7, '2025-04-17', '2025-04-24', 1, 'WiFi miễn phí, Máy lạnh, Lễ tân 24h, Thang máy, Bãi đỗ xe', 2100000.00, 'confirmed', '2025-04-16 15:31:07', '2025-04-16 15:31:45', 'Lê Văn Đạt', 'admin@gmail.com'),
(22, 3, 72, 8, '2025-04-17', '2025-05-01', 1, 'WiFi miễn phí, Máy lạnh, Lễ tân 24h, Thang máy, Bãi đỗ xe', 5670000.00, 'pending', '2025-04-16 16:16:09', '2025-04-16 16:16:09', 'Lê Văn Đạt', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `updated_at`) VALUES
(16, 'Homestay biển', 'Homestay gần biển, view đẹp', '2025-04-12 01:23:46'),
(17, 'Homestay núi', 'Homestay trên đồi núi, không khí trong lành', '2025-04-12 01:23:46'),
(18, 'Homestay thành phố', 'Homestay trung tâm thành phố, tiện nghi', '2025-04-12 01:23:46'),
(19, 'Homestay nông thôn', 'Homestay yên bình giữa làng quê', '2025-04-12 01:23:46'),
(20, 'Homestay sang trọng', 'Homestay cao cấp, đầy đủ tiện ích', '2025-04-12 01:23:46'),
(21, 'Homestay gia đình', 'Phù hợp cho gia đình, không gian ấm cúng', '2025-04-12 01:23:46'),
(22, 'Homestay sinh thái', 'Gần gũi với thiên nhiên, thân thiện môi trường', '2025-04-12 01:23:46'),
(23, 'Homestay vintage', 'Phong cách cổ điển, hoài cổ', '2025-04-12 01:23:46'),
(24, 'Homestay hiện đại', 'Thiết kế hiện đại, tiện nghi', '2025-04-12 01:23:46'),
(25, 'Homestay giá rẻ', 'Phù hợp cho khách du lịch tiết kiệm', '2025-04-12 01:23:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homestays`
--

CREATE TABLE `homestays` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Vietnam',
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT '0',
  `status` enum('active','inactive','pending','blocked') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `homestays`
--

INSERT INTO `homestays` (`id`, `category_id`, `name`, `price`, `location`, `address`, `city`, `country`, `description`, `image`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(71, 18, 'Libré Homestay ', 500000.00, 'Đống Đa', '29 Hang Chao Alley, Cát Linh, Quận Đống Đa, Hà Nội, Việt Nam', 'Đà Nẵng', 'Vietnam', 'Homestay gần biển với view đẹp', 'storage/uploads/homestays/1744776193-1743073854-mb.jpeg', 4, 'active', '2025-04-12 01:39:50', '2025-04-15 21:03:13'),
(72, 18, 'Miah Boutique Homestay', 450000.00, 'Hoàn Kiếm', '205 Hang Bong street, Hoan Kiem, Hàng Bông, Quận Hoàn Kiếm, Hà Nội, Việt Nam', 'Hà Nội', 'Vietnam', 'Không khí trong lành, yên tĩnh', 'storage/uploads/homestays/1744777133-1743074126-rl.jpeg', 5, 'active', '2025-04-12 01:39:50', '2025-04-15 21:18:53'),
(73, 18, 'City Haven', 600000.00, 'Quận 1', '78 Lý Tự Trọng', 'TP.HCM', 'Vietnam', 'Trung tâm thành phố, tiện nghi', 'city_haven.jpg', 3, 'pending', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(74, 19, 'Countryside Escape', 250000.00, 'Làng quê Củ Chi', '12 Đường Làng', 'TP.HCM', 'Vietnam', 'Yên bình, gần gũi thiên nhiên', 'countryside.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(75, 20, 'Luxury Villa', 1000000.00, 'Bãi biển Nha Trang', '56 Đường Trần Phú', 'Nha Trang', 'Vietnam', 'Homestay sang trọng, đầy đủ tiện ích', 'luxury_villa.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(76, 21, 'Family Nest', 550000.00, 'Khu phố cổ', '23 Hàng Bông', 'Hà Nội', 'Vietnam', 'Không gian ấm cúng cho gia đình', 'family_nest.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(77, 22, 'Eco Lodge', 350000.00, 'Rừng Cát Tiên', '89 Đường Rừng', 'Đồng Nai', 'Vietnam', 'Thân thiện với môi trường', 'eco_lodge.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(78, 23, 'Vintage Home', 400000.00, 'Phố cổ Hội An', '34 Nguyễn Thị Minh Khai', 'Hội An', 'Vietnam', 'Phong cách cổ điển, hoài cổ', 'vintage_home.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(79, 24, 'Modern Stay', 500000.00, 'Quận 7', '45 Nguyễn Hữu Thọ', 'TP.HCM', 'Vietnam', 'Thiết kế hiện đại, tiện nghi', 'modern_stay.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homestay_amenities`
--

CREATE TABLE `homestay_amenities` (
  `id` int NOT NULL,
  `homestay_id` int DEFAULT NULL,
  `amenity_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `homestay_amenities`
--

INSERT INTO `homestay_amenities` (`id`, `homestay_id`, `amenity_id`) VALUES
(1, 79, 3),
(2, 73, 4),
(3, 71, 1),
(4, 71, 2),
(5, 71, 3),
(6, 71, 4),
(7, 71, 5),
(8, 72, 1),
(9, 72, 2),
(10, 72, 3),
(11, 72, 4),
(12, 72, 5),
(13, 73, 1),
(14, 73, 2),
(15, 73, 3),
(16, 73, 5),
(17, 74, 1),
(18, 74, 2),
(19, 74, 3),
(20, 74, 4),
(21, 74, 5),
(22, 75, 1),
(23, 75, 2),
(24, 75, 3),
(25, 75, 4),
(26, 75, 5),
(27, 76, 1),
(28, 76, 2),
(29, 76, 3),
(30, 76, 4),
(31, 76, 5),
(32, 77, 1),
(33, 77, 2),
(34, 77, 3),
(35, 77, 4),
(36, 77, 5),
(37, 78, 1),
(38, 78, 2),
(39, 78, 3),
(40, 78, 4),
(41, 78, 5),
(42, 79, 1),
(43, 79, 2),
(44, 79, 4),
(45, 79, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `booking_id` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('COD','credit_card','e_wallet','bank_transfer') NOT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `room_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','expired') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`id`, `room_id`, `title`, `description`, `discount_percent`, `start_date`, `end_date`, `created_at`, `updated_at`, `status`) VALUES
(4, 6, 'Khuyến mãi mùa hè', 'Giảm giá cho đặt phòng tháng 6', 20.00, '2025-06-01', '2025-06-30', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(5, 7, 'Ưu đãi đầu năm', 'Giảm giá đặc biệt tháng 1', 15.00, '2025-01-01', '2025-01-31', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'expired'),
(6, 8, 'Khuyến mãi cuối tuần', 'Giảm giá cho cuối tuần', 10.00, '2025-04-15', '2025-04-30', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(7, 9, 'Ưu đãi dài ngày', 'Giảm giá khi ở trên 5 ngày', 25.00, '2025-05-01', '2025-05-31', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(8, 10, 'Khuyến mãi lễ', 'Giảm giá dịp lễ 30/4', 30.00, '2025-04-28', '2025-05-02', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(9, 11, 'Ưu đãi mùa thu', 'Giảm giá tháng 9', 20.00, '2025-09-01', '2025-09-30', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(10, 12, 'Khuyến mãi sinh thái', 'Ưu đãi cho phòng eco', 15.00, '2025-06-01', '2025-06-15', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(11, 13, 'Ưu đãi cổ điển', 'Giảm giá phòng vintage', 10.00, '2025-07-01', '2025-07-31', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(12, 14, 'Khuyến mãi hiện đại', 'Giảm giá phòng hiện đại', 20.00, '2025-08-01', '2025-08-31', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active'),
(13, 15, 'Ưu đãi giá rẻ', 'Giảm giá phòng budget', 25.00, '2025-04-15', '2025-04-30', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `homestay_id` int DEFAULT NULL,
  `score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text
) ;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `homestay_id`, `score`, `created_at`, `updated_at`, `content`) VALUES
(1, 1, 71, 4, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Homestay đẹp, view biển tuyệt vời'),
(2, 2, 72, 5, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Không khí trong lành, rất thư giãn'),
(3, 3, 73, 3, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Vị trí trung tâm nhưng hơi ồn'),
(4, 4, 74, 4, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Yên bình, thích hợp nghỉ dưỡng'),
(5, 5, 75, 5, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Sang trọng, dịch vụ tuyệt vời'),
(6, 6, 76, 4, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Phù hợp cho gia đình, không gian ấm cúng'),
(7, 7, 77, 5, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Thân thiện môi trường, rất thích'),
(8, 8, 78, 4, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Phong cách cổ điển, độc đáo'),
(9, 9, 79, 5, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Hiện đại, tiện nghi đầy đủ');

--
-- Bẫy `ratings`
--
DELIMITER $$
CREATE TRIGGER `update_homestay_rating` AFTER INSERT ON `ratings` FOR EACH ROW BEGIN
  DECLARE avg_rating FLOAT;
  DECLARE count_rating INT;
  
  SELECT AVG(score), COUNT(*) INTO avg_rating, count_rating 
  FROM ratings 
  WHERE homestay_id = NEW.homestay_id;
  
  UPDATE homestays 
  SET rating = avg_rating
  WHERE id = NEW.homestay_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_homestay_rating_after_delete` AFTER DELETE ON `ratings` FOR EACH ROW BEGIN
  DECLARE avg_rating FLOAT;
  DECLARE count_rating INT;
  
  SELECT AVG(score), COUNT(*) INTO avg_rating, count_rating 
  FROM ratings 
  WHERE homestay_id = OLD.homestay_id;
  
  UPDATE homestays 
  SET rating = IF(count_rating = 0, 0, avg_rating)
  WHERE id = OLD.homestay_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_homestay_rating_after_update` AFTER UPDATE ON `ratings` FOR EACH ROW BEGIN
  DECLARE avg_rating FLOAT;
  DECLARE count_rating INT;
  
  SELECT AVG(score), COUNT(*) INTO avg_rating, count_rating 
  FROM ratings 
  WHERE homestay_id = NEW.homestay_id;
  
  UPDATE homestays 
  SET rating = avg_rating
  WHERE id = NEW.homestay_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `homestay_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `capacity` int NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable','maintenance') DEFAULT 'available',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `homestay_id`, `name`, `description`, `price`, `quantity`, `capacity`, `image1`, `image2`, `image3`, `image4`, `status`, `updated_at`) VALUES
(6, 71, 'City View', 'Phòng view thành phố, đầy đủ tiện nghi', 373934.00, 2, 2, 'storage/uploads/rooms/1744776413-dt1.jpeg', 'storage/uploads/rooms/1744776413-dt2.jpeg', 'storage/uploads/rooms/1744776413-dt3.jpeg', 'storage/uploads/rooms/1744776413-dt4.jpeg', 'available', '2025-04-16 04:06:53'),
(7, 71, 'Stadium Low View', 'Phòng cơ bản, tiện nghi', 300000.00, 3, 2, 'storage/uploads/rooms/1744820259-dt2.jpeg', 'storage/uploads/rooms/1744776463-dt4.jpeg', 'storage/uploads/rooms/1744776463-mb1.jpeg', 'storage/uploads/rooms/1744776463-sh2.jpeg', 'unavailable', '2025-04-16 16:17:39'),
(8, 72, 'Phòng Mountain View', 'Phòng nhìn ra núi, thoáng mát', 450000.00, 2, 3, 'storage/uploads/rooms/1744820294-1744776463-sh2.jpeg', 'storage/uploads/rooms/1744820294-mb1.jpeg', 'storage/uploads/rooms/1744820294-1744776463-lm2.jpeg', 'storage/uploads/rooms/1744820294-th4.jpeg', 'unavailable', '2025-04-16 16:18:14'),
(9, 73, 'Phòng City Deluxe', 'Phòng sang trọng trung tâm', 600000.00, 1, 2, 'city_deluxe1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(10, 74, 'Phòng Countryside', 'Phòng yên bình, gần gũi thiên nhiên', 250000.00, 4, 4, 'countryside1.jpg', 'countryside2.jpg', NULL, NULL, 'available', '2025-04-16 01:02:35'),
(11, 75, 'Phòng Luxury Suite', 'Phòng cao cấp, tiện nghi hiện đại', 1000000.00, 1, 4, 'luxury_suite1.jpg', 'luxury_suite2.jpg', 'luxury_suite3.jpg', NULL, 'available', '2025-04-12 01:41:22'),
(12, 76, 'Phòng Family', 'Phòng rộng rãi cho gia đình', 550000.00, 2, 5, 'family_room1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(13, 77, 'Phòng Eco Cabin', 'Phòng thân thiện môi trường', 350000.00, 3, 2, 'eco_cabin1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(14, 78, 'Phòng Vintage', 'Phòng phong cách cổ điển', 400000.00, 2, 2, 'vintage_room1.jpg', 'vintage_room2.jpg', NULL, NULL, 'available', '2025-04-12 01:41:22'),
(15, 79, 'Phòng Modern', 'Phòng thiết kế hiện đại', 500000.00, 2, 2, 'modern_room1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','guest') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `avatar`, `email`, `phone`, `password`, `role`, `created_at`, `status`, `updated_at`) VALUES
(1, 'Nguyễn Văn Bình', 'avatar11.jpg', 'binh.nguyen2@email.com', '0911234561', '$2y$10$newhashedpassword1', 'user', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(2, 'Trần Thị Cúc', 'avatar12.jpg', 'cuc.tran@email.com', '0911234562', '$2y$10$newhashedpassword2', 'user', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(3, 'Lê Văn Đạt', NULL, 'admin@gmail.com', '0911234563', '$2y$10$WnXgX0fY0z1lQeX5a6z8vO5uZ7k9oB2vM3n4t5y6u7i8o9p0q1r2', 'admin', '2025-04-12 01:32:00', 'active', '2025-04-12 05:09:26'),
(4, 'Phạm Thị Hoa', 'avatar14.jpg', 'hoa.pham@email.com', '0911234564', '$2y$10$newhashedpassword4', 'user', '2025-04-12 01:32:00', 'inactive', '2025-04-12 01:32:00'),
(5, 'Hoàng Văn Khang', NULL, 'khang.hoang@email.com', '0911234565', '$2y$10$newhashedpassword5', 'guest', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(6, 'Vũ Thị Lan', 'avatar16.jpg', 'lan.vu@email.com', '0911234566', '$2y$10$newhashedpassword6', 'user', '2025-04-12 01:32:00', 'banned', '2025-04-12 01:32:00'),
(7, 'Đỗ Văn Minh', NULL, 'minh.do@email.com', '0911234567', '$2y$10$newhashedpassword7', 'user', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(8, 'Bùi Thị Ngọc', 'avatar18.jpg', 'ngoc.bui@email.com', '0911234568', '$2y$10$newhashedpassword8', 'admin', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(9, 'Ngô Văn Phong', NULL, 'phong.ngo@email.com', '0911234569', '$2y$10$newhashedpassword9', 'user', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
(10, 'Mai Thị Quyên', 'avatar20.jpg', 'quyen.mai@email.com', '0911234570', '$2y$10$newhashedpassword10', 'user', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_bookings_user_id` (`user_id`),
  ADD KEY `idx_bookings_homestay_id` (`homestay_id`),
  ADD KEY `idx_bookings_room_id` (`room_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `homestays`
--
ALTER TABLE `homestays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_homestays_category_id` (`category_id`);

--
-- Chỉ mục cho bảng `homestay_amenities`
--
ALTER TABLE `homestay_amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_homestay_amenities_homestay_id` (`homestay_id`),
  ADD KEY `idx_homestay_amenities_amenity_id` (`amenity_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_payments_booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_promotions_room_id` (`room_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ratings_user_id` (`user_id`),
  ADD KEY `idx_ratings_homestay_id` (`homestay_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_rooms_homestay_id` (`homestay_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `homestays`
--
ALTER TABLE `homestays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `homestay_amenities`
--
ALTER TABLE `homestay_amenities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookings_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `homestays`
--
ALTER TABLE `homestays`
  ADD CONSTRAINT `fk_homestays_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `homestay_amenities`
--
ALTER TABLE `homestay_amenities`
  ADD CONSTRAINT `fk_homestay_amenities_amenity_id` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_homestay_amenities_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `fk_promotions_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ratings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

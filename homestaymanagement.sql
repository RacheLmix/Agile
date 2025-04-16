-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 15, 2025 lúc 11:51 PM
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
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
-- Cấu trúc bảng cho bảng `amenities`
--

CREATE TABLE `amenities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
(1, 'WiFi miễn phí', 'Kết nối internet không dây tốc độ cao', 'fas fa-wifi', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(2, 'Máy lạnh', 'Phòng được trang bị máy điều hòa nhiệt độ', 'fas fa-snowflake', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(3, 'Lễ tân 24h', 'Dịch vụ hỗ trợ khách hàng 24/7', 'fas fa-concierge-bell', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(4, 'Thang máy', 'Tiện ích di chuyển giữa các tầng', 'fas fa-elevator', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
(5, 'Bãi đỗ xe', 'Chỗ đỗ xe miễn phí cho khách', 'fas fa-parking', '2025-03-26 11:00:00', '2025-03-26 11:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homestays`
--

CREATE TABLE `homestays` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `host_id` int DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_homestays_host_id` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_homestays_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `homestays`
--

INSERT INTO `homestays` (`id`, `host_id`, `category_id`, `name`, `price`, `location`, `address`, `city`, `country`, `description`, `image`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(71, 1, 16, 'Sea Breeze Homestay', 200000.00, 'Bãi biển Mỹ Khê', '123 Đường Biển', 'Đà Nẵng', 'Vietnam', 'Homestay gần biển với view đẹp', 'sea_breeze.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-15 15:47:51'),
(72, 2, 17, 'Mountain Retreat', 450000.00, 'Đồi Ba Vì', '45 Đường Núi', 'Hà Nội', 'Vietnam', 'Không khí trong lành, yên tĩnh', 'mountain_retreat.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(73, 3, 18, 'City Haven', 600000.00, 'Quận 1', '78 Lý Tự Trọng', 'TP.HCM', 'Vietnam', 'Trung tâm thành phố, tiện nghi', 'city_haven.jpg', 3, 'pending', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(74, 4, 19, 'Countryside Escape', 250000.00, 'Làng quê Củ Chi', '12 Đường Làng', 'TP.HCM', 'Vietnam', 'Yên bình, gần gũi thiên nhiên', 'countryside.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(75, 5, 20, 'Luxury Villa', 1000000.00, 'Bãi biển Nha Trang', '56 Đường Trần Phú', 'Nha Trang', 'Vietnam', 'Homestay sang trọng, đầy đủ tiện ích', 'luxury_villa.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(76, 6, 21, 'Family Nest', 550000.00, 'Khu phố cổ', '23 Hàng Bông', 'Hà Nội', 'Vietnam', 'Không gian ấm cúng cho gia đình', 'family_nest.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(77, 7, 22, 'Eco Lodge', 350000.00, 'Rừng Cát Tiên', '89 Đường Rừng', 'Đồng Nai', 'Vietnam', 'Thân thiện với môi trường', 'eco_lodge.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(78, 8, 23, 'Vintage Home', 400000.00, 'Phố cổ Hội An', '34 Nguyễn Thị Minh Khai', 'Hội An', 'Vietnam', 'Phong cách cổ điển, hoài cổ', 'vintage_home.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(79, 9, 24, 'Modern Stay', 500000.00, 'Quận 7', '45 Nguyễn Hữu Thọ', 'TP.HCM', 'Vietnam', 'Thiết kế hiện đại, tiện nghi', 'modern_stay.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55'),
(80, 10, 25, 'Budget Inn', 250000.00, 'Bãi biển Phú Quốc', '67 Đường Trần Hưng Đạo', 'Phú Quốc', 'Vietnam', 'Giá rẻ, phù hợp du lịch tiết kiệm', 'budget_inn.jpg', 3, 'active', '2025-04-12 01:39:50', '2025-04-12 01:41:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_rooms_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `homestay_id`, `name`, `description`, `price`, `quantity`, `capacity`, `image1`, `image2`, `image3`, `image4`, `status`, `updated_at`) VALUES
(6, 71, 'Phòng Sea View', 'Phòng view biển, đầy đủ tiện nghi', 500000.00, 2, 2, 'sea_view1.jpg', 'sea_view2.jpg', NULL, NULL, 'unavailable', '2025-04-11 22:16:47'),
(7, 71, 'Phòng Standard', 'Phòng cơ bản, tiện nghi', 300000.00, 3, 2, 'standard1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(8, 72, 'Phòng Mountain View', 'Phòng nhìn ra núi, thoáng mát', 450000.00, 2, 3, 'mountain_view1.jpg', 'mountain_view2.jpg', NULL, NULL, 'available', '2025-04-12 01:41:22'),
(9, 73, 'Phòng City Deluxe', 'Phòng sang trọng trung tâm', 600000.00, 1, 2, 'city_deluxe1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(10, 74, 'Phòng Countryside', 'Phòng yên bình, gần gũi thiên nhiên', 250000.00, 4, 4, 'countryside1.jpg', 'countryside2.jpg', NULL, NULL, 'available', '2025-04-12 01:41:22'),
(11, 75, 'Phòng Luxury Suite', 'Phòng cao cấp, tiện nghi hiện đại', 1000000.00, 1, 4, 'luxury_suite1.jpg', 'luxury_suite2.jpg', 'luxury_suite3.jpg', NULL, 'available', '2025-04-12 01:41:22'),
(12, 76, 'Phòng Family', 'Phòng rộng rãi cho gia đình', 550000.00, 2, 5, 'family_room1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(13, 77, 'Phòng Eco Cabin', 'Phòng thân thiện môi trường', 350000.00, 3, 2, 'eco_cabin1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22'),
(14, 78, 'Phòng Vintage', 'Phòng phong cách cổ điển', 400000.00, 2, 2, 'vintage_room1.jpg', 'vintage_room2.jpg', NULL, NULL, 'available', '2025-04-12 01:41:22'),
(15, 79, 'Phòng Modern', 'Phòng thiết kế hiện đại', 500000.00, 2, 2, 'modern_room1.jpg', NULL, NULL, NULL, 'available', '2025-04-12 01:41:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
    `full_name` varchar(255),
    `email` varchar(255),
    CONSTRAINT `fk_bookings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_bookings_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_bookings_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `homestay_id`, `room_id`, `check_in`, `check_out`, `guests`, `amenity`, `total_price`, `status`, `created_at`, `updated_at`, `full_name`, `email`) VALUES
(7, 1, 71, 6, '2025-04-12', '2025-04-15', 2, 'WiFi miễn phí', 1000000.00, 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Nguyễn Văn Bình', 'binh.nguyen2@email.com'),
(8, 2, 72, 8, '2025-04-12', '2025-04-14', 3, NULL, 600000.00, 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Trần Thị Cúc', 'cuc.tran@email.com'),
(9, 3, 73, 9, '2025-04-12', '2025-04-16', 2, 'Lễ tân 24h', 900000.00, 'confirmed', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Lê Văn Đạt', 'admin@gmail.com'),
(10, 4, 74, 10, '2025-04-12', '2025-04-15', 4, NULL, 1200000.00, 'cancelled', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Phạm Thị Hoa', 'hoa.pham@email.com'),
(11, 5, 75, 11, '2025-04-12', '2025-04-14', 4, 'Máy lạnh', 500000.00, 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Hoàng Văn Khang', 'khang.hoang@email.com'),
(12, 7, 76, 12, '2025-04-12', '2025-04-15', 5, NULL, 2000000.00, 'confirmed', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Đỗ Văn Minh', 'minh.do@email.com'),
(13, 9, 77, 13, '2025-04-12', '2025-04-14', 2, NULL, 1100000.00, 'confirmed', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Ngô Văn Phong', 'phong.ngo@email.com'),
(14, 1, 78, 14, '2025-04-12', '2025-04-15', 2, NULL, 700000.00, 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Nguyễn Văn Bình', 'binh.nguyen2@email.com'),
(15, 2, 79, 15, '2025-04-12', '2025-04-14', 2, 'Lễ tân 24h', 800000.00, 'confirmed', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Trần Thị Cúc', 'cuc.tran@email.com'),
(16, 3, 80, 10, '2025-04-12', '2025-04-15', 4, NULL, 1000000.00, 'confirmed', '2025-04-12 01:41:42', '2025-04-12 01:41:42', 'Lê Văn Đạt', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homestay_amenities`
--

CREATE TABLE `homestay_amenities` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `homestay_id` int DEFAULT NULL,
  `amenity_id` int DEFAULT NULL,
  CONSTRAINT `fk_homestay_amenities_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_homestay_amenities_amenity_id` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `homestay_amenities`
--

INSERT INTO `homestay_amenities` (`id`, `homestay_id`, `amenity_id`) VALUES
(1, 79, 3),
(2, 73, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `booking_id` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('COD','credit_card','e_wallet','bank_transfer') NOT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_payments_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 1000000.00, 'credit_card', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(2, 8, 600000.00, 'e_wallet', 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(3, 9, 900000.00, 'bank_transfer', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(4, 10, 1200000.00, 'COD', 'failed', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(5, 11, 500000.00, 'credit_card', 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(6, 12, 2000000.00, 'bank_transfer', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(7, 13, 1100000.00, 'e_wallet', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(8, 14, 700000.00, 'credit_card', 'pending', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(9, 15, 800000.00, 'COD', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42'),
(10, 16, 1000000.00, 'bank_transfer', 'paid', '2025-04-12 01:41:42', '2025-04-12 01:41:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `room_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','expired') DEFAULT 'active',
  CONSTRAINT `fk_promotions_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
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
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int DEFAULT NULL,
  `homestay_id` int DEFAULT NULL,
  `score` int NOT NULL CHECK (`score` >= 0 AND `score` <= 5),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text,
  CONSTRAINT `fk_ratings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ratings_homestay_id` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(9, 9, 79, 5, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Hiện đại, tiện nghi đầy đủ'),
(10, 10, 80, 3, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Giá rẻ nhưng cần cải thiện vệ sinh');

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

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `homestays`
--
ALTER TABLE `homestays`
  ADD KEY `idx_homestays_host_id` (`host_id`),
  ADD KEY `idx_homestays_category_id` (`category_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD KEY `idx_rooms_homestay_id` (`homestay_id`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD KEY `idx_bookings_user_id` (`user_id`),
  ADD KEY `idx_bookings_homestay_id` (`homestay_id`),
  ADD KEY `idx_bookings_room_id` (`room_id`);

--
-- Chỉ mục cho bảng `homestay_amenities`
--
ALTER TABLE `homestay_amenities`
  ADD KEY `idx_homestay_amenities_homestay_id` (`homestay_id`),
  ADD KEY `idx_homestay_amenities_amenity_id` (`amenity_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD KEY `idx_payments_booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD KEY `idx_promotions_room_id` (`room_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD KEY `idx_ratings_user_id` (`user_id`),
  ADD KEY `idx_ratings_homestay_id` (`homestay_id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
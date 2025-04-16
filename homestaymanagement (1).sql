-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 12, 2025 lúc 01:37 AM
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
(1, 'WiFi miễn phí', 'Kết nối internet không dây tốc độ cao', 'fas fa-wifi', '2025-03-26 11:00:00', '2025-03-26 11:00:00'),
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
  `user_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `host_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `homestay_id` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `homestay_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','pending','deleted') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(3, 'Lê Văn Đạt', NULL, 'dat.le@email.com', '0911234563', '$2y$10$newhashedpassword3', 'admin', '2025-04-12 01:32:00', 'active', '2025-04-12 01:32:00'),
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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

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
  ADD KEY `host_id` (`host_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_promotion_room` (`room_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `homestay_id` (`homestay_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `homestay_id` (`homestay_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homestay_id` (`homestay_id`);

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
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `homestays`
--
ALTER TABLE `homestays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `homestays`
--
ALTER TABLE `homestays`
  ADD CONSTRAINT `homestays_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `homestays_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `fk_promotion_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`homestay_id`) REFERENCES `homestays` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

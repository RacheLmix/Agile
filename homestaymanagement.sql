-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 20, 2025 lúc 05:42 AM
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

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `check_in`, `check_out`, `guests`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-12-20', '2023-12-25', 2, 1250.00, 'confirmed', '2025-03-16 09:44:31', '2025-03-20 05:37:41'),
(2, 3, 3, '2023-12-15', '2023-12-18', 4, 400.00, 'confirmed', '2025-03-16 09:44:31', '2025-03-20 05:37:41'),
(3, 4, 2, '2023-11-01', '2023-11-05', 2, 800.00, 'pending', '2025-03-16 09:44:31', '2025-03-20 05:37:41'),
(4, 5, 4, '2023-10-10', '2023-10-15', 2, 600.00, 'cancelled', '2025-03-16 09:44:31', '2025-03-20 05:37:41'),
(5, 1, 5, '2023-09-05', '2023-09-10', 2, 750.00, 'confirmed', '2025-03-16 09:44:31', '2025-03-20 05:37:41');

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
(1, 'Luxury', 'High-end luxury homestays for the ultimate comfort', '2025-03-20 05:37:41'),
(2, 'Budget', 'Affordable homestays for budget travelers', '2025-03-20 05:37:41'),
(3, 'Eco', 'Eco-friendly homestays for environmentally conscious guests', '2025-03-20 05:37:41'),
(4, 'Cultural', 'Homestays offering a cultural experience', '2025-03-20 05:37:41'),
(5, 'Adventure', 'Homestays near adventure sports locations', '2025-03-20 05:37:41');

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

--
-- Đang đổ dữ liệu cho bảng `homestays`
--

INSERT INTO `homestays` (`id`, `host_id`, `category_id`, `name`, `location`, `address`, `city`, `country`, `description`, `image`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Seaside Villa', 'Oceanview Boulevard, Miami', NULL, NULL, 'Vietnam', 'A luxurious seaside villa offering stunning ocean views.', NULL, 4.5, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(2, 2, 2, 'Mountain Retreat', 'Highland Road, Denver', NULL, NULL, 'Vietnam', 'A budget-friendly lodge in the heart of the mountains.', NULL, 4, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(3, 3, 3, 'Green Woods', 'Forest Lane, Portland', NULL, NULL, 'Vietnam', 'Eco-friendly cabins in the woods.', NULL, 4.8, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(4, 4, 4, 'Heritage House', 'Old Town, Charleston', NULL, NULL, 'Vietnam', 'Experience the charm of the old city in our cultural homestay.', NULL, 4.3, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(5, 5, 5, 'Adventure Basecamp', 'Valley Road, Boulder', NULL, NULL, 'Vietnam', 'Perfect spot for thrill-seekers looking to explore the rocky mountains.', NULL, 4.7, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(7, NULL, 2, 'Samsung Galaxy S24 Ultra', '5trjr', NULL, NULL, 'Vietnam', 'yfmhk', 'storage/uploads/homestays/1742217360-FB_IMG_1708414060536.jpg', 0, 'active', '2025-03-17 06:16:00', '2025-03-17 13:34:49'),
(8, NULL, 4, 'ryyk', 'fykug', NULL, NULL, 'Vietnam', 'guku', 'storage/uploads/homestays/1742217404-bang_chu_cai_hiragana_e1679480651200_186d4839c2.jpg', 0, 'active', '2025-03-17 06:16:44', '2025-03-17 13:34:49'),
(9, NULL, 1, 'Sora', 'Ha Noi', NULL, NULL, 'Vietnam', 'bdduongdev', 'storage/uploads/homestays/1742217480-FB_IMG_1708414060536.jpg', 0, 'active', '2025-03-17 06:18:00', '2025-03-17 23:05:26');

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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `beds` varchar(100) DEFAULT NULL COMMENT 'e.g. 1 King, 2 Twin',
  `size` int DEFAULT NULL COMMENT 'Room size in square meters',
  `amenities` text,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable','maintenance') DEFAULT 'available',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `homestay_id`, `name`, `description`, `price`, `quantity`, `capacity`, `beds`, `size`, `amenities`, `image`, `status`, `updated_at`) VALUES
(1, 1, 'Ocean Suite', NULL, 250.00, 1, 2, NULL, NULL, 'King bed, Ensuite bathroom, Ocean view', NULL, 'available', '2025-03-20 05:37:41'),
(2, 1, 'Beachfront Room', NULL, 200.00, 1, 2, NULL, NULL, 'Queen bed, Direct beach access', NULL, 'available', '2025-03-20 05:37:41'),
(3, 2, 'Mountain View', NULL, 100.00, 1, 4, NULL, NULL, '2 Double beds, Mountain view', NULL, 'available', '2025-03-20 05:37:41'),
(4, 3, 'Eco Pod', NULL, 120.00, 1, 2, NULL, NULL, 'Sustainable materials, Minimalist design', NULL, 'available', '2025-03-20 05:37:41'),
(5, 4, 'Cultural Corner', NULL, 150.00, 1, 2, NULL, NULL, 'Antique furniture, Cultural books collection', NULL, 'available', '2025-03-20 05:37:41');

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
(1, 'John Doe', NULL, 'john.doe@example.com', '1234567890', 'hashed_password', 'admin', '2025-03-16 09:44:31', 'active', '2025-03-20 05:37:41'),
(2, 'Jane Smith', NULL, 'jane.smith@example.com', '0987654321', 'hashed_password', 'user', '2025-03-16 09:44:31', 'active', '2025-03-20 05:37:41'),
(3, 'Alice Johnson', NULL, 'alice.j@example.com', '1230984567', 'hashed_password', 'user', '2025-03-16 09:44:31', 'active', '2025-03-20 05:37:41'),
(4, 'Bob Brown', NULL, 'bob.brown@example.com', '4567891230', 'hashed_password', 'user', '2025-03-16 09:44:31', 'active', '2025-03-20 05:37:41'),
(5, 'Charlie Davis', NULL, 'charlie.d@example.com', '7890123456', 'hashed_password', 'guest', '2025-03-16 09:44:31', 'active', '2025-03-20 05:37:41');

--
-- Chỉ mục cho các bảng đã đổ
--

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `homestays`
--
ALTER TABLE `homestays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

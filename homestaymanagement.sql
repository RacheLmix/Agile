-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 24, 2025 lúc 06:03 PM
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
(1, 'Phòng đơn', 'High-end luxury homestays for the ultimate comfort', '2025-03-24 17:52:18'),
(2, 'Phòng đôi', 'Affordable homestays for budget travelers', '2025-03-24 17:52:31'),
(3, 'Phòng gia đình', 'Eco-friendly homestays for environmentally conscious guests', '2025-03-24 17:52:53'),
(4, 'Phòng đơn VIP', 'Homestays offering a cultural experience', '2025-03-24 17:53:46'),
(5, 'Phòng đôi VIP', 'Homestays near adventure sports locations', '2025-03-24 17:54:04');

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
(2, 2, 2, 'Libré Homestay Dao Tan', 'Hồ Tây', 'Số 2, Ngõ 118, Đào Tấn, Cống Vị, Quận Ba Đình, Hà Nội, Việt Nam', 'Hà Nội', 'Vietnam', 'Lưu ý: nơi nghỉ trước đây mang tên Libre Homestay Đao Tan Libré Homestay Dao Tan là một nơi nghỉ nằm trong khu vực an ninh, toạ lạc tại Cống Vị. Quầy tiếp tân 24 giờ luôn sẵn sàng phục vụ quý khách từ thủ tục nhận phòng đến trả phòng hay bất kỳ yêu cầu nào. Nếu cần giúp đỡ xin hãy liên hệ đội ngũ tiếp tân, chúng tôi luôn sẵn sàng hỗ trợ quý khách. Sóng WiFi phủ khắp các khu vực chung của nơi nghỉ cho phép quý khách luôn kết nối với gia đình và bè bạn.', 'https://ik.imagekit.io/tvlk/apr-asset/Ixf4aptF5N2Qdfmh4fGGYhTN274kJXuNMkUAzpL5HuD9jzSxIGG5kZNhhHY-p7nw/hotel/asset/10035778-265771da0b14f5d082b7fd93a73a9b79.jpeg?_src=imagekit&tr=dpr-2,c-at_max,f-jpg,fo-auto,h-332,pr-true,q-80,w-480', 4, 'active', '2025-03-16 09:44:31', '2025-03-24 17:58:33'),
(3, 3, 3, 'Green Woods', 'Forest Lane, Portland', NULL, NULL, 'Vietnam', 'Eco-friendly cabins in the woods.', NULL, 4.8, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(4, 4, 4, 'Heritage House', 'Old Town, Charleston', NULL, NULL, 'Vietnam', 'Experience the charm of the old city in our cultural homestay.', NULL, 4.3, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(5, 5, 5, 'Adventure Basecamp', 'Valley Road, Boulder', NULL, NULL, 'Vietnam', 'Perfect spot for thrill-seekers looking to explore the rocky mountains.', NULL, 4.7, 'active', '2025-03-16 09:44:31', '2025-03-17 13:34:49'),
(9, NULL, 1, 'Libré Homestay', 'Hồ Hoàn Kiếm', 'No. 29 Hang Chao Alley, Cát Linh, Quận Đống Đa, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Lưu ý: nơi nghỉ trước đây mang tên Libre HomestayVị tríLibré Homestay là một nơi nghỉ nằm trong khu vực an ninh, toạ lạc tại Cát Linh.Thông tin về Libré HomestayLibré Homestay là đề xuất hàng đầu dành cho những tín đồ du lịch \"bụi\" mong muốn được nghỉ tại một nơi nghỉ vừa thoải mái lại hợp túi tiền.Từ sự kiện doanh nghiệp đến họp mặt công ty, Libré Homestay cung cấp đầy đủ các dịch vụ và tiện nghi đáp ứng mọi nhu cầu của quý khách và đồng nghiệp.Hãy tận hưởng thời gian vui vẻ cùng cả gia đình với hàng loạt tiện nghi giải trí tại Libré Homestay , một nơi nghỉ tuyệt vời phù hợp cho mọi kỳ nghỉ bên người thân.Khách sạn này là lựa chọn hoàn hảo cho các kỳ nghỉ mát lãng mạn hay tuần trăng mật của các cặp đôi. Quý khách hãy tận hưởng những đêm đáng nhớ nhất cùng người thương của mình tại Libré HomestayNếu dự định có một kỳ nghỉ dài, thì Libré Homestay chính là lựa chọn dành cho quý khách. Với đầy đủ tiện nghi với chất lượng dịch vụ tuyệt vời, Libré Homestay sẽ khiến quý khách cảm thấy thoải mái như đang ở nhà vậy.Du lịch một mình cũng không hề kém phần thú vị và Libré Homestay là nơi thích hợp dành riêng cho những ai đề cao sự riêng tư trong kỳ lưu trú.Libré Homestay là lựa chọn thông thái nhất cho những ai đang tìm kiếm một nơi nghỉ với dịch vụ xuất sắc nhưng hợp với túi tiền.Quầy tiếp tân 24 giờ luôn sẵn sàng phục vụ quý khách từ thủ tục nhận phòng đến trả phòng hay bất kỳ yêu cầu nào. Nếu cần giúp đỡ xin hãy liên hệ đội ngũ tiếp tân, chúng tôi luôn sẵn sàng hỗ trợ quý khách.Sóng WiFi phủ khắp các khu vực chung của nơi nghỉ cho phép quý khách luôn kết nối với gia đình và bè bạn.Libré Homestay là nơi nghỉ sở hữu đầy đủ tiện nghi và dịch vụ xuất sắc theo nhận định của hầu hết khách lưu trú.Libré Homestay là lựa chọn sáng suốt dành cho những du khách ghé thăm Cát Linh.', 'storage/uploads/homestays/1742454430-20071837-af7bcdfe65bfc5d3a6567013ac1113af.jpg', 0, 'active', '2025-03-17 06:18:00', '2025-03-20 00:07:10');

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

INSERT INTO `rooms` (`id`, `homestay_id`, `name`, `description`, `price`, `quantity`, `capacity`, `beds`, `size`, `amenities`, `image1`, `image2`, `image3`, `image4`, `status`, `updated_at`) VALUES
(1, 1, 'Ocean Suite', NULL, 250.00, 1, 2, NULL, NULL, 'King bed, Ensuite bathroom, Ocean view', NULL, NULL, NULL, NULL, 'available', '2025-03-20 05:37:41'),
(2, 1, 'Beachfront Room', NULL, 200.00, 1, 2, NULL, NULL, 'Queen bed, Direct beach access', NULL, NULL, NULL, NULL, 'available', '2025-03-20 05:37:41'),
(3, 2, 'Mountain View', NULL, 100.00, 1, 4, NULL, NULL, '2 Double beds, Mountain view', NULL, NULL, NULL, NULL, 'available', '2025-03-20 05:37:41'),
(4, 3, 'Eco Pod', NULL, 120.00, 1, 2, NULL, NULL, 'Sustainable materials, Minimalist design', NULL, NULL, NULL, NULL, 'available', '2025-03-20 05:37:41'),
(5, 4, 'Cultural Corner', NULL, 150.00, 1, 2, NULL, NULL, 'Antique furniture, Cultural books collection', NULL, NULL, NULL, NULL, 'available', '2025-03-20 05:37:41');

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
(1, 'John Doe', NULL, 'admin@gmail.com', '1234567890', '123456', 'admin', '2025-03-16 09:44:31', 'active', '2025-03-22 15:46:13'),
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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 18, 2025 lúc 05:59 AM
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
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'confirmed',
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
(22, 3, 72, 8, '2025-04-17', '2025-05-01', 1, 'WiFi miễn phí, Máy lạnh, Lễ tân 24h, Thang máy, Bãi đỗ xe', 5670000.00, 'confirmed', '2025-04-16 16:16:09', '2025-04-18 05:49:26', 'Lê Văn Đạt', 'admin@gmail.com'),
(24, 3, 74, 10, '2025-04-18', '2025-05-01', 1, 'Bãi đỗ xe, Lễ tân 24h, Máy lạnh, Thang máy, WiFi miễn phí', 10400000.00, 'confirmed', '2025-04-17 12:20:24', '2025-04-17 12:21:07', 'Lê Văn Đạt', 'admin@gmail.com');

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
(71, 18, 'Libre Homestay ', 500000.00, 'Đống Đa', '29 Hang Chao Alley, Cát Linh, Quận Đống Đa, Hà Nội, Việt Nam', 'Đà Nẵng', 'Vietnam', 'Homestay gần biển với view đẹp', 'storage/uploads/homestays/1744776193-1743073854-mb.jpeg', 4, 'active', '2025-04-12 01:39:50', '2025-04-17 04:14:47'),
(72, 18, 'Miah Boutique Homestay', 450000.00, 'Hoàn Kiếm', '205 Hang Bong street, Hoan Kiem, Hàng Bông, Quận Hoàn Kiếm, Hà Nội, Việt Nam', 'Hà Nội', 'Vietnam', 'Không khí trong lành, yên tĩnh', 'storage/uploads/homestays/1744777133-1743074126-rl.jpeg', 5, 'active', '2025-04-12 01:39:50', '2025-04-15 21:18:53'),
(73, 21, 'Lumos Home', 600000.00, 'Đống Đa', '39 Phan Phu Tien, Cat Linh, Dong Da, Cát Linh, Quận Đống Đa, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Lumos Home là một nơi nghỉ nằm trong khu vực an ninh, toạ lạc tại Cát Linh. Quầy tiếp tân 24 giờ luôn sẵn sàng phục vụ quý khách từ thủ tục nhận phòng đến trả phòng hay bất kỳ yêu cầu nào. Nếu cần giúp đỡ xin hãy liên hệ đội ngũ tiếp tân, chúng tôi luôn sẵn sàng hỗ trợ quý khách.', 'storage/uploads/homestays/1744890130-1743074038-lm.jpeg', 3, 'active', '2025-04-12 01:39:50', '2025-04-17 22:10:12'),
(74, 23, 'Sunny Homestay', 250000.00, 'Hoàn Kiếm', '64A Hàng Bồ, Hàng Bồ, Quận Hoàn Kiếm, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Lưu trú tại Sunny Homestay Hanoi là một lựa chọn đúng đắn khi quý khách đến thăm Hàng Bồ. Quầy tiếp tân 24 giờ luôn sẵn sàng phục vụ quý khách từ thủ tục nhận phòng đến trả phòng hay bất kỳ yêu cầu nào. Nếu cần giúp đỡ xin hãy liên hệ đội ngũ tiếp tân, chúng tôi luôn sẵn sàng hỗ trợ quý khách. Sóng WiFi phủ khắp các khu vực chung của nơi nghỉ cho phép quý khách luôn kết nối với gia đình và bè bạn.', 'storage/uploads/homestays/1744890261-1743074195-sh.jpeg', 4, 'active', '2025-04-12 01:39:50', '2025-04-17 04:44:21'),
(75, 20, 'VietHOME - 22 Pho Hue - Apartment 201', 1163000.00, 'Hoàn Kiếm', '22A P. Hue, Hàng Bài, Quận Hoàn Kiếm, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'VietHOME - 22 Pho Hue - Apartment 201 toạ lạc tại khu vực / thành phố Hàng Bài.', 'storage/uploads/homestays/1744890587-1z64g12000fcjmrjr70CD_R_1080_808_R5_Mtrip.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-17 04:49:47'),
(76, 21, 'PER - Vinhomes GreenBay Aparment', 550000.00, 'Nam Từ Liêm', 'G3 Vinhomes Green Bay, Phường Mễ Trì, Nam Từ Liêm, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Lưu trú tại PER - Vinhomes GreenBay Aparment là một lựa chọn đúng đắn khi quý khách đến thăm Phường Mễ Trì.', 'storage/uploads/homestays/1744890795-1z62412000g8xb5a4D551_R_1080_808_R5_Mtrip.jpg', 4, 'active', '2025-04-12 01:39:50', '2025-04-17 04:53:15'),
(77, 22, 'Kofi Kai Apartment', 350000.00, 'Hoàn Kiếm', '11 Hai Bà Trưng, Tràng Tiền, Quận Hoàn Kiếm, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Kofi Kai Apartment is a homestay in a good neighborhood, which is located at Trang Tien Ward.', 'storage/uploads/homestays/1744890998-1mc3s12000j15vvb4F35A_R_1080_808_R5_Mtrip.jpg', 5, 'active', '2025-04-12 01:39:50', '2025-04-17 04:56:38'),
(78, 23, 'Lee Homestay Hanoi', 400000.00, 'Đông Anh', 'Số nhà 42 Ngõ 92  Đường Phương Trạch, Vĩnh Ngọc, Quận Đông Anh, Hà Nội, Việt Nam', 'Hà Nội', 'Việt Nam', 'Phong cách cổ điển, hoài cổ', 'storage/uploads/homestays/1744891151-20085650-7f49ebd404b88f82c09e4f7bda724ef6.jpeg', 4, 'active', '2025-04-12 01:39:50', '2025-04-17 12:09:16'),
(86, 20, 'Tuna Homestay & Experience', 174000.00, 'Tây Hồ', 'Ngõ 445 / 12 Lạc Long Quân, Xuân La, Tây Hồ, Hà Nội, Việt Nam', 'Hà Nội', 'Vietnam', 'Tuna Homestay & Experience toạ lạc tại khu vực / thành phố Xuân La. Quầy tiếp tân 24 giờ luôn sẵn sàng phục vụ quý khách từ thủ tục nhận phòng đến trả phòng hay bất kỳ yêu cầu nào. Nếu cần giúp đỡ xin hãy liên hệ đội ngũ tiếp tân, chúng tôi luôn sẵn sàng hỗ trợ quý khách. Sóng WiFi phủ khắp các khu vực chung của nơi nghỉ cho phép quý khách luôn kết nối với gia đình và bè bạn.', 'storage/uploads/homestays/1744888699-20022211-f755f8e39376ddd4c9248934b85e53f5.jpeg', 0, 'active', '2025-04-17 04:18:19', '2025-04-17 22:07:55');

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
(62, 74, 5),
(63, 74, 3),
(64, 74, 2),
(65, 74, 4),
(66, 74, 1),
(67, 75, 5),
(68, 75, 3),
(69, 75, 2),
(70, 75, 4),
(71, 75, 1),
(72, 76, 5),
(73, 76, 3),
(74, 76, 2),
(75, 76, 4),
(76, 76, 1),
(77, 77, 5),
(78, 77, 3),
(79, 77, 2),
(80, 77, 4),
(81, 77, 1),
(82, 78, 5),
(83, 78, 3),
(84, 78, 2),
(85, 78, 4),
(86, 78, 1),
(90, 86, 5),
(91, 86, 3),
(92, 86, 4),
(93, 73, 5),
(94, 73, 3),
(95, 73, 2),
(96, 73, 4),
(97, 73, 1);

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
(12, 14, 'Khuyến mãi hiện đại', 'Giảm giá phòng hiện đại', 20.00, '2025-08-01', '2025-08-31', '2025-04-12 01:41:48', '2025-04-12 01:41:48', 'active');

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
(8, 8, 78, 4, '2025-04-12 01:41:55', '2025-04-12 01:41:55', 'Phong cách cổ điển, độc đáo');

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
(6, 71, 'City View', 'Phòng view thành phố, đầy đủ tiện nghi', 500000.00, 2, 2, 'storage/uploads/rooms/1744776413-dt1.jpeg', 'storage/uploads/rooms/1744776413-dt2.jpeg', 'storage/uploads/rooms/1744776413-dt3.jpeg', 'storage/uploads/rooms/1744776413-dt4.jpeg', 'available', '2025-04-18 05:08:27'),
(7, 71, 'Stadium Low View', 'Phòng cơ bản, tiện nghi', 500000.00, 3, 2, 'storage/uploads/rooms/1744820259-dt2.jpeg', 'storage/uploads/rooms/1744776463-dt4.jpeg', 'storage/uploads/rooms/1744776463-mb1.jpeg', 'storage/uploads/rooms/1744776463-sh2.jpeg', 'unavailable', '2025-04-18 05:08:39'),
(8, 72, 'Phòng Mountain View', 'Phòng nhìn ra núi, thoáng mát', 450000.00, 2, 3, 'storage/uploads/rooms/1744820294-1744776463-sh2.jpeg', 'storage/uploads/rooms/1744820294-mb1.jpeg', 'storage/uploads/rooms/1744820294-1744776463-lm2.jpeg', 'storage/uploads/rooms/1744820294-th4.jpeg', 'unavailable', '2025-04-16 16:18:14'),
(9, 73, 'Phòng City Deluxe', 'Phòng sang trọng trung tâm', 600000.00, 1, 2, 'storage/uploads/rooms/1744890415-lm1.jpeg', 'storage/uploads/rooms/1744890415-lm2.jpeg', 'storage/uploads/rooms/1744890415-lm3.jpeg', 'storage/uploads/rooms/1744890415-lm4.jpeg', 'available', '2025-04-17 11:46:55'),
(10, 74, 'Deluxe Family', 'Phòng yên bình, gần gũi thiên nhiên', 250000.00, 4, 4, 'storage/uploads/rooms/1744890370-sh1.jpeg', 'storage/uploads/rooms/1744890370-sh2.jpeg', 'storage/uploads/rooms/1744890370-sh3.jpeg', 'storage/uploads/rooms/1744890370-sh4.jpeg', 'unavailable', '2025-04-18 05:09:30'),
(11, 75, 'Superior Double', 'Phòng cao cấp, tiện nghi hiện đại', 1163000.00, 1, 4, 'storage/uploads/rooms/1744890666-1z64212000fcjmytq1ECC_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890666-1z60412000fcjmsp3A2DA_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890666-1z65d12000fcjmh4750F0_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890666-1z62i12000fcjmvljC087_R_1080_808_R5_Mtrip.jpg', 'available', '2025-04-17 11:51:06'),
(12, 76, 'Phòng Family', 'Phòng rộng rãi cho gia đình', 550000.00, 2, 5, 'storage/uploads/rooms/1744890861-1z64h12000g8xcc4vE5CE_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890861-1mc6l12000h1cz08n8299_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890861-1mc1n12000gndwb5320AF_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744890861-1mc0b12000gqbx18e1D9D_R_1080_808_R5_Mtrip.jpg', 'available', '2025-04-17 11:54:21'),
(13, 77, 'Basic Suite', 'Phòng thân thiện môi trường', 350000.00, 3, 2, 'storage/uploads/rooms/1744891051-1z65n12000itp60o54BFB_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744891051-1z65g12000itp0wk4987F_R_1080_808_R5_Mtrip.jpg', 'storage/uploads/rooms/1744891051-1z61t12000itp1htgEBF7_R5_Mtrip.jpg', 'storage/uploads/rooms/1744891051-1mc1812000ehzxszp0D87_R_1080_808_R5_Mtrip.jpg', 'available', '2025-04-17 11:57:31'),
(14, 78, 'Queen With Balcony', 'Phòng phong cách cổ điển', 400000.00, 2, 2, 'storage/uploads/rooms/1744891192-20085650-34d73a3c3bfe6f233e102e312b4af088.jpeg', 'storage/uploads/rooms/1744891192-20085650-1ffa77e2d3729674087c0955729b44fa.jpeg', 'storage/uploads/rooms/1744891192-20085650-2bcaf827f65a70e973fa949f73b1fe60.jpg', 'storage/uploads/rooms/1744891192-20085650-8599568e6f4700767d2d03b9ce4fc846.jpeg', 'available', '2025-04-17 11:59:52'),
(17, 86, 'Mixed Dormitory 6 Beds', 'Thông tin phòng\r\n20.0 m²\r\n1 khách', 174000.00, 1, 1, 'storage/uploads/rooms/1744888799-20022211-6cbb820bd5b59d145722ca147ed8c7d4.jpeg', NULL, 'storage/uploads/rooms/1744888799-20022211-2f46e5cf3949470bc062dbbbf2d9ee0e.jpeg', 'storage/uploads/rooms/1744888799-20022211-6fd46132a1d5c3514a894f8950c2b721.jpeg', 'available', '2025-04-17 11:19:59');

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
(3, 'Lê Văn Đạtt', NULL, 'admin@gmail.com', '0911234463', '$2y$10$WnXgX0fY0z1lQeX5a6z8vO5uZ7k9oB2vM3n4t5y6u7i8o9p0q1r2', 'admin', '2025-04-12 01:32:00', 'active', '2025-04-18 05:46:39'),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `homestays`
--
ALTER TABLE `homestays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `homestay_amenities`
--
ALTER TABLE `homestay_amenities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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

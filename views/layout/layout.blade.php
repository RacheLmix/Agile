<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Homestay - Tìm kiếm và đặt phòng dễ dàng')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0070cc;
            --secondary-color: #ff5e1f;
            --gray-color: #687176;
            --dark-color: #333;
            --light-color: #f8f9fc;
            --border-color: #e3e6f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header Styles */
        .site-header {
            width: 100%;
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Top Header */
        .top-header {
            height: 460px;
            padding: 10px 0;
            color: white;
            position: relative;
        }
        .background img{
            z-index: -1;
            position: absolute;
            right: 0;
            top: 0;
            width: 110%;
            height: 460px;
            background-position: center;
            filter: brightness(80%);
        }

        .top-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-img {
            width: 25%;
            background-color: white;
            border-radius: 30%;
        }

        .top-right {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .language-currency {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .language-currency .divider {
            margin: 0 10px;
            opacity: 0.7;
        }

        .dropdown {
            position: relative;
            cursor: pointer;
            font-weight: 600;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
        }

        .flag-icon {
            width: 16px;
            height: 11px;
            margin-right: 5px;
        }

        .user-links {
            display: flex;
            align-items: center;
        }

        .user-link {
            color: white;
            text-decoration: none;
            padding: 10px 12px;
            font-size: 14px;
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .user-link:hover{
            background-color: #999;
            opacity: 0.5;
            border-radius: 3px;
        }

        .user-link i {
            margin-right: 5px;
        }

        .btn-login, .btn-register {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            margin-left: 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .btn-login {
            color: white;
            border: 1px solid white;
            background-color: transparent;
        }

        .btn-register {
            background-color: #fff;
            color: #0770cd;
        }

        /* Main Navigation */
        .main-nav {
            z-index: 1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 0;
        }

        .nav-links {
            display: flex;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            font-size: 14px; 
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        .nav-link:hover{
            background-color: #999;
            opacity: 0.5;
            border-radius: 3px;
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 16px;
        }

        .nav-link.active {
            color: #0770cd;
            position: relative;
        }

        .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -11px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #0770cd;
        }

        /* Hero Banner */
        .hero-banner {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero-banner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.5));
        }

        .hero-content {
            position: absolute;
            bottom: 12%;
            left: 12%;
            z-index: 1;
            max-width: 800px;
            color: white;
        }

        .hero-content h1 {
            font-size: 32px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        /* Search Box */
        .search-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            margin-top: -50px;
            position: relative;
            z-index: 2;
            margin-bottom: 30px;
        }

        .search-form-header {
            width: 100%;
        }

        .search-form {
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .search-input {
            flex: 1;
        }

        .search-input label {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-with-icon {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            height: 48px;
            background-color: white;
        }

        .input-with-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #0770cd;
        }

        .input-with-icon input {
            width: 100%;
            height: 100%;
            border: none;
            padding: 0 15px 0 35px;
            font-size: 14px;
            background: transparent;
        }

        .input-with-icon input:focus {
            outline: none;
            border-color: #0770cd;
        }

        .search-button {
            background-color: #ff5e1f;
            color: white;
            border: none;
            height: 48px;
            width: 48px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-top: 23px; /* Để căn chỉnh với các input khác */
        }

        .search-button:hover {
            background-color: #e54e19;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .search-form {
                flex-direction: column;
            }
            
            .search-input {
                width: 100%;
                margin-bottom: 15px;
            }
            
            .search-button {
                width: 100%;
                margin-top: 0;
            }
        }

        @media (max-width: 768px) {
            .user-links {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .hero-content h1 {
                font-size: 24px;
            }
            
            .nav-links {
                overflow-x: auto;
                padding-bottom: 5px;
            }
            
            .nav-link {
                white-space: nowrap;
            }
        }

        /* Breadcrumbs */
        .breadcrumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin: 20px 0;
            color: #666;
            font-size: 13px;
        }

        .breadcrumbs a:hover {
            color: var(--primary-color);
        }

        /* Destination Cards */
        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .destination-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .destination-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .destination-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .destination-card .info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
            color: white;
        }

        .destination-card h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .destination-card p {
            font-size: 12px;
            margin: 0;
            opacity: 0.8;
        }

        /* Filters */
        .filters-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filters {
            flex: 0 0 250px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 20px;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
        }

        .filter-options {
            margin-top: 10px;
        }

        .filter-option {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .filter-option input[type="checkbox"] {
            margin-right: 10px;
        }

        .filter-option label {
            cursor: pointer;
            flex: 1;
        }

        .filter-option .count {
            color: #999;
        }

        .price-range {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .price-range input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-reset {
            background-color: white;
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: 4px;
            color: #666;
            cursor: pointer;
        }

        .btn-apply {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Homestay List */
        .homestay-container {
            flex: 1;
        }

        .homestay-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .homestay-count {
            font-weight: 500;
        }

        .sort-dropdown {
            position: relative;
            display: inline-block;
        }

        .sort-dropdown select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
        }

        .homestay-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .homestay-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
        }

        .homestay-image {
            flex: 0 0 250px;
            position: relative;
        }

        .homestay-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .homestay-info {
            flex: 1;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .homestay-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .homestay-location {
            color: #666;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .homestay-amenities {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .amenity {
            background-color: #f5f5f5;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .amenity i {
            margin-right: 5px;
            font-size: 10px;
        }

        .homestay-price {
            margin-top: auto;
            text-align: right;
        }

        .price-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .price-note {
            font-size: 12px;
            color: #999;
        }

        .homestay-rating {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating-score {
            background-color: var(--primary-color);
            color: white;
            padding: 3px 5px;
            border-radius: 4px;
            font-weight: 600;
            margin-right: 8px;
        }

        .rating-label {
            font-weight: 500;
            margin-right: 5px;
        }

        .rating-count {
            color: #999;
            font-size: 12px;
        }

        .btn-view {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-align: center;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-view:hover {
            background-color: #005aa3;
        }

        /* Customer Reviews */
        .customer-reviews {
            margin: 40px 0;
        }

        .review-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .review-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .review-user {
            font-weight: 500;
        }

        .review-date {
            color: #999;
            font-size: 12px;
            margin-top: 2px;
        }

        .review-score {
            margin-left: auto;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .review-score .out-of {
            font-size: 12px;
            color: #999;
            margin-left: 2px;
        }

        .review-content {
            line-height: 1.5;
        }

        .review-footer {
            margin-top: 15px;
            font-size: 12px;
            color: #999;
            text-align: right;
        }

        /* Promotional Section */
        .promo-section {
            background-color: #f9f9f9;
            padding: 30px;
            text-align: center;
            margin: 40px 0;
            border-radius: 8px;
        }

        .promo-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .promo-description {
            margin-bottom: 20px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .promo-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-promo {
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-promo.primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-promo.outline {
            background-color: white;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        /* Footer */
        footer {
            background-color: #fff;
            padding: 40px 0;
            border-top: 1px solid #eee;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-section h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #666;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: #666;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="background">
                <img src="https://ik.imagekit.io/tvlk/image/imageResource/2023/03/07/1678166313016-1942f4720ce7d002b6a8ab9742602eb5.jpeg?tr=h-460,q-75" alt="">
            </div>
            <div class="logo-container">
                <a href="/" class="logo">
                    <img src="../Logo/icon.png" alt="Homestay" class="logo-img">
                </a>
            </div>
            <div class="top-right">
                <div class="language-currency">
                    <div class="dropdown">
                        <span class="dropdown-toggle">
                            <img src="../storage/uploads/flag.png" alt="VN" class="flag-icon">
                            VI
                        </span>
                    </div>
                    <span class="divider">|</span>
                    <div class="dropdown">
                        <span class="dropdown-toggle">
                            VND
                        </span>
                    </div>
                </div>
                <div class="user-links">
                    <a href="#" class="user-link">
                        <i class="fas fa-tag"></i>
                        Khuyến mãi
                    </a>
                    <a href="#" class="user-link">
                        <i class="fas fa-question-circle"></i>
                        Hỗ trợ
                        <i style="margin-left: 5px;" class="fas fa-chevron-down fa-xs"></i>
                    </a>
                    <a href="#" class="user-link">Hợp tác với chúng tôi</a>
                    <a href="#" class="user-link">Đặt chỗ của tôi</a>
                    <a href="/login" class="btn-login"><i class="fa-solid fa-user" style="margin-right: 5px;"></i>Đăng Nhập</a>
                    <a href="/signin" class="btn-register">Đăng ký</a>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <div class="container">
                <div class="nav-links">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-hotel"></i>
                        Khách sạn
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-plane"></i>
                        Vé máy bay
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-bus"></i>
                        Vé xe khách
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-shuttle-van"></i>
                        Đưa đón sân bay
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-car"></i>
                        Cho thuê xe
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-umbrella-beach"></i>
                        Hoạt động & Vui chơi
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Hero Content -->
        <div class="hero-content">
            <h1>Homestay Hà Nội tốt trên MộcHomestay</h1>
            <p>Hãy khám phá những khách sạn tốt nhất tại Hà Nội, để bắt đầu chuyến hành trình kì diệu của bạn</p>
        </div>
    </div>

    <!-- Search Form Section -->
    <div class="container">
        <div class="search-container">
            <div class="search-form-header">
                <div class="search-form">
                    <div class="search-input location">
                        <label>Thành phố, địa điểm hoặc tên khách sạn:</label>
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" placeholder="Hà Nội" value="Hà Nội">
                        </div>
                    </div>
                    <div class="search-input date">
                        <label>Ngày nhận phòng và trả phòng</label>
                        <div class="input-with-icon">
                            <i class="far fa-calendar-alt"></i>
                            <input type="text" placeholder="21 thg 3 - 22 thg 3, 1 đêm" value="21 thg 3 - 22 thg 3, 1 đêm">
                        </div>
                    </div>
                    <div class="search-input guests">
                        <label>Khách và Phòng</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="2 người lớn, 0 Trẻ em, 1 phòng" value="2 người lớn, 0 Trẻ em, 1 phòng">
                        </div>
                    </div>
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Về Homestay</h3>
                <ul class="footer-links">
                    <li><a href="#">Cách đặt chỗ</a></li>
                    <li><a href="#">Liên hệ chúng tôi</a></li>
                    <li><a href="#">Trợ giúp</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                    <li><a href="#">Về chúng tôi</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Theo dõi chúng tôi trên</h3>
                <ul class="footer-links">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">TikTok</a></li>
                    <li><a href="#">Youtube</a></li>
                    <li><a href="#">Telegram</a></li>
                </ul>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-telegram-plane"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Sản phẩm</h3>
                <ul class="footer-links">
                    <li><a href="#">Khách sạn</a></li>
                    <li><a href="#">Vé máy bay</a></li>
                    <li><a href="#">Vé xe khách</a></li>
                    <li><a href="#">Đưa đón sân bay</a></li>
                    <li><a href="#">Cho thuê xe</a></li>
                    <li><a href="#">Hoạt động & Vui chơi</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Khác</h3>
                <ul class="footer-links">
                    <li><a href="#">Homestay Affiliate</a></li>
                    <li><a href="#">Homestay Blog</a></li>
                    <li><a href="#">Chính Sách Quyền Riêng</a></li>
                    <li><a href="#">Điều khoản & Điều kiện</a></li>
                    <li><a href="#">Đăng ký nơi nghỉ của bạn</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Homestay. All rights reserved</p>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle filter groups
        document.querySelectorAll('.filter-title').forEach(item => {
            item.addEventListener('click', event => {
                const content = item.nextElementSibling;
                if (content.style.display === 'none' || !content.style.display) {
                    content.style.display = 'block';
                    item.querySelector('i').classList.replace('fa-chevron-down', 'fa-chevron-up');
                } else {
                    content.style.display = 'none';
                    item.querySelector('i').classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
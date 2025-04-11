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

        /* Container */
        .container {
            max-width: 1300px;
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
        .background img {
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

        .user-link:hover {
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

        .nav-link:hover {
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
            margin-top: 23px;
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

        /* Common Card Styles */
        .panel-section, .info-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        /* CSS cho phần User Menu */
        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .user-menu {
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            transition: background-color 0.2s;
        }

        .user-info:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .user-name {
            font-weight: 500;
            margin-right: 5px;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 200px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 100;
            margin-top: 10px;
            display: none;
            overflow: hidden;
        }

        .user-dropdown.show {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        .dropdown-item i {
            margin-right: 10px;
            font-size: 14px;
            color: #666;
            width: 16px;
            text-align: center;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #eee;
            margin: 5px 0;
        }

        /* CSS cho phần nút đăng nhập/đăng ký */
        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .auth-btn {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: 500;
            margin-left: 10px;
            transition: all 0.2s;
        }

        .login-btn {
            color: white;
            border: 1px solid white;
            background-color: transparent;
        }

        .login-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .register-btn {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid white;
        }

        .register-btn:hover {
            background-color: #f5f5f5;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .container {
                padding: 0 10px;
            }
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
            .top-header .container {
                flex-direction: column;
                align-items: flex-start;
            }
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
            
            .user-name {
                max-width: 80px;
            }
            
            .auth-buttons {
                margin-top: 10px;
            }
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
                    <img src="../../Logo/icon.png" alt="Homestay" class="logo-img">
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
                    <div class="header-right">
                    @if(isset($_SESSION['user']))
                        <!-- Đã đăng nhập: Hiển thị menu người dùng -->
                        <div class="user-menu">
                            <div class="user-info" data-dropdown="userDropdown">
                                @if(isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'])
                                    <img src="{{ $_SESSION['user']['avatar'] }}" alt="Avatar" class="user-avatar">
                                @else
                                    <i class="fas fa-user-circle" style="font-size: 24px; margin-right: 8px; color: white;"></i>
                                @endif
                                <span class="user-name">{{ $_SESSION['user']['full_name'] }}</span>
                                <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 8px;"></i>
                            </div>
                            <div class="user-dropdown" id="userDropdown">
                                <a href="/profile" class="dropdown-item">
                                    <i class="fas fa-user"></i>
                                    <span>Tài khoản của tôi</span>
                                </a>
                                <a href="/bookings" class="dropdown-item">
                                    <i class="fas fa-list"></i>
                                    <span>Đặt chỗ của tôi</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Chưa đăng nhập: Hiển thị nút đăng nhập/đăng ký -->
                        <div class="auth-buttons">
                            <a href="/login" class="auth-btn login-btn">
                                <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>
                                <span>Đăng nhập</span>
                            </a>
                            <a href="/signin" class="auth-btn register-btn">
                                <i class="fas fa-user-plus" style="margin-right: 5px;"></i>
                                <span>Đăng ký</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
            <p>Hãy khám phá những khách sạn tốt nhất tại Hà Nội, để bắt đầu chuyến hành trình kỳ diệu của bạn</p>
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

        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý dropdown khi click
            document.querySelectorAll('[data-dropdown]').forEach(toggleBtn => {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdownId = this.getAttribute('data-dropdown');
                    const dropdown = document.getElementById(dropdownId);
                    dropdown.classList.toggle('show');
                });
            });
            
            // Đóng dropdown khi click bên ngoài
            document.addEventListener('click', function(e) {
                const dropdowns = document.querySelectorAll('.user-dropdown');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(e.target) && !e.target.hasAttribute('data-dropdown')) {
                        dropdown.classList.remove('show');
                    }
                });
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const dropdowns = document.querySelectorAll('.user-dropdown');
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

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
            height: 130px;
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
            background-position: center;
            filter: brightness(80%);
        }

        .top-header .container {
            display: flex;
            justify-content: space-between;
        }

        .logo-img {
            width: 20%;
            background-color: white;
            border-radius: 30%;
        }

        .top-right {
            display: flex;
            align-items: center;
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

        /* User Menu */
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

        /* Auth Buttons */
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

        /* Responsive Adjustments for Header */
        @media (max-width: 768px) {
            .top-header .container {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-links {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .user-name {
                max-width: 80px;
            }
            .auth-buttons {
                margin-top: 10px;
            }
        }

        /* Main Container */
        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            min-height: calc(100vh - 170px); /* Adjust for header and margin */
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: #fafafa;
            padding: 30px 20px;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header i {
            color: #f59e0b;
            font-size: 24px;
        }

        .sidebar-header h1 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .sidebar .user-name {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-email {
            font-size: 13px;
            color: #6b7280;
            word-break: break-all;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-nav a.active {
            background-color: #e3f2fd;
            color: #2563eb;
            font-weight: 600;
        }

        .sidebar-nav a:hover {
            background-color: #f1f5f9;
        }

        .sidebar-nav i {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 40px;
            background-color: #ffffff;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .profile-card h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            color: #1f2937;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-group input[readonly],
        .form-group textarea[readonly] {
            background-color: #e5e7eb;
            cursor: not-allowed;
        }

        .form-group .input-icon {
            position: relative;
        }

        .form-group .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 16px;
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .button-container {
            margin-top: 30px;
            text-align: center;
        }

        .save-button {
            background-color: #2563eb;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .save-button:hover {
            background-color: #1d4ed8;
        }

        /* Responsive Adjustments for Main Content */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                margin: 15px;
                min-height: auto;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }

            .content {
                padding: 30px;
            }

            .profile-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 20px;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-card h2 {
                font-size: 20px;
            }

            .form-group input,
            .form-group textarea {
                padding: 10px;
                font-size: 14px;
            }

            .save-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>

    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="background">
                <img src="https://ik.imagekit.io/tvlk/image/imageResource/2019/10/10/1570674738648-1337bd802b0a2aa503a105ec976bd3f3.jpeg?tr=h-460,q-75" alt="">
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
                        @if(isset($user))
                            <div class="user-menu">
                                <div class="user-info" data-dropdown="userDropdown">
                                    @if(isset($user['avatar']) && $user['avatar'])
                                        <img src="/storage/uploads/avatar/{{ $user['avatar'] }}" alt="Avatar" class="user-avatar">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size: 24px; margin-right: 8px; color: white;"></i>
                                    @endif
                                    <span class="user-name">{{ $user['full_name'] }}</span>
                                    <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 8px;"></i>
                                </div>
                                <div class="user-dropdown" id="userDropdown">
                                    <a href="/profile" class="dropdown-item">
                                        <i class="fas fa-user"></i>
                                        <span>Tài khoản của tôi</span>
                                    </a>
                                    <a href="/orderview" class="dropdown-item">
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

    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-home"></i>
                <h1>Homestay Management</h1>
            </div>
            <div class="user-info">
                <span class="user-name">{{ $user['full_name'] }}</span>
                <span class="user-email">{{ $user['email'] }}</span>
            </div>
            <div class="sidebar-nav">
                <a href="/profile" class="active">
                    <i class="fas fa-user"></i>
                    <span>Thông tin cá nhân</span>
                </a>
                <a href="/orderview">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Đơn hàng của tôi</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggle
            document.querySelectorAll('[data-dropdown]').forEach(toggleBtn => {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdownId = this.getAttribute('data-dropdown');
                    const dropdown = document.getElementById(dropdownId);
                    dropdown.classList.toggle('show');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const dropdowns = document.querySelectorAll('.user-dropdown');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(e.target) && !e.target.hasAttribute('data-dropdown')) {
                        dropdown.classList.remove('show');
                    }
                });
            });

            // Close dropdown on Escape key
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
</body>
</html>
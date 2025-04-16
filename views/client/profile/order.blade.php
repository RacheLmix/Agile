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
            max-width: 800px;
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

        .booking-item {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.2s;
        }

        .booking-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .booking-item:last-child {
            margin-bottom: 0;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .booking-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }

        .status-confirmed {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-completed {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .toggle-link {
            display: flex;
            align-items: center;
            color: #2563eb;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
            transition: color 0.2s;
        }

        .toggle-link:hover {
            color: #1d4ed8;
        }

        .toggle-link i {
            margin-right: 8px;
            font-size: 14px;
            transition: transform 0.2s;
        }

        .toggle-link i.rotate-180 {
            transform: rotate(180deg);
        }

        .booking-details {
            display: none;
            margin-top: 20px;
        }

        .booking-details.active {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .booking-details p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .booking-details p span {
            color: #1f2937;
            font-weight: 500;
        }

        .booking-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .total-price {
            font-size: 16px;
            font-weight: 600;
            color: #2563eb;
        }

        .button-container {
            display: flex;
            gap: 12px;
        }

        .action-button {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
            cursor: pointer;
            border: none;
        }

        .cancel-button {
            background-color: #dc2626;
            color: #ffffff;
        }

        .cancel-button:hover {
            background-color: #b91c1c;
        }

        .checkin-button {
            background-color: #2563eb;
            color: #ffffff;
        }

        .checkin-button:hover {
            background-color: #1d4ed8;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .empty-state p {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .explore-button {
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

        .explore-button:hover {
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

            .booking-item {
                padding: 15px;
            }

            .booking-header h3 {
                font-size: 16px;
            }

            .status-badge {
                font-size: 12px;
                padding: 5px 10px;
            }

            .booking-details.active {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .action-button {
                padding: 8px 15px;
                font-size: 13px;
            }

            .explore-button {
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
                        @if(isset($_SESSION['user']))
                            <div class="user-menu">
                                <div class="user-info" data-dropdown="userDropdown">
                                    @if(isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'])
                                        <img src="/storage/uploads/avatar/{{ $_SESSION['user']['avatar'] }}" alt="Avatar" class="user-avatar">
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
                <span class="user-name">{{ $_SESSION['user']['full_name'] ?? 'Khách hàng' }}</span>
                <span class="user-email">{{ $_SESSION['user']['email'] ?? 'Không có thông tin' }}</span>
            </div>
            <div class="sidebar-nav">
                <a href="/profile">
                    <i class="fas fa-user"></i>
                    <span>Thông tin cá nhân</span>
                </a>
                <a href="/orderview" class="active">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Đơn hàng của tôi</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="profile-card">
                <h2>Lịch sử đặt phòng</h2>
                
                @if(empty($bookings))
                    <div class="empty-state">
                        <p>Bạn chưa có đơn đặt phòng nào.</p>
                        <a href="/" class="explore-button">Khám phá các homestay</a>
                    </div>
                @else
                    @foreach($bookings as $booking)
                        <div class="booking-item">
                            <div class="booking-header">
                                <h3>Đơn đặt phòng #{{ $booking['id'] }}</h3>
                                <span class="status-badge 
                                    @if($booking['status'] == 'pending') status-pending
                                    @elseif($booking['status'] == 'confirmed') status-confirmed
                                    @elseif($booking['status'] == 'cancelled') status-cancelled
                                    @elseif($booking['status'] == 'completed') status-completed
                                    @endif">
                                    @if($booking['status'] == 'pending')
                                        Đang chờ xác nhận
                                    @elseif($booking['status'] == 'confirmed')
                                        Đã xác nhận
                                    @elseif($booking['status'] == 'cancelled')
                                        Đã hủy
                                    @elseif($booking['status'] == 'completed')
                                        Hoàn thành
                                    @else
                                        {{ $booking['status'] }}
                                    @endif
                                </span>
                            </div>

                            <div class="toggle-link" onclick="toggleBookingDetails({{ $booking['id'] }})">
                                <i class="fas fa-chevron-down" id="toggle-icon-{{ $booking['id'] }}"></i>
                                <span id="toggle-text-{{ $booking['id'] }}">Xem chi tiết đơn đặt phòng</span>
                            </div>
                            <div class="booking-details" id="booking-details-{{ $booking['id'] }}">
                                <div>
                                    <p>Người đặt: <span>{{ $_SESSION['user']['full_name'] ?? 'Không có thông tin' }}</span></p>
                                </div>
                                <div>
                                    <p>Email: <span>{{ $_SESSION['user']['email'] ?? 'Không có thông tin' }}</span></p>
                                </div>
                                <div>
                                    <p>Homestay: <span>{{ $booking['homestay_name'] }}</span></p>
                                </div>
                                <div>
                                    <p>Phòng: <span>{{ $booking['room_name'] }}</span></p>
                                </div>
                                <div>
                                    <p>Ngày nhận phòng: <span>{{ date('d/m/Y', strtotime($booking['check_in'])) }}</span></p>
                                </div>
                                <div>
                                    <p>Ngày trả phòng: <span>{{ date('d/m/Y', strtotime($booking['check_out'])) }}</span></p>
                                </div>
                                <div>
                                    <p>Số đêm: <span>{{ $booking['nights'] }}</span></p>
                                </div>
                                <div>
                                    <p>Số khách: <span>{{ $booking['guests'] }}</span></p>
                                </div>
                                <div>
                                    <p>Ngày đặt: <span>{{ date('d/m/Y H:i', strtotime($booking['created_at'])) }}</span></p>
                                </div>
                            </div>

                            <div class="booking-footer">
                                <p class="total-price">Tổng tiền: {{ number_format($booking['total_price'], 0, ',', '.') }} VND</p>
                                <div class="button-container">
                                    @if($booking['status'] == 'pending')
                                        <button class="action-button cancel-button" onclick="cancelBooking({{ $booking['id'] }})">Hủy đặt phòng</button>
                                    @endif
                                    <button class="action-button checkin-button" onclick="checkIn({{ $booking['id'] }})">Đã đến checkin</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function cancelBooking(bookingId) {
            if (confirm('Bạn có chắc chắn muốn hủy đặt phòng này không?')) {
                window.location.href = '/cancel/' + bookingId;
            }
        }

        function toggleBookingDetails(bookingId) {
            const detailsElement = document.getElementById('booking-details-' + bookingId);
            const toggleElement = document.getElementById('toggle-icon-' + bookingId);
            const toggleText = document.getElementById('toggle-text-' + bookingId);
            if (detailsElement.classList.contains('active')) {
                detailsElement.classList.remove('active');
                toggleElement.classList.remove('rotate-180');
                toggleText.textContent = 'Xem chi tiết đơn đặt phòng';
            } else {
                detailsElement.classList.add('active');
                toggleElement.classList.add('rotate-180');
                toggleText.textContent = 'Ẩn chi tiết đơn đặt phòng';
            }
        }

        function checkIn(bookingId) {
            if (confirm('Xác nhận bạn đã đến và checkin?')) {
                window.location.href = '/checkin/' + bookingId;
            }
        }

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
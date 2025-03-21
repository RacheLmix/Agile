<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --sidebar-width: 280px;
        --sidebar-collapsed-width: 80px;
        --primary-color: #4e73df;
        --primary-gradient: linear-gradient(135deg, #6e8efb, #4a6cf7);
        --hover-color: rgba(255, 255, 255, 0.15);
        --text-color: #f8f9fc;
        --transition-speed: 0.3s;
    }

    body {
        background-color: #f8f9fc;
    }

    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background: var(--primary-gradient);
        color: var(--text-color);
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 15px;
        transition: all var(--transition-speed) ease;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        z-index: 1000;
        overflow-x: hidden;
    }

    /* Header Sidebar */
    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 10px;
    }

    .logo {
        font-size: 24px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: 0.5px;
    }

    .logo i {
        font-size: 28px;
    }

    /* Nút Toggle */
    .toggle-btn {
        background: none;
        border: none;
        color: var(--text-color);
        font-size: 20px;
        cursor: pointer;
        transition: var(--transition-speed);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-btn:hover {
        background: var(--hover-color);
        transform: rotate(180deg);
    }

    /* Menu */
    .menu {
        list-style-type: none;
        padding: 10px 0;
    }

    .menu li {
        padding: 5px 20px;
        margin-bottom: 5px;
    }

    .menu li a {
        text-decoration: none;
        color: var(--text-color);
        display: flex;
        align-items: center;
        font-size: 16px;
        transition: all var(--transition-speed) ease;
        border-radius: 10px;
        padding: 12px 15px;
        white-space: nowrap;
        font-weight: 500;
        position: relative;
        overflow: hidden;
    }

    .menu li a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        transition: width var(--transition-speed) ease;
    }

    .menu li a:hover::before {
        width: 100%;
    }

    .menu li a i {
        width: 35px;
        text-align: center;
        font-size: 18px;
        transition: transform var(--transition-speed) ease;
        margin-right: 10px;
    }
    
    .menu li a span {
        transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        opacity: 1;
        transform: translateX(0);
    }

    .menu li a:hover {
        color: #ffffff;
    }

    .menu li a:hover i {
        transform: translateX(5px);
    }

    /* Active menu item */
    .menu li.active a {
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Divider */
    .menu-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 15px 20px;
    }

    /* Khi sidebar thu nhỏ */
    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar.collapsed .menu li a i {
        margin-right: 0;
        font-size: 22px;
    }

    .sidebar.collapsed .menu li a span {
        opacity: 0;
        transform: translateX(-10px);
        width: 0;
        overflow: hidden;
    }

    .sidebar.collapsed .logo span {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    /* Tooltip for collapsed sidebar */
    .sidebar.collapsed .menu li a:hover::after {
        content: attr(data-title);
        position: absolute;
        left: 70px;
        top: 50%;
        transform: translateY(-50%);
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        white-space: nowrap;
        z-index: 1000;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    /* Nội dung chính */
    .content {
        margin-left: var(--sidebar-width);
        padding: 40px;
        transition: margin-left var(--transition-speed) ease;
        background-color: #f8f9fc;
        min-height: 100vh;
    }

    .sidebar.collapsed + .content {
        margin-left: var(--sidebar-collapsed-width);
    }

    /* Responsive */
    @media (max-width: 768px) {
        :root {
            --sidebar-width: var(--sidebar-collapsed-width);
        }
        
        .sidebar .menu li a span {
            display: none;
        }
        
        .content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .logo span {
            display: none;
        }
    }
    /* ============================= */
    /* ====== HEADER QUẢN TRỊ ====== */
    /* ============================= */
    .admin-header {
        position: fixed;
        top: 0;
        left: var(--sidebar-width); /* Khi sidebar mở rộng */
        width: calc(100% - var(--sidebar-width));
        height: 70px;
        background: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 25px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: left var(--transition-speed) ease, width var(--transition-speed) ease;
        z-index: 900;
    }

    /* Khi sidebar thu nhỏ */
    .sidebar.collapsed + .admin-header {
        left: var(--sidebar-collapsed-width); /* Điều chỉnh header khi sidebar thu nhỏ */
        width: calc(100% - var(--sidebar-collapsed-width));
    }


    /* Tiêu đề bên trái */
    .header-left h1 {
        font-size: 22px;
        color: #333;
        font-weight: 600;
    }

    /* Phần bên phải */
    .header-right {
        display: flex;
        align-items: center;
    }

    /* Ô tìm kiếm */
    .search-box {
        position: relative;
        margin-right: 20px;
    }

    .search-box input {
        padding: 10px 15px;
        border: 1px solid #e3e6f0;
        border-radius: 30px;
        outline: none;
        font-size: 14px;
        width: 250px;
        transition: all 0.3s;
        background-color: #f8f9fc;
    }

    .search-box input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .search-box button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        cursor: pointer;
        color: #555;
        font-size: 16px;
    }

    /* Icon thông báo */
    .notifications {
        position: relative;
        margin-right: 25px;
        cursor: pointer;
        font-size: 18px;
        color: #555;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background 0.3s;
    }

    .notifications:hover {
        background-color: #f8f9fc;
    }

    .notifications .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #e74a3b;
        color: white;
        font-size: 12px;
        padding: 4px 7px;
        border-radius: 50%;
        font-weight: 600;
    }

    /* Hồ sơ người dùng */
    .profile {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 30px;
        transition: background 0.3s;
    }

    .profile:hover {
        background-color: #f8f9fc;
    }

    .profile img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin-right: 10px;
        border: 2px solid #e3e6f0;
        object-fit: cover;
    }

    .profile span {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-header {
            left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
            padding: 0 15px;
        }

        .search-box input {
            width: 180px;
        }
        
        .header-left h1 {
            font-size: 18px;
        }
    }
</style>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="logo"><i class="fas fa-home"></i> <span>Homestay</span></h2>
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <ul class="menu">
            <li class="active"><a href="/admin" data-title="Trang chủ"><i class="fas fa-home"></i> <span>Trang chủ</span></a></li>
            <li><a href="/admin/homestays" data-title="Homestay"><i class="fas fa-building"></i> <span>Homestay</span></a></li>
            <li><a href="/admin/bookings" data-title="Đặt phòng"><i class="fas fa-calendar-check"></i> <span>Đặt phòng</span></a></li>
            
            <div class="menu-divider"></div>
            
            <li><a href="#" data-title="Đánh giá"><i class="fas fa-star"></i> <span>Đánh giá</span></a></li>
            <li><a href="/admin/users" data-title="Tài khoản"><i class="fas fa-user"></i> <span>Tài khoản</span></a></li>
            <li><a href="#" data-title="Đăng xuất"><i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span></a></li>
        </ul>
    </div>
    <main>
        <!-- Header -->
        <header class="admin-header">
            <div class="header-left">
                <h1>Quản trị Homestay</h1>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="notifications">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <div class="profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <footer>

        </footer>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.querySelector(".sidebar");
            const header = document.querySelector(".admin-header");
            const toggleBtn = document.getElementById("toggleSidebar");
            const toggleIcon = toggleBtn.querySelector("i");
            
            // Lưu trạng thái sidebar vào localStorage
            const savedState = localStorage.getItem('sidebarState');
            if (savedState === 'collapsed') {
                sidebar.classList.add('collapsed');
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
                updateHeaderPosition();
            }
            
            toggleBtn.addEventListener("click", function () {
                sidebar.classList.toggle("collapsed");
                
                // Thay đổi icon khi toggle
                if (sidebar.classList.contains("collapsed")) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                    localStorage.setItem('sidebarState', 'collapsed');
                } else {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                    localStorage.setItem('sidebarState', 'expanded');
                }
                
                updateHeaderPosition();
            });
            
            // Hàm cập nhật vị trí header
            function updateHeaderPosition() {
                if (sidebar.classList.contains("collapsed")) {
                    header.style.left = "var(--sidebar-collapsed-width)";
                    header.style.width = "calc(100% - var(--sidebar-collapsed-width))";
                } else {
                    header.style.left = "var(--sidebar-width)";
                    header.style.width = "calc(100% - var(--sidebar-width))";
                }
            }
            
            // Cập nhật header khi trang được tải
            updateHeaderPosition();
            
            // Thêm class active khi click vào menu item
            const menuItems = document.querySelectorAll('.menu li');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
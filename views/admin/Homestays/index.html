<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        height: 100vh;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 20px;
        transition: width 0.4s ease-in-out;
        box-shadow: 5px 0 10px rgba(0, 0, 0, 0.2);
    }

    /* Header Sidebar */
    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
    }

    /* Nút Toggle */
    .toggle-btn {
        background: none;
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
        transition: 0.3s;
    }

    .toggle-btn:hover {
        color: #ffcc00;
    }

    /* Menu */
    .menu {
        list-style-type: none;
        padding: 10px 0;
    }

    .menu li {
        padding: 12px 20px;
    }

    .menu li a {
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        font-size: 18px;
        transition: 0.3s;
        border-radius: 5px;
        padding: 10px;
    }

    .menu li a i {
        width: 30px;
        text-align: center;
        font-size: 20px;
    }

    .menu li a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(5px);
    }

    /* Khi sidebar thu nhỏ */
    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar.collapsed .menu li a span {
        display: none;
    }

    .sidebar.collapsed .logo {
        display: none;
    }

    /* Nội dung chính */
    .content {
        margin-left: 250px;
        padding: 40px;
        transition: margin-left 0.4s ease-in-out;
        background-color: #f4f4f4;
        min-height: 100vh;
    }

    .sidebar.collapsed + .content {
        margin-left: 80px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            width: 80px;
        }

        .sidebar .menu li a span {
            display: none;
        }

        .content {
            margin-left: 80px;
        }
    }
    /* ============================= */
    /* ====== HEADER QUẢN TRỊ ====== */
    /* ============================= */
    .admin-header {
        position: fixed;
        top: 0;
        left: 250px; /* Khi sidebar mở rộng */
        width: calc(100% - 250px);
        height: 60px;
        background: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
    }

    /* Khi sidebar thu nhỏ */
    .sidebar.collapsed + .admin-header {
        left: 80px; /* Điều chỉnh header khi sidebar thu nhỏ */
        width: calc(100% - 80px);
    }


    /* Tiêu đề bên trái */
    .header-left h1 {
        font-size: 22px;
        color: #333;
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
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
        font-size: 14px;
        width: 200px;
    }

    .search-box button {
        position: absolute;
        right: 5px;
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
        margin-right: 20px;
        cursor: pointer;
        font-size: 18px;
        color: #555;
    }

    .notifications .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        font-size: 12px;
        padding: 4px 7px;
        border-radius: 50%;
    }

    /* Hồ sơ người dùng */
    .profile {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .profile span {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-header {
            left: 80px;
            width: calc(100% - 80px);
        }

        .search-box input {
            width: 150px;
        }
    }
</style>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="logo">🏠 Homestay</h2>
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <ul class="menu">
            <li><a href="#"><i class="fas fa-home"></i> <span>Trang chủ</span></a></li>
            <li><a href="#"><i class="fas fa-building"></i> <span>Homestay</span></a></li>
            <li><a href="#"><i class="fas fa-calendar-check"></i> <span>Đặt phòng</span></a></li>
            <li><a href="#"><i class="fas fa-star"></i> <span>Đánh giá</span></a></li>
            <li><a href="#"><i class="fas fa-user"></i> <span>Tài khoản</span></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span></a></li>
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
            const toggleBtn = document.querySelector(".toggle-btn");

            toggleBtn.addEventListener("click", function () {
                sidebar.classList.toggle("collapsed");

                // Kiểm tra trạng thái sidebar và cập nhật header
                if (sidebar.classList.contains("collapsed")) {
                    header.style.left = "80px";
                    header.style.width = "calc(100% - 80px)";
                } else {
                    header.style.left = "250px";
                    header.style.width = "calc(100% - 250px)";
                }
            });
        });
    </script>
</body>
</html>
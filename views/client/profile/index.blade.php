<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        .back-to-home {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: white;
            padding: 12px 20px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1c1e21;
            text-decoration: none;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .back-to-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .parallax-container {
            position: relative;
            height: 350px;
            overflow: hidden;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.1));
        }

        .cover-photo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.7) 0%,
                    rgba(0, 0, 0, 0.3) 50%,
                    rgba(0, 0, 0, 0.1) 100%),
                url('https://source.unsplash.com/1200x350/?nature,travel');
            background-size: cover;
            background-position: center;
            transform: translateZ(0);
            will-change: transform;
        }

        .profile-page {
            position: relative;
            min-height: 100vh;
            width: 100%;
        }

        .profile-info-container {
            position: relative;
            max-width: 1200px;
            margin: -90px auto 0;
            padding: 0 20px;
            z-index: 2;
        }

        .profile-header {
            display: flex;
            align-items: flex-end;
            padding: 20px;
            border-radius: 10px;
        }

        .profile-avatar-container {
            position: relative;
            margin-right: 30px;
            margin-top: -40px;
        }

        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
            object-fit: cover;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .avatar-upload {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            z-index: 3;
        }

        .avatar-upload:hover {
            transform: scale(1.1);
            background: #f0f2f5;
        }

        .profile-info-header {}

        .profile-name {
            font-size: 32px;
            font-weight: bold;
            color: #1c1e21;
            margin-bottom: 5px;
            text-shadow: none;
        }

        .profile-stats {
            display: flex;
            gap: 20px;
            margin: 15px 0;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #65676b;
            font-size: 15px;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
        }

        .profile-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .primary-btn {
            background: #1b74e4;
            color: white;
        }

        .primary-btn:hover {
            background: #1967d2;
            transform: translateY(-2px);
        }

        .secondary-btn {
            background: #e4e6eb;
            color: #050505;
        }

        .secondary-btn:hover {
            background: #d8dadf;
            transform: translateY(-2px);
        }

        .profile-name-container {
            padding-top: 20px;
            flex: 1;
        }

        .profile-email {
            color: #65676b;
            font-size: 15px;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-sidebar {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .info-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1c1e21;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e4e6eb;
        }

        .info-group {
            margin-bottom: 15px;
            padding: 10px 0;
        }

        .info-label {
            font-size: 15px;
            color: #65676b;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 15px;
            color: #1c1e21;
            font-weight: 500;
        }

        .edit-profile-btn {
            background: #1877f2;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
            margin-top: 10px;
        }

        .edit-profile-btn:hover {
            background: #166fe5;
        }

        .about-section {
            margin-bottom: 20px;
        }

        .about-text {
            color: #65676b;
            font-size: 15px;
            line-height: 1.5;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .back-to-home {
                top: 10px;
                left: 10px;
                padding: 8px 15px;
                font-size: 14px;
            }

            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding-top: 60px;
            }

            .profile-avatar-container {
                margin-right: 0;
                margin-top: -100px;
                margin-bottom: 20px;
            }

            .profile-name-container {
                padding-top: 0;
            }

            .profile-avatar {
                width: 150px;
                height: 150px;
            }

            .profile-stats {
                justify-content: center;
                flex-wrap: wrap;
            }

            .profile-actions {
                justify-content: center;
            }
        }

        .cover-upload {
            position: absolute;
            bottom: 20px;
            right: 30px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            z-index: 2;
        }

        .cover-upload:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <a href="/" class="back-to-home">
        <i class="fas fa-arrow-left"></i>
        <span>Trang chủ</span>
    </a>

    <div class="profile-page">
        <div class="parallax-container">
            <div class="cover-photo"></div>
            <!-- <button class="cover-upload">
                <i class="fas fa-camera"></i>
                <span>Chỉnh sửa ảnh bìa</span>
            </button> -->
        </div>

        <div class="profile-info-container">
            <div class="profile-header">
                <div class="profile-avatar-container">
                    @if($user['avatar'])
                        <img src="{{ $user['avatar'] }}" alt="Avatar" class="profile-avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['full_name']) }}&background=random"
                            alt="Avatar" class="profile-avatar">
                    @endif
                    <div class="avatar-upload">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="profile-name-container">
                    <h1 class="profile-name">{{ $user['full_name'] }}</h1>
                    <div class="profile-email">{{ $user['email'] }}</div>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-sidebar">
                <div class="about-section">
                    <h2 class="section-title">Giới thiệu</h2>
                    <p class="about-text">
                        Xin chào! Tôi là thành viên của cộng đồng Homestay.
                    </p>
                </div>
                <a href="/profile/edit/{{ $user['id'] }}" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Chỉnh sửa thông tin cá nhân
                </a>
            </div>

            <div class="info-section">
                <h2 class="section-title">Thông tin cá nhân</h2>

                <div class="info-group">
                    <div class="info-label">Họ và tên</div>
                    <div class="info-value">{{ $user['full_name'] }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user['email'] }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Số điện thoại</div>
                    <div class="info-value">{{ $user['phone'] ?? 'Chưa cập nhật' }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Vai trò</div>
                    <div class="info-value">{{ $user['role'] }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Trạng thái</div>
                    <div class="info-value">
                        @if($user['status'] == 1)
                            <span style="color: #28a745">Đang hoạt động</span>
                        @else
                            <span style="color: #dc3545">Đã khóa</span>
                        @endif
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">Ngày tham gia</div>
                    <div class="info-value">{{ date('d/m/Y', strtotime($user['created_at'])) }}</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chỉ giữ lại hiệu ứng Parallax cho ảnh bìa
        window.addEventListener('scroll', function () {
            const parallax = document.querySelector('.cover-photo');
            let scrollPosition = window.pageYOffset;
            parallax.style.transform = 'translateY(' + (scrollPosition * 0.5) + 'px)';
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
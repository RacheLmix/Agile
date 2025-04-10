<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2.2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #fff, transparent);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            transform: none !important;
        }

        input[type="file"] {
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed rgba(255, 255, 255, 0.3);
            cursor: pointer;
            color: transparent; 
            position: relative;
        }

        input[type="file"]::file-selector-button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            margin-right: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Thêm label hiển thị thay vì tên file */
        input[type="file"]::before {
            content: "Chọn ảnh đại diện";
            color: rgba(255, 255, 255, 0.7);
            position: absolute;
            left: 120px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        input[type="file"]::file-selector-button:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .form-group {
            position: relative;
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }
        .form-group:nth-child(3) { animation-delay: 0.6s; }
        .form-group:nth-child(4) { animation-delay: 0.8s; }
        .form-group:nth-child(5) { animation-delay: 1s; }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            position: absolute;
            top: -10px;
            left: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 0 10px;
            font-size: 0.8rem;
            color: white;
            border-radius: 10px;
        }

        button {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 10px;
            padding: 15px;
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: bounceIn 1s ease-out 1.2s forwards;
            opacity: 0;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #2575fc, #6a11cb);
        }

        @keyframes bounceIn {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Đăng Ký</h2>
    <div class="avatar-preview">
        <img id="preview" src="https://via.placeholder.com/100/FFFFFF/808080/?text=Avatar" alt="Avatar Preview">
    </div>
    <form action="/admin/auth/signin" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">Họ và tên</label>
            <input type="text" id="full_name" name="full_name" placeholder="Nhập họ và tên của bạn" required>
        </div>
        
        <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage()">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Tạo mật khẩu mới" required>
        </div>
        
        <button type="submit">Đăng Ký</button>
    </form>
</div>

<script>
    function previewImage() {
        const preview = document.getElementById('preview');
        const file = document.getElementById('avatar').files[0];
        const reader = new FileReader();
        
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "https://via.placeholder.com/100/FFFFFF/808080/?text=Avatar";
        }
    }
</script>
</body>
</html>
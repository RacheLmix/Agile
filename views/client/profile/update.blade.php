<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
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

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .edit-header {
            background: white;
            padding: 16px 20px;
            border-radius: 8px 8px 0 0;
            border-bottom: 1px solid #e4e6eb;
        }

        .edit-header h1 {
            font-size: 20px;
            color: #1c1e21;
        }

        .edit-form {
            background: white;
            border-radius: 0 0 8px 8px;
            padding: 20px;
        }

        .form-section {
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e4e6eb;
        }

        .section-title {
            font-size: 17px;
            font-weight: 600;
            color: #1c1e21;
            margin-bottom: 12px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 15px;
            color: #65676b;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 15px;
            color: #1c1e21;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            border-color: #1b74e4;
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            color: #65676b;
            background: #e4e6eb;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }

        .cancel-btn:hover {
            background: #d8dadf;
        }

        .save-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            background: #1b74e4;
            cursor: pointer;
            transition: background 0.2s;
        }

        .save-btn:hover {
            background: #1967d2;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
            }
        }

        .avatar-upload-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .file-upload-wrapper {
            position: relative;
        }

        .custom-file-upload {
            background: #e4e6eb;
            color: #050505;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .custom-file-upload:hover {
            background: #d8dadf;
            transform: translateY(-1px);
        }

        .custom-file-upload i {
            font-size: 16px;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-header">
            <h1>Chỉnh sửa thông tin cá nhân</h1>
        </div>

        <form action="/profile/update/{{ $user['id'] }}" method="POST" class="edit-form" enctype="multipart/form-data">
            <div class="form-section">
                <div class="section-title">Ảnh đại diện</div>
                <div class="avatar-upload-container">
                    @if($user['avatar'])
                        <img src="{{ $user['avatar'] }}" alt="Avatar" class="avatar-preview">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['full_name']) }}&background=random" 
                             alt="Avatar" class="avatar-preview">
                    @endif
                    <div class="file-upload-wrapper">
                        <label for="avatar" class="custom-file-upload">
                            <i class="fas fa-camera"></i>
                            Chọn ảnh mới
                        </label>
                        <input type="file" name="avatar" id="avatar" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">Thông tin cá nhân</div>
                <div class="form-group">
                    <label class="form-label" for="full_name">Họ và tên</label>
                    <input type="text" id="full_name" name="full_name" class="form-input" 
                           value="{{ $user['full_name'] }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-input" 
                           value="{{ $user['email'] }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" class="form-input" 
                           value="{{ $user['phone'] }}">
                </div>

            </div>

            <div class="form-actions">
                <a href="/profile" class="cancel-btn">Hủy</a>
                <button type="submit" class="save-btn">Lưu thay đổi</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>
</html>

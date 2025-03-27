<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: blue;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Đăng Ký</h2>
    <form action="/sign" method="POST" enctype="multipart/form-data">
        <input type="text" name="full_name" placeholder="Họ và tên" required>
        <input type="file" name="avatar" accept="image/*">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Số điện thoại" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng Ký</button>
    </form>
</div>
</body>
</html>
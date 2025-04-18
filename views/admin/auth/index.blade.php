<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      max-width: 400px;
      width: 100%;
      margin: 20px auto;
    }

    .card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    h3 {
      color: #fff;
      font-size: 2.2rem;
      font-weight: 700;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      position: relative;
    }

    h3::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, transparent, #fff, transparent);
    }

    .form-label {
      color: rgba(255, 255, 255, 0.9);
      font-weight: 500;
      font-size: 0.9rem;
      margin-bottom: 8px;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      color: #fff;
      padding: 15px;
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 255, 255, 0.4);
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
    }

    .form-check-label {
      color: rgba(255, 255, 255, 0.9);
      font-size: 0.9rem;
    }

    .btn-primary {
      background: linear-gradient(45deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 10px;
      padding: 15px;
      font-weight: 600;
      font-size: 1.1rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      background: linear-gradient(45deg, #2575fc, #6a11cb);
    }

    .error-message {
      background: rgba(255, 59, 48, 0.1);
      border: 1px solid rgba(255, 59, 48, 0.2);
      color: #fff;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 0.9rem;
    }

    .alert-success {
      background: rgba(52, 199, 89, 0.1) !important;
      border: 1px solid rgba(52, 199, 89, 0.2) !important;
      color: #fff !important;
      padding: 15px !important;
      border-radius: 10px !important;
      margin-bottom: 20px !important;
      text-align: center;
      font-size: 0.9rem;
    }

    .animate-links a {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .animate-links a:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .back-home-btn,
    .register-btn {
      font-weight: 500;
      font-size: 0.95rem;
      border-radius: 8px;
      padding: 10px 12px;
      text-decoration: none;
      color: white !important;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(4px);
    }

    .back-home-btn:hover,
    .register-btn:hover {
      background: rgba(255, 255, 255, 0.25);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="login-container">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Đăng nhập</h3>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['error'])) : ?>
            <div class="error-message text-center">
              <?php echo $_SESSION['error'];
              unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success text-center mb-4">
              <?php echo $_SESSION['success'];
              unset($_SESSION['success']); ?>
            </div>
          <?php endif; ?>

          <form action="/loginsession" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Mail</label>
              <input type="text" class="form-control" id="username" name="email">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
          </form>

          <div class="d-flex justify-content-between gap-2 mt-3 animate-links">
            <a href="/" class="btn btn-outline-light w-50 back-home-btn">
              <i class="fas fa-home me-1"></i> Trang chủ
            </a>
            <a href="/signin" class="btn btn-outline-light w-50 register-btn">
              <i class="fas fa-user-plus me-1"></i> Đăng ký
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

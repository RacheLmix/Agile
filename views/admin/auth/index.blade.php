<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2); /* Thay đổi màu gradient */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            perspective: 1000px;
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .star {
            display: none; /* Ẩn các ngôi sao vì không phù hợp với theme homestay */
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 20px auto;
            transform-style: preserve-3d;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transform-style: preserve-3d;
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        h3 {
            color: #fff;
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            position: relative;
        }

        h3:after {
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
    </style>
</head>
<body>
<div class="parallax-bg" id="parallax-bg"></div>
<div class="container">
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Đăng nhập</h3>
            </div>
            <div class="card-body">
                <?php if(isset($_SESSION['error'])): ?>
                <div class="error-message text-center">
                        <?php echo $_SESSION['error'];
                         unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success text-center mb-4" style="background: rgba(52, 199, 89, 0.1); border: 1px solid rgba(52, 199, 89, 0.2); color: #34c759; padding: 10px; border-radius: 8px; transform: translateZ(25px);">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
                <?php endif; ?>

                <form action="/loginsession" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Mail</label>
                        <input type="text" class="form-control" id="username" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Create stars background
    function createStars() {
        const bg = document.getElementById('parallax-bg');
        for (let i = 0; i < 200; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.width = Math.random() * 3 + 'px';
            star.style.height = star.style.width;
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            star.style.animationDelay = Math.random() * 2 + 's';
            bg.appendChild(star);
        }
    }

    // Add 3D effect on mouse move
    function add3DEffect() {
        const card = document.querySelector('.card');
        const container = document.querySelector('.container');

        container.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg) translateZ(20px)`;
        });

        container.addEventListener('mouseleave', () => {
            card.style.transform = 'rotateY(0) rotateX(0) translateZ(0)';
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        createStars();
        add3DEffect();
    });
</script>
</body>
</html>
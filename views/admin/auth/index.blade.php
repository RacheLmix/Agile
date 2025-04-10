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
            background: linear-gradient(45deg, #0a192f, #20314e);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            perspective: 1000px;
        }

        .star {
            position: absolute;
            background: #fff;
            border-radius: 50%;
            animation: twinkle 2s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .container {
            position: relative;
            z-index: 1;
            perspective: 1000px;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 20px auto;
            transform-style: preserve-3d;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }

        .card:hover {
            transform: translateZ(20px);
        }

        .card-header {
            border: none;
            background: transparent;
            padding-bottom: 2rem;
        }

        h3 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform: translateZ(40px);
            transition: transform 0.3s ease;
        }

        .form-label {
            color: #fff;
            font-weight: 500;
            transform: translateZ(20px);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            padding: 12px;
            transition: all 0.3s ease;
            transform: translateZ(30px);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            transform: translateZ(40px);
        }

        .form-check-label {
            color: #fff;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(45deg, #4a90e2, #63b3ed);
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transform: translateZ(35px);
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateZ(45px);
            box-shadow: 0 10px 20px rgba(74, 144, 226, 0.4);
            background: linear-gradient(45deg, #63b3ed, #4a90e2);
        }

        .error-message {
            background: rgba(255, 59, 48, 0.1);
            border: 1px solid rgba(255, 59, 48, 0.2);
            color: #ff3b30;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 1rem;
            transform: translateZ(25px);
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
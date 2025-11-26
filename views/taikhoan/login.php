<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', 'Roboto', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0,0,0,0.35);
            background-blend-mode: darken;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.92);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            width: 400px;
            max-width: 90%;
            backdrop-filter: blur(5px);
        }

        .login-title {
            font-weight: 800;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.4rem;
            font-family: 'Poppins', sans-serif;
        }

        .input-wrapper {
            border: 1px solid #ddd; 
            border-radius: 8px;
            margin-bottom: 25px; 
            padding: 10px 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #f9f9f9;
        }

        .input-wrapper:focus-within {
            border-color: #11998e;
            box-shadow: 0 0 0 0.25rem rgba(17, 153, 142, 0.25);
            background-color: #fff;
        }

        .input-wrapper i {
            color: #888;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .custom-input {
            border: none;
            outline: none;
            background-color: transparent;
            width: 100%; 
            padding: 0;
            color: #333;
        }

        .custom-input::placeholder {
            color: #aaa;
        }
        .btn-gradient {
            background: linear-gradient(to right, #11998e, #38ef7d); 
            border: none;
            color: white;
            padding: 12px;
            border-radius: 25px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            color: white;
            background: linear-gradient(to right, #38ef7d, #11998e);
        }

        .forgot-pass {
            float: right;
            font-size: 0.9rem;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="text-center login-title">Login</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger py-2">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="index.php?act=login" method="POST">
            
            <label class="fw-bold text-secondary small mb-1">Username</label>
           <div class="input-wrapper d-flex align-items-center">
                <i class="fas fa-user"></i>
                <input type="text" name="TenDangNhap" class="custom-input" required placeholder="Type your username">
            </div>
            <label class="fw-bold text-secondary small mb-1">Password</label>
            <div class="input-wrapper d-flex align-items-center">
                <i class="fas fa-lock"></i>
                <input type="password" name="MatKhau" class="custom-input" required placeholder="Type your password">
            </div>

            <a href="#" class="forgot-pass">Forgot password?</a>
            <button type="submit" class="btn btn-gradient">LOGIN</button>

        </form>
    </div>

</body>
</html>

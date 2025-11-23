<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #5acbfeb4 0%, #d96fffd0 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 400px;
            max-width: 90%;
        }

        .register-title {
            font-weight: 800;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .custom-input-group {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 5px;
            transition: border-color 0.3s;
        }

        .custom-input-group:focus-within {
            border-bottom-color: #d07bfd;
        }

        .custom-input-group i {
            color: #aaa;
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .custom-input {
            border: none;
            outline: none;
            width: 90%;
            color: #555;
        }

        .custom-input::placeholder {
            color: #aaa;
        }

        .btn-gradient {
            background: linear-gradient(to right, #4facfe 0%, #f680ff 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 25px;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            color: white;
        }

        .bottom-text {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }

        .bottom-text a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2 class="text-center register-title">Sign Up</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger py-2" style="font-size: 0.9rem;">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?act=register" method="POST">
            <label class="fw-bold text-secondary small mb-1">Username</label>
            <div class="custom-input-group d-flex align-items-center">
                <i class="fas fa-user"></i>
                <input type="text" name="TenDangNhap" class="custom-input" placeholder="Choose a username" required>
            </div>
            <label class="fw-bold text-secondary small mb-1">Password</label>
            <div class="custom-input-group d-flex align-items-center">
                <i class="fas fa-lock"></i>
                <input type="password" name="MatKhau" class="custom-input" placeholder="Create a password" required>
            </div>
            <label class="fw-bold text-secondary small mb-1">Confirm Password</label>
            <div class="custom-input-group d-flex align-items-center">
                <i class="fas fa-check-circle"></i>
                <input type="password" name="MatKhau2" class="custom-input" placeholder="Retype password" required>
            </div>
            <button type="submit" class="btn btn-gradient">SIGN UP</button>

        </form>
        <div class="bottom-text">
            Đã có tài khoản? <a href="index.php?act=login">Đăng nhập ngay</a>
        </div>
    </div>

</body>
</html>
<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'huong_dan_vien') {
    header("Location: index.php?act=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDV Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f5f8fa;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #085f63;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            color: white;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #d9f7f5;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #0a7b80;
            color: #fff;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .hero {
            background: url("https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1350&q=80") no-repeat center/cover;
            border-radius: 16px;
            height: 280px;
            display: flex;
            align-items: center;
            padding: 40px;
            color: white;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }

        .card-custom {
            border-radius: 14px;
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>

        <hr style="color: #aad;">

        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="hero mb-4">
            <div>
                <h2>Xin chào, Hướng dẫn viên <?= $_SESSION['user']['HoTen'] ?? '' ?></h2>
                <p>Chúc bạn có một chuyến đi thật tuyệt vời và đầy trải nghiệm cùng du khách!</p>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <a href="index.php?act=hdv_schedule" class="text-decoration-none text-dark">
                    <div class="card card-custom p-3">
                        <h5><i class="fa-solid fa-calendar-days text-primary"></i> Lịch trình & lịch làm việc</h5>
                        <p>Xem tour được phân công, địa điểm, nhiệm vụ mỗi ngày.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card card-custom p-3">
                        <h5><i class="fa-solid fa-users text-success"></i> Danh sách khách</h5>
                        <p>Tra cứu thông tin khách tham gia tour.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
    <a href="index.php?act=listTourOfHDV" class="text-decoration-none text-dark">
        <div class="card card-custom p-3">
            <h5><i class="fa-solid fa-book text-warning"></i> Nhật ký tour</h5>
            <p>Ghi chép sự kiện, hình ảnh, ghi chú từng ngày.</p>
        </div>
    </a>
</div>

            <div class="col-md-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card card-custom p-3">
                        <h5><i class="fa-solid fa-compass text-danger"></i> Vận hành tour</h5>
                        <p>Quản lý hoạt động tour được phân công.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="index.php?act=hdv_schedule" class="text-decoration-none text-dark">
                    <div class="card card-custom p-3">
                        <h5><i class="fa-solid fa-user-check text-info"></i> Quản lý khách</h5>
                        <p>Điểm danh, ghi nhận yêu cầu đặc biệt.</p>
                    </div>
                </a>
            </div>
        </div>

    </div>

</body>
</html>

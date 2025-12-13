<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            padding-top: 20px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 25px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.2rem;
            color: #fff;
            display: flex;
            align-items: center;
        }

        .sidebar-menu {
            padding: 0 10px;
        }

        .sidebar-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #95a5a6;
            margin: 15px 15px 5px;
            font-weight: 600;
        }

        .sidebar a {
            color: #bdc3c7;
            padding: 12px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .sidebar a i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: #3498db;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            border-radius: 16px;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 97, 255, 0.3);
            margin-bottom: 30px;
        }

        .welcome-card::before,
        .welcome-card::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .welcome-card::before {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -50px;
        }

        .welcome-card::after {
            width: 150px;
            height: 150px;
            bottom: -30px;
            right: 200px;
        }

        .user-name {
            color: #ffd700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .astronaut-img {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            width: 120px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            height: 100%;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .bg-light-blue {
            background: #e3f2fd;
            color: #0d6efd;
        }

        .bg-light-green {
            background: #d1e7dd;
            color: #198754;
        }

        .bg-light-yellow {
            background: #fff3cd;
            color: #ffc107;
        }

        .bg-light-red {
            background: #f8d7da;
            color: #dc3545;
        }

        .trend-badge {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .trend-up {
            color: #198754;
        }

        .trend-down {
            color: #dc3545;
        }

        .panel-card {
            background: #fff;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            padding: 0;
            overflow: hidden;
            height: 100%;
        }

        .panel-header {
            padding: 20px 25px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
            margin: 0;
        }

        .table-custom th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
        }

        .table-custom td {
            padding: 15px 25px;
            vertical-align: middle;
            color: #444;
            border-bottom: 1px solid #f5f5f5;
            font-size: 0.9rem;
        }

        .table-custom tr:last-child td {
            border-bottom: none;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-cho {
            background: #fff3cd;
            color: #856404;
        }

        .badge-coc {
            background: #d1e7dd;
            color: #0f5132;
        }

        .badge-xong {
            background: #cff4fc;
            color: #055160;
        }

        .badge-huy {
            background: #f8d7da;
            color: #842029;
        }

        .btn-quick {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 12px;
            text-decoration: none;
            color: #555;
            font-weight: 600;
            transition: 0.2s;
            margin-bottom: 15px;
        }

        .btn-quick:hover {
            background: #f8f9fa;
            border-color: #085f63;
            color: #085f63;
            transform: translateX(5px);
        }

        .btn-quick i {
            width: 30px;
            text-align: center;
            margin-right: 10px;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>

        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard" class="active"><i class="fa fa-home"></i> Trang chủ</a>

            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>

            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng
                xuất</a>
        </div>
    </div>
    <div class="content">

        <div class="welcome-card d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold mb-2">Xin chào, <span
                        class="user-name"><?= $_SESSION['user']['HoTen'] ?? 'Admin' ?>!</span> 👋</h2>
                <p class="mb-4 opacity-75">Chào mừng bạn quay trở lại. Chúc bạn một ngày làm việc hiệu quả!</p>
                <div class="d-flex gap-3">
                    <a href="index.php?act=listBooking" class="btn btn-outline-light rounded-pill px-4">
                        Xem Booking Mới
                    </a>
                </div>
            </div>
            <i class="fas fa-user-astronaut fa-6x text-white opacity-25 me-5"></i>
        </div>


        <div class="row g-4">

            <div class="col-lg-8">
                <div class="panel-card">
                    <div class="panel-header">
                        <h5 class="panel-title">Booking Gần Đây</h5>
                        <a href="index.php?act=listBooking" class="btn btn-sm btn-light text-primary fw-bold">Xem tất
                            cả</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Mã Booking</th>
                                    <th>Khách Hàng</th>
                                    <th>Tour Đăng Ký</th>
                                    <th>Trạng Thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($bookings)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Chưa có booking nào.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach (array_slice($bookings, 0, 5) as $bk): ?>
                                        <?php
                                        $badgeClass = 'badge-cho';
                                        $statusText = 'Chờ cọc';

                                        if ($bk['TrangThai'] == 'da_coc') {
                                            $badgeClass = 'badge-coc';
                                            $statusText = 'Đã cọc';
                                        } elseif ($bk['TrangThai'] == 'hoan_tat') {
                                            $badgeClass = 'badge-xong';
                                            $statusText = 'Hoàn tất';
                                        } elseif ($bk['TrangThai'] == 'da_huy') {
                                            $badgeClass = 'badge-huy';
                                            $statusText = 'Đã hủy';
                                        }
                                        ?>
                                        <tr>
                                            <td class="fw-bold text-primary">#<?= $bk['MaCodeBooking'] ?></td>
                                            <td>
                                                <div class="fw-bold"><?= $bk['TenKhachHang'] ?></div>
                                                <small class="text-muted"><?= $bk['SoDienThoai'] ?></small>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 200px;"
                                                    title="<?= $bk['TenTour'] ?>">
                                                    <?= $bk['TenTour'] ?>
                                                </div>
                                            </td>
                                            <td><span class="badge-status <?= $badgeClass ?>"><?= $statusText ?></span></td>
                                            <td class="text-center">
                                                <a href="index.php?act=editBooking&MaBooking=<?= $bk['MaBooking'] ?>"
                                                    class="text-primary" title="Xem chi tiết">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel-card h-100">
                    <div class="panel-header">
                        <h5 class="panel-title">Truy Cập Nhanh</h5>
                    </div>
                    <div class="p-3">
                        <a href="index.php?act=createTourForm" class="btn-quick">
                            <i class="fa-solid fa-plus text-primary"></i> Tạo Tour Mới
                        </a>
                        <a href="index.php?act=addTaiKhoan" class="btn-quick">
                            <i class="fa-solid fa-user-plus text-success"></i> Thêm Nhân Viên
                        </a>
                        <a href="index.php?act=createDKH" class="btn-quick">
                            <i class="fa-solid fa-bus text-warning"></i> Tạo Đoàn Khởi Hành
                        </a>
                        <a href="#" class="btn-quick mb-0">
                            <i class="fa-solid fa-chart-line text-danger"></i> Xem Báo Cáo
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
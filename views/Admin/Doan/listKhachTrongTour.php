\
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .badge-open {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-full {
            background-color: #f8d7da;
            color: #842029;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cancel {
            background-color: #e2e3e5;
            color: #41464b;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-done {
            background-color: #cfe2ff;
            color: #084298;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        td.actions {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }
        .actions a {
            text-decoration: none;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
        }
        .btn-list {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-list:hover {
            background-color: #0b5ed7;
            color: #fff;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            color: #fff;
        }

        body {
            background-color: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
            color: white;
        }

        .card-header h4 {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 500;
            transition: 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }

        .table {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #f1f3f5;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            padding: 12px;
        }

        .table td {
            vertical-align: middle;
            font-size: 14px;
            color: #444;
        }

        .table-hover tbody tr:hover {
            background-color: #f9fbff;
            transition: 0.2s ease-in-out;
        }

        .badge {
            font-size: 13px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .badge.bg-warning {
            background-color: #fff3cd !important;
            color: #856404 !important;
        }

        .badge.bg-info {
            background-color: #cfe2ff !important;
            color: #084298 !important;
        }

        .badge.bg-success {
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
        }

        .badge.bg-secondary {
            background-color: #e2e3e5 !important;
            color: #41464b !important;
        }

        .table-container {
            padding: 20px;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>

        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listDKH"><i class="fa fa-users"></i> Quản lí đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <table class="table table-hover table-bordered align-middle">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-map-marked-alt"></i> Danh sách khách trong đoàn</h4>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <a href="index.php?act=listDKH" class=" btn btn-primary">
                                <i class="fa-solid fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <thead class="table-light">
                <tr>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số giấy tờ</th>
                    <th>SĐT</th>
                    <th>Yêu cầu đặc biệt</th>
                    <th>Loại phòng</th>
                    <th>Booking</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listKhach)): ?>
                    <?php foreach ($listKhach as $k): ?>
                        <tr>
                            <td><?= htmlspecialchars($k['HoTen']) ?></td>
                            <td><?= $k['GioiTinh'] ?></td>
                            <td><?= $k['NgaySinh'] ?></td>
                            <td><?= htmlspecialchars($k['SoGiayTo']) ?></td>
                            <td><?= htmlspecialchars($k['SoDienThoai']) ?></td>
                            <td><?= nl2br(htmlspecialchars($k['GhiChuDacBiet'])) ?></td>
                            <td><?= htmlspecialchars($k['LoaiPhong']) ?></td>
                            <td>#<?= $k['MaBooking'] ?></td>
                            <td>
                                <?php if ($k['TrangThai'] === 'cho_coc'): ?>
                                    <span class="badge bg-warning text-dark">Chờ cọc</span>
                                <?php elseif ($k['TrangThai'] === 'da_coc'): ?>
                                    <span class="badge bg-info text-dark">Đã cọc</span>
                                <?php elseif ($k['TrangThai'] === 'hoan_tat'): ?>
                                    <span class="badge bg-success">Hoàn tất</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Khác</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">Chưa có khách nào đặt tour này</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Nhân Viên</title>

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="#"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="#"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
<div class="content">
    <div class="container mt-4">
    <h3 class="mb-3">Lịch Làm Việc • 
    <span class="text-primary"><?= $nhanvien['HoTen'] ?></span> 
    </h3>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Mã Lịch</th>
                <th>Ngày</th>
                <th>Trạng Thái</th>
                <th>Mã Đoàn</th>
                <th>Ghi Chú</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($ds_lich as $lich): ?>
                <tr>
                    <td><?= $lich['MaLichLamViec'] ?></td>
                    <td><?= $lich['NgayLamViec'] ?></td>
                    <td>
                        <?php
                            if ($lich['TrangThai'] == 'ranh') echo "<span class='badge bg-success'>Rảnh</span>";
                            else if ($lich['TrangThai'] == 'ban') echo "<span class='badge bg-warning text-dark'>Bận</span>";
                            else echo "<span class='badge bg-danger'>Nghỉ</span>";
                        ?>
                    </td>
                    <td><?= $lich['MaDoan'] ?></td>
                    <td><?= $lich['GhiChu'] ?></td>

                    <td>
                        <a onclick="return confirm('Xoá lịch này?')"
                           href="index.php?act=deleteLichLamViec&id=<?= $MaNhanVien ?>&MaLichLamViec=<?= $lich['MaLichLamViec'] ?>"
                           class="btn btn-danger btn-sm">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>


    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

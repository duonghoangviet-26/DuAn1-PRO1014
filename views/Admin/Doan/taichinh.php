<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý tài chính</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        /* Cột hành động */
        td.actions {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        /* Nút hành động chung */
        .actions a {
            text-decoration: none;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
        }

        /* Nút danh sách khách */
        .btn-list {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-list:hover {
            background-color: #0b5ed7;
            color: #fff;
        }

        /* Nút chỉnh sửa */
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #fff;
        }

        /* Nút xóa */
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            color: #fff;
        }
    </style>
</head>

<body class="container mt-4">
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

    <h2>Quản Lý Tài Chính - Đoàn #<?= $MaDoan ?></h2>

    <!-- Tổng quan -->
    <div class="row mt-4">

        <div class="col-md-4">
            <div class="alert alert-success ">
                <h5>Tổng Thu</h5>
                <h3><?= number_format($tongthu) ?> VNĐ</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="alert alert-danger ">
                <h5>Tổng Chi</h5>
                <h3><?= number_format($tongchi) ?> VNĐ</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="alert alert-primary ">
                <h5>Lợi Nhuận (Tạm tính)</h5>
                <h3><?= number_format($loinhuan) ?> VNĐ</h3>
            </div>
        </div>

    </div>

    <!-- Nút thêm giao dịch -->
    <a href="index.php?act=addtaichinh&id=<?= $MaDoan ?>" class="btn btn-primary mt-3">
        + Thêm Giao Dịch Mới
    </a>

    <!-- Danh sách giao dịch -->
    <div class="mt-4">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Loại</th>
                    <th>Hạng mục</th>
                    <th>Số tiền</th>
                    <th>Thanh toán</th>
                    <th>Hóa đơn</th>
                    <th>Ảnh chứng từ</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($list as $r): ?>
                    <tr>
                        <td><?= $r['NgayGiaoDich'] ?></td>
                        <td><?= $r['LoaiGiaoDich'] == 'thu' ? '<span class="text-success">Thu</span>' : '<span class="text-danger">Chi</span>' ?></td>
                        <td><?= $r['HangMucChi'] ?></td>
                        <td><?= number_format($r['SoTien']) ?> VNĐ</td>
                        <td><?= $r['PhuongThucThanhToan'] ?></td>
                        <td><?= $r['SoHoaDon'] ?></td>
                        <td>
                            <?php if ($r['AnhChungTu']): ?>
                                <img src="uploads/<?= $r['AnhChungTu'] ?>" width="70">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= $r['MoTa'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                href="index.php?act=deleteTC&id=<?= $r['MaTaiChinh'] ?>&doan=<?= $MaDoan ?>"
                                class="btn btn-danger btn-sm">Xóa</a>
                           <a href="index.php?act=editTC&id=<?= $r['MaTaiChinh'] ?>&doan=<?= $MaDoan ?>"
                            class="btn btn-warning btn-sm">Sửa</a>     
                        </td>
                        
                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>

</body>

</html>
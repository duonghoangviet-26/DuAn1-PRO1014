<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý tài chính</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* body {
            background-color: #eef1f4;
            font-family: "Segoe UI", sans-serif;
        } */

        /* SIDEBAR NEW STYLE */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            padding-top: 25px;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
        }

        .sidebar h4 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 30px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .sidebar a {
            padding: 14px 25px;
            display: flex;
            gap: 10px;
            align-items: center;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.25s ease;
            font-size: 15px;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: white;
            border-left: 3px solid #38bdf8;
        }

        .sidebar a.active {
            background-color: #0284c7;
            border-left: 3px solid #fff;
        }

        /* Mục đang active */
        .sidebar a.active {
            background: #1f2d3a;
            color: #fff;
            border-left: 4px solid #3498db;
            font-weight: 600;
        }

        .logout {
            color: #e74c3c !important;
            font-weight: 600;
        }

        .logout:hover {
            background: #c0392b !important;
            color: #fff !important;
            border-left: 4px solid #ff6b6b !important;
        }


        body {
    background-color: #f5f7fa;
    font-family: "Segoe UI", sans-serif;
}

/* CONTENT */
.content {
    margin-left: 250px;
    padding: 30px;
}

/* PAGE TITLE */
.page-title {
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    padding: 14px 22px;
    color: white;
    font-size: 22px;
    font-weight: 600;
    border-radius: 8px;
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(59,130,246,0.25);
}

/* STAT CARDS */
.stat-card {
    padding: 20px;
    border-radius: 12px;
    border: none;
    transition: 0.25s;
    background: white;
    color: #1e293b;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.stat-card:hover {
    transform: translateY(-3px);
}

/* Màu nền nhạt cho từng loại */
.bg-green { background: #3dd990ff !important; }
.bg-red   { background: #e15858ff !important; }
.bg-blue  { background: #4e8fe3ff !important; }

.stat-card h5 {
    color: #0e0f12ff;
    font-size: 15px;
}
.stat-card h3 {
    font-weight: bold;
    color: #F8F7F2;
}

/* BUTTONS */
.btn-action {
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    border: none;
    transition: 0.2s;
}

.btn-delete {
    background: #ef4444;
    color: white;
}
.btn-delete:hover {
    background: #dc2626;
}

.btn-edit {
    background: #fbbf24;
    color: black;
}
.btn-edit:hover {
    background: #f59e0b;
}

/* TABLE BOX */
.table-box {
    padding: 25px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
}

.table thead th {
    font-weight: bold;
    background: #d5dfebff;
    padding: 14px;
    border-bottom: 2px solid #e2e8f0;
    color: #060b13ff;
}

.table tbody td {
    padding: 14px;
    vertical-align: middle;
    color: #050a10ff;
    font-size: 15px;
}

.text-thu {
    color: #059669;
    font-weight: bold;
}
.text-chi {
    color: #dc2b2bff;
    font-weight: bold;
}

.table img {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    object-fit: cover;
    width: 70px;
    height: 70px;
}

.table tbody tr:hover {
    background: #e4eaf0ff;
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

        <div class="page-title">
            Quản Lý Tài Chính - Đoàn #<?= $MaDoan ?>
        </div>


        <div class="row mt-4">
            <div class="col-md-4">
                <div class="stat-card bg-green">
                    <h5>Tổng Thu</h5>
                    <h3><?= number_format((float)$tongthu) ?> VNĐ</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-red">
                    <h5>Tổng Chi</h5>
                    <h3><?= number_format((float)$tongchi) ?> VNĐ</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-blue">
                    <h5>Lợi Nhuận</h5>
                    <h3><?= number_format((float)$loinhuan) ?> VNĐ</h3>
                </div>
            </div>

        </div>

        <div class="mt-3 d-flex gap-2">

            <a href="index.php?act=listDKH" class="btn btn-secondary">
                ⬅ Quay lại
            </a>

            <a href="index.php?act=addtaichinh&id=<?= $MaDoan ?>" class="btn btn-primary">
                + Thêm Giao Dịch Mới
            </a>

        </div>


        <!-- Danh sách -->
        <div class="table-box mt-4">
            <table class="table table-hover">

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
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($list as $r): ?>
                        <tr>
                            <td><?= $r['NgayGiaoDich'] ?></td>

                            <td>
                                <span class="<?= $r['LoaiGiaoDich'] == 'thu' ? 'text-thu' : 'text-chi' ?>">
                                    <?= ucfirst($r['LoaiGiaoDich']) ?>
                                </span>
                            </td>

                            <td><?= $r['HangMucChi'] ?></td>
                            <td><?= number_format($r['SoTien']) ?> VNĐ</td>
                            <td><?= $r['PhuongThucThanhToan'] ?></td>
                            <td><?= $r['SoHoaDon'] ?></td>

                            <td>
                                <?php if ($r['AnhChungTu']): ?>
                                    <img src="uploads/<?= $r['AnhChungTu'] ?>" width="70" height="70">
                                <?php else: ?>
                                    <span class="text-muted">Không có</span>
                                <?php endif; ?>
                            </td>

                            <td><?= $r['MoTa'] ?></td>

                            <td class="text-center">
                                <a class="btn btn-delete btn-action"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                    href="index.php?act=deleteTC&id=<?= $r['MaTaiChinh'] ?>&doan=<?= $MaDoan ?>">
                                    Xóa
                                </a>

                                <a class="btn btn-edit btn-action"
                                    href="index.php?act=editTC&id=<?= $r['MaTaiChinh'] ?>&doan=<?= $MaDoan ?>">
                                    Sửa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>


    </div>

</body>

</html>
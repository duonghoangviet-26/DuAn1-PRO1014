<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-left: 250px;
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
            padding: 20px;
        }

        .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listDKH" class="active"><i class="fa fa-users"></i> Quản lý đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content container mt-4">

        <h3 class="text-primary fw-bold mb-3">Chi tiết Đoàn khởi hành</h3>

        <div class="card p-3 mb-4">
            <h4 class="mb-3"><?= htmlspecialchars($tour['TenTour'] ?? '') ?></h4>

            <p><b>Ngày đi:</b> <?= htmlspecialchars($doan['NgayKhoiHanh'] ?? '') ?></p>
            <p><b>Ngày về:</b> <?= htmlspecialchars($doan['NgayVe'] ?? '') ?></p>
            <p><b>Giờ khởi hành:</b> <?= htmlspecialchars($doan['GioKhoiHanh'] ?? '') ?></p>
            <p><b>Điểm tập trung:</b> <?= htmlspecialchars($doan['DiemTapTrung'] ?? '') ?></p>

            <p><b>Hướng dẫn viên:</b>
                <?= ($hdv && isset($hdv['TenNhanVien']))
                    ? htmlspecialchars($hdv['TenNhanVien'])
                    : 'Chưa gán hướng dẫn viên'; ?>
            </p>

            <p><b>Tài xế:</b>
                <?= ($taixe && isset($taixe['TenNhaCungCap']))
                    ? htmlspecialchars($taixe['TenNhaCungCap'])
                    : 'Chưa gán tài xế'; ?>
            </p>


        </div>

        <h4 class="fw-bold mb-3">Lịch trình</h4>

        <?php if (!empty($lichtrinh)) : ?>
            <?php foreach ($lichtrinh as $lt) : ?>
                <div class="card p-3 mb-3 border">
                    <h5>Ngày <?= htmlspecialchars($lt['NgayThu']) ?> – <?= htmlspecialchars($lt['TieuDeNgay']) ?></h5>
                    <p><?= nl2br(htmlspecialchars($lt['ChiTietHoatDong'])) ?></p>

                    <?php if (!empty($nccTheoNgay)) : ?>
                        <?php foreach ($nccTheoNgay as $n) : ?>
                            <?php if (
                                isset($n['MaLichTrinh']) &&
                                $n['MaLichTrinh'] == $lt['MaLichTrinh']
                            ) : ?>
                                <p>
                                    <b><?= ($n['LoaiNhaCungCap'] == "khach_san") ? "Khách sạn" : "Nhà hàng" ?>:</b>
                                    <?= htmlspecialchars($n['TenNhaCungCap']) ?>
                                </p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="alert alert-info">Chưa có lịch trình cho tour này.</div>
        <?php endif; ?>

    </div>

</body>

</html>
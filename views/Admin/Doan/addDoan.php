<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <!-- Link Bootstrap -->
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

    <!-- Nội dung -->
    <div class="content">
        <div class="card p-4">
            <h4 class="mb-3">Thêm Đoàn Khởi Hành</h4>

            <form method="post">
                <!-- TOUR -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Tour</label>
                    <select name="MaTour" id="MaTour" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Chọn Tour --</option>
                        <?php foreach ($tour as $t): ?>
                            <option value="<?= $t['MaTour'] ?>"
                                <?= (isset($_POST['MaTour']) && $_POST['MaTour'] == $t['MaTour']) ? 'selected' : '' ?>>
                                <?= $t['TenTour'] ?>
                                (<?= date('d/m/Y', strtotime($t['NgayBatDau'])) ?> →
                                <?= date('d/m/Y', strtotime($t['NgayKetThuc'])) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <?php if (!empty($lichtrinh)) : ?>
                    <h4 class="fw-bold mt-4">Lịch trình tour</h4>

                    <?php foreach ($lichtrinh as $day) : ?>
                        <div class="card p-3 mb-3 border">
                            <h5 class="text-primary">Ngày <?= $day['NgayThu'] ?>: <?= $day['TieuDeNgay'] ?></h5>

                            <p><?= $day['ChiTietHoatDong'] ?></p>

                            <!-- CHỌN KHÁCH SẠN -->
                            <label class="form-label fw-bold">Khách sạn</label>
                            <select name="khachsan[<?= $day['NgayThu'] ?>]">
                                <option value="">-- Chọn khách sạn --</option>
                                <?php foreach ($hotels as $h) : ?>
                                    <option value="<?= $h['MaNhaCungCap'] ?>">
                                        <?= $h['TenNhaCungCap'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <!-- CHỌN NHÀ HÀNG -->
                            <label class="form-label fw-bold mt-2">Nhà hàng</label>
                            <select name="nhahang[<?= $day['NgayThu'] ?>]">
                                <option value="">-- Chọn nhà hàng --</option>
                                <?php foreach ($restaurants as $r) : ?>
                                    <option value="<?= $r['MaNhaCungCap'] ?>">
                                        <?= $r['TenNhaCungCap'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                <!-- NGÀY ĐI / NGÀY VỀ / GIỜ -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Ngày đi</label>
                        <input type="date" name="NgayKhoiHanh" class="form-control"
                            value="<?= $tourSelected['NgayBatDau'] ?? ($_POST['NgayKhoiHanh'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Ngày về</label>
                        <input type="date" name="NgayVe" class="form-control"
                            value="<?= $tourSelected['NgayKetThuc'] ?? ($_POST['NgayVe'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Giờ khởi hành</label>
                        <input type="time" name="GioKhoiHanh" class="form-control" required>
                    </div>
                </div>

                <!-- ĐIỂM TẬP TRUNG -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Điểm tập trung</label>
                    <input type="text" name="DiemTapTrung" class="form-control" placeholder="VD: 102 Nguyễn Huệ, Q1"
                        required>
                </div>

                <!-- HDV -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Hướng dẫn viên</label>
                    <select name="MaHuongDanVien" class="form-control">
                        <option value="">-- Chọn HDV --</option>
                        <?php foreach ($hdv as $h): ?>
                            <option value="<?= $h['MaNhanVien'] ?>"><?= $h['HoTen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- TÀI XẾ -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Tài xế</label>
                    <select name="MaTaiXe" class="form-control">
                        <option value="">-- Chọn tài xế --</option>
                        <?php foreach ($taixe as $tx): ?>
                            <option value="<?= $tx['MaNhaCungCap'] ?>">
                                <?= $tx['TenLaiXe'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- SỐ CHỖ -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Số chỗ tối đa</label>
                    <input type="number" min="1" name="SoChoToiDa" class="form-control" required>
                </div>

                <!-- NÚT -->
                <button name="btnSave" class="btn btn-primary">Thêm</button>
                <a href="index.php?act=listDKH" class="btn btn-secondary">Hủy</a>

            </form>
        </div>


    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
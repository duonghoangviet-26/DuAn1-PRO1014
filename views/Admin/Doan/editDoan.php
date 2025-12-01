\
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

            <h4 class="mb-3">✏ Sửa Đoàn Khởi Hành</h4>

            <form action="index.php?act=updateDKH" method="post">

                <input type="hidden" name="MaDoan" value="<?= $doan['MaDoan'] ?>">

                <!-- TOUR -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Tour</label>
                    <select name="MaTour" class="form-control">
                        <?php foreach ($tour as $t): ?>
                            <option value="<?= $t['MaTour'] ?>" <?= $t['MaTour'] == $doan['MaTour'] ? 'selected' : '' ?>>
                                <?= $t['TenTour'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h4 class="mt-4">Lịch trình tour</h4>

                <?php foreach ($lichtrinh as $lt): ?>
                    <div class="border p-3 mb-3 bg-light">

                        <h5>Ngày <?= $lt['NgayThu'] ?>: <?= $lt['TieuDe'] ?></h5>

                        <!-- KHÁCH SẠN -->
                        <label class="form-label">Khách sạn</label>
                        <select name="khachsan[<?= $lt['NgayThu'] ?>]" class="form-control">
                            <option value="">-- Chọn khách sạn --</option>

                            <?php foreach ($hotels as $h): ?>
                                <option value="<?= $h['MaNhaCungCap'] ?>" <?= (isset($dvMap[$lt['NgayThu']]['khach_san'])
                                                                                && $dvMap[$lt['NgayThu']]['khach_san'] == $h['MaNhaCungCap'])
                                                                                ? 'selected' : '' ?>>
                                    <?= $h['TenNhaCungCap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- NHÀ HÀNG -->
                        <label class="form-label mt-2">Nhà hàng</label>
                        <select name="nhahang[<?= $lt['NgayThu'] ?>]" class="form-control">
                            <option value="">-- Chọn nhà hàng --</option>

                            <?php foreach ($restaurants as $r): ?>
                                <option value="<?= $r['MaNhaCungCap'] ?>" <?= (isset($dvMap[$lt['NgayThu']]['nha_hang'])
                                                                                && $dvMap[$lt['NgayThu']]['nha_hang'] == $r['MaNhaCungCap'])
                                                                                ? 'selected' : '' ?>>
                                    <?= $r['TenNhaCungCap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                <?php endforeach; ?>


                <!-- NGÀY — GIỜ -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày đi</label>
                        <input type="date" name="NgayKhoiHanh" value="<?= $doan['NgayKhoiHanh'] ?>" class="form-control"
                            readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày về</label>
                        <input type="date" name="NgayVe" value="<?= $doan['NgayVe'] ?>" class="form-control" readonly>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giờ khởi hành</label>
                        <input type="time" name="GioKhoiHanh" value="<?= $doan['GioKhoiHanh'] ?>" class="form-control">
                    </div>
                </div>

                <!-- ĐIỂM TẬP TRUNG -->
                <div class="mb-3">
                    <label class="form-label">Điểm tập trung</label>
                    <input type="text" name="DiemTapTrung" class="form-control" value="<?= $doan['DiemTapTrung'] ?>">
                </div>

                <!-- HDV -->
                <div class="mb-3">
                    <label class="form-label">Hướng dẫn viên</label>
                    <select name="MaHuongDanVien" class="form-control">
                        <?php foreach ($hdv as $h): ?>
                            <option value="<?= $h['MaNhanVien'] ?>"
                                <?= $h['MaNhanVien'] == $doan['MaHuongDanVien'] ? 'selected' : '' ?>>
                                <?= $h['HoTen'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- TÀI XẾ -->
                <div class="mb-3">
                    <label class="form-label">Tài xế</label>
                    <select name="MaTaiXe" class="form-control">
                        <?php foreach ($taixe as $tx): ?>
                            <option value="<?= $tx['MaNhaCungCap'] ?>"
                                <?= $tx['MaNhaCungCap'] == $doan['MaTaiXe'] ? 'selected' : '' ?>>
                                <?= $tx['TenLaiXe'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số chỗ tối đa</label>
                    <input type="number" name="SoChoToiDa" value="<?= $doan['SoChoToiDa'] ?>" class="form-control">
                </div>

                <button name="btnUpdate" class="btn btn-primary">Cập nhật</button>
                <a href="index.php?act=listDKH" class="btn btn-secondary">Hủy</a>

            </form>

        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
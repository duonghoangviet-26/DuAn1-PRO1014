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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>

        <a href="index.php?act=Home"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-map-marked-alt"></i> FORM Sửa Thông Tin Khách Hàng</h4>
            </div>
        </div>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                $errors = explode(",", $_GET['error']);
                foreach ($errors as $e) {
                    if ($e == "empty_name") echo "Vui lòng nhập Họ Tên<br>";
                    if ($e == "empty_phone") echo "Vui lòng nhập Số Điện Thoại<br>";
                    if ($e == "db_error") echo "Lỗi lưu dữ liệu, thử lại<br>";
                }
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?act=updateKH" method="POST">
            <input type="hidden" name="MaCodeKhachHang" value="<?= htmlspecialchars($kh['MaCodeKhachHang']) ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Mã Code Khách Hàng</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($kh['MaCodeKhachHang']) ?>"
                        disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Họ Tên *</label>
                    <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($kh['HoTen']) ?>"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="SoDienThoai" class="form-control"
                        value="<?= htmlspecialchars($kh['SoDienThoai']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($kh['Email']) ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control"
                        value="<?= htmlspecialchars($kh['NgaySinh']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Giới Tính</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="nam" <?= $kh['GioiTinh'] == 'nam' ? 'selected' : '' ?>>Nam</option>
                        <option value="nu" <?= $kh['GioiTinh'] == 'nu' ? 'selected' : '' ?>>Nữ</option>
                        <option value="khac" <?= $kh['GioiTinh'] == 'khac' ? 'selected' : '' ?>>Khác</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa Chỉ</label>
                <textarea name="DiaChi" class="form-control" rows="2"><?= htmlspecialchars($kh['DiaChi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Số Giấy Tờ (CMND/CCCD/Passport)</label>
                <input type="text" name="SoGiayTo" class="form-control"
                    value="<?= htmlspecialchars($kh['SoGiayTo']) ?>">
            </div>

            <h4 class="mt-4 mb-3">Thông tin Công ty (Nếu là khách công ty)</h4>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Loại Khách</label>
                    <select name="LoaiKhach" class="form-select">
                        <option value="ca_nhan" <?= $kh['LoaiKhach'] == 'ca_nhan' ? 'selected' : '' ?>>Cá nhân</option>
                        <option value="cong_ty" <?= $kh['LoaiKhach'] == 'cong_ty' ? 'selected' : '' ?>>Công ty</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tên Công Ty</label>
                    <input type="text" name="TenCongTy" class="form-control"
                        value="<?= htmlspecialchars($kh['TenCongTy']) ?>">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Mã Số Thuế</label>
                    <input type="text" name="MaSoThue" class="form-control"
                        value="<?= htmlspecialchars($kh['MaSoThue']) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ghi Chú</label>
                <textarea name="GhiChu" class="form-control" rows="3"><?= htmlspecialchars($kh['GhiChu']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Cập Nhật</button>
            <a href="?act=listKH" class="btn btn-secondary mt-3">Quay lại</a>
        </form>

    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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

    <!-- Sidebar giống giao diện addDanhMuc -->
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

    <!-- Nội dung -->
    <div class="content">
        <div class="container mt-4">
            <h2>Sửa thông tin nhân viên</h2>

            <form action="index.php?act=updateNV" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="MaNhanVien" value="<?= $nhanVien['MaNhanVien'] ?>">
                <input type="hidden" name="AnhCu" value="<?= $nhanVien['LinkAnhDaiDien'] ?>">

                <div class="mb-3">
                    <label class="form-label">Tên nhân viên</label>
                    <input type="text" name="HoTen" class="form-control" value="<?= $nhanVien['HoTen'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chức Vụ</label>
                    <select name="VaiTro" class="form-control">
                        <option value="huong_dan_vien">Hướng dẫn viên</option>
                        <option value="admin">ADMIN</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SoDienThoai" class="form-control" value="<?= $nhanVien['SoDienThoai'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" value="<?= $nhanVien['Email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện hiện tại</label><br>
                    <img src="./uploads/nhanvien/<?= $nhanVien['LinkAnhDaiDien'] ?>" width="100">
                </div>

                <div class="mb-3">
                    <label class="form-label">Chọn ảnh mới (nếu muốn)</label>
                    <input type="file" name="LinkAnhDaiDien" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="TrangThai" class="form-control">
                        <option value="dang_lam" <?= $nhanVien['TrangThai']=='dang_lam'?'selected':'' ?>>Đang làm</option>
                        <option value="nghi_viec" <?= $nhanVien['TrangThai']=='nghi_viec'?'selected':'' ?>>Nghỉ việc</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="index.php?controller=nhanvien&action=listNV" class="btn btn-secondary">Hủy</a>
            </form>

        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

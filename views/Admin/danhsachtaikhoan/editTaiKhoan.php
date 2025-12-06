<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: #ccc; display: block; padding: 10px 20px; text-decoration: none; }
        .content { margin-left: 250px; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=listTaiKhoan" class="bg-primary text-white">Quản lý Tài khoản</a>
    </div>

    <div class="content">
        <div class="container mt-4">
            <h2>Sửa Tài Khoản</h2>
            <form action="index.php?act=postEditTaiKhoan" method="POST">
                
                <input type="hidden" name="MaTaiKhoan" value="<?= $tk['MaTaiKhoan'] ?>">

                <div class="mb-3">
                    <label>Tên Đăng Nhập</label>
                    <input type="text" class="form-control" name="TenDangNhap" value="<?= $tk['TenDangNhap'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Mật Khẩu Mới (Để trống nếu không đổi)</label>
                    <input type="password" class="form-control" name="MatKhau" placeholder="Nhập mật khẩu mới...">
                </div>

                <div class="mb-3">
                    <label>Vai Trò</label>
                    <select class="form-select" name="VaiTro">
                        <option value="admin" <?= $tk['VaiTro'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="dieu_hanh" <?= $tk['VaiTro'] == 'dieu_hanh' ? 'selected' : '' ?>>Điều hành</option>
                        <option value="huong_dan_vien" <?= $tk['VaiTro'] == 'huong_dan_vien' ? 'selected' : '' ?>>Hướng dẫn viên</option>
                        <option value="khach_hang" <?= $tk['VaiTro'] == 'khach_hang' ? 'selected' : '' ?>>Khách hàng</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Trạng Thái</label>
                    <select class="form-select" name="TrangThai">
                        <option value="hoat_dong" <?= $tk['TrangThai'] == 'hoat_dong' ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="bi_khoa" <?= $tk['TrangThai'] == 'bi_khoa' ? 'selected' : '' ?>>Bị khóa</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Cập nhật</button>
                <a href="index.php?act=listTaiKhoan" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</body>
</html>
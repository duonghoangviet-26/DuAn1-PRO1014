<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm tài khoản</title>
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
            <h2>Thêm Tài Khoản Mới</h2>
            <form action="index.php?act=postAddTaiKhoan" method="POST">
                <div class="mb-3">
                    <label>Tên Đăng Nhập (*)</label>
                    <input type="text" class="form-control" name="TenDangNhap" required>
                </div>
                <div class="mb-3">
                    <label>Mật Khẩu (*)</label>
                    <input type="password" class="form-control" name="MatKhau" required>
                </div>
                <div class="mb-3">
                    <label>Vai Trò</label>
                    <select class="form-select" name="VaiTro">
                        <option value="admin">Admin (Quản trị)</option>
                        <option value="dieu_hanh">Nhân viên Điều hành</option>
                        <option value="huong_dan_vien">Hướng dẫn viên</option>
                        <option value="khach_hang">Khách hàng</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Trạng Thái</label>
                    <select class="form-select" name="TrangThai">
                        <option value="hoat_dong">Hoạt động</option>
                        <option value="bi_khoa">Bị khóa</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Thêm Tài Khoản</button>
                <a href="index.php?act=listTaiKhoan" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</body>
</html>
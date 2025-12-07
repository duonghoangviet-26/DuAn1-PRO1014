
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân sự</title>
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
        <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-circle"></i> Danh sách Tài khoản</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
    <div class="content">
    <div class="container mt-4">
        <h2 class="mb-4">Thêm Tài Khoản Mới</h2>
        
        <div class="card shadow">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Tạo tài khoản cho nhân viên</h5>
            </div>
            <div class="card-body">
                
                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $err) echo $err . "<br>"; ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?act=postAddTaiKhoan" method="POST">
    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn Nhân viên:</label>
                        <select name="MaNhanVien" id="selectNhanVien" class="form-select" required onchange="updateRole()">
                            <option value="" data-role="">-- Chọn Nhân viên --</option>
                            <?php foreach ($listNhanVien as $nv): ?>
                                <option value="<?= $nv['MaNhanVien'] ?>" data-role="<?= $nv['VaiTro'] ?>">
                                    <?= $nv['HoTen'] ?> (ID: <?= $nv['MaNhanVien'] ?>) - <?= $nv['VaiTro'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên đăng nhập:</label>
                        <input type="text" name="TenDangNhap" class="form-control" placeholder="Nhập tên đăng nhập" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mật khẩu:</label>
                        <input type="password" name="MatKhau" class="form-control" placeholder="Nhập mật khẩu" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Phân quyền (Tự động theo nhân viên):</label>
                        <select id="selectVaiTro" class="form-select bg-light" disabled>
                            <option value="">-- Tự động cập nhật --</option>
                            <option value="admin">Admin (Quản trị viên)</option>
                            <option value="dieu_hanh">Điều hành</option>
                            <option value="huong_dan_vien">Hướng dẫn viên</option>
                            <option value="tai_xe">Tài xế</option>
                            <option value="khach_hang">Khách hàng</option>
                        </select>
                        
                        <input type="hidden" name="VaiTro" id="inputVaiTro">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                        <a href="index.php?act=listTaiKhoan" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function updateRole() {
        var selectNV = document.getElementById("selectNhanVien");
        var selectedOption = selectNV.options[selectNV.selectedIndex];
        var role = selectedOption.getAttribute("data-role");
        var selectRole = document.getElementById("selectVaiTro");
        var inputRole = document.getElementById("inputVaiTro");
        
        if (role) {
            selectRole.value = role;
            inputRole.value = role;
        } else {
            selectRole.value = "";
            inputRole.value = "";
        }
    }
</script>
</body>

</html>
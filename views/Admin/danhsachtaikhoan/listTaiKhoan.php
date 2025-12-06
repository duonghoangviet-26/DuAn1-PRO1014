<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: #ccc; display: block; padding: 10px 20px; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; color: #fff; }
        .content { margin-left: 250px; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="#"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        
        <a href="index.php?act=listTaiKhoan" class="bg-primary text-white"><i class="fa fa-user-circle"></i> Danh sách Tài khoản</a>
        
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container-fluid py-4">
            <h4 class="mb-3 text-primary"><i class="fa fa-users"></i> Danh Sách Tài Khoản</h4>
            
            <a href="index.php?act=addTaiKhoan" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Thêm Tài Khoản</a>

            <table class="table table-bordered table-hover bg-white">
                <thead class="table-light">
                    <tr>
                        <th>ID</th> <th>Tên Đăng Nhập</th>
                        <th>Mật Khẩu</th>
                        <th>Vai Trò</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Tạo</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listTaiKhoan as $tk): ?>
                    <tr>
                        <td class="text-center text-muted"><?= $tk['MaTaiKhoan'] ?></td>
                        <td><strong><?= $tk['TenDangNhap'] ?></strong></td>
                        <td class="text-danger"><?= $tk['MatKhau'] ?></td>
                        <td>
                            <?php 
                                if($tk['VaiTro'] == 'admin') echo '<span class="badge bg-danger">Admin</span>';
                                elseif($tk['VaiTro'] == 'dieu_hanh') echo '<span class="badge bg-warning text-dark">Điều hành</span>';
                                elseif($tk['VaiTro'] == 'huong_dan_vien') echo '<span class="badge bg-info">HDV</span>';
                                else echo '<span class="badge bg-secondary">Khách hàng</span>';
                            ?>
                        </td>
                        <td>
                            <?php if ($tk['TrangThai'] == 'hoat_dong'): ?>
                                <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Bị khóa</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($tk['NgayTao'])) ?></td>
                        <td>
                            <a href="index.php?act=editTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Sửa</a>
                            <a href="index.php?act=deleteTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa tài khoản này?')"><i class="fa fa-trash"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
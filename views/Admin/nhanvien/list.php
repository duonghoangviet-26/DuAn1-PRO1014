\
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
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="#"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-white border-bottom">
                            <h4 class="mb-0 text-primary"><i class="fas fa-users"></i> Danh Sách Nhân Sự</h4>
                        </div>
                        <div class="card-body">
                            <!-- <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                <?php unset($_SESSION['success']); ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?> -->

                            <div class="row mb-3">
                                <div class="col-md-12 d-flex justify-content-start">
                                    <a href="index.php?controller=nhanvien&action=create" class="btn btn-success me-2">
                                        <i class="fas fa-user-plus"></i> Thêm Nhân Viên Mới
                                    </a>
                                    <a href="index.php?controller=nhanvien&action=findAvailableStaff"
                                        class="btn btn-info text-white">
                                        <i class="fas fa-search-dollar"></i> Tìm NV Rảnh
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">Mã NV</th>
                                            <th width="20%">Họ Tên</th>
                                            <th width="15%">Chức Vụ (Vai Trò)</th>
                                            <th width="15%">Liên Hệ</th>
                                            <!-- <th width="10%">Lương CB (Tạm Ẩn)</th> -->
                                            <th width="10%">Trạng Thái</th>
                                            <th width="25%">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listNhanVien as $nv):
                                            $vaiTroHienThi = strtoupper(str_replace(
                                                ['huong_dan_vien', 'tai_xe', 'dieu_hanh', 'admin'],
                                                ['HDV', 'TXE', 'ĐH', 'ADMIN'],
                                                $nv['VaiTro']
                                            ));
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $nv['MaNhanVien'] ?></td>
                                            <td><strong><?= $nv['HoTen'] ?></strong>
                                            </td>
                                            <td><?= $vaiTroHienThi ?></td>
                                            <td>
                                                <?= $nv['SoDienThoai'] ?><br>
                                                <small class="text-muted"><?= $nv['Email'] ?></small>
                                            </td>
                                            <!-- <td class="text-center">N/A</td> -->
                                            <td class="text-center">
                                                <?php if ($nv['TrangThai'] == 'dang_lam'): ?>
                                                <span class="badge bg-success">Đang
                                                    làm việc</span>
                                                <?php else: ?>
                                                <span class="badge bg-secondary">Đã
                                                    nghỉ việc</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?controller=nhanvien&action=lichlamviec&id=<?= $nv['MaNhanVien'] ?>"
                                                    class="btn btn-sm btn-info text-white" title="Xem Lịch">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    Lịch
                                                </a>
                                                <a href="index.php?controller=nhanvien&action=edit&id=<?= $nv['MaNhanVien'] ?>"
                                                    class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="index.php?controller=nhanvien&action=delete&id=<?= $nv['MaNhanVien'] ?>"
                                                    class="btn btn-sm btn-danger" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
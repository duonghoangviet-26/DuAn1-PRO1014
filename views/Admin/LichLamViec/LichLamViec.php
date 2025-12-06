<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lịch Làm Việc</title>
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
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a> 
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listDKH"><i class="fa fa-users"></i> Quản lí đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="index.php?act=addTaiKhoan"><i class="fas fa-user-plus"></i>Thêm Tài Khoản</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container mt-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="text-primary fw-bold"><i class="fas fa-calendar-alt"></i> Lịch Làm Việc</h3>
                    <h5 class="text-secondary">Nhân sự: <strong><?= isset($nhanvien['HoTen']) ? $nhanvien['HoTen'] : 'Không xác định' ?></strong></h5>
                </div>
                <div>
                    <a href="index.php?act=addLich&idNV=<?= isset($nhanvien['MaNhanVien']) ? $nhanvien['MaNhanVien'] : '' ?>" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Phân công lịch mới
                    </a>
                    <a href="index.php?act=listNV" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại DS Nhân sự
                    </a>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Mã Lịch</th>
                                <th>Ngày Khởi Hành</th>
                                <th>Thông tin Đoàn</th>
                                <th>Trạng Thái</th>
                                <th>Ghi Chú</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ds_lich)): ?>
                                <?php foreach ($ds_lich as $lich): ?>
                                    <tr>
                                        <td class="text-center fw-bold">#<?= $lich['MaLichLamViec'] ?></td>
                                        <td class="text-center text-primary fw-bold">
                                            <?= date('d/m/Y', strtotime($lich['NgayLamViec'])) ?>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">Mã Đoàn: <?= $lich['MaDoan'] ?></span><br>
                                            
                                            <small class="text-muted">
                                                Tour: <?= isset($lich['TenTour']) ? $lich['TenTour'] : 'Chưa xác định' ?>
                                            </small>
                                            
                                        </td>
                                        
                                        <td class="text-center">
                                            <?php 
                                                if($lich['TrangThai'] == 'ranh') echo '<span class="badge bg-success">Sẵn sàng</span>';
                                                elseif($lich['TrangThai'] == 'ban') echo '<span class="badge bg-warning text-dark">Đang đi tour</span>';
                                                else echo '<span class="badge bg-secondary">Đã hoàn thành/Nghỉ</span>';
                                            ?>
                                        </td>
                                        <td><?= $lich['GhiChu'] ?></td>
                                        <td class="text-center">
                                            <a href="index.php?act=editLich&MaLichLamViec=<?= $lich['MaLichLamViec'] ?>" class="btn btn-warning btn-sm" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?act=deleteLichLamViec&MaLichLamViec=<?= $lich['MaLichLamViec'] ?>&id=<?= $lich['MaNhanVien'] ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Bạn có chắc muốn hủy lịch phân công này?')" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        Chưa có lịch làm việc nào được phân công.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
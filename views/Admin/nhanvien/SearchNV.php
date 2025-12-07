<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm Nhân Viên Rảnh</title>
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
        <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-circle"></i> Danh sách Tài khoản</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container mt-4">
            <h2 class="text-primary"><i class="fas fa-search"></i> Tìm Nhân Sự Rảnh</h2>
            
            <div class="card p-4 shadow mb-4">
                <form action="index.php?act=searchNV" method="POST" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Chọn ngày cần kiểm tra:</label>
                        <input type="date" name="NgayCanTim" class="form-control" value="<?= $selectedDate ?>" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Kiểm tra</button>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?act=listNV" class="btn btn-secondary w-100">Quay lại</a>
                    </div>
                </form>
            </div>

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Kết quả: Có <?= count($listNhanVienRanh) ?> nhân sự sẵn sàng vào ngày <?= date('d/m/Y', strtotime($selectedDate)) ?></h5>
                </div>
                <div class="card-body">
                    <?php if (empty($listNhanVienRanh)): ?>
                        <div class="alert alert-warning text-center">
                            Không có nhân sự nào rảnh vào ngày này!
                        </div>
                    <?php else: ?>
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã NV</th>
                                    <th>Họ Tên</th>
                                    <th>Vai Trò</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listNhanVienRanh as $nv): ?>
                                    <tr>
                                        <td><?= $nv['MaNhanVien'] ?></td>
                                        <td class="fw-bold"><?= $nv['HoTen'] ?></td>
                                        <td>
                                            <?php 
                                            if($nv['VaiTro'] == 'huong_dan_vien') echo 'Hướng dẫn viên';
                                            elseif($nv['VaiTro'] == 'tai_xe') echo 'Tài xế';
                                            else echo $nv['VaiTro'];
                                            ?>
                                        </td>
                                        <td><?= $nv['SoDienThoai'] ?></td>
                                        <td>
                                            <a href="index.php?act=addLich&idNV=<?= $nv['MaNhanVien'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus-circle"></i> Phân công ngay
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách nhà cung cấp</title>
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
        <a href="index.php?act=listNCC" class="bg-primary text-white"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-white border-bottom">
                            <h4 class="mb-0 text-primary"><i class="fa fa-handshake"></i> Danh Sách Nhà Cung Cấp</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex justify-content-start">
                                    <a href="index.php?act=listNCC" class="btn btn-secondary me-2">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>
                                    <a href="index.php?act=addNCC&loai=<?= $_GET['loai'] ?? '' ?>" class="btn btn-success me-2">
                                        <i class="fas fa-plus"></i> Thêm Nhà Cung Cấp
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mã NCC</th>
                                            <th>Tên Nhà Cung Cấp</th>
                                            <th>Loại</th>
                                            <th>Người Liên Hệ</th>
                                            
                                            <?php if (isset($_GET['loai']) && $_GET['loai'] == 'van_chuyen'): ?>
                                                <th>Tài xế / SĐT</th>
                                            <?php endif; ?>
                                            <th>Liên Hệ (SĐT/Email)</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listNhaCungCap as $ncc): ?>
                                        <tr>
                                            <td class="text-center"><?= $ncc['MaNhaCungCap'] ?></td>
                                            <td>
                                                <strong><?= $ncc['TenNhaCungCap'] ?></strong><br>
                                                <small class="text-muted"><?= $ncc['MaCodeNCC'] ?></small>
                                            </td>
                                            <td><?= $ncc['LoaiNhaCungCap'] ?></td>
                                            <td><?= $ncc['NguoiLienHe'] ?></td>
                                            
                                            <?php if (isset($_GET['loai']) && $_GET['loai'] == 'van_chuyen'): ?>
                                            <td>
                                                <?php if (!empty($ncc['TenLaiXe'])): ?>
                                                    <i class="fas fa-user-tie text-primary"></i> <?= $ncc['TenLaiXe'] ?><br>
                                                    <small><i class="fas fa-phone text-muted"></i> <?= $ncc['SDTLaiXe'] ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted small">---</span>
                                                <?php endif; ?>
                                            </td>
                                            <?php endif; ?>
                                            <td>
                                                <?= $ncc['SoDienThoai'] ?><br>
                                                <small class="text-muted"><?= $ncc['Email'] ?></small>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($ncc['TrangThai'] == 'hoat_dong'): ?>
                                                    <span class="badge bg-success">Hoạt động</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Không hoạt động</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?act=detailNCC&id=<?= $ncc['MaNhaCungCap'] ?>" class="btn btn-sm btn-info" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="index.php?act=editNCC&id=<?= $ncc['MaNhaCungCap'] ?>" class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="index.php?act=deleteNCC&id=<?= $ncc['MaNhaCungCap'] ?>" class="btn btn-sm btn-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này?')">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết nhà cung cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: #ccc; display: block; padding: 10px 20px; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; color: #fff; }
        .content { margin-left: 250px; padding: 20px; }
        
        .detail-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 24px;
        }
        .detail-card h5 {
            font-weight: 600;
            color: #007bff;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .detail-item {
            display: flex;
            margin-bottom: 12px;
        }
        .detail-item strong {
            width: 180px;
            color: #555;
        }
        .detail-item span {
            flex: 1;
            color: #222;
        }
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
        <div class="container mt-4">
            <h2 class="mb-4">Chi Tiết Nhà Cung Cấp: <?= $ncc['TenNhaCungCap'] ?></h2>

            <div class="detail-card">
                
                <h5><i class="fas fa-info-circle"></i> Thông tin Cơ bản</h5>
                <div class="detail-item"><strong>Mã Code NCC:</strong> <span><?= $ncc['MaCodeNCC'] ?></span></div>
                <div class="detail-item"><strong>Tên NCC:</strong> <span><?= $ncc['TenNhaCungCap'] ?></span></div>
                <div class="detail-item"><strong>Loại NCC:</strong> <span><?= $ncc['LoaiNhaCungCap'] ?></span></div>
                <div class="detail-item"><strong>Trạng Thái:</strong>
                    <span>
                        <?php if ($ncc['TrangThai'] == 'hoat_dong'): ?>
                            <span class="badge bg-success">Hoạt động</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Không hoạt động</span>
                        <?php endif; ?>
                    </span>
                </div>

                <h5 class="mt-4"><i class="fas fa-user-tie"></i> Thông tin Liên Hệ</h5>
                <div class="detail-item"><strong>Người Liên Hệ:</strong> <span><?= $ncc['NguoiLienHe'] ?></span></div>
                <div class="detail-item"><strong>Số Điện Thoại:</strong> <span><?= $ncc['SoDienThoai'] ?></span></div>
                <div class="detail-item"><strong>Email:</strong> <span><?= $ncc['Email'] ?></span></div>
                <div class="detail-item"><strong>Địa Chỉ:</strong> <span><?= $ncc['DiaChi'] ?></span></div>

                <?php if ($ncc['LoaiNhaCungCap'] == 'van_chuyen'): ?>
                    <hr class="my-4">
                    <h5 class="text-success mt-3"><i class="fas fa-shuttle-van"></i> Thông tin Lái xe & Điều hành</h5>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <strong><i class="fas fa-user"></i> Tài xế:</strong> 
                                <span class="text-danger fw-bold">
                                    <?= !empty($ncc['TenLaiXe']) ? $ncc['TenLaiXe'] : '<em>(Chưa cập nhật)</em>' ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <strong><i class="fas fa-phone"></i> SĐT Liên hệ:</strong> 
                                <span class="text-danger fw-bold">
                                    <?= !empty($ncc['SDTLaiXe']) ? $ncc['SDTLaiXe'] : '<em>(Chưa cập nhật)</em>' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                <?php endif; ?>
                <h5 class="mt-4"><i class="fas fa-file-contract"></i> Thông tin Dịch vụ & Hợp đồng</h5>
                <div class="detail-item"><strong>Dịch Vụ Cung Cấp:</strong> <span><?= $ncc['DichVuCungCap'] ?></span></div>
                <div class="detail-item"><strong>File Hợp Đồng:</strong> <span><?= $ncc['FileHopDong'] ?></span></div>
                <div class="detail-item"><strong>Ngày Bắt Đầu HĐ:</strong> <span><?= date('d/m/Y', strtotime($ncc['NgayBatDauHopDong'])) ?></span></div>
                <div class="detail-item"><strong>Ngày Kết Thúc HĐ:</strong> <span><?= date('d/m/Y', strtotime($ncc['NgayKetThucHopDong'])) ?></span></div>
                <div class="detail-item"><strong>Đánh Giá:</strong> <span><?= $ncc['DanhGia'] ?> / 5.0 sao</span></div>
                <div class="detail-item"><strong>Ghi Chú:</strong> <span><?= $ncc['GhiChu'] ?></span></div>

            </div>

            <div class="mt-4">
                <a href="index.php?act=listNCCByCategory&loai=<?= $ncc['LoaiNhaCungCap'] ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại Danh sách
                </a>
                <a href="index.php?act=editNCC&id=<?= $ncc['MaNhaCungCap'] ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Sửa
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
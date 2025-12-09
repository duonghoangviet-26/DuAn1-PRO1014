<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Nhà Cung Cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f3f4f6; font-family: 'Inter', sans-serif; margin: 0; }

        .sidebar {
            width: 260px; height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1; padding-top: 20px; box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            z-index: 1000; overflow-y: auto;
        }
        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h4 { font-weight: 700; font-size: 1.2rem; color: #fff; display: flex; align-items: center; }
        .sidebar-menu { padding: 0 10px; }
        .sidebar-title { font-size: 0.75rem; text-transform: uppercase; color: #95a5a6; margin: 15px 15px 5px; font-weight: 600; }
        .sidebar a { color: #bdc3c7; padding: 12px 15px; text-decoration: none; display: flex; align-items: center; border-radius: 8px; font-size: 0.95rem; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a i { width: 25px; text-align: center; margin-right: 10px; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px); }
        .sidebar a.active { background-color: #3498db; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); }

        .main-content { margin-left: 260px; padding: 30px; width: calc(100% - 260px); min-height: 100vh; }
        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; margin-bottom: 20px; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); } /* Màu cam edit */
        
        .btn-submit { background-color: #f59e0b; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #d97706; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>
        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard"><i class="fa fa-home"></i> Trang chủ</a>
            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>
            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC" class="active"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listNCCByCategory&loai=<?= $ncc['LoaiNhaCungCap'] ?>" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Cập Nhật Nhà Cung Cấp</h3>
                        <p class="text-muted mb-0">Chỉnh sửa thông tin đối tác: <strong><?= $ncc['TenNhaCungCap'] ?></strong></p>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="index.php?act=submitEditNCC" method="POST">
                <input type="hidden" name="MaNhaCungCap" value="<?= $ncc['MaNhaCungCap'] ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-warning mb-0"><i class="fas fa-building me-2"></i> Thông Tin Cơ Bản</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="form-label">Mã Code NCC <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="MaCodeNCC" value="<?= $ncc['MaCodeNCC'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên Nhà Cung Cấp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="TenNhaCungCap" value="<?= $ncc['TenNhaCungCap'] ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Loại hình</label>
                                        <select class="form-select" name="LoaiNhaCungCap" required>
                                            <option value="khach_san" <?= ($ncc['LoaiNhaCungCap'] == 'khach_san') ? 'selected' : '' ?>>Khách sạn</option>
                                            <option value="nha_hang" <?= ($ncc['LoaiNhaCungCap'] == 'nha_hang') ? 'selected' : '' ?>>Nhà hàng</option>
                                            <option value="van_chuyen" <?= ($ncc['LoaiNhaCungCap'] == 'van_chuyen') ? 'selected' : '' ?>>Vận chuyển</option>
                                            <option value="visa" <?= ($ncc['LoaiNhaCungCap'] == 'visa') ? 'selected' : '' ?>>Visa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <select class="form-select" name="TrangThai">
                                            <option value="hoat_dong" <?= ($ncc['TrangThai'] == 'hoat_dong') ? 'selected' : '' ?>>🟢 Hoạt động</option>
                                            <option value="khong_hoat_dong" <?= ($ncc['TrangThai'] == 'khong_hoat_dong') ? 'selected' : '' ?>>🔴 Ngưng HĐ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dịch vụ cung cấp</label>
                                    <textarea class="form-control" name="DichVuCungCap" rows="3"><?= $ncc['DichVuCungCap'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-info mb-0"><i class="fas fa-address-card me-2"></i> Liên Hệ & Hợp Đồng</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Người liên hệ</label>
                                        <input type="text" class="form-control" name="NguoiLienHe" value="<?= $ncc['NguoiLienHe'] ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" name="SoDienThoai" value="<?= $ncc['SoDienThoai'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="Email" value="<?= $ncc['Email'] ?>">
                                </div>

                                <?php if ($ncc['LoaiNhaCungCap'] == 'van_chuyen'): ?>
                                <div class="p-3 bg-light rounded mb-3 border">
                                    <h6 class="text-primary small fw-bold mb-2">THÔNG TIN LÁI XE</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm" name="TenLaiXe" value="<?= $ncc['TenLaiXe'] ?>" placeholder="Họ tên lái xe">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm" name="SDTLaiXe" value="<?= $ncc['SDTLaiXe'] ?>" placeholder="SĐT lái xe">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="DiaChi" value="<?= $ncc['DiaChi'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small">Bắt đầu HĐ</label>
                                        <input type="date" class="form-control" name="NgayBatDauHopDong" value="<?= $ncc['NgayBatDauHopDong'] ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small">Kết thúc HĐ</label>
                                        <input type="date" class="form-control" name="NgayKetThucHopDong" value="<?= $ncc['NgayKetThucHopDong'] ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small">Đánh giá (Sao)</label>
                                        <input type="number" class="form-control" name="DanhGia" min="0" max="5" step="0.1" value="<?= $ncc['DanhGia'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-form p-3 sticky-bottom text-end mt-3">
                    <a href="index.php?act=listNCCByCategory&loai=<?= $ncc['LoaiNhaCungCap'] ?>" class="btn btn-cancel me-2">Hủy bỏ</a>
                    <button type="submit" class="btn btn-submit text-white">
                        <i class="fas fa-save me-2"></i> Lưu Cập Nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
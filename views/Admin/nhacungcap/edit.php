<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật nhà cung cấp</title>
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
        <div class="container mt-4">
            <h2>Cập Nhật Nhà Cung Cấp: <?= $ncc['TenNhaCungCap'] ?></h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="index.php?act=submitEditNCC" method="POST" class="row g-3">
                
                <input type="hidden" name="MaNhaCungCap" value="<?= $ncc['MaNhaCungCap'] ?>">

                <div class="col-md-4">
                    <label for="MaCodeNCC" class="form-label">Mã Code NCC (*)</label>
                    <input type="text" class="form-control" name="MaCodeNCC" id="MaCodeNCC" required 
                           value="<?= $ncc['MaCodeNCC'] ?>">
                </div>
                <div class="col-md-8">
                    <label for="TenNhaCungCap" class="form-label">Tên Nhà Cung Cấp (*)</label>
                    <input type="text" class="form-control" name="TenNhaCungCap" id="TenNhaCungCap" required
                           value="<?= $ncc['TenNhaCungCap'] ?>">
                </div>

                <div class="col-md-4">
                    <label for="LoaiNhaCungCap" class="form-label">Loại Nhà Cung Cấp (*)</label>
                    <select class="form-select" name="LoaiNhaCungCap" id="LoaiNhaCungCap" required>
                        <option value="khach_san" <?= ($ncc['LoaiNhaCungCap'] == 'khach_san') ? 'selected' : '' ?>>Khách sạn</option>
                        <option value="nha_hang" <?= ($ncc['LoaiNhaCungCap'] == 'nha_hang') ? 'selected' : '' ?>>Nhà hàng</option>
                        <option value="van_chuyen" <?= ($ncc['LoaiNhaCungCap'] == 'van_chuyen') ? 'selected' : '' ?>>Vận chuyển</option>
                        <option value="visa" <?= ($ncc['LoaiNhaCungCap'] == 'visa') ? 'selected' : '' ?>>Visa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="NguoiLienHe" class="form-label">Người Liên Hệ</label>
                    <input type="text" class="form-control" name="NguoiLienHe" id="NguoiLienHe"
                           value="<?= $ncc['NguoiLienHe'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="TrangThai" class="form-label">Trạng Thái (*)</label>
                    <select class="form-select" name="TrangThai" id="TrangThai" required>
                        <option value="hoat_dong" <?= ($ncc['TrangThai'] == 'hoat_dong') ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="khong_hoat_dong" <?= ($ncc['TrangThai'] == 'khong_hoat_dong') ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <?php if ($ncc['LoaiNhaCungCap'] == 'van_chuyen'): ?>
                <div class="col-md-12">
                    <div class="card p-3 bg-light border-0">
                        <h6 class="text-primary"><i class="fas fa-steering-wheel"></i> Thông tin Lái xe</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Họ tên lái xe</label>
                                <input type="text" class="form-control" name="TenLaiXe" 
                                       value="<?= $ncc['TenLaiXe'] ?>" placeholder="Nhập tên lái xe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SĐT Lái xe</label>
                                <input type="text" class="form-control" name="SDTLaiXe" 
                                       value="<?= $ncc['SDTLaiXe'] ?>" placeholder="Nhập SĐT lái xe">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                    <label for="SoDienThoai" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" name="SoDienThoai" id="SoDienThoai"
                           value="<?= $ncc['SoDienThoai'] ?>">
                    </div>
                    <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="Email" id="Email"
                           value="<?= $ncc['Email'] ?>">
                    </div>

                    <div class="col-12">
                    <label for="DiaChi" class="form-label">Địa Chỉ</label>
                    <textarea class="form-control" name="DiaChi" id="DiaChi" rows="2"><?= $ncc['DiaChi'] ?></textarea>
                    </div>

                    <div class="col-12">
                    <label for="DichVuCungCap" class="form-label">Dịch Vụ Cung Cấp</label>
                    <textarea class="form-control" name="DichVuCungCap" id="DichVuCungCap" rows="2"><?= $ncc['DichVuCungCap'] ?></textarea>
                    </div>

                    <hr class="my-3">
                    <h5><i class="fa fa-file-contract"></i> Thông tin Hợp Đồng</h5>

                    <div class="col-md-4">
                    <label for="NgayBatDauHopDong" class="form-label">Ngày Bắt Đầu HĐ</label>
                    <input type="date" class="form-control" name="NgayBatDauHopDong" id="NgayBatDauHopDong"
                           value="<?= $ncc['NgayBatDauHopDong'] ?>">
                    </div>
                    <div class="col-md-4">
                    <label for="NgayKetThucHopDong" class="form-label">Ngày Kết Thúc HĐ</label>
                    <input type="date" class="form-control" name="NgayKetThucHopDong" id="NgayKetThucHopDong"
                           value="<?= $ncc['NgayKetThucHopDong'] ?>">
                    </div>
                    <div class="col-md-4">
                    <label for="DanhGia" class="form-label">Đánh Giá (sao: 1-5)</label>
                    <input type="number" class="form-control" name="DanhGia" id="DanhGia" min="0" max="5" step="0.1"
                           value="<?= $ncc['DanhGia'] ?>">
                    </div>

                    <div class="col-md-12">
                    <label for="FileHopDong" class="form-label">Đường dẫn File Hợp Đồng</label>
                    <input type="text" class="form-control" name="FileHopDong" id="FileHopDong"
                           value="<?= $ncc['FileHopDong'] ?>">
                    <small class="form-text text-muted">Tạm thời nhập link/đường dẫn. Chức năng upload file sẽ phức tạp hơn.</small>
                    </div>

                    <div class="col-12">
                    <label for="GhiChu" class="form-label">Ghi Chú</label>
                    <textarea class="form-control" name="GhiChu" id="GhiChu" rows="3"><?= $ncc['GhiChu'] ?></textarea>
                    </div>

                    <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Cập Nhật Nhà Cung Cấp</button>
                    <a href="index.php?act=listNCCByCategory&loai=<?= $ncc['LoaiNhaCungCap'] ?>" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>
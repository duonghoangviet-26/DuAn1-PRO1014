<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm nhà cung cấp</title>
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
    <?php $loai_mac_dinh = $_GET['loai'] ?? ''; ?>

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
            <h2>Thêm Nhà Cung Cấp Mới</h2>

            <form action="index.php?act=submitAddNCC" method="POST" class="row g-3">

                <div class="col-md-4">
                    <label for="MaCodeNCC" class="form-label">Mã Code NCC (*)</label>
                    <input type="text" class="form-control" name="MaCodeNCC" id="MaCodeNCC" required>
                </div>
                <div class="col-md-8">
                    <label for="TenNhaCungCap" class="form-label">Tên Nhà Cung Cấp (*)</label>
                    <input type="text" class="form-control" name="TenNhaCungCap" id="TenNhaCungCap" required>
                </div>

                <div class="col-md-4">
                    <label for="LoaiNhaCungCap" class="form-label">Loại Nhà Cung Cấp (*)</label>
                    <select class="form-select" name="LoaiNhaCungCap" id="LoaiNhaCungCap" required>
                        <option value="khach_san" <?= $loai_mac_dinh == 'khach_san' ? 'selected' : '' ?>>Khách sạn</option>
                        <option value="nha_hang" <?= $loai_mac_dinh == 'nha_hang' ? 'selected' : '' ?>>Nhà hàng</option>
                        <option value="van_chuyen" <?= $loai_mac_dinh == 'van_chuyen' ? 'selected' : '' ?>>Vận chuyển</option>
                        <option value="visa" <?= $loai_mac_dinh == 'visa' ? 'selected' : '' ?>>Visa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="NguoiLienHe" class="form-label">Người Liên Hệ</label>
                    <input type="text" class="form-control" name="NguoiLienHe" id="NguoiLienHe">
                </div>
                <div class="col-md-4">
                    <label for="TrangThai" class="form-label">Trạng Thái (*)</label>
                    <select class="form-select" name="TrangThai" id="TrangThai" required>
                        <option value="hoat_dong">Hoạt động</option>
                        <option value="khong_hoat_dong">Không hoạt động</option>
                    </select>
                </div>

                <div class="col-md-12" id="driver-info-section" style="display: none;">
                    <div class="card p-3 bg-light border-0">
                        <h6 class="text-primary"><i class="fas fa-steering-wheel"></i> Thông tin Lái xe (Dành cho Vận chuyển)</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Họ tên lái xe</label>
                                <input type="text" class="form-control" name="TenLaiXe" id="TenLaiXe" placeholder="Nhập tên lái xe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SĐT Lái xe</label>
                                <input type="text" class="form-control" name="SDTLaiXe" id="SDTLaiXe" placeholder="Nhập SĐT lái xe">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="SoDienThoai" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" name="SoDienThoai" id="SoDienThoai">
                </div>
                <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control"  name="Email" id="Email">
                </div>

                <div class="col-12">
                    <label for="DiaChi" class="form-label">Địa Chỉ</label>
                    <textarea class="form-control" name="DiaChi" id="DiaChi" rows="2"></textarea>
                </div>

                <div class="col-12">
                    <label for="DichVuCungCap" class="form-label">Dịch Vụ Cung Cấp</label>
                    <textarea class="form-control" name="DichVuCungCap" id="DichVuCungCap" rows="2"></textarea>
                </div>

                <hr class="my-3">
                <h5><i class="fa fa-file-contract"></i> Thông tin Hợp Đồng</h5>

                <div class="col-md-4">
                    <label for="NgayBatDauHopDong" class="form-label">Ngày Bắt Đầu HĐ</label>
                    <input type="date" class="form-control" name="NgayBatDauHopDong" id="NgayBatDauHopDong">
                </div>
                <div class="col-md-4">
                    <label for="NgayKetThucHopDong" class="form-label">Ngày Kết Thúc HĐ</label>
                    <input type="date" class="form-control" name="NgayKetThucHopDong" id="NgayKetThucHopDong">
                </div>
                <div class="col-md-4">
                    <label for="DanhGia" class="form-label">Đánh Giá (sao: 1-5)</label>
                    <input type="number" class="form-control" name="DanhGia" id="DanhGia" min="0" max="5" step="0.1" value="0.0">
                </div>

                <div class="col-md-12">
                    <label for="FileHopDong" class="form-label">Đường dẫn File Hợp Đồng</label>
                    <input type="text" class="form-control" name="FileHopDong" id="FileHopDong">
                    <small class="form-text text-muted">Tạm thời nhập link/đường dẫn. Chức năng upload file sẽ phức tạp hơn.</small>
                </div>

                <div class="col-12">
                    <label for="GhiChu" class="form-label">Ghi Chú</label>
                    <textarea class="form-control" name="GhiChu" id="GhiChu" rows="3"></textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-success">Thêm Nhà Cung Cấp</button>
                    <?php if (!empty($loai_mac_dinh)): ?>
                        <a href="index.php?act=listNCCByCategory&loai=<?= $loai_mac_dinh ?>" class="btn btn-secondary">Hủy</a>
                    <?php else: ?>
                        <a href="index.php?act=listNCC" class="btn btn-secondary">Hủy</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loaiSelect = document.getElementById('LoaiNhaCungCap');
            const driverSection = document.getElementById('driver-info-section');
            const inputTenLaiXe = document.getElementById('TenLaiXe');
            const inputSDTLaiXe = document.getElementById('SDTLaiXe');

            function toggleDriverSection() {
                if (loaiSelect.value === 'van_chuyen') {
                    driverSection.style.display = 'block'; // Hiện
                } else {
                    driverSection.style.display = 'none';  // Ẩn
                    inputTenLaiXe.value = '';
                    inputSDTLaiXe.value = '';
                }
            }

            toggleDriverSection();

            loaiSelect.addEventListener('change', toggleDriverSection);
        });
    </script>
</body>
</html>
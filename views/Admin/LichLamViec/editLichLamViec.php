<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Phân Công</title>
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
            <h2>Chỉnh Sửa Phân Công</h2>
            
            <form action="index.php?act=submitEditLich" method="POST" class="card p-4 shadow mt-3" novalidate onsubmit="return validateForm(event)">
                <input type="hidden" name="MaLichLamViec" value="<?= $lich['MaLichLamViec'] ?>">
                
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h5 class="border-bottom pb-2 mb-4 text-warning">Cập nhật thông tin</h5>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nhân sự (HDV/Tài xế):</label>
                            <input type="text" class="form-control bg-light" 
                                   value="<?= $nhanVienHienTai['HoTen'] ?> - (<?= $nhanVienHienTai['VaiTro'] ?>)" 
                                   readonly>
                            <input type="hidden" name="MaNhanVien" value="<?= $nhanVienHienTai['MaNhanVien'] ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Đoàn Khởi Hành (Không thể thay đổi):</label>
                            
                            <input type="text" class="form-control bg-light" 
                                   value="[Đoàn #<?= $doanHienTai['MaDoan'] ?>] - Ngày đi: <?= date('d/m/Y', strtotime($doanHienTai['NgayKhoiHanh'])) ?>" 
                                   readonly>
                            
                            <input type="hidden" name="MaDoan" value="<?= $doanHienTai['MaDoan'] ?>">
                            
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Để đổi đoàn khác, vui lòng xóa lịch này và tạo phân công mới.
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Trạng Thái Công Việc:</label>
                            <select name="TrangThai" class="form-select">
                                <option value="ranh" <?= ($lich['TrangThai'] == 'ranh') ? 'selected' : '' ?>>Sẵn sàng (Chưa khởi hành)</option>
                                <option value="ban" <?= ($lich['TrangThai'] == 'ban') ? 'selected' : '' ?>>Đang bận (Đang dẫn đoàn)</option>
                                <option value="nghi" <?= ($lich['TrangThai'] == 'nghi') ? 'selected' : '' ?>>Đã hoàn thành / Hủy</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú công việc</label>
                            <textarea class="form-control" name="GhiChu" rows="3"><?= isset($lich['GhiChu']) ? $lich['GhiChu'] : '' ?></textarea>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-warning px-5 text-white">
                                <i class="fas fa-save"></i> Cập Nhật
                            </button>
                            <a href="index.php?act=lichlamviec&id=<?= $lich['MaNhanVien'] ?>" class="btn btn-secondary px-4">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm(e) {
            const form = e.target;
            const inputs = form.querySelectorAll('select');
            let isFull = true;
            for (let i = 0; i < inputs.length; i++) {
                const el = inputs[i];
                if (el.value.trim() === "") {
                    isFull = false;
                    el.style.border = "1px solid red";
                } else {
                    el.style.border = "";
                }
            }

            if (!isFull) {
                e.preventDefault();
                alert("Vui lòng không để trống thông tin!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
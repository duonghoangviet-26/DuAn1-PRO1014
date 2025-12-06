<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân Công Lịch</title>
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
            <h2>Phân Công Công Việc Mới</h2>
            
            <form action="index.php?act=submitAddLich" method="POST" class="card p-4 shadow mt-3">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h5 class="border-bottom pb-2 mb-4 text-primary">Thông tin phân công</h5>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nhân sự được phân công:</label>
                            <input type="text" class="form-control bg-light" 
                                   value="<?= $nhanVienHienTai['HoTen'] ?> - (<?= $nhanVienHienTai['VaiTro'] ?>)" 
                                   readonly>
                            
                            <input type="hidden" name="MaNhanVien" value="<?= $nhanVienHienTai['MaNhanVien'] ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Chọn Đoàn Khởi Hành <span class="text-danger">*</span></label>
                            
                            <?php if (empty($doan)): ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-circle"></i> 
                                    Nhân viên này chưa được gán vào Đoàn nào trong phần "Quản Lý Đoàn Khởi Hành". 
                                    Vui lòng sang mục quản lý đoàn để thêm nhân viên này vào đoàn trước.
                                </div>
                                <select name="MaDoan" class="form-select" disabled>
                                    <option>-- Không có đoàn khả dụng --</option>
                                </select>
                            <?php else: ?>
                                <select name="MaDoan" class="form-select" required>
                                    <option value="">-- Chọn chuyến đi --</option>
                                    <?php foreach ($doan as $d): ?>
                                        <option value="<?= $d['MaDoan'] ?>">
                                            [Đoàn #<?= $d['MaDoan'] ?>] - Ngày đi: <?= date('d/m/Y', strtotime($d['NgayKhoiHanh'])) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Trạng Thái Công Việc:</label>
                            <select name="TrangThai" class="form-select">
                                <option value="ranh" selected>Sẵn sàng (Chưa khởi hành)</option>
                                <option value="ban">Đang bận (Đang dẫn đoàn)</option>
                                <option value="nghi">Đã hoàn thành / Hủy</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú công việc</label>
                            <textarea class="form-control" name="GhiChu" rows="3" placeholder="Nhập ghi chú..."></textarea>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save"></i> Xác nhận
                            </button>
                            <a href="index.php?act=lichlamviec&id=<?= $nhanVienHienTai['MaNhanVien'] ?>" class="btn btn-secondary px-4">
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
            const inputs = form.querySelectorAll('select, textarea');
            let isFull = true;
            for (let i = 0; i < inputs.length; i++) {
                const el = inputs[i];
                if (el.name === 'GhiChu') continue; 

                if (el.value.trim() === "") {
                    isFull = false;
                    el.style.border = "1px solid red";
                } else {
                    el.style.border = "";
                }
            }

            if (!isFull) {
                e.preventDefault();
                alert("Vui lòng chọn đầy đủ Nhân sự và Đoàn khởi hành!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
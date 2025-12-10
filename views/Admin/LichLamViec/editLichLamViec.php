<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Phân Công</title>
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
        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); } /* Màu cam edit */
        
        .form-control[readonly] { background-color: #f8fafc; color: #64748b; cursor: not-allowed; }

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
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV" class="active"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center mb-4">
                <a href="index.php?act=lichlamviec&id=<?= $lich['MaNhanVien'] ?>" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Cập Nhật Phân Công</h3>
                    <p class="text-muted mb-0">Chỉnh sửa trạng thái lịch làm việc</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="index.php?act=submitEditLich" method="POST" class="card card-form" novalidate onsubmit="return validateForm(event)">
                        <input type="hidden" name="MaLichLamViec" value="<?= $lich['MaLichLamViec'] ?>">
                        <input type="hidden" name="MaNhanVien" value="<?= $nhanVienHienTai['MaNhanVien'] ?>">
                        <input type="hidden" name="MaDoan" value="<?= $doanHienTai['MaDoan'] ?>">

                        <div class="card-header-custom">
                            <h5 class="fw-bold text-warning mb-0"><i class="fas fa-edit me-2"></i> Thông Tin Lịch</h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label">Nhân sự (HDV/Tài xế):</label>
                                <input type="text" class="form-control" value="<?= $nhanVienHienTai['HoTen'] ?> - (<?= $nhanVienHienTai['VaiTro'] ?>)" readonly>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Đoàn Khởi Hành:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-bus"></i></span>
                                    <input type="text" class="form-control" value="[Đoàn #<?= $doanHienTai['MaDoan'] ?>] - Ngày đi: <?= date('d/m/Y', strtotime($doanHienTai['NgayKhoiHanh'])) ?>" readonly>
                                </div>
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i> Để đổi đoàn khác, vui lòng xóa lịch này và tạo phân công mới.
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Trạng Thái Công Việc <span class="text-danger">*</span></label>
                                <select name="TrangThai" class="form-select" required>
                                    <option value="ranh" <?= ($lich['TrangThai'] == 'ranh') ? 'selected' : '' ?>>🟢 Sẵn sàng (Chưa khởi hành)</option>
                                    <option value="ban" <?= ($lich['TrangThai'] == 'ban') ? 'selected' : '' ?>>🟠 Đang bận (Đang đi tour)</option>
                                    <option value="nghi" <?= ($lich['TrangThai'] == 'nghi') ? 'selected' : '' ?>>⚫ Đã hoàn thành / Hủy</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi chú công việc</label>
                                <textarea class="form-control" name="GhiChu" rows="4" placeholder="Ghi chú thêm về chuyến đi..."><?= isset($lich['GhiChu']) ? $lich['GhiChu'] : '' ?></textarea>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 pb-4 pt-0 text-end">
                            <a href="index.php?act=lichlamviec&id=<?= $lich['MaNhanVien'] ?>" class="btn btn-cancel me-2">Hủy bỏ</a>
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-save me-2"></i> Lưu Cập Nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm(e) {
            if(!confirm('Bạn có chắc chắn muốn lưu thay đổi này?')) {
                e.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
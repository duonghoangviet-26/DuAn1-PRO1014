<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đoàn Khởi Hành</title>
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

        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; margin-bottom: 25px; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); } /* Màu xanh lá Add */
        
        .btn-submit { background-color: #10b981; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }

        .schedule-item { border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px; background-color: #fff; margin-bottom: 15px; }
        .schedule-title { font-size: 1rem; font-weight: 700; color: #10b981; margin-bottom: 15px; border-bottom: 1px dashed #e5e7eb; padding-bottom: 10px; }
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
            <a href="index.php?act=listDKH" class="active"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>
            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listDKH" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Thêm Đoàn Khởi Hành</h3>
                        <p class="text-muted mb-0">Tạo lịch trình khởi hành mới cho tour</p>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger shadow-sm border-0 mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?act=createDKH" method="post">
                
                <div class="card card-form">
                    <div class="card-header-custom">
                        <h5 class="fw-bold text-success mb-0"><i class="fas fa-info-circle me-2"></i> Thông Tin Cơ Bản</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Chọn Tour <span class="text-danger">*</span></label>
                                <select name="MaTour" id="MaTour" class="form-select form-select-lg" onchange="this.form.submit()" required>
                                    <option value="">-- Chọn Tour khởi hành --</option>
                                    <?php foreach ($tour as $t): ?>
                                        <option value="<?= $t['MaTour'] ?>" 
                                            <?= (isset($_POST['MaTour']) && $_POST['MaTour'] == $t['MaTour']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($t['TenTour']) ?> 
                                            (<?= date('d/m/Y', strtotime($t['NgayBatDau'])) ?> → <?= date('d/m/Y', strtotime($t['NgayKetThuc'])) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày Khởi Hành</label>
                                <input type="date" name="NgayKhoiHanh" class="form-control" 
                                    value="<?= $tourSelected['NgayBatDau'] ?? ($_POST['NgayKhoiHanh'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày Về</label>
                                <input type="date" name="NgayVe" class="form-control" 
                                    value="<?= $tourSelected['NgayKetThuc'] ?? ($_POST['NgayVe'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Giờ Khởi Hành</label>
                                <input type="time" name="GioKhoiHanh" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điểm Tập Trung</label>
                            <input type="text" name="DiemTapTrung" class="form-control" placeholder="VD: 102 Nguyễn Huệ, Q1, TP.HCM" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Hướng Dẫn Viên</label>
                                <select name="MaHuongDanVien" class="form-select">
                                    <option value="">-- Chọn HDV --</option>
                                    <?php foreach ($hdv as $h): ?>
                                        <option value="<?= $h['MaNhanVien'] ?>"><?= $h['HoTen'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tài Xế / Xe</label>
                                <select name="MaTaiXe" class="form-select">
                                    <option value="">-- Chọn Nhà xe --</option>
                                    <?php foreach ($taixe as $tx): ?>
                                        <option value="<?= $tx['MaNhaCungCap'] ?>"><?= $tx['TenLaiXe'] ?> (<?= $tx['TenNhaCungCap'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Số Chỗ Tối Đa</label>
                                <input type="number" name="SoChoToiDa" class="form-control" min="1" required>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($lichtrinh)) : ?>
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-concierge-bell me-2"></i> Dịch Vụ Theo Lịch Trình</h5>
                    
                    <div class="row">
                        <?php foreach ($lichtrinh as $day) : ?>
                        <div class="col-md-6">
                            <div class="schedule-item">
                                <div class="schedule-title">
                                    <i class="far fa-calendar-alt me-1"></i> Ngày <?= $day['NgayThu'] ?>: <?= htmlspecialchars($day['TieuDeNgay']) ?>
                                </div>
                                
                                <p class="small text-muted mb-3 fst-italic">
                                    <?= htmlspecialchars(mb_strimwidth($day['ChiTietHoatDong'] ?? '', 0, 100, "...")) ?>
                                </p>

                                <div class="mb-3">
                                    <label class="form-label small text-muted"><i class="fas fa-hotel me-1"></i> Khách sạn</label>
                                    <select name="khachsan[<?= $day['NgayThu'] ?>]" class="form-select form-select-sm">
                                        <option value="">-- Chọn khách sạn --</option>
                                        <?php foreach ($hotels as $h) : ?>
                                            <option value="<?= $h['MaNhaCungCap'] ?>"><?= $h['TenNhaCungCap'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label small text-muted"><i class="fas fa-utensils me-1"></i> Nhà hàng</label>
                                    <select name="nhahang[<?= $day['NgayThu'] ?>]" class="form-select form-select-sm">
                                        <option value="">-- Chọn nhà hàng --</option>
                                        <?php foreach ($restaurants as $r) : ?>
                                            <option value="<?= $r['MaNhaCungCap'] ?>"><?= $r['TenNhaCungCap'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="card card-form p-3 sticky-bottom text-end mt-3">
                    <a href="index.php?act=listDKH" class="btn btn-cancel me-2">Hủy bỏ</a>
                    <button type="submit" name="btnSave" class="btn btn-submit text-white">
                        <i class="fas fa-save me-2"></i> Lưu Đoàn Mới
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
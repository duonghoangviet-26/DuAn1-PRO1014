<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đoàn Khởi Hành</title>
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
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); } /* Màu cam edit */
        
        .btn-submit { background-color: #f59e0b; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #d97706; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }

        .schedule-item { border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px; background-color: #fff; margin-bottom: 15px; }
        .schedule-title { font-size: 1rem; font-weight: 700; color: #3b82f6; margin-bottom: 15px; border-bottom: 1px dashed #e5e7eb; padding-bottom: 10px; }
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
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">
        <div class="card p-4">

            <h4 class="mb-3">✏ Sửa Đoàn Khởi Hành</h4>

            <form action="index.php?act=updateDKH" method="post">

                <input type="hidden" name="MaDoan" value="<?= $doan['MaDoan'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Tour</label>
                    <select name="MaTour" class="form-control">
                        <?php foreach ($tour as $t): ?>
                            <option value="<?= $t['MaTour'] ?>" <?= $t['MaTour'] == $doan['MaTour'] ? 'selected' : '' ?>>
                                <?= $t['TenTour'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h4 class="mt-4">Lịch trình tour</h4>

                <?php foreach ($lichtrinh as $lt): ?>
                    <div class="border p-3 mb-3 bg-light">

                        <h5>Ngày <?= $lt['NgayThu'] ?>: <?= $lt['TieuDe'] ?></h5>

                        <label class="form-label">Khách sạn</label>
                        <select name="khachsan[<?= $lt['NgayThu'] ?>]" class="form-control">
                            <option value="">-- Chọn khách sạn --</option>

                            <?php foreach ($hotels as $h): ?>
                                <option value="<?= $h['MaNhaCungCap'] ?>" <?= (isset($dvMap[$lt['NgayThu']]['khach_san'])
                                                                                && $dvMap[$lt['NgayThu']]['khach_san'] == $h['MaNhaCungCap'])
                                                                                ? 'selected' : '' ?>>
                                    <?= $h['TenNhaCungCap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label class="form-label mt-2">Nhà hàng</label>
                        <select name="nhahang[<?= $lt['NgayThu'] ?>]" class="form-control">
                            <option value="">-- Chọn nhà hàng --</option>

                            <?php foreach ($restaurants as $r): ?>
                                <option value="<?= $r['MaNhaCungCap'] ?>" <?= (isset($dvMap[$lt['NgayThu']]['nha_hang'])
                                                                                && $dvMap[$lt['NgayThu']]['nha_hang'] == $r['MaNhaCungCap'])
                                                                                ? 'selected' : '' ?>>
                                    <?= $r['TenNhaCungCap'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày đi</label>
                        <input type="date" name="NgayKhoiHanh" value="<?= $doan['NgayKhoiHanh'] ?>" class="form-control"
                            readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày về</label>
                        <input type="date" name="NgayVe" value="<?= $doan['NgayVe'] ?>" class="form-control" readonly>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giờ khởi hành</label>
                        <input type="time" name="GioKhoiHanh" value="<?= $doan['GioKhoiHanh'] ?>" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Điểm tập trung</label>
                    <input type="text" name="DiemTapTrung" class="form-control" value="<?= $doan['DiemTapTrung'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Hướng dẫn viên</label>
                    <select name="MaHuongDanVien" class="form-control">
                        <option value="">-Chọn--</option>
                        <?php foreach ($hdv as $h): ?>
                            <option value="<?= $h['MaNhanVien'] ?>"
                                <?= $h['MaNhanVien'] == $doan['MaHuongDanVien'] ? 'selected' : '' ?>>
                                <?= $h['HoTen'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tài xế</label>
                    <select name="MaTaiXe" class="form-control">
                        <option value="">-Chọn--</option>
                        <?php foreach ($taixe as $tx): ?>
                            <option value="<?= $tx['MaNhaCungCap'] ?>"
                                <?= $tx['MaNhaCungCap'] == $doan['MaTaiXe'] ? 'selected' : '' ?>>
                                <?= $tx['TenLaiXe'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số chỗ tối đa</label>
                    <input type="number" name="SoChoToiDa" value="<?= $doan['SoChoToiDa'] ?>" class="form-control">
                </div>

                <button name="btnUpdate" class="btn btn-primary">Cập nhật</button>
                <a href="index.php?act=listDKH" class="btn btn-secondary">Hủy</a>

            </form>

        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listDKH" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Cập Nhật Đoàn Khởi Hành</h3>
                        <p class="text-muted mb-0">Chỉnh sửa thông tin và dịch vụ cho đoàn</p>
                    </div>
                </div>
            </div>

            <form action="index.php?act=updateDKH" method="post">
                <input type="hidden" name="MaDoan" value="<?= $doan['MaDoan'] ?>">

                <div class="card card-form">
                    <div class="card-header-custom">
                        <h5 class="fw-bold text-warning mb-0"><i class="fas fa-edit me-2"></i> Thông Tin Cơ Bản</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Chọn Tour <span class="text-danger">*</span></label>
                                <select name="MaTour" class="form-select" required>
                                    <?php foreach ($tour as $t): ?>
                                        <option value="<?= $t['MaTour'] ?>" <?= $t['MaTour'] == $doan['MaTour'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($t['TenTour'] ?? '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày Khởi Hành</label>
                                <input type="date" name="NgayKhoiHanh" value="<?= $doan['NgayKhoiHanh'] ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày Về</label>
                                <input type="date" name="NgayVe" value="<?= $doan['NgayVe'] ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Giờ Khởi Hành</label>
                                <input type="time" name="GioKhoiHanh" value="<?= $doan['GioKhoiHanh'] ?>" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điểm Tập Trung</label>
                            <input type="text" name="DiemTapTrung" class="form-control" value="<?= htmlspecialchars($doan['DiemTapTrung'] ?? '') ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Hướng Dẫn Viên</label>
                                <select name="MaHuongDanVien" class="form-select">
                                    <option value="">-- Chọn HDV --</option>
                                    <?php foreach ($hdv as $h): ?>
                                        <option value="<?= $h['MaNhanVien'] ?>" <?= $h['MaNhanVien'] == $doan['MaHuongDanVien'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($h['HoTen'] ?? '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tài Xế / Xe</label>
                                <select name="MaTaiXe" class="form-select">
                                    <option value="">-- Chọn Nhà xe --</option>
                                    <?php foreach ($taixe as $tx): ?>
                                        <option value="<?= $tx['MaNhaCungCap'] ?>" <?= $tx['MaNhaCungCap'] == $doan['MaTaiXe'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($tx['TenLaiXe'] ?? '') ?> (<?= htmlspecialchars($tx['TenNhaCungCap'] ?? '') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Số Chỗ Tối Đa</label>
                                <input type="number" name="SoChoToiDa" value="<?= $doan['SoChoToiDa'] ?>" class="form-control" min="1">
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-concierge-bell me-2"></i> Dịch Vụ Theo Ngày</h5>
                
                <div class="row">
                    <?php if (!empty($lichtrinh)): ?>
                        <?php foreach ($lichtrinh as $lt): ?>
                        <div class="col-md-6">
                            <div class="schedule-item">
                                <div class="schedule-title">
                                    <i class="far fa-calendar-alt me-1"></i> 
                                    Ngày <?= htmlspecialchars($lt['NgayThu'] ?? '') ?>: <?= htmlspecialchars($lt['TieuDe'] ?? '') ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small text-muted"><i class="fas fa-hotel me-1"></i> Khách sạn</label>
                                    <select name="khachsan[<?= $lt['NgayThu'] ?>]" class="form-select form-select-sm">
                                        <option value="">-- Chọn khách sạn --</option>
                                        <?php foreach ($hotels as $h): ?>
                                            <option value="<?= $h['MaNhaCungCap'] ?>" 
                                                <?= (isset($dvMap[$lt['NgayThu']]['khach_san']) && $dvMap[$lt['NgayThu']]['khach_san'] == $h['MaNhaCungCap']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($h['TenNhaCungCap'] ?? '') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label small text-muted"><i class="fas fa-utensils me-1"></i> Nhà hàng</label>
                                    <select name="nhahang[<?= $lt['NgayThu'] ?>]" class="form-select form-select-sm">
                                        <option value="">-- Chọn nhà hàng --</option>
                                        <?php foreach ($restaurants as $r): ?>
                                            <option value="<?= $r['MaNhaCungCap'] ?>" 
                                                <?= (isset($dvMap[$lt['NgayThu']]['nha_hang']) && $dvMap[$lt['NgayThu']]['nha_hang'] == $r['MaNhaCungCap']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($r['TenNhaCungCap'] ?? '') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">Chưa có lịch trình cho tour này.</div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card card-form p-3 sticky-bottom text-end mt-3">
                    <a href="index.php?act=listDKH" class="btn btn-cancel me-2">Hủy bỏ</a>
                    <button type="submit" name="btnUpdate" class="btn btn-submit text-white">
                        <i class="fas fa-save me-2"></i> Lưu Cập Nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
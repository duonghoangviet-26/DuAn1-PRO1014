<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đoàn Khởi Hành</title>
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

        .card-info { border: none; border-radius: 12px; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.03); margin-bottom: 25px; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #e5e7eb; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #6b7280; font-weight: 500; }
        .info-val { font-weight: 600; color: #111827; }
        .timeline-day-card { border: 1px solid #e5e7eb; border-radius: 10px; margin-bottom: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .timeline-header { background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e5e7eb; border-radius: 10px 10px 0 0; }
        .timeline-body { padding: 20px; }
        
        .session-box { background: #f8fafc; border-radius: 8px; padding: 12px; margin-bottom: 10px; border-left: 4px solid #cbd5e1; }
        .session-morning { border-left-color: #f59e0b; }
        .session-noon { border-left-color: #ef4444; }
        .session-afternoon { border-left-color: #3b82f6; }
        .session-evening { border-left-color: #8b5cf6; }

        .service-tag { background: #e0f2fe; color: #0284c7; padding: 5px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; margin-right: 5px; display: inline-block; margin-bottom: 5px; }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listDKH" class="active"><i class="fa fa-users"></i> Quản lý đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content container mt-4">

        <h3 class="text-primary fw-bold mb-3">Chi tiết Đoàn khởi hành</h3>

        <div class="card p-3 mb-4">
            <h4 class="mb-3"><?= htmlspecialchars($tour['TenTour'] ?? '') ?></h4>

            <p><b>Ngày đi:</b> <?= htmlspecialchars($doan['NgayKhoiHanh'] ?? '') ?></p>
            <p><b>Ngày về:</b> <?= htmlspecialchars($doan['NgayVe'] ?? '') ?></p>
            <p><b>Giờ khởi hành:</b> <?= htmlspecialchars($doan['GioKhoiHanh'] ?? '') ?></p>
            <p><b>Điểm tập trung:</b> <?= htmlspecialchars($doan['DiemTapTrung'] ?? '') ?></p>

            <p><b>Hướng dẫn viên:</b>
                <?= ($hdv && isset($hdv['HoTen']))
                    ? htmlspecialchars($hdv['HoTen'])
                    : 'Chưa gán hướng dẫn viên'; ?>
            </p>


            <p><b>Tài xế:</b>
                <?= ($taixe && isset($taixe['TenLaiXe']))
                    ? htmlspecialchars($taixe['TenLaiXe'])
                    : 'Chưa gán tài xế'; ?>
            </p>

        </div>

        <h4 class="fw-bold mb-3">Lịch trình</h4>

        <?php if (!empty($lichtrinh)) : ?>
        <?php foreach ($lichtrinh as $lt) : ?>
        <?php
                $sang = array_filter(explode("\n", $lt['NoiDungSang']));
                $trua = array_filter(explode("\n", $lt['NoiDungTrua']));
                $chieu = array_filter(explode("\n", $lt['NoiDungChieu']));
                $toi = array_filter(explode("\n", $lt['NoiDungToi']));
                ?>
        <div class="card p-3 mb-4 border">

            <h5 class="fw-bold text-primary">
                Ngày <?= htmlspecialchars($lt['NgayThu']) ?> – <?= htmlspecialchars($lt['TieuDeNgay']) ?>
            </h5>

            <p><b>Giờ tập trung:</b> <?= htmlspecialchars($lt['GioTapTrung']) ?></p>
            <p><b>Giờ xuất phát:</b> <?= htmlspecialchars($lt['GioXuatPhat']) ?></p>
            <p><b>Giờ kết thúc:</b> <?= htmlspecialchars($lt['GioKetThuc']) ?></p>

            <?php
                    $khachsan = "Chưa gán";
                    $nhahang = "Chưa gán";

                    $ngaySuDung = date('Y-m-d', strtotime($doan['NgayKhoiHanh'] . ' + ' . ($lt['NgayThu'] - 1) . ' days'));

                    foreach ($nccTheoNgay as $n) {

                        if ($n['NgaySuDung'] == $ngaySuDung) {

                            if ($n['LoaiDichVu'] == 'khach_san') {
                                $khachsan = $n['TenNhaCungCap'];
                            }

                            if ($n['LoaiDichVu'] == 'nha_hang') {
                                $nhahang = $n['TenNhaCungCap'];
                            }
                        }
                    }
                    ?>
            <p><b>🏨 Khách sạn:</b> <?= htmlspecialchars($khachsan) ?></p>
            <p><b>🍽 Nhà hàng:</b> <?= htmlspecialchars($nhahang) ?></p>



            <hr>

            <!-- BUỔI SÁNG -->
            <h6 class="mt-3 text-success">🌅 Hoạt động buổi sáng</h6>
            <?php if (!empty($sang)) : ?>
            <?php foreach ($sang as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI TRƯA -->
            <h6 class="mt-3 text-warning">🍽 Hoạt động buổi trưa</h6>
            <?php if (!empty($trua)) : ?>
            <?php foreach ($trua as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI CHIỀU -->
            <h6 class="mt-3 text-info">🌇 Hoạt động buổi chiều</h6>
            <?php if (!empty($chieu)) : ?>
            <?php foreach ($chieu as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI TỐI -->
            <h6 class="mt-3 text-danger">🌙 Hoạt động buổi tối</h6>
            <?php if (!empty($toi)) : ?>
            <?php foreach ($toi as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

        </div>

        <?php endforeach; ?>
        <?php else : ?>
        <div class="alert alert-info">Chưa có lịch trình cho tour này.</div>
        <?php endif; ?>
        <div class="text-center mt-4 mb-5">
            <a href="index.php?act=listDKH" class="btn btn-secondary px-4">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listDKH" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Chi Tiết Đoàn Khởi Hành</h3>
                        <p class="text-muted mb-0">Thông tin chi tiết về chuyến đi</p>
                    </div>
                </div>
                <div>
                    <a href="index.php?act=editDKH&id=<?= $doan['MaDoan'] ?>" class="btn btn-warning text-white shadow-sm">
                        <i class="fas fa-edit me-1"></i> Chỉnh Sửa
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-info p-4">
                        <h5 class="fw-bold text-primary mb-3"><i class="fas fa-info-circle me-2"></i> Thông Tin Chung</h5>
                        
                        <div class="mb-3 pb-3 border-bottom">
                            <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($tour['TenTour'] ?? '') ?></h5>
                            <span class="badge bg-secondary">Mã Đoàn: #<?= $doan['MaDoan'] ?></span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Ngày đi:</span>
                            <span class="info-val text-success"><?= date('d/m/Y', strtotime($doan['NgayKhoiHanh'])) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Ngày về:</span>
                            <span class="info-val text-danger"><?= date('d/m/Y', strtotime($doan['NgayVe'])) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Giờ khởi hành:</span>
                            <span class="info-val"><?= $doan['GioKhoiHanh'] ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Điểm tập trung:</span>
                            <span class="info-val text-end" style="max-width: 60%;"><?= htmlspecialchars($doan['DiemTapTrung']) ?></span>
                        </div>
                    </div>

                    <div class="card card-info p-4">
                        <h5 class="fw-bold text-success mb-3"><i class="fas fa-users me-2"></i> Nhân Sự Phụ Trách</h5>
                        
                        <div class="info-row">
                            <span class="info-label">Hướng dẫn viên:</span>
                            <span class="info-val text-primary">
                                <?= ($hdv && isset($hdv['HoTen'])) ? htmlspecialchars($hdv['HoTen']) : '<span class="text-muted fst-italic">Chưa gán</span>' ?>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tài xế / Xe:</span>
                            <span class="info-val text-secondary">
                                <?= ($taixe && isset($taixe['TenLaiXe'])) ? htmlspecialchars($taixe['TenLaiXe']) : '<span class="text-muted fst-italic">Chưa gán</span>' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h4 class="fw-bold text-dark mb-3"><i class="fas fa-calendar-alt me-2"></i> Lịch Trình Chi Tiết</h4>

                    <?php if (!empty($lichtrinh)) : ?>
                        <?php foreach ($lichtrinh as $lt) : ?>
                            <?php
                                $sang = array_filter(explode("\n", $lt['NoiDungSang']));
                                $trua = array_filter(explode("\n", $lt['NoiDungTrua']));
                                $chieu = array_filter(explode("\n", $lt['NoiDungChieu']));
                                $toi = array_filter(explode("\n", $lt['NoiDungToi']));
                                $khachsan = "Chưa gán";
                                $nhahang = "Chưa gán";
                                $ngaySuDung = date('Y-m-d', strtotime($doan['NgayKhoiHanh'] . ' + ' . ($lt['NgayThu'] - 1) . ' days'));

                                foreach ($nccTheoNgay as $n) {
                                    if ($n['NgaySuDung'] == $ngaySuDung) {
                                        if ($n['LoaiDichVu'] == 'khach_san') $khachsan = $n['TenNhaCungCap'];
                                        if ($n['LoaiDichVu'] == 'nha_hang') $nhahang = $n['TenNhaCungCap'];
                                    }
                                }
                            ?>

                            <div class="timeline-day-card">
                                <div class="timeline-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        NGÀY <?= $lt['NgayThu'] ?>: <?= htmlspecialchars($lt['TieuDeNgay']) ?>
                                    </h6>
                                    <span class="badge bg-light text-dark border"><?= date('d/m/Y', strtotime($ngaySuDung)) ?></span>
                                </div>
                                <div class="timeline-body">
                                    
                                    <div class="row g-2 mb-3 small text-muted border-bottom pb-3">
                                        <div class="col-auto"><i class="far fa-clock me-1"></i> Tập trung: <?= $lt['GioTapTrung'] ?></div>
                                        <div class="col-auto">|</div>
                                        <div class="col-auto"><i class="fas fa-play me-1"></i> Xuất phát: <?= $lt['GioXuatPhat'] ?></div>
                                        <div class="col-auto">|</div>
                                        <div class="col-auto"><i class="fas fa-stop me-1"></i> Kết thúc: <?= $lt['GioKetThuc'] ?></div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="service-tag"><i class="fas fa-hotel me-1"></i> <?= htmlspecialchars($khachsan) ?></div>
                                        <div class="service-tag"><i class="fas fa-utensils me-1"></i> <?= htmlspecialchars($nhahang) ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="session-box session-morning">
                                                <div class="fw-bold text-warning small mb-1"><i class="fas fa-sun me-1"></i> BUỔI SÁNG</div>
                                                <?php if (!empty($sang)) : ?>
                                                    <ul class="mb-0 ps-3 small text-secondary">
                                                        <?php foreach ($sang as $line) : ?><li><?= htmlspecialchars($line) ?></li><?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?><span class="small text-muted italic">Không có hoạt động</span><?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="session-box session-noon">
                                                <div class="fw-bold text-danger small mb-1"><i class="fas fa-utensils me-1"></i> BUỔI TRƯA</div>
                                                <?php if (!empty($trua)) : ?>
                                                    <ul class="mb-0 ps-3 small text-secondary">
                                                        <?php foreach ($trua as $line) : ?><li><?= htmlspecialchars($line) ?></li><?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?><span class="small text-muted italic">Không có hoạt động</span><?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="session-box session-afternoon">
                                                <div class="fw-bold text-primary small mb-1"><i class="fas fa-cloud-sun me-1"></i> BUỔI CHIỀU</div>
                                                <?php if (!empty($chieu)) : ?>
                                                    <ul class="mb-0 ps-3 small text-secondary">
                                                        <?php foreach ($chieu as $line) : ?><li><?= htmlspecialchars($line) ?></li><?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?><span class="small text-muted italic">Không có hoạt động</span><?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="session-box session-evening">
                                                <div class="fw-bold text-info small mb-1"><i class="fas fa-moon me-1"></i> BUỔI TỐI</div>
                                                <?php if (!empty($toi)) : ?>
                                                    <ul class="mb-0 ps-3 small text-secondary">
                                                        <?php foreach ($toi as $line) : ?><li><?= htmlspecialchars($line) ?></li><?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?><span class="small text-muted italic">Không có hoạt động</span><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-info text-center py-4 border-0 shadow-sm">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <p>Chưa có lịch trình chi tiết cho tour này.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tour</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .tour-header-img { width: 100%; height: 350px; object-fit: cover; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px; }
        
        .card-info { border: none; border-radius: 12px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 25px; }
        .card-title-custom { font-weight: 700; color: #1f2937; margin-bottom: 20px; font-size: 1.1rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 10px; }
        
        .info-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px dashed #e5e7eb; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #6b7280; font-weight: 500; }
        .info-val { font-weight: 600; color: #111827; }
        
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; }
        .active-status { background: #dcfce7; color: #166534; }
        .pause-status { background: #fef3c7; color: #92400e; }
        .stop-status { background: #f3f4f6; color: #4b5563; }

        .timeline-item { border-left: 3px solid #3b82f6; padding-left: 25px; position: relative; padding-bottom: 30px; }
        .timeline-item::before { content: ""; width: 12px; height: 12px; background: #3b82f6; border-radius: 50%; position: absolute; left: -7.5px; top: 0; box-shadow: 0 0 0 4px #e0f2fe; }
        .timeline-item:last-child { padding-bottom: 0; border-left-color: transparent; }
        .timeline-day { font-weight: 800; color: #3b82f6; font-size: 1.1rem; margin-bottom: 10px; display: block; }
        
        .session-box { background: #f8fafc; border-radius: 8px; padding: 12px; margin-bottom: 10px; border: 1px solid #e5e7eb; }
        .session-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; color: #64748b; }
        
        .btn-edit-float { position: fixed; bottom: 30px; right: 30px; border-radius: 50px; padding: 12px 25px; font-weight: 600; box-shadow: 0 5px 20px rgba(245, 158, 11, 0.4); z-index: 999; }
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
            <a href="index.php?act=listTour" class="active"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
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
            
            <div class="d-flex align-items-center mb-4">
                <a href="index.php?act=listTour" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Chi Tiết Tour</h3>
                    <p class="text-muted mb-0">Mã Tour: <strong>#<?= $tour['MaTour'] ?></strong></p>
                </div>
            </div>

            <?php if (!empty($tour['LinkAnhBia'])): ?>
                <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $tour['LinkAnhBia'] ?>" class="tour-header-img" alt="Ảnh bìa tour">
            <?php else: ?>
                <div class="tour-header-img bg-light d-flex align-items-center justify-content-center text-muted fs-4">Chưa có ảnh bìa</div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-info p-4">
                        <h5 class="card-title-custom"><i class="fas fa-info-circle me-2 text-primary"></i>Thông Tin Chung</h5>
                        
                        <div class="mb-3">
                            <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($tour['TenTour']) ?></h5>
                            <span class="badge bg-secondary"><?= htmlspecialchars($tour['TenDanhMuc']) ?></span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Giá bán:</span>
                            <span class="info-val text-danger fs-5"><?= number_format($tour['GiaBanMacDinh'], 0, ',', '.') ?>đ</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Giá vốn:</span>
                            <span class="info-val text-muted"><?= $tour['GiaVonDuKien'] ? number_format($tour['GiaVonDuKien'], 0, ',', '.').'đ' : '—' ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Thời gian:</span>
                            <span class="info-val"><?= $tour['SoNgay'] ?> Ngày <?= $tour['SoDem'] ?> Đêm</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Khởi hành:</span>
                            <span class="info-val"><?= htmlspecialchars($tour['DiemKhoiHanh']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Trạng thái:</span>
                            <span class="info-val">
                                <?php if ($tour['TrangThai'] == 'hoat_dong'): ?>
                                    <span class="badge badge-status active-status">Hoạt động</span>
                                <?php elseif ($tour['TrangThai'] == 'tam_dung'): ?>
                                    <span class="badge badge-status pause-status">Tạm dừng</span>
                                <?php else: ?>
                                    <span class="badge badge-status stop-status">Đã kết thúc</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Ngày tạo:</span>
                            <span class="info-val small text-muted"><?= date("d/m/Y H:i", strtotime($tour['NgayTao'])) ?></span>
                        </div>
                    </div>

                    <div class="card card-info p-4">
                        <h5 class="card-title-custom"><i class="fas fa-file-alt me-2 text-warning"></i>Mô Tả</h5>
                        <p class="text-secondary small mb-0 text-justify">
                            <?= nl2br(htmlspecialchars($tour['MoTa'])) ?>
                        </p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-info p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title-custom mb-0 border-0 pb-0"><i class="fas fa-calendar-alt me-2 text-success"></i>Lịch Trình Chi Tiết</h5>
                        </div>

                        <?php if (!empty($lichTrinh)): ?>
                            <div class="ps-2">
                                <?php foreach ($lichTrinh as $lt): ?>
                                    <div class="timeline-item">
                                        <span class="timeline-day">NGÀY <?= $lt['NgayThu'] ?>: <?= htmlspecialchars($lt['TieuDeNgay']) ?></span>
                                        
                                        <div class="row g-2 mb-3 small text-muted">
                                            <div class="col-auto"><i class="fas fa-map-marker-alt text-danger"></i> <?= $lt['DiaDiemThamQuan'] ?: 'Chưa cập nhật' ?></div>
                                            <div class="col-auto">|</div>
                                            <div class="col-auto"><i class="fas fa-bed text-primary"></i> <?= $lt['NoiO'] ?: 'Chưa cập nhật' ?></div>
                                        </div>

                                        <?php if(!empty($lt['NoiDungSang'])): ?>
                                        <div class="session-box">
                                            <div class="session-title"><i class="fas fa-sun text-warning me-1"></i> Sáng</div>
                                            <div class="small"><?= nl2br(htmlspecialchars($lt['NoiDungSang'])) ?></div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty($lt['NoiDungTrua'])): ?>
                                        <div class="session-box">
                                            <div class="session-title"><i class="fas fa-utensils text-danger me-1"></i> Trưa</div>
                                            <div class="small"><?= nl2br(htmlspecialchars($lt['NoiDungTrua'])) ?></div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty($lt['NoiDungChieu'])): ?>
                                        <div class="session-box">
                                            <div class="session-title"><i class="fas fa-cloud-sun text-primary me-1"></i> Chiều</div>
                                            <div class="small"><?= nl2br(htmlspecialchars($lt['NoiDungChieu'])) ?></div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty($lt['NoiDungToi'])): ?>
                                        <div class="session-box">
                                            <div class="session-title"><i class="fas fa-moon text-info me-1"></i> Tối</div>
                                            <div class="small"><?= nl2br(htmlspecialchars($lt['NoiDungToi'])) ?></div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="mt-2 small text-secondary">
                                            <i class="fas fa-utensils me-1"></i> Ăn: 
                                            <?= $lt['CoBuaSang'] ? '<span class="text-success fw-bold">Sáng</span>' : '<span class="text-muted text-decoration-line-through">Sáng</span>' ?> - 
                                            <?= $lt['CoBuaTrua'] ? '<span class="text-success fw-bold">Trưa</span>' : '<span class="text-muted text-decoration-line-through">Trưa</span>' ?> - 
                                            <?= $lt['CoBuaToi'] ? '<span class="text-success fw-bold">Tối</span>' : '<span class="text-muted text-decoration-line-through">Tối</span>' ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-light text-center">Chưa có thông tin lịch trình.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <a href="index.php?act=editTour&id=<?= $tour['MaTour'] ?>" class="btn btn-warning text-white btn-edit-float">
                <i class="fas fa-pen me-2"></i> Chỉnh Sửa Tour
            </a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
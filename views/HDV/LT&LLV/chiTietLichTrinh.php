<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Lịch Trình</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f5f8fa; font-family: 'Segoe UI', sans-serif; }
        
        .timeline-container { position: relative; padding-left: 20px; }
        .timeline-container::before {
            content: ''; position: absolute; left: 20px; top: 0; bottom: 0;
            width: 4px; background: #e9ecef; border-radius: 2px;
        }

        .day-block { position: relative; margin-bottom: 40px; }
        
        .day-badge {
            position: relative; margin-bottom: 20px; z-index: 2;
            display: inline-block;
        }
        .day-badge span {
            background: #0d5e56; color: white; padding: 8px 20px;
            border-radius: 50px; font-weight: bold; box-shadow: 0 4px 10px rgba(13, 94, 86, 0.3);
        }

        .timeline-card {
            background: white; border: none; border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05); margin-left: 30px;
            position: relative; overflow: hidden;
        }
        .timeline-card::before {
            content: ''; position: absolute; left: -36px; top: 25px;
            width: 20px; height: 20px; background: #0d5e56;
            border: 4px solid #fff; border-radius: 50%; box-shadow: 0 0 0 3px #e9ecef;
        }

        .session-block {
            border-bottom: 1px dashed #eee; padding: 15px 20px;
        }
        .session-block:last-child { border-bottom: none; }
        
        .session-title {
            font-weight: 700; color: #0d5e56; margin-bottom: 8px; text-transform: uppercase; font-size: 0.85rem;
        }
        .session-content { color: #555; white-space: pre-line; line-height: 1.6; }

        .time-box {
            display: inline-block; background: #eef2f5; color: #333;
            padding: 4px 10px; border-radius: 6px; font-size: 0.9rem; font-weight: 600;
            margin-right: 10px; margin-bottom: 10px;
        }

        .info-card {
            background: white; border-radius: 12px;
            border-top: 5px solid #0d5e56;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

    <div class="container py-5" style="max-width: 900px;">
        
        <div class="d-flex align-items-center mb-4">
            <a href="index.php?act=hdv_schedule" class="btn btn-outline-secondary me-3 rounded-circle" style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3 class="mb-0 fw-bold text-dark">Chi Tiết Lịch Trình</h3>
        </div>

        <div class="info-card p-4 mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    
                    <div class="text-muted mb-3">
                        <i class="fas fa-barcode me-1"></i> Mã Đoàn: <strong><?= $thongTinChung['MaDoan'] ?></strong> &bull; 
                        <i class="far fa-calendar-alt me-1 ms-2"></i> Khởi hành: <strong><?= date('d/m/Y', strtotime($thongTinChung['NgayKhoiHanh'])) ?></strong>
                    </div>
                    <?php if (!empty($thongTinChung['GhiChu'])): ?>
                        <div class="alert alert-warning d-inline-block py-2 px-3 mb-0">
                            <i class="fas fa-sticky-note me-2"></i> <strong>Ghi chú công việc:</strong> <?= $thongTinChung['GhiChu'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" alt="Tour Icon" style="width: 80px; opacity: 0.8;">
                </div>
            </div>
        </div>

        <h5 class="fw-bold mb-4 ps-2 border-start border-4 border-success"> <i class="fas fa-list-ul me-2"></i> LỘ TRÌNH CHI TIẾT</h5>

        <?php if (empty($lichTrinhChiTiet)): ?>
            <div class="text-center text-muted py-5 card bg-light border-0">
                <i class="fas fa-search fa-3x mb-3 opacity-25"></i>
                <p>Chưa có dữ liệu lịch trình chi tiết cho tour này.</p>
            </div>
        <?php else: ?>
            
            <div class="timeline-container">
                <?php foreach ($lichTrinhChiTiet as $ngay): 
                    $ngayThucTe = date('d/m/Y', strtotime($thongTinChung['NgayKhoiHanh'] . ' + ' . ($ngay['NgayThu'] - 1) . ' days'));
                ?>
                
                <div class="day-block">
                    <div class="day-badge">
                        <span>NGÀY <?= $ngay['NgayThu'] ?> <small class="fw-normal ms-1 opacity-75">(<?= $ngayThucTe ?>)</small></span>
                    </div>

                    <div class="timeline-card">
                        <div class="p-3 bg-light border-bottom">
                            <h5 class="fw-bold text-dark mb-1"><?= $ngay['TieuDeNgay'] ?></h5>
                            <?php if(!empty($ngay['DiaDiemThamQuan'])): ?>
                                <small class="text-primary"><i class="fas fa-map-marker-alt me-1"></i> <?= $ngay['DiaDiemThamQuan'] ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="p-3 border-bottom bg-white d-flex flex-wrap">
                            <?php if(!empty($ngay['GioTapTrung']) && $ngay['GioTapTrung'] != '00:00:00'): ?>
                                <div class="time-box"><i class="far fa-clock text-danger"></i> Tập trung: <?= date('H:i', strtotime($ngay['GioTapTrung'])) ?></div>
                            <?php endif; ?>
                            <?php if(!empty($ngay['GioXuatPhat']) && $ngay['GioXuatPhat'] != '00:00:00'): ?>
                                <div class="time-box"><i class="fas fa-bus text-success"></i> Xuất phát: <?= date('H:i', strtotime($ngay['GioXuatPhat'])) ?></div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($ngay['NoiDungSang'])): ?>
                            <div class="session-block">
                                <div class="session-title text-warning"><i class="fas fa-sun me-1"></i> Buổi Sáng</div>
                                <div class="session-content">
                                    <?= nl2br($ngay['NoiDungSang']) ?>
                                    <?php if($ngay['CoBuaSang']) echo '<div class="mt-2 badge bg-success bg-opacity-10 text-success border border-success"><i class="fas fa-utensils me-1"></i> Có bữa sáng</div>'; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($ngay['NoiDungTrua'])): ?>
                            <div class="session-block">
                                <div class="session-title text-danger"><i class="fas fa-sun me-1"></i> Buổi Trưa</div>
                                <div class="session-content">
                                    <?= nl2br($ngay['NoiDungTrua']) ?>
                                    <?php if($ngay['CoBuaTrua']) echo '<div class="mt-2 badge bg-success bg-opacity-10 text-success border border-success"><i class="fas fa-utensils me-1"></i> Có bữa trưa</div>'; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($ngay['NoiDungChieu'])): ?>
                            <div class="session-block">
                                <div class="session-title text-primary"><i class="fas fa-cloud-sun me-1"></i> Buổi Chiều</div>
                                <div class="session-content">
                                    <?= nl2br($ngay['NoiDungChieu']) ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($ngay['NoiDungToi'])): ?>
                            <div class="session-block">
                                <div class="session-title text-dark"><i class="fas fa-moon me-1"></i> Buổi Tối</div>
                                <div class="session-content">
                                    <?= nl2br($ngay['NoiDungToi']) ?>
                                    <?php if($ngay['CoBuaToi']) echo '<div class="mt-2 badge bg-success bg-opacity-10 text-success border border-success"><i class="fas fa-utensils me-1"></i> Có bữa tối</div>'; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($ngay['NoiO'])): ?>
                            <div class="p-3 bg-light border-top">
                                <i class="fas fa-bed text-primary me-2"></i> <strong>Nghỉ đêm:</strong> <?= $ngay['NoiO'] ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <div class="text-center mt-5 mb-5">
            <button class="btn btn-success px-4 py-2 rounded-pill shadow" onclick="window.print()">
                <i class="fas fa-print me-2"></i> In Lịch Trình
            </button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
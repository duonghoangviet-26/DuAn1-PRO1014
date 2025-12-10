<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Tour Viết Nhật Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #0a7b80; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        
        .card-tour { border: none; border-radius: 15px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-tour:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV" style="background: #0a7b80; color: #fff;"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <hr style="color: #aad;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <h3 class="mb-4 fw-bold text-primary">Chọn Tour Cần Ghi Nhật Ký / Điểm Danh</h3>
        
        <div class="row g-4">
            <?php if(empty($listTour)): ?>
                <div class="col-12 text-center text-muted py-5">
                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                    <p>Bạn chưa được phân công tour nào đang hoạt động.</p>
                </div>
            <?php else: ?>
                <?php foreach($listTour as $tour): ?>
                <div class="col-md-4">
                    <div class="card card-tour h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark"><?= $tour['TenTour'] ?></h5>
                            <p class="card-text text-muted mb-2"><i class="fa-solid fa-barcode"></i> Mã đoàn: <strong><?= $tour['MaDoan'] ?></strong></p>
                            <p class="card-text text-muted mb-3"><i class="fa-regular fa-calendar"></i> <?= date('d/m/Y', strtotime($tour['NgayKhoiHanh'])) ?> - <?= date('d/m/Y', strtotime($tour['NgayVe'])) ?></p>
                            
                            <div class="d-flex gap-2 mt-3">
                                <a href="index.php?act=listNhatKy&maDoan=<?= $tour['MaDoan'] ?>" class="btn btn-outline-primary flex-grow-1 fw-bold">
                                    <i class="fa-solid fa-book-open me-1"></i> Nhật Ký
                                </a>

                                <?php if (!empty($tour['MaLichLamViec'])): ?>
                                    <a href="index.php?act=historyDiemDanh&maDoan=<?= $tour['MaDoan'] ?>" class="btn btn-info flex-grow-1 fw-bold text-white">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Lịch Sử Điểm Danh
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-secondary flex-grow-1 fw-bold" disabled>
                                        <i class="fa-solid fa-ban me-1"></i> Chưa có Lịch
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
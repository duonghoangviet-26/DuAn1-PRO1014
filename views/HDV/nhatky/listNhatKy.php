<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhật Ký Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar h4 { text-align: center; margin-bottom: 30px; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; font-size: 16px; transition: 0.3s; }
        .sidebar a:hover { background: #0a7b80; color: #fff; }
        
        .content { margin-left: 260px; padding: 30px; }
        
        .timeline-item { border-left: 4px solid #085f63; padding-left: 20px; margin-bottom: 30px; position: relative; }
        .timeline-item::before { content: ''; width: 14px; height: 14px; background: #085f63; border-radius: 50%; position: absolute; left: -9px; top: 5px; }
        .img-nhatky { max-width: 200px; border-radius: 8px; margin-top: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .badge-su-co { background-color: #dc3545; color: white; }
        .badge-normal { background-color: #198754; color: white; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
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
        <div class="mb-3">
            <a href="index.php?act=listTourOfHDV" class="text-secondary text-decoration-none">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary m-0">Nhật Ký: <?= $thongTinDoan['TenTour'] ?></h3>
                <span class="badge bg-secondary">Đoàn: <?= $thongTinDoan['MaDoan'] ?></span>
            </div>
            <a href="index.php?act=addNhatKy&maDoan=<?= $thongTinDoan['MaDoan'] ?>" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Viết Nhật Ký Mới
            </a>
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <?php if (empty($listNhatKy)): ?>
                <div class="text-center text-muted py-5">
                    <i class="fa-regular fa-clipboard fa-3x mb-3"></i>
                    <p>Chưa có nhật ký nào.</p>
                </div>
            <?php else: ?>
                <?php foreach ($listNhatKy as $nk): ?>
                    <div class="timeline-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1">
                                    <?= date('H:i', strtotime($nk['GioGhi'])) ?> - Ngày <?= date('d/m/Y', strtotime($nk['NgayGhi'])) ?>
                                </h5>
                                <div class="mt-1">
                                    <?php if ($nk['LoaiSuCo'] == 'Bình thường'): ?>
                                        <span class="badge badge-normal">Hoạt động bình thường</span>
                                    <?php else: ?>
                                        <span class="badge badge-su-co"><?= $nk['LoaiSuCo'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <p class="mt-3 text-dark" style="font-size: 1.05rem; white-space: pre-line;">
                            <?= $nk['NoiDung'] ?>
                        </p>
                        
                        <?php if (!empty($nk['LinkAnh'])): ?>
                            <a href="./uploads/nhatky/<?= $nk['LinkAnh'] ?>" target="_blank">
                                <img src="./uploads/nhatky/<?= $nk['LinkAnh'] ?>" class="img-nhatky" alt="Ảnh nhật ký">
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
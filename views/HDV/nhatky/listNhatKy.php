<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhật Ký Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; }
        .content { margin-left: 260px; padding: 30px; }
        .timeline-item { border-left: 3px solid #085f63; padding-left: 20px; margin-bottom: 30px; position: relative; }
        .timeline-item::before { content: ''; width: 12px; height: 12px; background: #085f63; border-radius: 50%; position: absolute; left: -7.5px; top: 5px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4">HDV Panel</h4>
        <a href="index.php?act=listTourOfHDV" style="background: #0a7b80;">Quay lại danh sách Tour</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-primary">Nhật Ký: <?= $thongTinDoan['TenTour'] ?></h4>
                <span class="badge bg-secondary">Đoàn: <?= $thongTinDoan['MaDoan'] ?></span>
            </div>
            <a href="index.php?act=addNhatKy&maDoan=<?= $thongTinDoan['MaDoan'] ?>" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Viết Nhật Ký Mới
            </a>
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <?php if(empty($listNhatKy)): ?>
                <p class="text-center text-muted">Chưa có nhật ký nào.</p>
            <?php else: ?>
                <?php foreach($listNhatKy as $nk): ?>
                <div class="timeline-item">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold text-dark">
                            <?= date('H:i', strtotime($nk['GioGhi'])) ?> - <?= date('d/m/Y', strtotime($nk['NgayGhi'])) ?>
                            <?php if($nk['LoaiSuCo'] != 'Bình thường'): ?>
                                <span class="badge bg-danger ms-2"><?= $nk['LoaiSuCo'] ?></span>
                            <?php else: ?>
                                <span class="badge bg-success ms-2">Bình thường</span>
                            <?php endif; ?>
                        </h6>
                        <div>
                            <a href="index.php?act=editNhatKy&id=<?= $nk['MaNhatKy'] ?>" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-edit"></i></a>
                            <a href="index.php?act=deleteNhatKy&id=<?= $nk['MaNhatKy'] ?>&maDoan=<?= $nk['MaDoan'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa nhật ký này?')"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                    <p class="mt-2 text-secondary"><?= nl2br($nk['NoiDung']) ?></p>
                    <?php if(!empty($nk['LinkAnh'])): ?>
                        <img src="./uploads/nhatky/<?= $nk['LinkAnh'] ?>" width="150" class="rounded shadow-sm">
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhật Ký Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        background: #f5f8fa;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
        color: #ecf0f1;
        padding-top: 20px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        z-index: 1000;
    }

    .sidebar-header {
        padding: 0 25px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 15px;
    }

    .sidebar-header h4 {
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff;
        display: flex;
        align-items: center;
    }

    .sidebar-menu {
        padding: 0 10px;
    }

    .sidebar-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #95a5a6;
        margin: 15px 15px 5px;
        font-weight: 600;
    }

    .sidebar a {
        color: #bdc3c7;
        padding: 12px 15px;
        text-decoration: none;
        display: flex;
        align-items: center;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        margin-bottom: 5px;
    }

    .sidebar a i {
        width: 25px;
        text-align: center;
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar a.active {
        background-color: #3498db;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }



    .content {
        margin-left: 260px;
        padding: 30px;
    }

    .timeline-item {
        border-left: 4px solid #085f63;
        padding-left: 20px;
        margin-bottom: 30px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        width: 14px;
        height: 14px;
        background: #085f63;
        border-radius: 50%;
        position: absolute;
        left: -9px;
        top: 5px;
    }

    .img-nhatky {
        max-width: 200px;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .badge-su-co {
        background-color: #dc3545;
        color: white;
    }

    .badge-normal {
        background-color: #198754;
        color: white;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>

        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard" class="active"><i class="fa fa-home"></i> Trang chủ</a>

            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>

            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng
                xuất</a>
        </div>
    </div>

    <div class="content">
        <div class="mb-3">
            <a href="index.php?act=listDKH" class="text-secondary text-decoration-none">
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
                            <?= date('H:i', strtotime($nk['GioGhi'])) ?> - Ngày
                            <?= date('d/m/Y', strtotime($nk['NgayGhi'])) ?>
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
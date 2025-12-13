<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Trình Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    body {
        background: #f5f8fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        background: #085f63;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 30px;
        color: white;
        z-index: 1000;
    }

    .sidebar h4 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .sidebar a {
        color: #d9f7f5;
        text-decoration: none;
        padding: 12px 20px;
        display: block;
        font-size: 16px;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #0a7b80;
        color: #fff;
    }

    .sidebar a.active {
        background: #0a7b80;
        color: #fff;
        border-left: 4px solid #ffc107;
    }

    .content {
        margin-left: 260px;
        padding: 30px;
    }

    .card-schedule {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        background: white;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .card-schedule:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-schedule::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
    }

    .status-ranh::before {
        background-color: #0dcaf0;
    }

    .status-ban::before {
        background-color: #ffc107;
    }

    .status-nghi::before {
        background-color: #198754;
    }

    .date-col {
        min-width: 100px;
        text-align: center;
        border-right: 1px dashed #e0e0e0;
        padding-right: 20px;
    }

    .date-day {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1;
        color: #333;
    }

    .date-month {
        font-size: 0.9rem;
        text-transform: uppercase;
        color: #888;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .date-year {
        font-size: 0.85rem;
        color: #aaa;
    }

    .info-col {
        padding-left: 20px;
        flex-grow: 1;
    }

    .tour-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #085f63;
        margin-bottom: 5px;
    }

    .tour-meta {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .tour-meta i {
        color: #888;
    }

    .note-box {
        background-color: #fff8e1;
        border-left: 3px solid #ffc107;
        padding: 8px 12px;
        font-size: 0.9rem;
        color: #555;
        border-radius: 4px;
        margin-top: 10px;
        display: inline-block;
        width: 100%;
    }

    .action-col {
        min-width: 220px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-custom {
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 6px 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: 0.2s;
        flex: 1;
        min-width: 100px;
    }

    .btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .badge-status {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .badge-ranh {
        background-color: #e0f7fa;
        color: #006064;
    }

    .badge-ban {
        background-color: #fff3cd;
        color: #856404;
    }

    .badge-nghi {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .nav-pills .nav-link {
        color: #555;
        font-weight: 600;
        border: 1px solid #ddd;
        margin-right: 8px;
        border-radius: 6px;
    }

    .nav-pills .nav-link.active {
        background-color: #085f63;
        color: white;
        border-color: #085f63;
    }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>

        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule" class="active"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch
            làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="#"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>

        <hr style="border-color: #aad; margin: 20px;">

        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #085f63;">Lịch Trình Của Bạn</h3>
            <button class="btn btn-outline-secondary btn-sm" onclick="window.print()"><i class="fas fa-print me-1"></i>
                In lịch</button>
        </div>

        <ul class="nav nav-pills mb-4" id="pills-tab">
            <li class="nav-item"><button class="nav-link active" onclick="filterSchedule('all', this)">Tất cả</button>
            </li>
            <li class="nav-item"><button class="nav-link bg-white" onclick="filterSchedule('active', this)">Sắp tới /
                    Đang đi</button></li>
            <li class="nav-item"><button class="nav-link bg-white" onclick="filterSchedule('completed', this)">Đã hoàn
                    thành</button></li>
        </ul>

        <div class="schedule-list">
            <?php if (empty($ds_lich)): ?>
            <div class="alert alert-light text-center py-5 border shadow-sm">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3 opacity-50"></i><br>
                Hiện tại bạn chưa có lịch phân công nào.
            </div>
            <?php else: ?>
            <?php foreach ($ds_lich as $lich): 
                    $statusDoan = $lich['TrangThaiDoan'] ?? 'san_sang'; 
                    
                    $badgeText = 'Sẵn sàng';
                    $badgeClass = 'bg-info text-dark';
                    $cardStatusClass = 'status-ranh';
                    
                    if ($statusDoan == 'dang_dien_ra') {
                        $badgeText = 'Đang diễn ra';
                        $badgeClass = 'bg-warning text-dark';
                        $cardStatusClass = 'status-ban';
                    } elseif ($statusDoan == 'da_ket_thuc') {
                        $badgeText = 'Đã kết thúc';
                        $badgeClass = 'bg-secondary text-white';
                        $cardStatusClass = 'status-nghi';
                    } elseif ($statusDoan == 'da_huy') {
                         $badgeText = 'Đã hủy';
                         $badgeClass = 'bg-danger text-white';
                         $cardStatusClass = 'status-nghi';
                    }


                    $ngay = date('d', strtotime($lich['NgayLamViec']));
                    $thang = date('M', strtotime($lich['NgayLamViec']));
                    $nam = date('Y', strtotime($lich['NgayLamViec']));
                ?>

            <div class="card-schedule p-3 d-flex flex-column flex-md-row align-items-center <?= $cardStatusClass ?>"
                data-status="<?= $statusDoan ?>">

                <div class="date-box mb-3 mb-md-0">
                    <div class="day"><?= $ngay ?></div>
                    <div class="month"><?= $thang ?></div>
                    <small class="text-muted"><?= $nam ?></small>
                </div>

                <div class="schedule-info ms-md-3 flex-grow-1 w-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-1">
                                <?php
$icon = ($statusDoan == 'dang_dien_ra') ? 'fa-plane-departure text-warning' : (($statusDoan == 'da_ket_thuc') ? 'fa-check-circle text-success' : 'fa-clock text-info');
                                    ?>
                                <i class="fas <?= $icon ?> me-2"></i>
                                <?= isset($lich['TenTour']) ? $lich['TenTour'] : 'Chưa cập nhật tên tour' ?>
                            </h5>
                            <div class="text-muted small mb-2">
                                <i class="fas fa-barcode me-1"></i> Mã Đoàn: <strong><?= $lich['MaDoan'] ?></strong>
                            </div>
                        </div>

                        <div class="ms-3 d-none d-md-block">
                            <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2"><?= $badgeText ?></span>
                        </div>
                    </div>

                    <?php if (!empty($lich['GhiChu'])): ?>
                    <div class="alert alert-light border p-2 mb-2 mt-1 small text-secondary">
                        <i class="fas fa-sticky-note text-warning me-1"></i> <?= $lich['GhiChu'] ?>
                    </div>
                    <?php endif; ?>

                    <div class="d-flex flex-wrap gap-2 mt-3 pt-2 border-top">
                        <a href="index.php?act=hdv_schedule_detail&id=<?= $lich['MaLichLamViec'] ?>"
                            class="btn btn-outline-primary btn-custom">
                            <i class="fas fa-info-circle"></i> Chi tiết
                        </a>

                        <a href="index.php?act=hdv_quanlykhach&id=<?= $lich['MaLichLamViec'] ?>"
                            class="btn btn-success btn-custom text-white">
                            <i class="fas fa-user-check"></i> Điểm danh
                        </a>

                        <a href="index.php?act=hdv_guest_list&id=<?= $lich['MaLichLamViec'] ?>"
                            class="btn btn-info btn-custom text-white">
                            <i class="fas fa-users"></i> DS Khách
                        </a>

                        <a href="index.php?act=hdv_vanhanh&id=<?= $lich['MaLichLamViec'] ?>"
                            class="btn btn-outline-danger btn-custom">
                            <i class="fas fa-coins"></i> Vận hành
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

            <div id="no-result-msg" class="alert alert-warning text-center mt-3 shadow-sm" style="display: none;">
                Không tìm thấy chuyến đi nào trong mục này.
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function filterSchedule(filterType, btnElement) {
        document.querySelectorAll('.nav-link').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.add('bg-white', 'text-dark', 'border');
        });

        btnElement.classList.add('active');
        btnElement.classList.remove('bg-white', 'text-dark', 'border');
        const items = document.querySelectorAll('.card-schedule');
        let hasResult = false;

        items.forEach(item => {
            let status = item.getAttribute('data-status'); // Lấy trạng thái đoàn

            let shouldShow = false;

            if (filterType === 'all') {
                shouldShow = true;
            } else if (filterType === 'active') {
                if (status === 'san_sang' || status === 'dang_dien_ra') {
                    shouldShow = true;
                }
            } else if (filterType === 'completed') {
                if (status === 'da_ket_thuc' || status === 'da_huy') {
                    shouldShow = true;
                }
            }

            if (shouldShow) {
                item.classList.remove('d-none');
                item.classList.add('d-flex');
                hasResult = true;
            } else {
                item.classList.remove('d-flex');
                item.classList.add('d-none');
            }
        });
        const msg = document.getElementById('no-result-msg');
        if (!hasResult) {
            msg.style.display = 'block';
        } else {
            msg.style.display = 'none';
        }
    }
    </script>
</body>

</html>
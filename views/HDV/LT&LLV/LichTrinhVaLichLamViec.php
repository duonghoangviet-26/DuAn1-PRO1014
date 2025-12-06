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
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            background: white;
            margin-bottom: 20px;
            border-left: 5px solid #ccc;
        }

        .card-schedule:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .status-ranh { border-left-color: #0dcaf0; }
        .status-ban { border-left-color: #ffc107; }
        .status-nghi { border-left-color: #198754; }

        .date-box {
            text-align: center;
            padding-right: 15px;
            border-right: 1px solid #eee;
            min-width: 80px;
        }
        .date-box .day { font-size: 1.8rem; font-weight: bold; color: #333; line-height: 1; }
        .date-box .month { font-size: 0.9rem; color: #777; text-transform: uppercase; }
        
        .schedule-info h5 { color: #085f63; font-weight: 700; margin-bottom: 5px; }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #085f63;
            color: white !important;
        }
        .nav-link {
            color: #555;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>

        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule" class="active"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>

        <hr style="border-color: #aad; margin: 20px;">

        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: #085f63;">Lịch Trình Của Bạn</h2>
                <p class="text-muted">Xem chi tiết các tour được phân công và nhiệm vụ sắp tới.</p>
            </div>
            <button class="btn btn-outline-secondary" onclick="window.print()"><i class="fas fa-print"></i> In lịch</button>
        </div>

        <ul class="nav nav-pills mb-4" id="pills-tab">
            <li class="nav-item">
                <button class="nav-link active" onclick="filterSchedule('all', this)">Tất cả</button>
            </li>
            <li class="nav-item ms-2">
                <button class="nav-link border bg-white" onclick="filterSchedule('active', this)">Sắp tới / Đang đi</button>
            </li>
            <li class="nav-item ms-2">
                <button class="nav-link border bg-white" onclick="filterSchedule('completed', this)">Đã hoàn thành</button>
            </li>
        </ul>

        <div class="schedule-list">
            <?php if (empty($ds_lich)): ?>
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-calendar-times fa-3x mb-3"></i><br>
                    Hiện tại bạn chưa có lịch phân công nào. Hãy nghỉ ngơi nhé!
                </div>
            <?php else: ?>
                <?php foreach ($ds_lich as $lich): 
                    $statusClass = 'status-' . $lich['TrangThai']; 
                    $ngay = date('d', strtotime($lich['NgayLamViec']));
                    $thang = date('M', strtotime($lich['NgayLamViec']));
                    $nam = date('Y', strtotime($lich['NgayLamViec']));
                ?>
                
                <div class="card-schedule p-3 d-flex align-items-center <?= $statusClass ?>" data-status="<?= $lich['TrangThai'] ?>">
                    
                    <div class="date-box">
                        <div class="day"><?= $ngay ?></div>
                        <div class="month"><?= $thang ?></div>
                        <small><?= $nam ?></small>
                    </div>

                    <div class="schedule-info ms-3 flex-grow-1">
                        <h5>
                            <?php if ($lich['TrangThai'] == 'ban'): ?>
                                <i class="fas fa-plane-departure text-warning me-2"></i>
                            <?php elseif ($lich['TrangThai'] == 'nghi'): ?>
                                <i class="fas fa-check-circle text-success me-2"></i>
                            <?php else: ?>
                                <i class="fas fa-clock text-info me-2"></i>
                            <?php endif; ?>
                            
                            <?= isset($lich['TenTour']) ? $lich['TenTour'] : 'Chuyến đi chưa cập nhật tên' ?>
                        </h5>
                        <div class="text-muted small mb-1">
                            <i class="fas fa-barcode"></i> Mã Đoàn: <strong><?= $lich['MaDoan'] ?></strong>
                        </div>
                        <?php if (!empty($lich['GhiChu'])): ?>
                            <div class="alert alert-light border p-2 mb-0 mt-2 small text-secondary">
                                <i class="fas fa-sticky-note text-warning"></i> <strong>Ghi chú:</strong> <?= $lich['GhiChu'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="ms-3 text-end" style="min-width: 140px;"> <div class="mb-3"> <?php 
                                if($lich['TrangThai'] == 'ranh') 
                                    echo '<span class="badge bg-info text-dark rounded-pill px-3 py-2">Sẵn sàng</span>';
                                elseif($lich['TrangThai'] == 'ban') 
                                    echo '<span class="badge bg-warning text-dark rounded-pill px-3 py-2">Đang đi tour</span>';
                                else 
                                    echo '<span class="badge bg-success rounded-pill px-3 py-2">Hoàn thành</span>';
                            ?>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <a href="index.php?act=hdv_schedule_detail&id=<?= $lich['MaLichLamViec'] ?>" 
                                class="btn btn-sm btn-outline-primary flex-grow-1">
                                Chi tiết
                                </a>
                                
                                <a href="index.php?act=hdv_quanlykhach&id=<?= $lich['MaLichLamViec'] ?>" 
                                class="btn btn-sm btn-success flex-grow-1">
                                Điểm danh
                                </a>

                                <a href="index.php?act=hdv_guest_list&id=<?= $lich['MaLichLamViec'] ?>" 
                                class="btn btn-sm btn-info text-white flex-grow-1" title="Xem danh sách khách">
                                <i class="fas fa-users"></i> DS Khách
                                </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <div id="no-result-msg" class="alert alert-warning text-center mt-3" style="display: none;">
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
                let rawStatus = item.getAttribute('data-status');
                const status = rawStatus ? rawStatus.trim() : ''; 

                let shouldShow = false;

                if (filterType === 'all') {
                    shouldShow = true;
                } 
                else if (filterType === 'active') {
                    if (status === 'ranh' || status === 'ban') {
                        shouldShow = true;
                    }
                } 
                else if (filterType === 'completed') {
                    if (status === 'nghi') {
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
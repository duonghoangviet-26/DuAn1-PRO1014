<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách Trong Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* --- SIDEBAR STYLE --- */
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

        /* --- CONTENT STYLE --- */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* --- TABLE & CARD --- */
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; overflow: hidden; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center; }
        
        .table-modern thead th {
            background-color: #f8f9fa; color: #6b7280; font-weight: 600;
            text-transform: uppercase; font-size: 0.75rem; padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb; white-space: nowrap;
        }
        .table-modern tbody td { padding: 15px 20px; vertical-align: middle; color: #374151; font-size: 0.9rem; }
        .table-modern tbody tr:hover { background-color: #f9fafb; }
        
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .status-deposit { background-color: #fef3c7; color: #92400e; } /* Chờ cọc */
        .status-paid { background-color: #dbeafe; color: #1e40af; } /* Đã cọc */
        .status-done { background-color: #dcfce7; color: #166534; } /* Hoàn tất */
        .status-other { background-color: #f3f4f6; color: #4b5563; } /* Khác */

        .btn-back { background-color: #e5e7eb; color: #374151; border: none; padding: 8px 15px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; transition: 0.2s; }
        .btn-back:hover { background-color: #d1d5db; color: #1f2937; }
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
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH" class="active"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

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
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Danh Sách Khách Trong Tour</h3>
                    <p class="text-muted mb-0">Quản lý thông tin hành khách tham gia đoàn</p>
                </div>
                <a href="index.php?act=listDKH" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại DS Đoàn
                </a>
            </div>

            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="fw-bold text-primary mb-0">
                        <i class="fas fa-users me-2"></i> Thông Tin Hành Khách
                        <span class="badge bg-light text-dark ms-2 border">Tổng: <?= count($listKhach) ?> khách</span>
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Giấy tờ tùy thân</th>
                                <th>Liên hệ</th>
                                <th>Yêu cầu đặc biệt</th>
                                <th>Phòng</th>
                                <th>Booking</th>
                                <th class="text-center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listKhach)): ?>
                                <?php foreach ($listKhach as $k): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark"><?= htmlspecialchars($k['HoTen']) ?></td>
                                        <td><?= ucfirst($k['GioiTinh']) ?></td>
                                        <td><?= !empty($k['NgaySinh']) ? date('d/m/Y', strtotime($k['NgaySinh'])) : '---' ?></td>
                                        <td>
                                            <i class="far fa-id-card me-1 text-muted"></i> <?= htmlspecialchars($k['SoGiayTo'] ?: '---') ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($k['SoDienThoai'])): ?>
                                                <a href="tel:<?= htmlspecialchars($k['SoDienThoai']) ?>" class="text-decoration-none fw-bold text-dark">
                                                    <?= htmlspecialchars($k['SoDienThoai']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">---</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($k['GhiChuDacBiet'])): ?>
                                                <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i> <?= nl2br(htmlspecialchars($k['GhiChuDacBiet'])) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted small">Không có</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= htmlspecialchars(ucfirst($k['LoaiPhong'])) ?></span>
                                        </td>
                                        <td>
                                            <a href="index.php?act=editBooking&MaBooking=<?= $k['MaBooking'] ?>" class="text-primary text-decoration-none fw-bold">
                                                #<?= $k['MaCodeBooking'] ?? $k['MaBooking'] ?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                if ($k['TrangThai'] === 'cho_coc') echo '<span class="badge badge-status status-deposit">Chờ cọc</span>';
                                                elseif ($k['TrangThai'] === 'da_coc') echo '<span class="badge badge-status status-paid">Đã cọc</span>';
                                                elseif ($k['TrangThai'] === 'hoan_tat') echo '<span class="badge badge-status status-done">Hoàn tất</span>';
                                                else echo '<span class="badge badge-status status-other">Khác</span>';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 opacity-25"></i>
                                        <p>Chưa có khách hàng nào trong đoàn này.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
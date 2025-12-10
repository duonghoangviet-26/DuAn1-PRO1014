<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lịch Làm Việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

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
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; }
        
        .table-modern thead th {
            background-color: #f8f9fa; color: #6b7280; font-weight: 600;
            text-transform: uppercase; font-size: 0.75rem; padding: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .table-modern tbody td { padding: 15px; vertical-align: middle; color: #374151; font-size: 0.9rem; }
        .table-modern tbody tr:hover { background-color: #f9fafb; }
        
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .status-ready { background-color: #dcfce7; color: #166534; }
        .status-busy { background-color: #fef3c7; color: #92400e; } 
        .status-off { background-color: #f3f4f6; color: #4b5563; } 

        .btn-action { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; transition: 0.2s; border: none; margin-right: 5px; }
        .btn-edit { background: #fef3c7; color: #d97706; } .btn-edit:hover { background: #d97706; color: #fff; }
        .btn-delete { background: #fee2e2; color: #dc2626; } .btn-delete:hover { background: #dc2626; color: #fff; }
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
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>
            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV" class="active"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listNV" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Lịch Làm Việc</h3>
                        <p class="text-muted mb-0">Nhân sự: <strong class="text-primary"><?= isset($nhanvien['HoTen']) ? $nhanvien['HoTen'] : 'Không xác định' ?></strong></p>
                    </div>
                </div>
                <a href="index.php?act=addLich&idNV=<?= isset($nhanvien['MaNhanVien']) ? $nhanvien['MaNhanVien'] : '' ?>" class="btn btn-success shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Phân Công Mới
                </a>
            </div>

            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Mã Lịch</th>
                                <th>Ngày Khởi Hành</th>
                                <th>Thông tin Đoàn</th>
                                <th>Trạng Thái</th>
                                <th>Ghi Chú</th>
                                <th class="text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ds_lich)): ?>
                                <?php foreach ($ds_lich as $lich): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-secondary">#<?= $lich['MaLichLamViec'] ?></td>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                <i class="far fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($lich['NgayLamViec'])) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark mb-1">Mã Đoàn: <?= $lich['MaDoan'] ?></div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                                Tour: <?= isset($lich['TenTour']) ? $lich['TenTour'] : 'Chưa xác định' ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php 
                                                if($lich['TrangThai'] == 'ranh') 
                                                    echo '<span class="badge badge-status status-ready">Sẵn sàng</span>';
                                                elseif($lich['TrangThai'] == 'ban') 
                                                    echo '<span class="badge badge-status status-busy">Đang đi tour</span>';
                                                else 
                                                    echo '<span class="badge badge-status status-off">Đã hoàn thành</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <span class="text-muted fst-italic small"><?= !empty($lich['GhiChu']) ? $lich['GhiChu'] : '---' ?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="index.php?act=editLich&MaLichLamViec=<?= $lich['MaLichLamViec'] ?>" class="btn-action btn-edit" title="Sửa">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="index.php?act=deleteLichLamViec&MaLichLamViec=<?= $lich['MaLichLamViec'] ?>&id=<?= $lich['MaNhanVien'] ?>" 
                                                   class="btn-action btn-delete" title="Xóa"
                                                   onclick="return confirm('Bạn có chắc muốn hủy lịch phân công này?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-calendar-times fa-3x mb-3 opacity-25"></i>
                                        <p>Chưa có lịch làm việc nào được phân công.</p>
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
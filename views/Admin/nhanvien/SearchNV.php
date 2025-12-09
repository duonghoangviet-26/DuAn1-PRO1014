<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm Nhân Viên Rảnh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
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
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h4 { font-weight: 700; font-size: 1.2rem; color: #fff; display: flex; align-items: center; }
        .sidebar-menu { padding: 0 10px; }
        .sidebar-title { font-size: 0.75rem; text-transform: uppercase; color: #95a5a6; margin: 15px 15px 5px; font-weight: 600; }
        .sidebar a { color: #bdc3c7; padding: 12px 15px; text-decoration: none; display: flex; align-items: center; border-radius: 8px; font-size: 0.95rem; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a i { width: 25px; text-align: center; margin-right: 10px; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px); }
        .sidebar a.active { background-color: #3498db; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); background: #fff; }
        .search-box { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03); margin-bottom: 30px; border-left: 5px solid #0d6efd; }
        
        .form-control-lg-custom { border-radius: 10px; padding: 12px 15px; border: 1px solid #dee2e6; }
        .form-control-lg-custom:focus { box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1); border-color: #0d6efd; }
        
        .btn-custom { border-radius: 10px; padding: 12px 20px; font-weight: 600; transition: 0.3s; }
        .btn-custom:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .table-modern thead th { background-color: #f1f5f9; color: #495057; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; padding: 15px; border-bottom: 2px solid #e9ecef; }
        .table-modern tbody td { padding: 15px; vertical-align: middle; color: #555; }
        
        .badge-role { padding: 8px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 600; }
        .role-hdv { background-color: #e0f2fe; color: #0369a1; }
        .role-driver { background-color: #dcfce7; color: #15803d; }
        .role-other { background-color: #f3f4f6; color: #4b5563; }

        .result-header { display: flex; justify-content: space-between; align-items: center; padding: 20px; border-bottom: 1px solid #f0f0f0; }
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
            <a href="index.php?act=listNV" ><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                    <i class="fas fa-search fa-lg"></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Tìm Kiếm Nhân Sự</h3>
                    <p class="text-muted mb-0">Kiểm tra và phân công nhân sự rảnh theo ngày</p>
                </div>
            </div>

            <div class="search-box">
                <form action="index.php?act=searchNV" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary text-uppercase small">Ngày cần kiểm tra</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="far fa-calendar-alt text-primary"></i></span>
                            <input type="date" name="NgayCanTim" class="form-control form-control-lg-custom border-start-0 ps-0" value="<?= $selectedDate ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-custom w-100 shadow-sm">
                            <i class="fas fa-filter me-2"></i> Kiểm tra ngay
                        </button>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <a href="index.php?act=listNV" class="btn btn-light btn-custom w-100 border">
                            <i class="fas fa-arrow-left me-2"></i> Quay lại DS
                        </a>
                    </div>
                </form>
            </div>

            <div class="card card-custom">
                <div class="result-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list-ul me-2 text-primary"></i>
                        <h5 class="mb-0 fw-bold">Kết quả tìm kiếm</h5>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-users me-1"></i> <?= count($listNhanVienRanh) ?> nhân sự sẵn sàng
                    </span>
                </div>
                
                <div class="card-body p-0">
                    <?php if (empty($listNhanVienRanh)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-clock fa-3x text-muted mb-3 opacity-50"></i>
                            <h5 class="text-muted fw-bold">Không tìm thấy nhân sự nào!</h5>
                            <p class="text-secondary mb-0">Tất cả nhân viên đều bận vào ngày <?= date('d/m/Y', strtotime($selectedDate)) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Mã NV</th>
                                        <th>Thông tin nhân viên</th>
                                        <th>Vai trò</th>
                                        <th>Liên hệ</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listNhanVienRanh as $nv): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-secondary">#<?= $nv['MaNhanVien'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-secondary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark"><?= $nv['HoTen'] ?></div>
                                                        <small class="text-muted">ID: <?= $nv['MaCodeNhanVien'] ?? $nv['MaNhanVien'] ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php 
                                                if($nv['VaiTro'] == 'huong_dan_vien') 
                                                    echo '<span class="badge-role role-hdv"><i class="fas fa-flag me-1"></i> Hướng dẫn viên</span>';
                                                elseif($nv['VaiTro'] == 'tai_xe') 
                                                    echo '<span class="badge-role role-driver"><i class="fas fa-steering-wheel me-1"></i> Tài xế</span>';
                                                else 
                                                    echo '<span class="badge-role role-other">'.ucfirst($nv['VaiTro']).'</span>';
                                                ?>
                                            </td>
                                            <td>
                                                <a href="tel:<?= $nv['SoDienThoai'] ?>" class="text-decoration-none text-dark fw-bold">
                                                    <i class="fas fa-phone-alt text-success me-2"></i><?= $nv['SoDienThoai'] ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?act=addLich&idNV=<?= $nv['MaNhanVien'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                                                    <i class="fas fa-plus-circle me-1"></i> Phân công
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
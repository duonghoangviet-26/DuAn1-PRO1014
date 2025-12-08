\
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
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
        }

        .sidebar-header {
            padding: 0 25px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 15px;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.2rem;
            color: #fff;
            display: flex;
            align-items: center;
        }

        .sidebar-menu { padding: 0 10px; }
        
        .sidebar-title {
            font-size: 0.75rem; text-transform: uppercase; color: #95a5a6;
            margin: 15px 15px 5px; font-weight: 600;
        }

        .sidebar a {
            color: #bdc3c7; padding: 12px 15px; text-decoration: none;
            display: flex; align-items: center; border-radius: 8px;
            font-size: 0.95rem; transition: all 0.3s ease; margin-bottom: 5px;
        }

        .sidebar a i { width: 25px; text-align: center; margin-right: 10px; font-size: 1.1rem; }

        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px);
        }

        .sidebar a.active { background-color: #3498db; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* --- PROFILE CARD STYLE --- */
        .card-profile { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: #fff; overflow: hidden; }
        .profile-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            height: 150px;
            position: relative;
        }
        .profile-img-container {
            position: absolute;
            bottom: -50px;
            left: 40px;
        }
        .profile-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid #fff;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .profile-actions {
            position: absolute;
            bottom: 15px;
            right: 30px;
        }

        .profile-body {
            padding-top: 60px; /* Để tránh bị ảnh đè */
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 40px;
        }

        .info-label { font-weight: 600; color: #6b7280; font-size: 0.9rem; margin-bottom: 5px; }
        .info-value { font-weight: 500; color: #111827; font-size: 1rem; }
        .info-group { margin-bottom: 20px; }
        
        .badge-role { font-size: 0.9rem; padding: 8px 15px; border-radius: 30px; }
        .role-admin { background: #fee2e2; color: #991b1b; }
        .role-hdv { background: #e0f2fe; color: #075985; }
        
        .status-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 5px; }
        .dot-active { background-color: #10b981; }
        .dot-inactive { background-color: #6b7280; }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>

        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard" ><i class="fa fa-home"></i> Trang chủ</a>
            
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
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center mb-4">
                <a href="index.php?act=listNV" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                <h3 class="fw-bold text-dark mb-0">Hồ Sơ Nhân Viên</h3>
            </div>

            <div class="card card-profile">
                <div class="profile-header">
                    <div class="profile-img-container">
                        <img src="./uploads/nhanvien/<?= !empty($nhanVien['LinkAnhDaiDien']) ? $nhanVien['LinkAnhDaiDien'] : 'default-avatar.png' ?>" 
                             class="profile-img" alt="Avatar">
                    </div>
                    <div class="profile-actions">
                        <a href="index.php?act=editNV&id=<?= $nhanVien['MaNhanVien'] ?>" class="btn btn-light fw-bold shadow-sm">
                            <i class="fas fa-pen me-2"></i> Chỉnh sửa
                        </a>
                    </div>
                </div>

                <div class="profile-body">
                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="fw-bold mb-1"><?= $nhanVien['HoTen'] ?></h2>
                            <p class="text-muted mb-2">
                                <i class="fas fa-id-badge me-2"></i> <?= $nhanVien['MaCodeNhanVien'] ?>
                            </p>
                            
                            <?php 
                                $roleText = strtoupper(str_replace('_', ' ', $nhanVien['VaiTro']));
                                $roleClass = ($nhanVien['VaiTro'] == 'admin') ? 'role-admin' : 'role-hdv';
                            ?>
                            <span class="badge badge-role <?= $roleClass ?>"><?= $roleText ?></span>

                            <span class="ms-3 text-secondary" style="font-size: 0.9rem;">
                                <?php if($nhanVien['TrangThai'] == 'dang_lam'): ?>
                                    <span class="status-dot dot-active"></span> Đang làm việc
                                <?php else: ?>
                                    <span class="status-dot dot-inactive"></span> Đã nghỉ việc
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-5">
                        <div class="col-md-6">
                            <h5 class="text-primary fw-bold mb-4"><i class="far fa-user me-2"></i> Thông tin cá nhân</h5>
                            
                            <div class="info-group">
                                <div class="info-label">Ngày sinh</div>
                                <div class="info-value"><?= date('d/m/Y', strtotime($nhanVien['NgaySinh'])) ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Giới tính</div>
                                <div class="info-value">
                                    <?= ($nhanVien['GioiTinh'] == 'nam') ? 'Nam' : (($nhanVien['GioiTinh'] == 'nu') ? 'Nữ' : 'Khác') ?>
                                </div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Số điện thoại</div>
                                <div class="info-value"><a href="tel:<?= $nhanVien['SoDienThoai'] ?>" class="text-decoration-none text-dark"><?= $nhanVien['SoDienThoai'] ?></a></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value"><a href="mailto:<?= $nhanVien['Email'] ?>" class="text-decoration-none text-dark"><?= $nhanVien['Email'] ?></a></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Địa chỉ</div>
                                <div class="info-value"><?= $nhanVien['DiaChi'] ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-success fw-bold mb-4"><i class="fas fa-briefcase me-2"></i> Hồ sơ năng lực</h5>

                            <div class="info-group">
                                <div class="info-label">Kinh nghiệm</div>
                                <div class="info-value"><?= $nhanVien['SoNamKinhNghiem'] ?> năm</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Chuyên môn</div>
                                <div class="info-value"><?= $nhanVien['ChuyenMon'] ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Ngôn ngữ thành thạo</div>
                                <div class="info-value"><?= $nhanVien['NgonNgu'] ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Chứng chỉ & Bằng cấp</div>
                                <div class="info-value bg-light p-3 rounded text-secondary" style="font-size: 0.9rem;">
                                    <?= nl2br($nhanVien['ChungChi']) ?>
                                </div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Ngày tham gia hệ thống</div>
                                <div class="info-value text-muted small">
                                    <i class="far fa-clock me-1"></i> <?= date('d/m/Y H:i', strtotime($nhanVien['NgayTao'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
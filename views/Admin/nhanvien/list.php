
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân sự</title>
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
            overflow-y: auto;
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

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; }
        .card-header-custom { 
            background: #fff; border-bottom: 1px solid #f0f0f0; 
            padding: 20px 25px; border-radius: 12px 12px 0 0 !important;
            display: flex; justify-content: space-between; align-items: center;
        }
        
        .table-modern thead th {
            background-color: #f8f9fa; color: #6b7280; font-weight: 600;
            text-transform: uppercase; font-size: 0.75rem; padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .table-modern tbody td { padding: 15px 20px; vertical-align: middle; color: #374151; font-size: 0.9rem; }
        .table-modern tbody tr:hover { background-color: #f9fafb; }

        .avatar-circle {
            width: 45px; height: 45px; border-radius: 50%; object-fit: cover;
            border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-active { background-color: #dcfce7; color: #166534; }
        .badge-inactive { background-color: #f3f4f6; color: #4b5563; }

        .btn-action { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; transition: 0.2s; border: none; }
        .btn-view { background: #e0f2fe; color: #0284c7; } .btn-view:hover { background: #0284c7; color: #fff; }
        .btn-edit { background: #fef3c7; color: #d97706; } .btn-edit:hover { background: #d97706; color: #fff; }
        .btn-delete { background: #fee2e2; color: #dc2626; } .btn-delete:hover { background: #dc2626; color: #fff; }
        .btn-calendar { background: #f3e8ff; color: #7e22ce; width: auto; padding: 0 10px; font-size: 0.8rem; height: 28px; margin-right: 5px; text-decoration: none; }
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
            <a href="index.php?act=listNV" class="active"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Danh Sách Nhân Sự</h3>
                    <p class="text-muted mb-0">Quản lý thông tin và phân công nhân viên</p>
                </div>
                <div>
                    <a href="index.php?act=searchNV" class="btn btn-info text-white me-2">
                        <i class="fas fa-search me-1"></i> Tìm NV Rảnh
                    </a>
                    <a href="index.php?act=creatNV" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Thêm Mới
                    </a>
                </div>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-modern mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Mã NV</th>
                                <th>Thông tin nhân viên</th>
                                <th>Chức vụ</th>
                                <th>Liên hệ</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listNhanVien as $nv): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary">#<?= $nv['MaNhanVien'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="./uploads/nhanvien/<?= $nv['LinkAnhDaiDien'] ?? 'default-avatar.png' ?>" 
                                                 class="avatar-circle me-3" alt="Avatar">
                                            <div>
                                                <div class="fw-bold text-dark"><?= $nv['HoTen'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php 
                                            $roleClass = 'bg-light text-dark border';
                                            if($nv['VaiTro'] == 'admin') $roleClass = 'bg-danger bg-opacity-10 text-danger border-danger border-opacity-10';
                                            elseif($nv['VaiTro'] == 'huong_dan_vien') $roleClass = 'bg-info bg-opacity-10 text-info border-info border-opacity-10';
                                        ?>
                                        <span class="badge rounded-pill <?= $roleClass ?> px-3 py-2 fw-normal">
                                            <?= strtoupper(str_replace('_', ' ', $nv['VaiTro'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold mb-1"><?= $nv['SoDienThoai'] ?></span>
                                            <span class="text-muted small"><?= $nv['Email'] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($nv['TrangThai'] == 'dang_lam'): ?>
                                            <span class="badge badge-status badge-active">Đang làm việc</span>
                                        <?php else: ?>
                                            <span class="badge badge-status badge-inactive">Đã nghỉ</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if ($nv['VaiTro'] !== 'admin'): ?>
                                                <a href="index.php?act=lichlamviec&id=<?= $nv['MaNhanVien'] ?>" 
                                                   class="btn-calendar rounded-pill d-flex align-items-center" title="Xem lịch">
                                                   <i class="fas fa-calendar-alt me-1"></i> Lịch
                                                </a>
                                            <?php endif; ?>

                                            <a href="index.php?act=chitietNV&id=<?= $nv['MaNhanVien'] ?>" class="btn-action btn-view" title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?act=editNV&id=<?= $nv['MaNhanVien'] ?>" class="btn-action btn-edit" title="Sửa">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            
                                            <?php if ($nv['TrangThai'] == 'da_nghi'): ?>
                                                <a href="index.php?act=deleteNV&id=<?= $nv['MaNhanVien'] ?>" 
                                                   class="btn-action btn-secondary" title="Xóa vĩnh viễn"
                                                   onclick="return confirm('Xóa vĩnh viễn nhân viên này?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="index.php?act=deleteNV&id=<?= $nv['MaNhanVien'] ?>" 
                                                   class="btn-action btn-delete" title="Cho nghỉ việc"
                                                   onclick="return confirm('Chuyển trạng thái sang Đã nghỉ?')">
                                                    <i class="fas fa-user-slash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1): ?>
                <div class="card-footer bg-white border-top-0 py-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link border-0" href="index.php?act=listNV&page=<?= $page - 1 ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                    <a class="page-link border-0 rounded-circle mx-1 text-center" style="width:35px; height:35px; line-height:20px;" 
                                       href="index.php?act=listNV&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link border-0" href="index.php?act=listNV&page=<?= $page + 1 ?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
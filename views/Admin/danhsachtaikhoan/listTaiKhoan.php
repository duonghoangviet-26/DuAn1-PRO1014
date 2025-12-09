<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
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
        }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; }
        
        .table-modern thead th {
            background-color: #f8f9fa; color: #6b7280; font-weight: 600;
            text-transform: uppercase; font-size: 0.75rem; padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .table-modern tbody td { padding: 15px 20px; vertical-align: middle; color: #374151; font-size: 0.9rem; }
        .table-modern tbody tr:hover { background-color: #f9fafb; }

        .badge-role { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .role-admin { background-color: #fee2e2; color: #991b1b; }
        .role-hdv { background-color: #e0f2fe; color: #075985; }
        .role-staff { background-color: #ffedd5; color: #9a3412; }
        .role-user { background-color: #f3f4f6; color: #4b5563; }

        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .status-active { background-color: #dcfce7; color: #166534; }
        .status-locked { background-color: #f3f4f6; color: #4b5563; }

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

            <table class="table table-bordered table-hover bg-white">
                <thead class="table-light">
                    <tr>
                        <th>ID</th> <th>Tên Đăng Nhập</th>
                        <th>Mật Khẩu</th>
                        <th>Vai Trò</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Tạo</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listTaiKhoan as $tk): ?>
                    <tr>
                        <td class="text-center text-muted"><?= $tk['MaTaiKhoan'] ?></td>
                        <td><strong><?= $tk['TenDangNhap'] ?></strong></td>
                        <td class="text-danger"><?= $tk['MatKhau'] ?></td>
                        <td>
                            <?php 
                                if($tk['VaiTro'] == 'admin') echo '<span class="badge bg-danger">Admin</span>';
                                elseif($tk['VaiTro'] == 'dieu_hanh') echo '<span class="badge bg-warning text-dark">Điều hành</span>';
                                elseif($tk['VaiTro'] == 'huong_dan_vien') echo '<span class="badge bg-info">HDV</span>';
                                else echo '<span class="badge bg-secondary">Khách hàng</span>';
                            ?>
                        </td>
                        <td>
                            <?php if ($tk['TrangThai'] == 'hoat_dong'): ?>
                                <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Bị khóa</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($tk['NgayTao'])) ?></td>
                        <td>
                            <a href="index.php?act=editTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Sửa</a>
                            <a href="index.php?act=deleteTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa tài khoản này?')"><i class="fa fa-trash"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>

            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan" class="active"><i class="fa fa-user-gear"></i> Tài khoản </a>
            
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Danh Sách Tài Khoản</h3>
                    <p class="text-muted mb-0">Quản lý tài khoản đăng nhập hệ thống</p>
                </div>
                <a href="index.php?act=addTaiKhoan" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Thêm Tài Khoản
                </a>
            </div>

            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Tên Đăng Nhập</th>
                                <th>Mật Khẩu</th> <th>Vai Trò</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Tạo</th>
                                <th class="text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTaiKhoan as $tk): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary">#<?= $tk['MaTaiKhoan'] ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $tk['TenDangNhap'] ?></div>
                                    </td>
                                    <td>
                                        <span class="text-muted fst-italic">******</span> 
                                    </td>
                                    <td>
                                        <?php 
                                            $roleClass = 'role-user';
                                            $roleText = 'Khách hàng';
                                            
                                            if($tk['VaiTro'] == 'admin') { $roleClass = 'role-admin'; $roleText = 'Admin'; }
                                            elseif($tk['VaiTro'] == 'huong_dan_vien') { $roleClass = 'role-hdv'; $roleText = 'HDV'; }
                                            elseif($tk['VaiTro'] == 'dieu_hanh') { $roleClass = 'role-staff'; $roleText = 'Điều hành'; }
                                            elseif($tk['VaiTro'] == 'tai_xe') { $roleClass = 'role-staff'; $roleText = 'Tài xế'; }
                                        ?>
                                        <span class="badge badge-role <?= $roleClass ?>"><?= $roleText ?></span>
                                    </td>
                                    <td>
                                        <?php if ($tk['TrangThai'] == 'hoat_dong'): ?>
                                            <span class="badge badge-status status-active">Hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge badge-status status-locked">Bị khóa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="text-muted small"><?= date('d/m/Y', strtotime($tk['NgayTao'])) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="index.php?act=editTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" class="btn-action btn-edit" title="Sửa">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="index.php?act=deleteTaiKhoan&id=<?= $tk['MaTaiKhoan'] ?>" 
                                               class="btn-action btn-delete" title="Xóa"
                                               onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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

        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        
        .btn-submit { background-color: #10b981; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }
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
            <a href="index.php?act=listdm" class="active"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
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
                <a href="index.php?act=listdm" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Thêm Danh Mục Mới</h3>
                    <p class="text-muted mb-0">Tạo mới loại hình du lịch</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="" method="POST" class="card card-form p-4" novalidate onsubmit="return validateForm(event)">
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> <?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label for="TenDanhMuc" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="TenDanhMuc" id="TenDanhMuc" placeholder="VD: Tour Trong Nước, Tour Quốc Tế..." required>
                        </div>

                        <div class="mb-4">
                            <label for="MoTa" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="MoTa" id="MoTa" rows="4" placeholder="Nhập mô tả ngắn về danh mục này..."></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-2 border-top pt-4">
                            <a href="index.php?act=listdm" class="btn btn-cancel">Hủy bỏ</a>
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-plus-circle me-2"></i> Thêm Danh Mục
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
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

        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; margin-bottom: 20px; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); } /* Màu xanh lá Add */
        
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
            <a href="index.php?act=admin_dashboard"><i class="fa fa-home"></i> Trang chủ</a>
            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH" class="active"><i class="fa fa-users"></i> Khách hàng</a>
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
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listKH" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Thêm Khách Hàng Mới</h3>
                        <p class="text-muted mb-0">Tạo hồ sơ khách hàng vào hệ thống</p>
                    </div>
                </div>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger shadow-sm border-0 mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php
                    $errors = explode(",", $_GET['error']);
                    foreach ($errors as $e) {
                        if ($e == "empty_name") echo "Vui lòng nhập Họ Tên.<br>";
                        if ($e == "empty_phone") echo "Vui lòng nhập Số Điện Thoại.<br>";
                        if ($e == "db_error") echo "Lỗi lưu dữ liệu, vui lòng thử lại.<br>";
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form action="index.php?act=creatKH" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-success mb-0"><i class="fas fa-user-plus me-2"></i> Thông Tin Cá Nhân</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="form-label">Mã Code Khách Hàng <span class="text-danger">*</span></label>
                                    <input type="text" name="MaCodeKhachHang" class="form-control" placeholder="VD: KH001" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Họ Tên <span class="text-danger">*</span></label>
                                    <input type="text" name="HoTen" class="form-control" placeholder="Nhập họ và tên" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ngày Sinh</label>
                                        <input type="date" name="NgaySinh" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Giới Tính</label>
                                        <select name="GioiTinh" class="form-select">
                                            <option value="nam" selected>Nam</option>
                                            <option value="nu">Nữ</option>
                                            <option value="khac">Khác</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số Giấy Tờ (CMND/CCCD/Passport)</label>
                                    <input type="text" name="SoGiayTo" class="form-control" placeholder="Nhập số giấy tờ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-info mb-0"><i class="fas fa-address-book me-2"></i> Liên Hệ & Loại Hình</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input type="text" name="SoDienThoai" class="form-control" placeholder="09xxxxxxxx">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="Email" class="form-control" placeholder="email@domain.com">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa Chỉ</label>
                                    <input type="text" name="DiaChi" class="form-control" placeholder="Nhập địa chỉ">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Loại Khách Hàng</label>
                                    <select name="LoaiKhach" id="LoaiKhach" class="form-select">
                                        <option value="ca_nhan" selected>Cá nhân</option>
                                        <option value="cong_ty">Công ty / Doanh nghiệp</option>
                                    </select>
                                </div>

                                <div id="company-info" style="display: none;">
                                    <div class="p-3 bg-light rounded border mb-3">
                                        <h6 class="text-primary small fw-bold mb-2"><i class="fas fa-building"></i> THÔNG TIN DOANH NGHIỆP</h6>
                                        <div class="mb-2">
                                            <label class="form-label small">Tên Công Ty</label>
                                            <input type="text" name="TenCongTy" class="form-control form-control-sm" placeholder="Nhập tên công ty">
                                        </div>
                                        <div>
                                            <label class="form-label small">Mã Số Thuế</label>
                                            <input type="text" name="MaSoThue" class="form-control form-control-sm" placeholder="Nhập mã số thuế">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ghi Chú</label>
                                    <textarea name="GhiChu" class="form-control" rows="2" placeholder="Ghi chú thêm..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-form p-3 sticky-bottom text-end mt-2">
                    <a href="index.php?act=listKH" class="btn btn-cancel me-2">Hủy bỏ</a>
                    <button type="submit" class="btn btn-submit text-white">
                        <i class="fas fa-save me-2"></i> Lưu Khách Hàng
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loaiSelect = document.getElementById("LoaiKhach");
            const companyInfo = document.getElementById("company-info");

            function toggleCompany() {
                if (loaiSelect.value === "cong_ty") {
                    companyInfo.style.display = "block";
                } else {
                    companyInfo.style.display = "none";
                }
            }

            toggleCompany();
            loaiSelect.addEventListener("change", toggleCompany);
        });
    </script>
</body>

</html>
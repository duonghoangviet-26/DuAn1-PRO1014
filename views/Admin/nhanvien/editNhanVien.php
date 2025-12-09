<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Nhân Viên</title>

    <!-- Bootstrap + Icons -->
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
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }
        .form-control:disabled { background-color: #f9fafb; color: #6b7280; }

        .section-title { font-size: 1.1rem; font-weight: 700; color: #111827; padding-bottom: 10px; border-bottom: 2px solid #f3f4f6; margin-bottom: 20px; }
        
        .btn-submit { background-color: #f59e0b; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #d97706; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }

        .preview-img { width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #e5e7eb; padding: 2px; }
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
                <div>
                    <h3 class="fw-bold text-dark mb-0">Cập Nhật Nhân Viên</h3>
                    <p class="text-muted mb-0">Chỉnh sửa thông tin hồ sơ nhân sự</p>
                </div>
            </div>

            <form action="index.php?act=updateNV" method="POST" enctype="multipart/form-data" class="card card-form p-4" novalidate onsubmit="return validateForm(event)">
                <input type="hidden" name="MaNhanVien" value="<?= $nhanVien['MaNhanVien'] ?>">
                <input type="hidden" name="AnhCu" value="<?= $nhanVien['LinkAnhDaiDien'] ?>">

                <div class="row g-4">
                    <div class="col-lg-6">
                        <h5 class="section-title text-warning"><i class="fas fa-user-edit me-2"></i>Thông tin cơ bản</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" value="<?= $nhanVien['MaCodeNhanVien'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="HoTen" value="<?= $nhanVien['HoTen'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chức vụ (Vai trò)</label>
                            <select class="form-select" name="VaiTro">
                                <option value="huong_dan_vien" <?= $nhanVien['VaiTro'] == 'huong_dan_vien' ? 'selected' : '' ?>>Hướng dẫn viên</option>
                                <option value="tai_xe" <?= $nhanVien['VaiTro'] == 'tai_xe' ? 'selected' : '' ?>>Tài xế</option>
                                <option value="dieu_hanh" <?= $nhanVien['VaiTro'] == 'dieu_hanh' ? 'selected' : '' ?>>Điều hành</option>
                                <option value="admin" <?= $nhanVien['VaiTro'] == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" name="NgaySinh" value="<?= $nhanVien['NgaySinh'] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giới tính</label>
                                <select class="form-select" name="GioiTinh">
                                    <option value="nam" <?= $nhanVien['GioiTinh'] == 'nam' ? 'selected' : '' ?>>Nam</option>
                                    <option value="nu" <?= $nhanVien['GioiTinh'] == 'nu' ? 'selected' : '' ?>>Nữ</option>
                                    <option value="khac" <?= $nhanVien['GioiTinh'] == 'khac' ? 'selected' : '' ?>>Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="SoDienThoai" value="<?= $nhanVien['SoDienThoai'] ?>" pattern="[0-9]{10,11}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="Email" value="<?= $nhanVien['Email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control" name="DiaChi" rows="2"><?= $nhanVien['DiaChi'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h5 class="section-title text-info"><i class="fas fa-briefcase me-2"></i>Thông tin nghề nghiệp</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kinh nghiệm (năm)</label>
                                <input type="number" class="form-control" name="SoNamKinhNghiem" value="<?= $nhanVien['SoNamKinhNghiem'] ?>" min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chuyên môn</label>
                                <input type="text" class="form-control" name="ChuyenMon" value="<?= $nhanVien['ChuyenMon'] ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ngôn ngữ</label>
                            <input type="text" class="form-control" name="NgonNgu" value="<?= $nhanVien['NgonNgu'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chứng chỉ</label>
                            <textarea class="form-control" name="ChungChi" rows="2"><?= $nhanVien['ChungChi'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <div class="d-flex align-items-center">
                                <?php if(!empty($nhanVien['LinkAnhDaiDien'])): ?>
                                    <img src="./uploads/nhanvien/<?= $nhanVien['LinkAnhDaiDien'] ?>" class="preview-img me-3">
                                <?php else: ?>
                                    <div class="preview-img me-3 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-image fa-2x"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control" name="LinkAnhDaiDien" accept="image/*">
                                    <small class="text-muted d-block mt-1">Chọn ảnh mới nếu muốn thay đổi.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái làm việc</label>
                            <select class="form-select bg-light" name="TrangThai">
                                <option value="dang_lam" <?= $nhanVien['TrangThai'] == 'dang_lam' ? 'selected' : '' ?>>🟢 Đang làm việc</option>
                                <option value="da_nghi" <?= $nhanVien['TrangThai'] == 'da_nghi' ? 'selected' : '' ?>>🔴 Đã nghỉ việc</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                    <a href="index.php?act=listNV" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i> Hủy bỏ
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i> Cập Nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm(e) {
            const form = e.target;
            const inputs = form.querySelectorAll('input, select, textarea');
            let isFull = true;
            const anhCu = form.querySelector('input[name="AnhCu"]');

            for (let i = 0; i < inputs.length; i++) {
                const el = inputs[i];
                
                if (el.type === 'hidden' || el.disabled || el.type === 'submit') {
                    continue;
                }

                if (el.type === 'file' && el.value === "" && anhCu && anhCu.value !== "") {
                    continue;
                }

                if (el.value.trim() === "") {
                    isFull = false;
                    el.style.border = "1px solid red";
                } else {
                    el.style.border = "";
                }
            }

            if (!isFull) {
                e.preventDefault();
                alert("hãy nhập đầy đủ các trường dữ liệu ");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>

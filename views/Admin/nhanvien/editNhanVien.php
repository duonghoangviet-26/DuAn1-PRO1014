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
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>

</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="#"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="index.php?act=addTaiKhoan"><i class="fas fa-user-plus"></i>Thêm Tài Khoản</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container mt-4">
            <h2>Sửa thông tin nhân viên</h2>

            <form action="index.php?act=updateNV" method="POST" enctype="multipart/form-data" class="card p-4 shadow" novalidate onsubmit="return validateForm(event)">
                <input type="hidden" name="MaNhanVien" value="<?= $nhanVien['MaNhanVien'] ?>">
                <input type="hidden" name="AnhCu" value="<?= $nhanVien['LinkAnhDaiDien'] ?>">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3 text-muted">Thông tin cơ bản</h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã nhân viên (Auto)</label>
                            <input type="text" class="form-control bg-light" value="<?= $nhanVien['MaCodeNhanVien'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" name="HoTen" class="form-control" value="<?= $nhanVien['HoTen'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Vai trò</label>
                            <select name="VaiTro" class="form-select">
                                <option value="huong_dan_vien" <?= $nhanVien['VaiTro'] == 'huong_dan_vien' ? 'selected' : '' ?>>Hướng dẫn viên</option>
                                <option value="tai_xe" <?= $nhanVien['VaiTro'] == 'tai_xe' ? 'selected' : '' ?>>Tài xế</option>
                                <option value="dieu_hanh" <?= $nhanVien['VaiTro'] == 'dieu_hanh' ? 'selected' : '' ?>>Điều hành</option>
                                <option value="admin" <?= $nhanVien['VaiTro'] == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ngày sinh</label>
                                <input type="date" name="NgaySinh" class="form-control" value="<?= $nhanVien['NgaySinh'] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giới tính</label>
                                <select name="GioiTinh" class="form-select">
                                    <option value="nam" <?= $nhanVien['GioiTinh'] == 'nam' ? 'selected' : '' ?>>Nam</option>
                                    <option value="nu" <?= $nhanVien['GioiTinh'] == 'nu' ? 'selected' : '' ?>>Nữ</option>
                                    <option value="khac" <?= $nhanVien['GioiTinh'] == 'khac' ? 'selected' : '' ?>>Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="SoDienThoai" class="form-control" value="<?= $nhanVien['SoDienThoai'] ?>" pattern="[0-9]{10,11}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="Email" class="form-control" value="<?= $nhanVien['Email'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ</label>
                            <textarea name="DiaChi" class="form-control" rows="2"><?= $nhanVien['DiaChi'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3 text-muted">Thông tin nghề nghiệp</h5>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kinh nghiệm (năm)</label>
                            <input type="number" name="SoNamKinhNghiem" class="form-control" value="<?= $nhanVien['SoNamKinhNghiem'] ?>" min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Chuyên môn</label>
                            <input type="text" name="ChuyenMon" class="form-control" value="<?= $nhanVien['ChuyenMon'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ngôn ngữ</label>
                            <input type="text" name="NgonNgu" class="form-control" value="<?= $nhanVien['NgonNgu'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Chứng chỉ</label>
                            <textarea name="ChungChi" class="form-control" rows="2"><?= $nhanVien['ChungChi'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ảnh đại diện</label>
                            <div class="d-flex align-items-center">
                                <?php if(!empty($nhanVien['LinkAnhDaiDien'])): ?>
                                    <img src="./uploads/nhanvien/<?= $nhanVien['LinkAnhDaiDien'] ?>" class="rounded me-3" width="80" height="80" style="object-fit:cover;">
                                <?php endif; ?>
                                <input type="file" name="LinkAnhDaiDien" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái</label>
                            <select name="TrangThai" class="form-select">
                                <option value="dang_lam" <?= $nhanVien['TrangThai'] == 'dang_lam' ? 'selected' : '' ?>>Đang làm</option>
                                <option value="da_nghi" <?= $nhanVien['TrangThai'] == 'da_nghi' ? 'selected' : '' ?>>Đã nghỉ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 border-top pt-3">
                    <button type="submit" class="btn btn-warning px-4 fw-bold text-white">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                    <a href="index.php?act=listNV" class="btn btn-secondary px-4"><i class="fas fa-times"></i> Hủy bỏ</a>
                </div>
            </form>

        </div>
    </div>

    <!-- JS Bootstrap -->
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

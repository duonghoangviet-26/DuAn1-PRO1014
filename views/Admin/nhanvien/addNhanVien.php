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
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="#"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listDKH"><i class="fa fa-users"></i> Quản lí đoàn khởi hành</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="index.php?act=addTaiKhoan"><i class="fas fa-user-plus"></i>Thêm Tài Khoản</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>


    <!-- Nội dung -->
    <div class="content">
        <div class="container mt-4">
                    <h2>Thêm Nhân Viên Mới</h2>

                    <form action="index.php?act=creatNV" method="POST" enctype="multipart/form-data" class="card p-4 shadow" novalidate onsubmit="return validateForm(event)">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Thông tin cá nhân</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="HoTen" placeholder="Nhập họ tên">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Vai trò <span class="text-danger">*</span></label>
                                    <select class="form-select" name="VaiTro">
                                        <option value="">-- Chọn vai trò --</option>
                                        <option value="huong_dan_vien">Hướng dẫn viên</option>
                                        <option value="tai_xe">Tài xế</option>
                                        <option value="dieu_hanh">Điều hành</option>
                                        <option value="admin">Quản trị viên</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Ngày sinh</label>
                                        <input type="date" class="form-control" name="NgaySinh">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Giới tính</label>
                                        <select class="form-select" name="GioiTinh">
                                            <option value="">-- Chọn --</option>
                                            <option value="nam">Nam</option>
                                            <option value="nu">Nữ</option>
                                            <option value="khac">Khác</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="SoDienThoai" pattern="[0-9]{10,11}" title="Nhập số điện thoại hợp lệ (10-11 số)">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="Email" placeholder="example@email.com">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Địa chỉ</label>
                                    <textarea class="form-control" name="DiaChi" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Thông tin chuyên môn & Khác</h5>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Số năm kinh nghiệm</label>
                                    <input type="number" class="form-control" name="SoNamKinhNghiem" min="0" placeholder="Số năm">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Chuyên môn</label>
                                    <input type="text" class="form-control" name="ChuyenMon" placeholder="VD: Lịch sử, Địa lý...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Ngôn ngữ thành thạo</label>
                                    <input type="text" class="form-control" name="NgonNgu" placeholder="VD: Tiếng Anh, Tiếng Pháp">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Chứng chỉ</label>
                                    <textarea class="form-control" name="ChungChi" rows="2" placeholder="Các chứng chỉ nghề nghiệp"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="LinkAnhDaiDien" accept="image/*">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Trạng thái làm việc</label>
                                    <select class="form-select" name="TrangThai">
                                        <option value="dang_lam" selected>Đang làm</option>
                                        <option value="da_nghi">Đã nghỉ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4" onclick="return confirm('Xác nhận thêm nhân viên này?')">
                                <i class="fas fa-plus-circle"></i> Thêm nhân viên
                            </button>
                            <a href="index.php?act=listNV" class="btn btn-secondary px-4"><i class="fas fa-times"></i> Hủy</a>
                        </div>
    </div>
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm(e) {
            const form = e.target;
            const inputs = form.querySelectorAll('input, select, textarea');
            let isFull = true;
            for (let i = 0; i < inputs.length; i++) {
                const el = inputs[i];
                if (el.type === 'hidden' || el.disabled || el.type === 'submit') {
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
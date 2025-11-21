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
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="#"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container mt-4">
    <h3 class="mb-4 text-primary">Thông Tin Chi Tiết Nhân Viên</h3>

    <div class="card shadow p-4">
        <div class="row">

            <!-- Ảnh đại diện -->
            <div class="col-md-4 text-center">
                <img src="uploads/nhanvien/<?= $nhanVien['LinkAnhDaiDien'] ?>" 
                     class="img-fluid rounded" style="max-height: 240px;">
                <h5 class="mt-3 text-primary"><?= $nhanVien['HoTen'] ?></h5>

                <p><strong>Mã Code NV:</strong> 
                    <span class="badge bg-dark"><?= $nhanVien['MaCodeNhanVien'] ?></span>
                </p>
            </div>

            <!-- Thông tin chi tiết -->
            <div class="col-md-8">

                <table class="table table-bordered">
                    <tr>
                        <th>Họ Tên</th>
                        <td><?= $nhanVien['HoTen'] ?></td>
                    </tr>

                    <tr>
                        <th>Vai Trò</th>
                        <td><?= $nhanVien['VaiTro'] ?></td>
                    </tr>

                    <tr>
                        <th>Số Điện Thoại</th>
                        <td><?= $nhanVien['SoDienThoai'] ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?= $nhanVien['Email'] ?></td>
                    </tr>

                    <tr>
                        <th>Ngày Sinh</th>
                        <td><?= $nhanVien['NgaySinh'] ?></td>
                    </tr>

                    <tr>
                        <th>Giới Tính</th>
                        <td>
                            <?php
                                if ($nhanVien['GioiTinh'] == 'nam') echo "Nam";
                                elseif ($nhanVien['GioiTinh'] == 'nu') echo "Nữ";
                                else echo "Khác";
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Địa Chỉ</th>
                        <td><?= $nhanVien['DiaChi'] ?></td>
                    </tr>

                    <tr>
                        <th>Chứng Chỉ</th>
                        <td><?= $nhanVien['ChungChi'] ?></td>
                    </tr>

                    <tr>
                        <th>Ngôn Ngữ</th>
                        <td><?= $nhanVien['NgonNgu'] ?></td>
                    </tr>

                    <tr>
                        <th>Số Năm Kinh Nghiệm</th>
                        <td><?= $nhanVien['SoNamKinhNghiem'] ?> năm</td>
                    </tr>

                    <tr>
                        <th>Chuyên Môn</th>
                        <td><?= $nhanVien['ChuyenMon'] ?></td>
                    </tr>

                    <tr>
                        <th>Trạng Thái</th>
                        <td>
                            <?php if ($nhanVien['TrangThai'] == "dang_lam"): ?>
                                <span class="badge bg-success">Đang làm</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Đã nghỉ</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Ngày Tạo</th>
                        <td><?= $nhanVien['NgayTao'] ?></td>
                    </tr>
                </table>

                <a href="index.php?act=listNV" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>
</div>

    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
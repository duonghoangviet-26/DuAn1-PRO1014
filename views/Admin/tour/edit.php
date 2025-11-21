<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tour</title>

    <!-- Bootstrap + FontAwesome -->
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

        .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: bold;
        }

        .content {
            margin-left: 250px;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 35px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>

        <a href="#"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour" class="active"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- NỘI DUNG CHÍNH -->
    <div class="content">

        <h2 class="fw-bold mb-4">Sửa Tour</h2>

        <?php if (!isset($tour)) : ?>
            <div class='alert alert-danger'>Không tìm thấy dữ liệu tour.</div>
        <?php else : ?>

            <form action="index.php?act=updateTour" method="POST" enctype="multipart/form-data">

                <!-- ID tour -->
                <input type="hidden" name="MaTour" value="<?= $tour['MaTour'] ?>">

                <!-- Tên tour -->
                <label class="form-label">Tên tour</label>
                <input type="text" name="TenTour"
                    value="<?= htmlspecialchars($tour['TenTour']) ?>"
                    class="form-control mb-3" required>

                <!-- Danh mục -->
                <label class="form-label">Danh mục tour</label>
                <select name="MaDanhMuc" class="form-control mb-3" required>
                    <?php foreach ($danhmuc as $dm): ?>
                        <option value="<?= $dm['MaDanhMuc'] ?>"
                            <?= ($dm['MaDanhMuc'] == $tour['MaDanhMuc']) ? "selected" : "" ?>>
                            <?= $dm['TenDanhMuc'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Giá bán -->
                <label class="form-label">Giá bán</label>
                <input type="number" name="GiaBanMacDinh"
                    value="<?= (float)$tour['GiaBanMacDinh'] ?>"
                    class="form-control mb-3" required>

                <!-- Điểm khởi hành -->
                <label class="form-label">Điểm khởi hành</label>
                <input type="text" name="DiemKhoiHanh"
                    value="<?= htmlspecialchars($tour['DiemKhoiHanh']) ?>"
                    class="form-control mb-3" required>

                <!-- Số ngày -->
                <label class="form-label">Số ngày</label>
                <input type="number" name="SoNgay"
                    value="<?= (int)$tour['SoNgay'] ?>"
                    class="form-control mb-3" required>

                <div class="form-group">
                    <label>Số đêm</label>
                    <input type="number" class="form-control"
                        name="SoDem" value="<?= $tour['SoDem'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Giá vốn dự kiến</label>
                    <input type="number" class="form-control"
                        name="GiaVonDuKien" value="<?= $tour['GiaVonDuKien'] ?>" required>
                </div>
                <!-- ⭐ NGÀY BẮT ĐẦU -->
                <div class="mb-3">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="NgayBatDau"
                        value="<?= $tour['NgayBatDau'] ?>"
                        class="form-control" required>
                </div>

                <!-- ⭐ NGÀY KẾT THÚC -->
                <div class="mb-3">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" name="NgayKetThuc"
                        value="<?= $tour['NgayKetThuc'] ?>"
                        class="form-control" required>
                </div>

                <!-- Mô tả -->
                <label class="form-label">Mô tả</label>
                <textarea name="MoTa" rows="4" class="form-control mb-4"><?= htmlspecialchars($tour['MoTa']) ?></textarea>

                <!-- Ảnh hiện tại -->
                <label class="form-label">Ảnh hiện tại</label><br>
                <?php if (!empty($tour["LinkAnhBia"])): ?>
                    <img src="uploads/imgproduct/<?= $tour['LinkAnhBia'] ?>"
                        style="width:150px; height:110px; object-fit:cover; border-radius:5px; border:1px solid #ccc;">
                <?php else: ?>
                    <p class="text-muted">Chưa có ảnh</p>
                <?php endif; ?>

                <br><br>

                <!-- Upload ảnh mới -->
                <label class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
                <input type="file" name="LinkAnhBia" class="form-control mb-4" accept="image/*">


                <hr class="my-4">

                <h4 class="fw-bold text-primary"><i class="fa fa-calendar"></i> Sửa Lịch Trình Tour</h4>

                <?php if (!empty($lichTrinh)): ?>
                    <?php foreach ($lichTrinh as $lt): ?>
                        <div class="border rounded p-3 mb-3">

                            <input type="hidden" name="MaLichTrinh[]" value="<?= $lt['MaLichTrinh'] ?>">

                            <label>Ngày thứ <?= $lt['NgayThu'] ?></label>

                            <label>Tiêu đề ngày</label>
                            <input type="text"
                                name="TieuDeNgay[]"
                                value="<?= htmlspecialchars($lt['TieuDeNgay']) ?>"
                                class="form-control mb-2">

                            <label>Chi tiết hoạt động</label>
                            <textarea name="ChiTietHoatDong[]"
                                class="form-control mb-2"><?= htmlspecialchars($lt['ChiTietHoatDong']) ?></textarea>

                            <label>Nơi ở</label>
                            <input type="text"
                                name="NoiO[]"
                                value="<?= htmlspecialchars($lt['NoiO']) ?>"
                                class="form-control mb-2">

                            <label>Địa điểm tham quan</label>
                            <input type="text"
                                name="DiaDiemThamQuan[]"
                                value="<?= htmlspecialchars($lt['DiaDiemThamQuan']) ?>"
                                class="form-control mb-2">


                            <!-- ⭐ GIỜ TRONG NGÀY -->
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label>Giờ tập trung</label>
                                    <input type="time" name="GioTapTrung[]"
                                        value="<?= $lt['GioTapTrung'] ?>"
                                        class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <label>Giờ xuất phát</label>
                                    <input type="time" name="GioXuatPhat[]"
                                        value="<?= $lt['GioXuatPhat'] ?>"
                                        class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <label>Giờ kết thúc</label>
                                    <input type="time" name="GioKetThuc[]"
                                        value="<?= $lt['GioKetThuc'] ?>"
                                        class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <label>Giờ hoạt động</label>
                                    <input type="time" name="GioHoatDong[]"
                                        value="<?= $lt['GioHoatDong'] ?>"
                                        class="form-control mb-2">
                                </div>
                            </div>
                            <!-- ⚡ HẾT PHẦN GIỜ -->

                            <label>Bữa ăn:</label><br>

                            <label><input type="checkbox" name="CoBuaSang[]" value="1"
                                    <?= $lt['CoBuaSang'] ? 'checked' : '' ?>> Sáng</label>

                            <label><input type="checkbox" name="CoBuaTrua[]" value="1"
                                    <?= $lt['CoBuaTrua'] ? 'checked' : '' ?>> Trưa</label>

                            <label><input type="checkbox" name="CoBuaToi[]" value="1"
                                    <?= $lt['CoBuaToi'] ? 'checked' : '' ?>> Tối</label>


                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p class="text-muted">Tour này chưa có lịch trình.</p>
                <?php endif; ?>

                <hr class="my-4">

                <!-- <h4 class="fw-bold text-dark"><i class="fa fa-file-contract"></i> Chính Sách Tour</h4>

                <label class="form-label">Giá Bao Gồm</label>
                <textarea name="ChinhSachBaoGom" rows="3" class="form-control mb-3"><?= htmlspecialchars($tour['ChinhSachBaoGom'] ?? "") ?></textarea>

                <label class="form-label">Giá Không Bao Gồm</label>
                <textarea name="ChinhSachKhongBaoGom" rows="3" class="form-control mb-3"><?= htmlspecialchars($tour['ChinhSachKhongBaoGom'] ?? "") ?></textarea>

                <label class="form-label">Chính Sách Hủy Tour</label>
                <textarea name="ChinhSachHuy" rows="3" class="form-control mb-3"><?= htmlspecialchars($tour['ChinhSachHuy'] ?? "") ?></textarea>

                <label class="form-label">Chính Sách Hoàn Tiền</label>
                <textarea name="ChinhSachHoanTien" rows="3" class="form-control mb-3"><?= htmlspecialchars($tour['ChinhSachHoanTien'] ?? "") ?></textarea>

 -->
                <button type="submit" name="btn-update" class="btn btn-success">Cập nhật</button>
                <a href="index.php?act=listTour" class="btn btn-secondary ms-2">Quay lại</a>


            </form>

        <?php endif; ?>

    </div>

</body>

</html>
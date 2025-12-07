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

    <div class="content">

        <h2 class="fw-bold mb-4">Sửa Tour</h2>

        <?php if (!isset($tour)) : ?>
            <div class='alert alert-danger'>Không tìm thấy dữ liệu tour.</div>
        <?php else : ?>

            <form action="index.php?act=updateTour" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="MaTour" value="<?= $tour['MaTour'] ?>">

                <label class="form-label">Tên tour</label>
                <input type="text" name="TenTour"
                    value="<?= htmlspecialchars($tour['TenTour']) ?>"
                    class="form-control mb-3" required>

                <label class="form-label">Danh mục tour</label>
                <select name="MaDanhMuc" class="form-control mb-3" required>
                    <?php foreach ($danhmuc as $dm): ?>
                        <option value="<?= $dm['MaDanhMuc'] ?>"
                            <?= ($dm['MaDanhMuc'] == $tour['MaDanhMuc']) ? "selected" : "" ?>>
                            <?= $dm['TenDanhMuc'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label class="form-label">Giá bán</label>
                <input type="number" name="GiaBanMacDinh"
                    value="<?= (float)$tour['GiaBanMacDinh'] ?>"
                    class="form-control mb-3" required>

                <label class="form-label">Điểm khởi hành</label>
                <input type="text" name="DiemKhoiHanh"
                    value="<?= htmlspecialchars($tour['DiemKhoiHanh']) ?>"
                    class="form-control mb-3" required>

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
                <div class="mb-3">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="NgayBatDau"
                        value="<?= $tour['NgayBatDau'] ?>"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" name="NgayKetThuc"
                        value="<?= $tour['NgayKetThuc'] ?>"
                        class="form-control" required>
                </div>

                <label class="form-label">Mô tả</label>
                <textarea name="MoTa" rows="4" class="form-control mb-4"><?= htmlspecialchars($tour['MoTa']) ?></textarea>

                <label class="form-label">Trạng thái</label>
                <select name="TrangThai" class="form-control mb-4">
                    <option value="hoat_dong" <?= ($tour['TrangThai'] == 'hoat_dong') ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="tam_dung" <?= ($tour['TrangThai'] == 'tam_dung') ? 'selected' : '' ?>>Tạm dừng</option>
                    <option value="da_ket_thuc" <?= ($tour['TrangThai'] == 'da_ket_thuc') ? 'selected' : '' ?>>Đã kết thúc</option>
                </select>

              
                <label class="form-label">Ảnh hiện tại</label><br>
                <?php if (!empty($tour["LinkAnhBia"])): ?>
                    <img src="uploads/imgproduct/<?= $tour['LinkAnhBia'] ?>"
                        style="width:150px; height:110px; object-fit:cover; border-radius:5px; border:1px solid #ccc;">
                <?php else: ?>
                    <p class="text-muted">Chưa có ảnh</p>
                <?php endif; ?>

                <br><br>

                <label class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
                <input type="file" name="LinkAnhBia" class="form-control mb-4" accept="image/*">


                <hr class="my-4">

                <h4 class="fw-bold text-primary"><i class="fa fa-calendar"></i> Sửa Lịch Trình Tour</h4>

                <?php foreach ($lichTrinh as $idx => $lt): ?>
                    <div class="border rounded p-3 mb-4">

                        <input type="hidden" name="MaLichTrinh[]" value="<?= $lt['MaLichTrinh'] ?>">

                        <h5 class="text-primary fw-bold">Ngày thứ <?= $lt['NgayThu'] ?></h5>

                        <label>Tiêu đề ngày</label>
                        <input type="text" class="form-control mb-2" name="TieuDeNgay[]" value="<?= $lt['TieuDeNgay'] ?>">

                        <label>Nơi ở</label>
                        <input type="text" class="form-control mb-2" name="NoiO[]" value="<?= $lt['NoiO'] ?>">

                        <label>Địa điểm tham quan</label>
                        <input type="text" class="form-control mb-2" name="DiaDiemThamQuan[]" value="<?= $lt['DiaDiemThamQuan'] ?>">

                        <div class="row">
                            <div class="col-md-4">
                                <label>Giờ tập trung</label>
                                <input type="time" class="form-control" name="GioTapTrung[]" value="<?= $lt['GioTapTrung'] ?>">
                            </div>

                            <div class="col-md-4">
                                <label>Giờ xuất phát</label>
                                <input type="time" class="form-control" name="GioXuatPhat[]" value="<?= $lt['GioXuatPhat'] ?>">
                            </div>

                            <div class="col-md-4">
                                <label>Giờ kết thúc</label>
                                <input type="time" class="form-control" name="GioKetThuc[]" value="<?= $lt['GioKetThuc'] ?>">
                            </div>
                        </div>

                        <label class="mt-3"><b>Bữa ăn:</b></label><br>
                        <label><input type="checkbox" name="CoBuaSang[]" value="1" <?= $lt['CoBuaSang'] ? "checked" : "" ?>> Sáng</label>
                        <label class="ms-3"><input type="checkbox" name="CoBuaTrua[]" value="1" <?= $lt['CoBuaTrua'] ? "checked" : "" ?>> Trưa</label>
                        <label class="ms-3"><input type="checkbox" name="CoBuaToi[]" value="1" <?= $lt['CoBuaToi'] ? "checked" : "" ?>> Tối</label>

                        <hr>

                        <h6 class="fw-bold">☀ Hoạt động buổi sáng</h6>

                        <div id="BuoiSang_<?= $idx ?>">
                            <?php foreach ($lt['Sang']['gio'] as $j => $g): ?>
                                <div class="row mb-2 singleRow">
                                    <div class="col-md-3">
                                        <input type="time" class="form-control"
                                            name="Sang_Gio[<?= $idx ?>][]" value="<?= $g ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            name="Sang_HD[<?= $idx ?>][]" value="<?= $lt['Sang']['hd'][$j] ?>">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <span class="text-danger delRow" style="cursor:pointer; font-size:18px;">&times;</span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary"
                            onclick="addRow('Sang', <?= $idx ?>)">+ Thêm giờ sáng</button>

                        <hr>

                        <h6 class="fw-bold">🍱 Hoạt động buổi trưa</h6>

                        <div id="BuoiTrua_<?= $idx ?>">
                            <?php foreach ($lt['Trua']['gio'] as $j => $g): ?>
                                <div class="row mb-2 singleRow">
                                    <div class="col-md-3">
                                        <input type="time" class="form-control"
                                            name="Sang_Gio[<?= $idx ?>][]" value="<?= $g ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            name="Sang_HD[<?= $idx ?>][]" value="<?= $lt['Sang']['hd'][$j] ?>">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <span class="text-danger delRow" style="cursor:pointer; font-size:18px;">&times;</span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-warning"
                            onclick="addRow('Trua', <?= $idx ?>)">+ Thêm giờ trưa</button>

                        <hr>

                        <h6 class="fw-bold">🌇 Hoạt động buổi chiều</h6>

                        <div id="BuoiChieu_<?= $idx ?>">
                            <?php foreach ($lt['Chieu']['gio'] as $j => $g): ?>
                                <div class="row mb-2 singleRow">
                                    <div class="col-md-3">
                                        <input type="time" class="form-control"
                                            name="Sang_Gio[<?= $idx ?>][]" value="<?= $g ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            name="Sang_HD[<?= $idx ?>][]" value="<?= $lt['Sang']['hd'][$j] ?>">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <span class="text-danger delRow" style="cursor:pointer; font-size:18px;">&times;</span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-info"
                            onclick="addRow('Chieu', <?= $idx ?>)">+ Thêm giờ chiều</button>

                        <hr>

                        <h6 class="fw-bold">🌙 Hoạt động buổi tối</h6>

                        <div id="BuoiToi_<?= $idx ?>">
                            <?php foreach ($lt['Toi']['gio'] as $j => $g): ?>
                                <div class="row mb-2 singleRow">
                                    <div class="col-md-3">
                                        <input type="time" class="form-control"
                                            name="Sang_Gio[<?= $idx ?>][]" value="<?= $g ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            name="Sang_HD[<?= $idx ?>][]" value="<?= $lt['Sang']['hd'][$j] ?>">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <span class="text-danger delRow" style="cursor:pointer; font-size:18px;">&times;</span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-dark"
                            onclick="addRow('Toi', <?= $idx ?>)">+ Thêm giờ tối</button>

                    </div>
                <?php endforeach; ?>

                <button class="btn btn-success">Cập nhật</button>
                <a href="index.php?act=listTour" class="btn btn-secondary">Quay lại</a>



            </form>

        <?php endif; ?>

    </div>
    <script>
        function addRow(type, day) {
    const container = document.getElementById("Buoi" + type + "_" + day);

    const html = `
        <div class="row mb-2 singleRow">
            <div class="col-md-3">
                <input type="time" class="form-control" name="${type}_Gio[${day}][]">
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="${type}_HD[${day}][]" placeholder="Hoạt động">
            </div>
            <div class="col-md-1 d-flex align-items-center justify-content-center">
                <span class="text-danger delRow" style="cursor:pointer; font-size:18px;">&times;</span>
            </div>
        </div>
    `;

    container.insertAdjacentHTML("beforeend", html);
}

        document.addEventListener("click", function (e) {
    if (e.target.classList.contains("delRow")) {
        let row = e.target.closest(".singleRow");
        row.remove();
    }
});

    </script>

</body>

</html>
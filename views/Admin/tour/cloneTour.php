<?php
// HÀM TÁCH NỘI DUNG BUỔI THÀNH MẢNG
function tachBuoi($str)
{
    $lines = explode("\n", trim($str));
    $gio = [];
    $hd = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line == "") continue;

        if (preg_match('/⏰\s*([0-9:\-]+)\s*-\s*(.*)/u', $line, $m)) {
            $gio[] = trim($m[1]);
            $hd[]  = trim($m[2]);
        }
    }
    return ["gio" => $gio, "hd" => $hd];
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Nhân bản tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ccc;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .delRow {
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php">Tổng quan</a>
        <a href="index.php?act=listdm">Danh mục tour</a>
        <a class="active" href="index.php?act=listTour">Quản lý tour</a>
        <a href="index.php?act=listBooking">Booking</a>
        <a href="index.php?act=listNV">Tài khoản / HDV</a>
    </div>

    <div class="content">

        <h2 class="fw-bold mb-4">Nhân bản Tour</h2>

        <form action="index.php?act=cloneTourSave" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="OldAnh" value="<?= $tour['LinkAnhBia'] ?>">

            <label class="form-label">Tên tour</label>
            <input type="text" name="TenTour" class="form-control mb-3" value="<?= htmlspecialchars($tour['TenTour']) ?>" required>

            <label>Danh mục</label>
            <select name="MaDanhMuc" class="form-control mb-3">
                <?php foreach ($danhmuc as $dm): ?>
                    <option value="<?= $dm['MaDanhMuc'] ?>" <?= $tour['MaDanhMuc'] == $dm['MaDanhMuc'] ? 'selected' : '' ?>>
                        <?= $dm['TenDanhMuc'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Giá bán</label>
            <input type="number" name="GiaBanMacDinh" class="form-control mb-3" value="<?= $tour['GiaBanMacDinh'] ?>" required>

            <label>Giá vốn dự kiến</label>
            <input type="number" name="GiaVonDuKien" class="form-control mb-3" value="<?= $tour['GiaVonDuKien'] ?>" required>

            <label>Điểm khởi hành</label>
            <input type="text" name="DiemKhoiHanh" class="form-control mb-3" value="<?= $tour['DiemKhoiHanh'] ?>" required>

            <label>Số ngày</label>
            <input type="number" name="SoNgay" class="form-control mb-3" value="<?= $tour['SoNgay'] ?>" required>

            <label>Số đêm</label>
            <input type="number" name="SoDem" class="form-control mb-3" value="<?= $tour['SoDem'] ?>" required>
            <label class="form-label">Trạng thái</label>
            <select name="TrangThai" class="form-control mb-3" required>
                <option value="hoat_dong">Hoạt động</option>
                <option value="tam_dung">Tạm dừng</option>
                <option value="da_ket_thuc">Đã kết thúc</option>
            </select>

            <label>Ngày bắt đầu</label>
            <input type="date" name="NgayBatDau" class="form-control mb-3" value="<?= $tour['NgayBatDau'] ?>" required>

            <label>Ngày kết thúc</label>
            <input type="date" name="NgayKetThuc" class="form-control mb-3" value="<?= $tour['NgayKetThuc'] ?>" required>

            <label>Mô tả</label>
            <textarea name="MoTa" class="form-control mb-3" rows="3"><?= htmlspecialchars($tour['MoTa']) ?></textarea>

            <hr>

            <h4 class="fw-bold text-primary">📅 Lịch Trình Tour</h4>

            <?php foreach ($lichTrinh as $idx => $lt): ?>

                <?php
                $Sang  = tachBuoi($lt["NoiDungSang"]);
                $Trua  = tachBuoi($lt["NoiDungTrua"]);
                $Chieu = tachBuoi($lt["NoiDungChieu"]);
                $Toi   = tachBuoi($lt["NoiDungToi"]);
                ?>

                <div class="border rounded p-3 mt-4 bg-white">

                    <input type="hidden" name="NgayThu[]" value="<?= $lt['NgayThu'] ?>">
                    <input type="hidden" name="MaLichTrinh[]" value="<?= $lt['MaLichTrinh'] ?>">

                    <input type="hidden" name="ChiTietHoatDong[]" value="">
                    <input type="hidden" name="GioHoatDong[]" value="">

                    <h5 class="fw-bold text-primary">Ngày thứ <?= $lt['NgayThu'] ?></h5>

                    <label>Tiêu đề ngày</label>
                    <input type="text" name="TieuDeNgay[]" class="form-control mb-2" value="<?= htmlspecialchars($lt['TieuDeNgay']) ?>">

                    <label>Nơi ở</label>
                    <input type="text" name="NoiO[]" class="form-control mb-2" value="<?= htmlspecialchars($lt['NoiO']) ?>">

                    <label>Địa điểm tham quan</label>
                    <input type="text" name="DiaDiemThamQuan[]" class="form-control mb-2" value="<?= htmlspecialchars($lt['DiaDiemThamQuan']) ?>">

                    <label>Giờ tập trung</label>
                    <input type="time" name="GioTapTrung[]" class="form-control mb-2" value="<?= $lt['GioTapTrung'] ?>">

                    <label>Giờ xuất phát</label>
                    <input type="time" name="GioXuatPhat[]" class="form-control mb-2" value="<?= $lt['GioXuatPhat'] ?>">

                    <label>Giờ kết thúc</label>
                    <input type="time" name="GioKetThuc[]" class="form-control mb-2" value="<?= $lt['GioKetThuc'] ?>">

                    <hr>

                    <h6>☀ Hoạt động buổi sáng</h6>
                    <div id="Sang_<?= $idx ?>">
                        <?php foreach ($Sang['gio'] as $i => $g): ?>
                            <div class="row mb-2 singleRow">
                                <div class="col-md-3"><input type="time" class="form-control" name="GioSang[<?= $idx ?>][]" value="<?= $g ?>"></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="NoiDungSang[<?= $idx ?>][]" value="<?= $Sang['hd'][$i] ?>"></div>
                                <div class="col-md-1 text-center"><span class="delRow text-danger">&times;</span></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRow('Sang', <?= $idx ?>)">+ Thêm giờ sáng</button>

                    <hr>

                    <h6>🍱 Hoạt động buổi trưa</h6>
                    <div id="Trua_<?= $idx ?>">
                        <?php foreach ($Trua['gio'] as $i => $g): ?>
                            <div class="row mb-2 singleRow">
                                <div class="col-md-3">
                                    <input type="time" class="form-control" name="GioTrua[<?= $idx ?>][]" value="<?= $g ?>">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="NoiDungTrua[<?= $idx ?>][]" value="<?= $Trua['hd'][$i] ?>">
                                </div>

                                <div class="col-md-1 text-center"><span class="delRow text-danger">&times;</span></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="addRow('Trua', <?= $idx ?>)">+ Thêm giờ trưa</button>

                    <hr>

                    <h6>🌇 Hoạt động buổi chiều</h6>
                    <div id="Chieu_<?= $idx ?>">
                        <?php foreach ($Chieu['gio'] as $i => $g): ?>
                            <div class="row mb-2 singleRow">
                                <div class="col-md-3">
                                    <input type="time" class="form-control" name="GioChieu[<?= $idx ?>][]" value="<?= $g ?>">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="NoiDungChieu[<?= $idx ?>][]" value="<?= $Chieu['hd'][$i] ?>">
                                </div>

                                <div class="col-md-1 text-center"><span class="delRow text-danger">&times;</span></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-info" onclick="addRow('Chieu', <?= $idx ?>)">+ Thêm giờ chiều</button>

                    <hr>

                    <h6>🌙 Hoạt động buổi tối</h6>
                    <div id="Toi_<?= $idx ?>">
                        <?php foreach ($Toi['gio'] as $i => $g): ?>
                            <div class="row mb-2 singleRow">
                                <div class="col-md-3">
                                    <input type="time" class="form-control" name="GioToi[<?= $idx ?>][]" value="<?= $g ?>">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="NoiDungToi[<?= $idx ?>][]" value="<?= $Toi['hd'][$i] ?>">
                                </div>

                                <div class="col-md-1 text-center"><span class="delRow text-danger">&times;</span></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-dark" onclick="addRow('Toi', <?= $idx ?>)">+ Thêm giờ tối</button>

                </div>

            <?php endforeach; ?>

            <button class="btn btn-success btn-lg mt-4">Nhân bản Tour</button>
            <a href="index.php?act=listTour" class="btn btn-secondary mt-4 ms-2">Quay lại</a>

        </form>

    </div>

    <script>
        function addRow(buoi, id) {
            const map = {
                Sang: ["GioSang", "NoiDungSang"],
                Trua: ["GioTrua", "NoiDungTrua"],
                Chieu: ["GioChieu", "NoiDungChieu"],
                Toi: ["GioToi", "NoiDungToi"]
            };

            let [gioName, ndName] = map[buoi];
            let wrap = document.getElementById(buoi + "_" + id);

            let html = `
        <div class="row mb-2 singleRow">
            <div class="col-md-3">
                <input type="time" class="form-control" name="${gioName}[${id}][]">
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="${ndName}[${id}][]" placeholder="Hoạt động">
            </div>
            <div class="col-md-1 text-center">
                <span class="delRow text-danger" style="cursor:pointer">&times;</span>
            </div>
        </div>
    `;

            wrap.insertAdjacentHTML("beforeend", html);
        }

        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("delRow")) {
                e.target.closest(".singleRow").remove();
            }
        });
    </script>

</body>

</html>
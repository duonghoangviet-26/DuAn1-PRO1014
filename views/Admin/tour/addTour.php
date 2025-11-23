<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tour Mới</title>

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
            padding: 40px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour" class="active"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">
        <h2 class="fw-bold mb-4">Thêm Tour Mới</h2>

        <form action="index.php?act=createTour" method="POST" enctype="multipart/form-data">

            <!-- THÔNG TIN TOUR -->
            <div class="mb-3">
                <label class="form-label">Tên tour</label>
                <input type="text" name="TenTour" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục tour</label>
                <select name="MaDanhMuc" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($danhmuc as $dm): ?>
                        <option value="<?= $dm['MaDanhMuc'] ?>"><?= $dm['TenDanhMuc'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Giá bán</label>
                    <input type="number" name="GiaBanMacDinh" class="form-control" required min=0>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Điểm khởi hành</label>
                    <input type="text" name="DiemKhoiHanh" class="form-control" required>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá vốn dự kiến</label>
                    <input type="number" class="form-control" name="GiaVonDuKien" required min=0>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Số ngày</label>
                    <input type="number" name="SoNgay" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Số đêm</label>
                    <input type="number" name="SoDem" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="NgayBatDau" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" name="NgayKetThuc" class="form-control" required>
                </div>
            </div>

            <!-- Ảnh bìa -->
            <div class="mb-3">
                <label class="form-label">Ảnh bìa tour</label>
                <input type="file" name="LinkAnhBia" class="form-control" accept="image/*">
            </div>

            <div class="mb-4">
                <label class="form-label">Mô tả tour</label>
                <textarea name="MoTa" class="form-control" rows="4"></textarea>
            </div>

            <!-- LỊCH TRÌNH TOUR -->
            <hr>
            <h4 class="fw-bold text-primary"><i class="fa fa-calendar"></i> Lịch Trình Tour</h4>

            <div id="lichTrinhContainer">

                <!-- BLOCK LỊCH TRÌNH MẪU -->
                <div class="lichTrinhItem border p-3 my-3 rounded">

                    <label>Ngày thứ</label>
                    <input type="number" name="NgayThu[]" class="form-control mb-2" placeholder="1" required>

                    <label>Tiêu đề ngày</label>
                    <input type="text" name="TieuDeNgay[]" class="form-control mb-2">

                    <label>Nơi ở</label>
                    <input type="text" name="NoiO[]" class="form-control mb-2">

                    <label>Địa điểm tham quan</label>
                    <input type="text" name="DiaDiemThamQuan[]" class="form-control mb-2">

                    <label><b>Bữa ăn:</b></label><br>
                    <label><input type="checkbox" class="me-1 bua-sang"> Sáng</label>
                    <label><input type="checkbox" class="ms-3 me-1 bua-trua"> Trưa</label>
                    <label><input type="checkbox" class="ms-3 me-1 bua-toi"> Tối</label>

                    <!-- hidden real values -->
                    <input type="hidden" name="CoBuaSang[]" value="0">
                    <input type="hidden" name="CoBuaTrua[]" value="0">
                    <input type="hidden" name="CoBuaToi[]" value="0">

                    <div class="row">
                        <label><b>Giờ</b></label><br>
                        <div class="col-md-4 mb-2">
                            <label>Giờ tập trung</label>
                            <input type="time" name="GioTapTrung[]" class="form-control">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label>Giờ xuất phát</label>
                            <input type="time" name="GioXuatPhat[]" class="form-control">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label>Giờ kết thúc</label>
                            <input type="time" name="GioKetThuc[]" class="form-control">
                        </div>
                    </div>

                    <label>Nội dung buổi sáng</label>
                    <textarea name="NoiDungSang[]" class="form-control" rows="2"></textarea>

                    <label class="mt-2">Nội dung buổi trưa</label>
                    <textarea name="NoiDungTrua[]" class="form-control" rows="2"></textarea>

                    <label class="mt-2">Nội dung buổi chiều</label>
                    <textarea name="NoiDungChieu[]" class="form-control" rows="2"></textarea>

                    <label class="mt-2">Nội dung buổi tối</label>
                    <textarea name="NoiDungToi[]" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <!-- Nút thêm ngày -->
            <button type="button" id="addDayBtn" class="btn btn-info mb-4">+ Thêm Ngày</button>

            <!-- NÚT SUBMIT -->
            <hr>
            <button type="submit" name="btn-add" class="btn btn-success px-4">Thêm Tour</button>
            <a href="index.php?act=listTour" class="btn btn-secondary ms-2">Quay lại</a>

        </form>
    </div>

    <!-- JS thêm ngày -->
    <script>
        document.getElementById("addDayBtn").onclick = function() {
            let container = document.getElementById("lichTrinhContainer");
            let item = container.querySelector(".lichTrinhItem");
            let clone = item.cloneNode(true);

            clone.querySelectorAll("input, textarea").forEach(el => {
                if (el.type !== "hidden") el.value = "";
                if (el.type === "checkbox") el.checked = false;
            });

            container.appendChild(clone);
        };

        document.addEventListener("change", function(e) {
            if (e.target.classList.contains("bua-sang")) {
                e.target.parentNode.parentNode.querySelector("input[name='CoBuaSang[]']").value = e.target.checked ? 1 : 0;
            }
            if (e.target.classList.contains("bua-trua")) {
                e.target.parentNode.parentNode.querySelector("input[name='CoBuaTrua[]']").value = e.target.checked ? 1 : 0;
            }
            if (e.target.classList.contains("bua-toi")) {
                e.target.parentNode.parentNode.querySelector("input[name='CoBuaToi[]']").value = e.target.checked ? 1 : 0;
            }
        });
    </script>
    <script>
    // danh sách các trường giá cần chặn số âm
    const priceFields = ["GiaBanMacDinh", "GiaVonDuKien"];

    priceFields.forEach(name => {
        document.querySelector(`input[name="${name}"]`).addEventListener("input", function () {
            if (this.value < 0) this.value = 0;

            // Nếu người dùng cố tình gõ dấu trừ "-"
            if (this.value.includes("-")) this.value = this.value.replace("-", "");
        });
    });
</script>


</body>

</html>
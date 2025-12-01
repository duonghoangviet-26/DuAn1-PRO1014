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
            padding: 10px 20px;
            display: block;
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

        .delRow {
            cursor: pointer;
            color: red;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour" class="active"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <h2 class="fw-bold mb-4">Thêm Tour Mới</h2>

        <form action="index.php?act=createTour" method="POST" enctype="multipart/form-data">

            <!--============ THÔNG TIN TOUR ============-->
            <div class="mb-3">
                <label>Tên tour</label>
                <input type="text" name="TenTour" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Danh mục tour</label>
                <select name="MaDanhMuc" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>

                    <?php foreach ($danhmuc as $dm): ?>
                        <option value="<?= $dm['MaDanhMuc'] ?>">
                            <?= htmlspecialchars($dm['TenDanhMuc']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Giá bán</label>
                    <input type="number" name="GiaBanMacDinh" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Điểm khởi hành</label>
                    <input type="text" name="DiemKhoiHanh" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Giá vốn</label>
                    <input type="number" name="GiaVonDuKien" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Số ngày</label>
                    <input type="number" name="SoNgay" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Số đêm</label>
                    <input type="number" name="SoDem" class="form-control" required>
                </div>


            </div>
            <label class="form-label">Trạng thái</label>
<select name="TrangThai" class="form-control mb-3" required>
    <option value="hoat_dong">Hoạt động</option>
    <option value="tam_dung">Tạm dừng</option>
    <option value="da_ket_thuc">Đã kết thúc</option>
</select>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Ngày bắt đầu</label>
                    <input type="date" name="NgayBatDau" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Ngày kết thúc</label>
                    <input type="date" name="NgayKetThuc" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Ảnh bìa tour</label>
                <input type="file" name="LinkAnhBia" class="form-control" accept="image/*">
            </div>

            <label>Mô tả tour</label>
            <textarea name="MoTa" class="form-control mb-4"></textarea>

            <hr>

            <!--============ LỊCH TRÌNH ============-->
            <h4 class="fw-bold text-primary mb-3"><i class="fa fa-calendar"></i> Lịch Trình Tour</h4>

            <div id="lichTrinhContainer">

                <!--========= MẪU NGÀY 1 (index = 0) =========-->
                <div class="lichTrinhItem border p-3 my-3 rounded" data-index="0">

                    <label><b>Ngày thứ</b></label>
                    <input type="number" name="NgayThu[]" class="form-control mb-2" value="1" readonly>

                    <label>Tiêu đề ngày</label>
                    <input type="text" name="TieuDeNgay[]" class="form-control mb-2">

                    <label>Nơi ở</label>
                    <input type="text" name="NoiO[]" class="form-control mb-2">

                    <label>Địa điểm tham quan</label>
                    <input type="text" name="DiaDiemThamQuan[]" class="form-control mb-2">
                    <div class="mt-3">
                        <label><b>Bữa ăn bao gồm:</b></label><br>

                        <label class="me-3">
                            <input type="checkbox" name="CoBuaSang[]" value="1"> Sáng
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="CoBuaTrua[]" value="1"> Trưa
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="CoBuaToi[]" value="1"> Tối
                        </label>
                    </div>

                    <!-- GIỜ HOẠT ĐỘNG CHUNG -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Giờ tập trung</label>
                            <input type="time" name="GioTapTrung[]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Giờ xuất phát</label>
                            <input type="time" name="GioXuatPhat[]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Giờ kết thúc</label>
                            <input type="time" name="GioKetThuc[]" class="form-control">
                        </div>
                    </div>

                    <hr>
                    <h5><b>Giờ & hoạt động từng buổi</b></h5>

                    <!--======== BUỔI SÁNG =========-->
                    <h6>☀ Buổi sáng</h6>
                    <div id="BuoiSang_0">
                        <div class="row mt-2 singleRow">
                            <div class="col-md-3">
                                <input type="time" class="form-control" name="GioSang[0][]">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NoiDungSang[0][]" placeholder="Hoạt động">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <span class="delRow">&times;</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRow('Sang',0)">+ Thêm giờ sáng</button>

                    <!--======== BUỔI TRƯA =========-->
                    <h6 class="mt-3">🍱 Buổi trưa</h6>
                    <div id="BuoiTrua_0">
                        <div class="row mt-2 singleRow">
                            <div class="col-md-3">
                                <input type="time" class="form-control" name="GioTrua[0][]">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NoiDungTrua[0][]" placeholder="Hoạt động">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <span class="delRow">&times;</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRow('Trua',0)">+ Thêm giờ trưa</button>

                    <!--======== BUỔI CHIỀU =========-->
                    <h6 class="mt-3">🌇 Buổi chiều</h6>
                    <div id="BuoiChieu_0">
                        <div class="row mt-2 singleRow">
                            <div class="col-md-3">
                                <input type="time" class="form-control" name="GioChieu[0][]">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NoiDungChieu[0][]" placeholder="Hoạt động">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <span class="delRow">&times;</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRow('Chieu',0)">+ Thêm giờ chiều</button>

                    <!--======== BUỔI TỐI =========-->
                    <h6 class="mt-3">🌙 Buổi tối</h6>
                    <div id="BuoiToi_0">
                        <div class="row mt-2 singleRow">
                            <div class="col-md-3">
                                <input type="time" class="form-control" name="GioToi[0][]">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NoiDungToi[0][]" placeholder="Hoạt động">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <span class="delRow">&times;</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRow('Toi',0)">+ Thêm giờ tối</button>

                </div>
            </div>

            <button type="button" id="addDayBtn" class="btn btn-info mt-3">+ Thêm ngày</button>

            <hr>
            <button type="submit" name="btn-add" class="btn btn-success px-4">Thêm tour</button>

        </form>
    </div>

    <!--============= JAVASCRIPT XỬ LÝ =============-->
    <script>
        let dayIndex = 0;

        document.getElementById("addDayBtn").onclick = function() {
            dayIndex++;

            let container = document.getElementById("lichTrinhContainer");
            let first = container.querySelector(".lichTrinhItem");
            let clone = first.cloneNode(true);

            // SET DATA-INDEX CHO NGÀY MỚI
            clone.setAttribute("data-index", dayIndex);

            // --- RESET INPUT NHƯNG KHÔNG RESET NGÀY THỨ ---
            clone.querySelectorAll("input, textarea").forEach(el => {
                if (el.name !== "NgayThu[]") {
                    el.value = "";
                }
            });

            // --- CẬP NHẬT NGÀY THỨ ---
            clone.querySelector("input[name='NgayThu[]']").value = dayIndex + 1;

            // --- CẬP NHẬT ID CỦA BUỔI (BuoiSang_0 → BuoiSang_1) ---
            clone.querySelectorAll("[id]").forEach(el => {
                if (el.id.includes("_0")) {
                    el.id = el.id.replace("_0", "_" + dayIndex);
                }
            });

            // --- CẬP NHẬT NAME MẢNG THEO NGÀY (GioSang[0] → GioSang[1]) ---
            clone.querySelectorAll("input[name], textarea[name]").forEach(el => {
                el.name = el.name.replace("[0]", "[" + dayIndex + "]");
            });

            // --- CẬP NHẬT FUNCTION addRow ĐỂ KHÔNG BỊ LỖI ---
            clone.querySelectorAll("button").forEach(btn => {
                let onclickAttr = btn.getAttribute("onclick");
                if (onclickAttr && onclickAttr.includes("addRow")) {
                    btn.setAttribute("onclick", onclickAttr.replace(",0)", "," + dayIndex + ")"));
                }
            });

            container.appendChild(clone);
        };


        // ====== HÀM THÊM GIỜ GIỮ NGUYÊN ======
        function addRow(session, day) {
            let container = document.getElementById("Buoi" + session + "_" + day);

            let html = `
        <div class="row mt-2 singleRow">
            <div class="col-md-3">
                <input type="time" class="form-control" name="Gio${session}[${day}][]">
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="NoiDung${session}[${day}][]" placeholder="Hoạt động">
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <span class="delRow">&times;</span>
            </div>
        </div>
    `;

            container.insertAdjacentHTML("beforeend", html);
        }


        // ====== XÓA DÒNG ======
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("delRow")) {
                let row = e.target.closest(".singleRow");
                let parent = row.parentNode;

                if (parent.children.length > 1) row.remove();
                else alert("Phải có ít nhất 1 giờ trong mỗi buổi!");
            }
        });
    </script>

</body>

</html>
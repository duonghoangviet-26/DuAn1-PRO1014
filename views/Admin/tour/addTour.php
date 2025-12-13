<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tour Mới</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            margin: 0;
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
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 25px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.2rem;
            color: #fff;
            display: flex;
            align-items: center;
        }

        .sidebar-menu {
            padding: 0 10px;
        }

        .sidebar-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #95a5a6;
            margin: 15px 15px 5px;
            font-weight: 600;
        }

        .sidebar a {
            color: #bdc3c7;
            padding: 12px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: 0.3s;
            margin-bottom: 5px;
        }

        .sidebar a i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: #3498db;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .card-form {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            background: #fff;
            margin-bottom: 30px;
        }

        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 20px 25px;
            border-radius: 12px 12px 0 0;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border-color: #e5e7eb;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .schedule-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .schedule-header {
            background: #f8fafc;
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .schedule-body {
            padding: 20px;
        }

        .session-block {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #cbd5e1;
        }

        .session-morning {
            border-left-color: #f59e0b;
        }

        .session-noon {
            border-left-color: #ef4444;
        }

        .session-afternoon {
            border-left-color: #3b82f6;
        }

        .session-evening {
            border-left-color: #8b5cf6;
        }

        .delRow {
            cursor: pointer;
            color: #ef4444;
            font-size: 1.2rem;
            transition: 0.2s;
        }

        .delRow:hover {
            color: #dc2626;
            transform: scale(1.1);
        }

        .btn-action {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
        }
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
            <a href="index.php?act=listTour" class="active"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>
            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>
            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng
                xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listTour" class="text-secondary me-3 fs-4"><i
                            class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Thêm Tour Mới</h3>
                        <p class="text-muted mb-0">Thiết lập thông tin và lịch trình tour</p>
                    </div>
                </div>
            </div>

            <form action="index.php?act=createTour" method="POST" enctype="multipart/form-data">

                <div class="card card-form">
                    <div class="card-header-custom">
                        <h5 class="fw-bold text-primary mb-0"><i class="fas fa-info-circle me-2"></i> Thông Tin Cơ Bản
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên tour <span class="text-danger">*</span></label>
                                    <input type="text" name="TenTour" class="form-control"
                                        placeholder="Nhập tên tour..." required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                    <select name="MaDanhMuc" class="form-select" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php foreach ($danhmuc as $dm): ?>
                                            <option value="<?= $dm['MaDanhMuc'] ?>">
                                                <?= htmlspecialchars($dm['TenDanhMuc']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Giá bán</label>
                                        <input type="number" name="GiaBanMacDinh" class="form-control" placeholder="0"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Giá vốn</label>
                                        <input type="number" name="GiaVonDuKien" class="form-control" placeholder="0"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Điểm khởi hành</label>
                                    <input type="text" name="DiemKhoiHanh" class="form-control"
                                        placeholder="VD: Hà Nội, TP.HCM..." required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Số ngày</label>
                                        <input type="number" name="SoNgay" class="form-control" min="1" value="1"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Số đêm</label>
                                        <input type="number" name="SoDem" class="form-control" min="0" value="0"
                                            required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="TrangThai" class="form-select bg-light" required>
                                        <option value="hoat_dong">🟢 Hoạt động</option>
                                        <option value="tam_dung">🟠 Tạm dừng</option>
                                        <option value="da_ket_thuc">🔴 Đã kết thúc</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ngày bắt đầu</label>
                                        <input type="date" name="NgayBatDau" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ngày kết thúc</label>
                                        <input type="date" name="NgayKetThuc" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ảnh bìa</label>
                                    <input type="file" name="LinkAnhBia" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Mô tả chi tiết</label>
                                <textarea name="MoTa" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold text-dark mb-0">Lịch Trình Chi Tiết</h4>
                    <button type="button" id="addDayBtn" class="btn btn-primary btn-action">
                        <i class="fas fa-plus me-2"></i> Thêm Ngày Mới
                    </button>
                </div>

                <div id="lichTrinhContainer">
                    <div class="schedule-card lichTrinhItem" data-index="0">
                        <div class="schedule-header">
                            <h6 class="mb-0 fw-bold text-primary">NGÀY <span class="day-number">1</span></h6>
                            <input type="hidden" name="NgayThu[]" value="1">
                        </div>
                        <div class="schedule-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Tiêu đề ngày</label>
                                    <input type="text" name="TieuDeNgay[]" class="form-control"
                                        placeholder="VD: Khám phá Vịnh Hạ Long" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Địa điểm tham quan</label>
                                    <input type="text" name="DiaDiemThamQuan[]" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Nơi ở (Khách sạn)</label>
                                    <input type="text" name="NoiO[]" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small text-muted me-3">Bữa ăn bao gồm:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="CoBuaSang[]" value="1">
                                        <label class="form-check-label">Sáng</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="CoBuaTrua[]" value="1">
                                        <label class="form-check-label">Trưa</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="CoBuaToi[]" value="1">
                                        <label class="form-check-label">Tối</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4 p-3 bg-light rounded">
                                <div class="col-md-4"><input type="time" name="GioTapTrung[]" class="form-control"
                                        required>
                                    <div class="form-text">Giờ tập trung</div>
                                </div>
                                <div class="col-md-4"><input type="time" name="GioXuatPhat[]" class="form-control"
                                        required>
                                    <div class="form-text">Giờ xuất phát</div>
                                </div>
                                <div class="col-md-4"><input type="time" name="GioKetThuc[]" class="form-control"
                                        require>
                                    <div class="form-text">Giờ kết thúc</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="session-block session-morning">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong><i class="fas fa-sun text-warning me-2"></i>Sáng</strong>
                                            <button type="button" class="btn btn-sm btn-light text-primary py-0"
                                                onclick="addRow('Sang',0)">+ Thêm</button>
                                        </div>
                                        <div id="BuoiSang_0">
                                            <div class="row mt-2 singleRow">
                                                <div class="col-3"><input type="time"
                                                        class="form-control form-control-sm" name="GioSang[0][]"
                                                        required></div>
                                                <div class="col-8"><input type="text"
                                                        class="form-control form-control-sm" name="NoiDungSang[0][]"
                                                        placeholder="Hoạt động..." required></div>
                                                <div class="col-1"><span class="delRow">&times;</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="session-block session-noon">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong><i class="fas fa-utensils text-danger me-2"></i>Trưa</strong>
                                            <button type="button" class="btn btn-sm btn-light text-primary py-0"
                                                onclick="addRow('Trua',0)">+ Thêm</button>
                                        </div>
                                        <div id="BuoiTrua_0">
                                            <div class="row mt-2 singleRow">
                                                <div class="col-3"><input type="time"
                                                        class="form-control form-control-sm" name="GioTrua[0][]"
                                                        required></div>
                                                <div class="col-8"><input type="text"
                                                        class="form-control form-control-sm" name="NoiDungTrua[0][]"
                                                        placeholder="Hoạt động..." required></div>
                                                <div class="col-1"><span class="delRow">&times;</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="session-block session-afternoon">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong><i class="fas fa-cloud-sun text-primary me-2"></i>Chiều</strong>
                                            <button type="button" class="btn btn-sm btn-light text-primary py-0"
                                                onclick="addRow('Chieu',0)">+ Thêm</button>
                                        </div>
                                        <div id="BuoiChieu_0">
                                            <div class="row mt-2 singleRow">
                                                <div class="col-3"><input type="time"
                                                        class="form-control form-control-sm" name="GioChieu[0][]"
                                                        required></div>
                                                <div class="col-8"><input type="text"
                                                        class="form-control form-control-sm" name="NoiDungChieu[0][]"
                                                        placeholder="Hoạt động..." required></div>
                                                <div class="col-1"><span class="delRow">&times;</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="session-block session-evening">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong><i class="fas fa-moon text-info me-2"></i>Tối</strong>
                                            <button type="button" class="btn btn-sm btn-light text-primary py-0"
                                                onclick="addRow('Toi',0)">+ Thêm</button>
                                        </div>
                                        <div id="BuoiToi_0">
                                            <div class="row mt-2 singleRow">
                                                <div class="col-3"><input type="time"
                                                        class="form-control form-control-sm" name="GioToi[0][]"
                                                        required></div>
                                                <div class="col-8"><input type="text"
                                                        class="form-control form-control-sm" name="NoiDungToi[0][]"
                                                        placeholder="Hoạt động..." required></div>
                                                <div class="col-1"><span class="delRow">&times;</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-form p-3 sticky-bottom text-end">
                    <a href="index.php?act=listTour" class="btn btn-light btn-action border me-2">Hủy bỏ</a>


                    <button type="submit" class="btn btn-success btn-action" name="btn-add">

                        <i class="fas fa-save me-2"></i> Lưu Tour
                    </button>

                </div>

            </form>
        </div>
    </div>

    <script>
        let dayIndex = 0;

        document.getElementById("addDayBtn").onclick = function() {
            dayIndex++;

            let container = document.getElementById("lichTrinhContainer");
            let first = container.querySelector(".lichTrinhItem");
            let clone = first.cloneNode(true);

            clone.setAttribute("data-index", dayIndex);

            clone.querySelector(".day-number").innerText = dayIndex + 1;
            clone.querySelector("input[name='NgayThu[]']").value = dayIndex + 1;

            clone.querySelectorAll("input[type='text'], input[type='time']").forEach(el => el.value = "");
            clone.querySelectorAll("input[type='checkbox']").forEach(el => el.checked = false);

            clone.querySelectorAll("[id^='Buoi']").forEach(el => {
                let parts = el.id.split('_');
                el.id = parts[0] + "_" + dayIndex;
            });

            clone.querySelectorAll("input[name]").forEach(el => {
                let name = el.name;
                if (name.indexOf('[') !== -1) {
                    if (name.match(/\[\d+\]\[\]/)) {
                        el.name = name.replace(/\[\d+\]/, "[" + dayIndex + "]");
                    }
                }
            });

            clone.querySelectorAll("button").forEach(btn => {
                let onclickAttr = btn.getAttribute("onclick");
                if (onclickAttr && onclickAttr.includes("addRow")) {
                    btn.setAttribute("onclick", onclickAttr.replace(",0)", "," + dayIndex + ")"));
                }
            });

            container.appendChild(clone);
        };

        function addRow(session, day) {
            let container = document.getElementById("Buoi" + session + "_" + day);
            let html = `
                <div class="row mt-2 singleRow">
                    <div class="col-3">
                        <input type="time" class="form-control form-control-sm" name="Gio${session}[${day}][]" required>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" name="NoiDung${session}[${day}][]" placeholder="Hoạt động..." required>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <span class="delRow">&times;</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML("beforeend", html);
        }

        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("delRow")) {
                let row = e.target.closest(".singleRow");
                let parent = row.parentNode;
                if (parent.children.length > 1) row.remove();
                else alert("Phải có ít nhất 1 dòng hoạt động!");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
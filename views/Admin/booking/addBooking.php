<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Booking Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        background: #eef2f7 !important;
        font-family: "Inter", "Segoe UI", sans-serif;
        color: #333;
    }

    .card {
        border: none;
        border-radius: 14px;
    }

    .card-header-custom {
        background: white;
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 20px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
    }

    .card-header-custom h3 {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .btn-back {
        border-radius: 50%;
        padding: 10px 12px;
        border: none;
        background: #f1f3f5;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #e2e6ea;
    }

    /* Main card */
    .card-body {
        padding: 25px;
    }

    h5 {
        font-weight: 600;
        margin-top: 25px;
        padding-bottom: 6px;
        border-left: 4px solid #0d6efd;
        padding-left: 10px;
    }


    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        height: 45px;
        border-radius: 10px;
        border: 1px solid #ced4da;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.13);
    }

    input[readonly] {
        background: #f8f9fa;
        font-weight: 700;
    }

    /* ===== CUSTOMER & GUEST SECTION ===== */

    #khachContainer .card {
        border-left: 4px solid #28a745;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }

    #khachContainer h6 {
        font-size: 1rem;
        font-weight: 600;
    }

    /* ===== BUTTONS ===== */
    .btn-primary {
        padding: 10px 25px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
    }

    .btn-secondary {
        padding: 10px 25px;
        border-radius: 8px;
        font-size: 15px;
    }

    /* Hover effects */
    .btn-primary:hover {
        filter: brightness(1.15);
    }

    .btn-secondary:hover {
        background: #6c757d;
        color: white;
    }


    option {
        padding: 8px;
    }

    /* Đoàn lỗi */
    #doanMessage {
        font-size: 14px;
    }

    /* Nhấn mạnh nhóm */
    h5.text-primary {
        font-size: 18px;
        margin-top: 30px !important;
        padding-left: 12px;
        border-left: 4px solid #0d6efd;
    }

    /* INPUT STYLE */
    .form-control,
    .form-select {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #d0d7de;
        background: #ffffff;
        transition: .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    /* CARD SECTION */
    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        padding: 20px;
    }

    /* HEADER CARD */
    .card shadow-sm.mb-4 {
        border-radius: 14px;
    }

    /* LABEL */
    .form-label {
        font-weight: 600;
        font-size: 14px;
    }

    /* BUTTONS */
    .btn-primary {
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
    }

    .btn-secondary {
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 15px;
    }

    /* KHÁCH ĐI TOUR CARD */
    .khach-card {
        border-left: 4px solid #198754;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 18px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        background: #fff;
    }

    .khach-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #198754;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* GRID 5 INPUT */

    .khach-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
    }


    .customer-grid-3 .col-md-6,
    .customer-grid-3 .col-md-12 {
        flex: 0 0 calc(33.333% - 10px);
        max-width: calc(33.333% - 10px);
    }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <a href="index.php?controller=booking&action=index" class="btn btn-light me-3">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h3 class="mb-0">Tạo Booking Mới</h3>
                                <p class="text-muted mb-0">Nhập thông tin khách hàng và tour</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger mb-3">
                            <?= $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                        </div>
                        <?php endif; ?>
                        <form method="POST" action="index.php?act=createBookingProcess">
                            <div class="row g-3">
                                <input type="hidden" name="MaCodeBooking" value="<?= 'BK' . date('YmdHis') ?>">
                                <!-- Khách hàng -->
                                <h5 class="text-primary mt-3"><i class="fa fa-user"></i> Thông tin khách hàng đại diện
                                </h5>
                                <div class="grid-3">
                                    <div>
                                        <label class="form-label">Họ tên *</label>
                                        <input name="KH_HoTen" class="form-control" required>
                                    </div>

                                    <div>
                                        <label class="form-label">Số điện thoại *</label>
                                        <input name="KH_SDT" class="form-control" required>
                                    </div>

                                    <div>
                                        <label class="form-label">Email</label>
                                        <input name="KH_Email" class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label">Ngày sinh</label>
                                        <input type="date" name="KH_NgaySinh" class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label">Số giấy tờ(CCCD)</label>
                                        <input name="KH_SoGiayTo" class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label">Địa chỉ</label>
                                        <input name="KH_DiaChi" class="form-control">
                                    </div>
                                    <!-- Loại booking -->
                                    <div class="">
                                        <label class="form-label">Loại booking</label>
                                        <select name="LoaiBooking" class="form-select">
                                            <option value="ca_nhan">Cá nhân</option>
                                            <option value="nhom">Nhóm</option>
                                            <option value="cong_ty">Công Ty</option>
                                        </select>
                                    </div>

                                </div>


                                <!-- Tour -->
                                <h5 class="text-primary mt-3"><i class=""></i> Chọn Tour Muốn Booking
                                </h5>
                                <div class="col-md-12">
                                    <label class="form-label">Vui lòng chọn Tour <span
                                            class="text-danger">*</span></label>
                                    <select name="MaTour" id="tourSelect" class="form-select" required>
                                        <option value="">-- Chọn tour --</option>
                                        <?php foreach ($tours as $tour): ?>
                                        <option value="<?= $tour['MaTour'] ?>"
                                            data-price="<?= $tour['GiaBanMacDinh'] ?>"
                                            data-start="<?= $tour['NgayBatDau'] ?>"
                                            data-end="<?= $tour['NgayKetThuc'] ?>">

                                            <?= htmlspecialchars($tour['TenTour']) ?>
                                            (<?= date('d/m/Y', strtotime($tour['NgayBatDau'])) ?> →
                                            <?= date('d/m/Y', strtotime($tour['NgayKetThuc'])) ?>)
                                            - <?= number_format($tour['GiaBanMacDinh'], 0, ',', '.') ?>đ
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>



                                <!-- COMPANY FIELDS -->
                                <div id="companyFields" style="display: none;">
                                    <h6 class="mt-3 fw-bold text-primary">Thông tin công ty</h6>

                                    <div class="grid-3 mt-2">

                                        <div>
                                            <label class="form-label">Tên công ty</label>
                                            <input name="KH_TenCongTy" class="form-control">
                                        </div>

                                        <div>
                                            <label class="form-label">Mã số thuế</label>
                                            <input name="KH_MaSoThue" class="form-control">
                                        </div>

                                        <div style="grid-column: span 3;">
                                            <label class="form-label">Ghi chú</label>
                                            <textarea name="KH_GhiChu" class="form-control"></textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Chọn Đoàn Khởi Hành<span
                                            class="text-danger">*</span></label>

                                    <select name="MaDoan" id="doanSelect" class="form-select" required>
                                        <option value="">-- Chọn Đoàn Khởi Hành --</option>
                                        <!-- Các option sẽ được load bằng AJAX -->
                                    </select>

                                    <p id="doanMessage" class="text-danger mt-1 fw-bold"></p>
                                </div>



                                <h5 class="text-primary mt-3"><i class="fa fa-users"></i> Nhập số lượng khách</h5>

                                <div class="grid-3">

                                    <div>
                                        <label class="form-label">Số người lớn <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="TongNguoiLon" id="adults" value="0" min="0"
                                            class="form-control" onchange="calculateTotal()" required>
                                    </div>

                                    <div>
                                        <label class="form-label">Số trẻ em (6-11 tuổi)</label>
                                        <input type="number" name="TongTreEm" id="children" value="0" min="0"
                                            class="form-control" onchange="calculateTotal()">
                                    </div>

                                    <div>
                                        <label class="form-label">Số em bé (&lt; 6 tuổi)</label>
                                        <input type="number" name="TongEmBe" id="babies" value="0" min="0"
                                            class="form-control" onchange="calculateTotal()">
                                    </div>

                                </div>

                                <div class="grid-3">

                                    <div>
                                        <label class="form-label">Tổng tiền (VNĐ)</label>
                                        <input type="number" name="TongTien" id="totalAmount"
                                            class="form-control bg-light fw-bold" readonly>
                                    </div>

                                    <div>
                                        <label class="form-label">Số tiền đặt cọc (VNĐ)</label>
                                        <input type="number" name="SoTienDaCoc" value="0" min="0" class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label">Trạng thái</label>
                                        <select name="TrangThai" class="form-select">
                                            <option value="cho_coc">Chờ cọc</option>
                                            <option value="da_coc">Đã cọc</option>
                                            <option value="hoan_tat">Hoàn tất</option>
                                            <option value="da_huy">Đã hủy</option>
                                        </select>
                                    </div>

                                </div>
                                <hr class="my-4">

                                <h5 class="mb-3 text-primary"><i class="fa fa-users"></i> Danh Sách Khách Đi Tour
                                </h5>

                                <div id="khachContainer"></div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="index.php?controller=booking&action=index" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo Booking
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function renderKhachInputs() {
        let nl = parseInt(document.getElementById('adults').value) || 0;
        let te = parseInt(document.getElementById('children').value) || 0;
        let eb = parseInt(document.getElementById('babies').value) || 0;
        let total = nl + te + eb;

        let container = document.getElementById('khachContainer');
        container.innerHTML = ""; // reset

        for (let i = 1; i <= total; i++) {
            container.innerHTML += `
            <div class="card khach-card mb-3">
                <h6 class="khach-title">Khách Thứ ${i}</h6>

                <div class="khach-grid">
                    <div>
                        <label class="form-label">Họ tên</label>
                        <input name="khach[${i}][HoTen]" class="form-control" required>
                    </div>

                    <div >
                        <label class="form-label">Giới tính</label>
                        <select name="khach[${i}][GioiTinh]" class="form-control" required>
                            <option>-Chọn-</option>
                            <option>Nam</option>
                            <option>Nữ</option>
                        </select>
                    </div>

                    <div >
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" name="khach[${i}][NgaySinh]" class="form-control">
                    </div>

                    <div >
                        <label class="form-label">Số giấy tờ</label>
                        <input name="khach[${i}][GiayTo]" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">SDT</label>
                        <input name="khach[${i}][SDT]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        }
    }

    // Kích hoạt khi thay đổi số lượng
    document.getElementById('adults').addEventListener('change', renderKhachInputs);
    document.getElementById('children').addEventListener('change', renderKhachInputs);
    document.getElementById('babies').addEventListener('change', renderKhachInputs);

    // Tính tiền
    function calculateTotal() {
        const tourSelect = document.getElementById('tourSelect');
        const selectedOption = tourSelect.options[tourSelect.selectedIndex];
        const basePrice = parseFloat(selectedOption.dataset.price) || 0;

        const adults = parseInt(document.getElementById('adults').value) || 0;
        const children = parseInt(document.getElementById('children').value) || 0;
        const babies = parseInt(document.getElementById('babies').value) || 0;

        // Trẻ em 70%, em bé 30%
        const total = (adults * basePrice) + (children * basePrice * 0.7) + (babies * basePrice * 0.3);

        document.getElementById('totalAmount').value = Math.round(total);
    }

    document.getElementById('tourSelect').addEventListener('change', calculateTotal);

    // HIỂN THỊ ĐOÀN THEO TOUR  
    document.getElementById('tourSelect').addEventListener('change', function() {
        let maTour = this.value;

        fetch('index.php?act=getDoanByTour&MaTour=' + maTour)
            .then(response => response.json())
            .then(data => {
                let doanSelect = document.getElementById('doanSelect');
                let msg = document.getElementById('doanMessage');

                doanSelect.innerHTML = '<option value="">-- Chọn Đoàn Khởi Hành --</option>';
                msg.innerHTML = '';

                if (data.length === 0) {
                    msg.innerHTML = '❌ Tour này chưa có đoàn khởi hành!';
                    return;
                }

                data.forEach(d => {
                    doanSelect.innerHTML += `
                    <option value="${d.MaDoan}">
                        [#${d.MaDoan}] ${d.TenTour} - ${d.NgayKhoiHanh}
                    </option>
                `;
                });
            });
    });
    </script>


</body>

</html>
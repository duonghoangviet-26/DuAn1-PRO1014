<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Booking</title>

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

        .card-body {
            padding: 25px;
        }

        .header-card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
            margin-bottom: 20px;
        }

        .header-card h3 {
            font-weight: 700;
            font-size: 1.45rem;
        }

        .btn-back {
            border-radius: 50%;
            padding: 10px 12px;
            border: none;
            background: #f1f3f5;
        }

        .btn-back:hover {
            background: #e2e6ea;
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
        }

        .form-control,
        .form-select {
            height: 45px;
            border-radius: 10px;
        }

        input[readonly] {
            background: #f8f9fa;
            font-weight: 700;
        }

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

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        @media (max-width: 992px) {
            .grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        textarea {
            border-radius: 10px !important;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- HEADER -->
                <div class="header-card d-flex align-items-center">
                    <a href="index.php?controller=booking&action=index" class="btn-back me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>

                    <div>
                        <h3 class="mb-0">Cập nhật Booking</h3>
                        <p class="text-muted mb-0">Mã booking: <?= $booking['MaCodeBooking'] ?></p>
                    </div>
                </div>

                <!-- ERROR -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger mb-3">
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- FORM -->
                <div class="card shadow-sm">
                    <div class="card-body">

                        <form method="POST" action="index.php?act=editBookingProcess">
                            <!-- <input type="hidden" name="LoaiKhach" value="<?= $khachDaiDien['LoaiKhach'] ?>"> -->
                            <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">
                            <input type="hidden" name="LoaiKhach" value="<?= $khachDaiDien['LoaiKhach'] ?>">
                            <input type="hidden" name="KH_GioiTinh" value="<?= $khachDaiDien['GioiTinh'] ?>">
                            <input type="hidden" name="MaKhachHang" value="<?= $booking['MaKhachHang'] ?>">

                            <!-- TOUR -->
                            <h5><i class="fa fa-map"></i> Thông tin tour</h5>

                            <d class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Tour</label>
                                    <select name="MaTour" id="tourSelect" class="form-select" required>
                                        <?php foreach ($tours as $tour): ?>
                                            <option value="<?= $tour['MaTour'] ?>"
                                                data-price="<?= $tour['GiaBanMacDinh'] ?>"
                                                <?= $booking['MaTour'] == $tour['MaTour'] ? 'selected' : '' ?>>
                                                <?= $tour['TenTour'] ?> - <?= number_format($tour['GiaBanMacDinh']) ?>đ
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- ĐOÀN -->
                                <h5><i class="fa fa-calendar"></i> Đoàn khởi hành</h5>

                                <select name="MaDoan" id="doanSelect" class="form-select" required>
                                    <option value="">-- Chọn Đoàn Khởi Hành --</option>
                                </select>

                                <p id="doanMessage" class="text-danger mt-1 fw-bold"></p>

                                <input type="hidden" name="MaKhachHang" value="<?= $booking['MaKhachHang'] ?>">


                                <!-- KHACH -->
                                <h5 class="text-primary mt-3"><i class="fa fa-user"></i> Thông tin khách hàng đại diện
                                </h5>
                                <div class="grid-3 mt-2">

                                    <div>
                                        <label class="form-label">Họ tên *</label>
                                        <input name="KH_HoTen" class="form-control"
                                            value="<?= $khachDaiDien['HoTen'] ?>" required>
                                    </div>

                                    <div>
                                        <label class="form-label">Số điện thoại *</label>
                                        <input name="KH_SDT" class="form-control"
                                            value="<?= $khachDaiDien['SoDienThoai'] ?>" required>
                                    </div>

                                    <div>
                                        <label class="form-label">Email</label>
                                        <input name="KH_Email" class="form-control"
                                            value="<?= $khachDaiDien['Email'] ?>">
                                    </div>

                                    <div>
                                        <label class="form-label">Ngày sinh</label>
                                        <input type="date" name="KH_NgaySinh" class="form-control"
                                            value="<?= $khachDaiDien['NgaySinh'] ?>">
                                    </div>

                                    <div>
                                        <label class="form-label">Số giấy tờ</label>
                                        <input name="KH_SoGiayTo" class="form-control"
                                            value="<?= $khachDaiDien['SoGiayTo'] ?>">
                                    </div>

                                    <div>
                                        <label class="form-label">Địa chỉ</label>
                                        <input name="KH_DiaChi" class="form-control"
                                            value="<?= $khachDaiDien['DiaChi'] ?>">
                                    </div>
                                    <!-- Loại -->
                                    <div>
                                        <label class="form-label">Loại booking</label>
                                        <select name="LoaiBooking" class="form-select">
                                            <option value="ca_nhan"
                                                <?= $booking['LoaiBooking'] == 'ca_nhan' ? 'selected' : '' ?>>
                                                Cá nhân</option>
                                            <option value="nhom"
                                                <?= $booking['LoaiBooking'] == 'nhom' ? 'selected' : '' ?>>
                                                Nhóm</option>
                                        </select>
                                    </div>
                                </div>


                                <div style="display:none;">
                                    <label class="form-label">Loại khách</label>
                                    <select name="LoaiKhach" class="form-select" required>
                                        <option value="ca_nhan"
                                            <?= $khachDaiDien['LoaiKhach'] == 'ca_nhan' ? 'selected' : '' ?>>Cá nhân
                                        </option>
                                        <option value="cong_ty"
                                            <?= $khachDaiDien['LoaiKhach'] == 'cong_ty' ? 'selected' : '' ?>>Công ty
                                        </option>
                                    </select>
                                </div>


                                <h5><i class="fa fa-users"></i> Số lượng khách</h5>
                                <div class="grid-3 mt-2">
                                    <!-- SỐ LƯỢNG -->
                                    <div>
                                        <label class="form-label">Người lớn</label>
                                        <input type="number" name="TongNguoiLon" id="adults"
                                            value="<?= $booking['TongNguoiLon'] ?>" min="0" class="form-control"
                                            onchange="calculateTotal()">
                                    </div>

                                    <div>
                                        <label class="form-label">Trẻ em</label>
                                        <input type="number" name="TongTreEm" id="children"
                                            value="<?= $booking['TongTreEm'] ?>" min="0" class="form-control"
                                            onchange="calculateTotal()">
                                    </div>

                                    <div>
                                        <label class="form-label">Em bé</label>
                                        <input type="number" name="TongEmBe" id="babies"
                                            value="<?= $booking['TongEmBe'] ?>" min="0" class="form-control"
                                            onchange="calculateTotal()">
                                    </div>
                                </div>

                                <!-- TIỀN -->
                                <h5><i class="fa fa-money-bill"></i> Thanh toán</h5>

                                <div class="grid-3 mt-2">
                                    <div>
                                        <label class="form-label">Tổng tiền</label>
                                        <input type="number" class="form-control fw-bold bg-light" id="totalAmount"
                                            name="TongTien" value="<?= $booking['TongTien'] ?>" readonly>
                                    </div>

                                    <div>
                                        <label class="form-label">Đặt cọc</label>
                                        <input type="number" name="SoTienDaCoc" class="form-control"
                                            value="<?= $booking['SoTienDaCoc'] ?>">
                                    </div>




                                    <div>
                                        <label class="form-label">Trạng thái</label>
                                        <select name="TrangThai" class="form-select">
                                            <option value="cho_coc"
                                                <?= $booking['TrangThai'] == 'cho_coc' ? 'selected' : '' ?>>
                                                Chờ cọc</option>
                                            <option value="da_coc"
                                                <?= $booking['TrangThai'] == 'da_coc' ? 'selected' : '' ?>>
                                                Đã cọc</option>
                                            <option value="hoan_tat"
                                                <?= $booking['TrangThai'] == 'hoan_tat' ? 'selected' : '' ?>>
                                                Hoàn tất</option>
                                            <option value="da_huy"
                                                <?= $booking['TrangThai'] == 'da_huy' ? 'selected' : '' ?>>
                                                Đã hủy</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- NOTE -->
                                <h5><i class="fa fa-edit"></i> Ghi chú</h5>

                                <div class="col-md-12">
                                    <textarea name="YeuCauDacBiet" rows="4"
                                        class="form-control"><?= $booking['YeuCauDacBiet'] ?></textarea>
                                </div>

                                <!-- BUTTONS -->
                                <div class="d-flex justify-content-end mt-4 gap-2">
                                    <a href="index.php?controller=booking&action=index" class="btn btn-secondary">
                                        Hủy
                                    </a>
                                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>

                                </div>

                        </form>
                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            let maTour = document.getElementById("tourSelect").value;
            let selectedDoan = "<?= $booking['MaDoan'] ?>";

            loadDoan(maTour, selectedDoan);
        });

        document.getElementById('tourSelect').addEventListener('change', function() {
            loadDoan(this.value, null);
        });

        function loadDoan(maTour, selectedDoan = null) {
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
                        let selected = (selectedDoan == d.MaDoan) ? 'selected' : '';
                        doanSelect.innerHTML += `
                    <option value="${d.MaDoan}" ${selected}>
                        [#${d.MaDoan}] ${d.TenTour} - ${d.NgayKhoiHanh}
                    </option>
                `;
                    });
                });
        }
    </script>

</body>

</html>
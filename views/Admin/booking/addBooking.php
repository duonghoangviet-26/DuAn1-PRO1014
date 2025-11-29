<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Booking Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        <form method="POST" action="index.php?act=createBookingProcess">
                            <div class="row g-3">
                                <input type="hidden" name="MaCodeBooking" value="<?= 'BK' . date('YmdHis') ?>">
                                <!-- Tour -->
                                <div class="col-md-12">
                                    <label class="form-label">Tour <span class="text-danger">*</span></label>
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

                                <!-- Khách hàng -->
                                <h5 class="text-primary mt-3"><i class="fa fa-user"></i> Thông tin khách hàng đại diện
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Họ tên *</label>
                                        <input name="KH_HoTen" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Số điện thoại *</label>
                                        <input name="KH_SDT" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input name="KH_Email" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Ngày sinh</label>
                                        <input type="date" name="KH_NgaySinh" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Số giấy tờ</label>
                                        <input name="KH_SoGiayTo" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Địa chỉ</label>
                                        <input name="KH_DiaChi" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Loại Khách</label>
                                        <select name="LoaiKhach" id="LoaiKhach" class="form-select">
                                            <option value="ca_nhan">Cá nhân</option>
                                            <option value="cong_ty">Công ty</option>
                                        </select>
                                    </div>
                                    <div id="companyFields" style="display: none;">
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Tên công ty</label>
                                                <input name="KH_TenCongTy" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Mã số thuế</label>
                                                <input name="KH_MaSoThue" class="form-control">
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Ghi chú</label>
                                                <textarea name="KH_GhiChu" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label">Đoàn khởi hành <span class="text-danger">*</span></label>

                                    <select name="MaDoan" id="doanSelect" class="form-select" required>
                                        <option value="">-- Chọn Đoàn Khởi Hành --</option>
                                        <!-- Các option sẽ được load bằng AJAX -->
                                    </select>

                                    <p id="doanMessage" class="text-danger mt-1 fw-bold"></p>
                                </div>


                                <!-- Loại booking -->
                                <div class="col-md-6">
                                    <label class="form-label">Loại booking</label>
                                    <select name="LoaiBooking" class="form-select">
                                        <option value="ca_nhan">Cá nhân</option>
                                        <option value="nhom">Nhóm</option>
                                    </select>
                                </div>

                                <!-- Người lớn -->
                                <div class="col-md-6">
                                    <label class="form-label">Số người lớn <span class="text-danger">*</span></label>
                                    <input type="number" name="TongNguoiLon" id="adults" value="0" min="0"
                                        class="form-control" onchange="calculateTotal()" required>
                                </div>

                                <!-- Trẻ em -->
                                <div class="col-md-6">
                                    <label class="form-label">Số trẻ em (6-11 tuổi)</label>
                                    <input type="number" name="TongTreEm" id="children" value="0" min="0"
                                        class="form-control" onchange="calculateTotal()">
                                </div>

                                <!-- Em bé -->
                                <div class="col-md-6">
                                    <label class="form-label">Số em bé (&lt; 6 tuổi)</label>
                                    <input type="number" name="TongEmBe" id="babies" value="0" min="0"
                                        class="form-control" onchange="calculateTotal()">
                                </div>

                                <!-- Tổng tiền -->
                                <div class="col-md-6">
                                    <label class="form-label">Tổng tiền (VNĐ)</label>
                                    <input type="number" name="TongTien" id="totalAmount"
                                        class="form-control bg-light fw-bold" readonly>
                                </div>

                                <!-- Đặt cọc -->
                                <div class="col-md-6">
                                    <label class="form-label">Số tiền đặt cọc (VNĐ)</label>
                                    <input type="number" name="SoTienDaCoc" value="0" min="0" class="form-control">
                                </div>

                                <!-- Trạng thái -->
                                <div class="col-md-6">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="TrangThai" class="form-select">
                                        <option value="cho_coc">Chờ cọc</option>
                                        <option value="da_coc">Đã cọc</option>
                                        <option value="hoan_tat">Hoàn tất</option>
                                        <option value="da_huy">Đã hủy</option>
                                    </select>
                                </div>

                                <!-- Yêu cầu đặc biệt -->
                                <div class="col-md-12">
                                    <label class="form-label">Yêu cầu đặc biệt</label>
                                    <textarea name="YeuCauDacBiet" rows="4" class="form-control"
                                        placeholder="Nhập yêu cầu đặc biệt của khách..."></textarea>
                                </div>
                                <hr class="my-4">

                                <h5 class="mb-3 text-primary"><i class="fa fa-users"></i> Danh Sách Khách Đi Tour</h5>

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
            <div class="card p-3 mb-3">
                <h6 class="mb-3 text-success">Khách ${i}</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Họ tên</label>
                        <input name="khach[${i}][HoTen]" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Giới tính</label>
                        <select name="khach[${i}][GioiTinh]" class="form-control" required>
                            <option>-Chọn-</option>
                            <option>Nam</option>
                            <option>Nữ</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" name="khach[${i}][NgaySinh]" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Số giấy tờ</label>
                        <input name="khach[${i}][GiayTo]" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">SDT</label>
                        <input name="khach[${i}][SDT]" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="khach[${i}][GhiChu]" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                    <label class="form-label">Loại phòng</label>
                    <select name="khach[${i}][LoaiPhong]" class="form-control" required>
                        <option value="don">Phòng đơn</option>
                        <option value="doi">Phòng đôi</option>
                        <option value="2_giuong">2 giường</option>
                    </select>
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



        // ẩn hiện nếu chọn là cty 
        document.getElementById("LoaiKhach").addEventListener("change", (e) => {
            let companyBlock = document.getElementById("companyFields");
            if (e.target.value === 'cong_ty') {
                companyBlock.style.display = "block";
            } else {
                companyBlock.style.display = "none";
            }
        });


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
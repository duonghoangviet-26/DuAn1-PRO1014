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
                        <form method="POST" action="index.php?controller=booking&action=store">
                            <div class="row g-3">
                                <!-- Tour -->
                                <div class="col-md-12">
                                    <label class="form-label">Tour <span class="text-danger">*</span></label>
                                    <select name="MaTour" id="tourSelect" class="form-select" required>
                                        <option value="">-- Chọn tour --</option>
                                        <?php foreach ($tours as $tour): ?>
                                            <option value="<?= $tour['MaTour'] ?>"
                                                data-price="<?= $tour['GiaBanMacDinh'] ?>">
                                                <?= htmlspecialchars($tour['TenTour']) ?>
                                                (<?= $tour['SoNgay'] ?>N<?= $tour['SoDem'] ?>Đ) -
                                                <?= number_format($tour['GiaBanMacDinh'], 0, ',', '.') ?>đ
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Khách hàng -->
                                <div class="col-md-12">
                                    <label class="form-label">Khách hàng <span class="text-danger">*</span></label>
                                    <select name="MaKhachHang" class="form-select" required>
                                        <option value="">-- Chọn khách hàng --</option>
                                        <?php foreach ($khachHangs as $kh): ?>
                                            <option value="<?= $kh['MaKhachHang'] ?>">
                                                <?= htmlspecialchars($kh['HoTen']) ?> - <?= $kh['SoDienThoai'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
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
                                    <input type="number" name="TongNguoiLon" id="adults" value="1" min="0"
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
                            </div>

                            <!-- Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="index.php?controller=booking&action=index" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo Nooking
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
    </script>
</body>

</html>
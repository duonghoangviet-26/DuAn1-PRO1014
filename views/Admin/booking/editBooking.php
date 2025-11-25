<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body d-flex align-items-center">
                        <a href="index.php?controller=booking&action=index" class="btn btn-light me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h3 class="mb-0">Update Booking</h3>
                            <p class="text-muted mb-0"><?= $booking['MaCodeBooking'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="index.php?act=editBookingProcess">
                            <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">
                            <div class="row g-3">

                                <!-- TOUR -->
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

                                <!-- KHÁCH -->
                                <div class="col-md-12">
                                    <label class="form-label">Khách hàng</label>
                                    <select name="MaKhachHang" class="form-select" required>
                                        <?php foreach ($khachHangs as $kh): ?>
                                            <option value="<?= $kh['MaKhachHang'] ?>"
                                                <?= $booking['MaKhachHang'] == $kh['MaKhachHang'] ? 'selected' : '' ?>>
                                                <?= $kh['HoTen'] ?> - <?= $kh['SoDienThoai'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- ĐOÀN -->
                                <div class="col-md-12">
                                    <label class="form-label">Đoàn khởi hành</label>
                                    <select name="MaDoan" class="form-select" required>
                                        <?php foreach ($listDoan as $doan): ?>
                                            <option value="<?= $doan['MaDoan'] ?>"
                                                <?= $booking['MaDoan'] == $doan['MaDoan'] ? 'selected' : '' ?>>
                                                [#<?= $doan['MaDoan'] ?>] <?= $doan['TenTour'] ?> -
                                                <?= date('d/m/Y', strtotime($doan['NgayKhoiHanh'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- LOẠI BOOKING -->
                                <div class="col-md-6">
                                    <label class="form-label">Loại booking</label>
                                    <select name="LoaiBooking" class="form-select">
                                        <option value="ca_nhan"
                                            <?= $booking['LoaiBooking'] == 'ca_nhan' ? 'selected' : '' ?>>Cá nhân
                                        </option>
                                        <option value="nhom" <?= $booking['LoaiBooking'] == 'nhom' ? 'selected' : '' ?>>
                                            Nhóm</option>
                                    </select>
                                </div>

                                <!-- NGƯỜI LỚN -->
                                <div class="col-md-6">
                                    <label class="form-label">Người lớn</label>
                                    <input type="number" name="TongNguoiLon" id="adults"
                                        value="<?= $booking['TongNguoiLon'] ?>" min="0" class="form-control"
                                        onchange="calculateTotal()" required>
                                </div>

                                <!-- TRẺ EM -->
                                <div class="col-md-6">
                                    <label class="form-label">Trẻ em</label>
                                    <input type="number" name="TongTreEm" id="children"
                                        value="<?= $booking['TongTreEm'] ?>" min="0" class="form-control"
                                        onchange="calculateTotal()">
                                </div>

                                <!-- EM BÉ -->
                                <div class="col-md-6">
                                    <label class="form-label">Em bé</label>
                                    <input type="number" name="TongEmBe" id="babies" value="<?= $booking['TongEmBe'] ?>"
                                        min="0" class="form-control" onchange="calculateTotal()">
                                </div>

                                <!-- TỔNG TIỀN -->
                                <div class="col-md-6">
                                    <label class="form-label">Tổng tiền (VNĐ)</label>
                                    <input type="number" name="TongTien" id="totalAmount"
                                        class="form-control bg-light fw-bold" readonly
                                        value="<?= $booking['TongTien'] ?>">
                                </div>

                                <!-- ĐẶT CỌC -->
                                <div class="col-md-6">
                                    <label class="form-label">Số tiền đặt cọc</label>
                                    <input type="number" name="SoTienDaCoc" class="form-control"
                                        value="<?= $booking['SoTienDaCoc'] ?>">
                                </div>

                                <!-- TRẠNG THÁI -->
                                <div class="col-md-6">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="TrangThai" class="form-select">
                                        <option value="cho_coc"
                                            <?= $booking['TrangThai'] == 'cho_coc' ? 'selected' : '' ?>>Chờ cọc</option>
                                        <option value="da_coc"
                                            <?= $booking['TrangThai'] == 'da_coc' ? 'selected' : '' ?>>Đã cọc</option>
                                        <option value="hoan_tat"
                                            <?= $booking['TrangThai'] == 'hoan_tat' ? 'selected' : '' ?>>Hoàn tất
                                        </option>
                                        <option value="da_huy"
                                            <?= $booking['TrangThai'] == 'da_huy' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </div>

                                <!-- YÊU CẦU -->
                                <div class="col-md-12">
                                    <label class="form-label">Yêu cầu đặc biệt</label>
                                    <textarea name="YeuCauDacBiet" rows="4"
                                        class="form-control"><?= $booking['YeuCauDacBiet'] ?></textarea>
                                </div>

                            </div>

                            <!-- BUTTONS -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="index.php?controller=booking&action=index" class="btn btn-secondary">
                                    Hủy
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Lưu thay đổi
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS tính tổng tiền -->
    <script>
        function calculateTotal() {
            const tourSelect = document.getElementById('tourSelect');
            const price = parseFloat(tourSelect.options[tourSelect.selectedIndex].dataset.price) || 0;

            const nl = parseInt(document.getElementById('adults').value) || 0;
            const te = parseInt(document.getElementById('children').value) || 0;
            const eb = parseInt(document.getElementById('babies').value) || 0;

            const total = (nl * price) + (te * price * 0.7) + (eb * price * 0.3);

            document.getElementById('totalAmount').value = Math.round(total);
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập Nhật Giao Dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f7fb;
            font-family: 'Segoe UI';
        }

        .card-custom {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-save {
            background: #ff9f0a;
            color: white;
            font-weight: 600;
        }

        .btn-save:hover {
            background: #e08900;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #0a6ebd;
            margin-bottom: 15px;
        }

        .img-preview {
            border-radius: 8px;
            width: 200px;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #085f63;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            color: white;
            z-index: 1000;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a {
            color: #d9f7f5;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0a7b80;
            color: #fff;
        }

        .sidebar a.active {
            border-left: 4px solid #ffc107;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="#"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#" class="active"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>
    <?php
// Bảo vệ: nếu thiếu biến thì dừng
if (!isset($data, $maDoan, $maLich)) {
    die("Thiếu dữ liệu form!");
}
?>

<div class="container mt-4">

    <a href="index.php?act=hdv_vanhanh&id=<?= $maLich ?>" class="btn btn-outline-secondary mb-3">
        ← Quay lại
    </a>

    <h3 class="fw-bold mb-3">Cập Nhật Giao Dịch</h3>

    <form action="index.php?act=hdv_update_tc" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="MaTaiChinh" value="<?= $data['MaTaiChinh'] ?>">
        <input type="hidden" name="MaDoan" value="<?= $maDoan ?>">
        <input type="hidden" name="MaLichLamViec" value="<?= $maLich ?>">
        <input type="hidden" name="AnhCu" value="<?= $data['AnhChungTu'] ?>">

        <div class="row">
            <div class="col-md-8">

                <!-- Loại giao dịch -->
                <label class="form-label fw-bold">Loại giao dịch</label>
                <select name="LoaiGiaoDich" class="form-select mb-3">
                    <option value="thu" <?= $data['LoaiGiaoDich'] == 'thu' ? 'selected' : '' ?>>Thu</option>
                    <option value="chi" <?= $data['LoaiGiaoDich'] == 'chi' ? 'selected' : '' ?>>Chi</option>
                </select>

                <!-- Ngày GD -->
                <label class="form-label fw-bold">Ngày giao dịch</label>
                <input type="date" name="NgayGiaoDich" class="form-control mb-3"
                       value="<?= $data['NgayGiaoDich'] ?>">

                <!-- Số tiền -->
                <label class="form-label fw-bold">Số tiền</label>
                <input type="number" name="SoTien" class="form-control mb-3"
                       value="<?= $data['SoTien'] ?>">

                <!-- Hạng mục -->
                <label class="form-label fw-bold">Hạng mục / Nội dung</label>
                <input type="text" name="HangMucChi" class="form-control mb-3"
                       value="<?= $data['HangMucChi'] ?>">

                <!-- Ghi chú -->
                <label class="form-label fw-bold">Ghi chú</label>
                <textarea name="MoTa" class="form-control mb-3" rows="3"><?= $data['MoTa'] ?></textarea>

            </div>

            <div class="col-md-4">

                <label class="form-label fw-bold">Phương thức thanh toán</label>
                <select name="PhuongThucThanhToan" class="form-select mb-3">
                    <option value="Tiền mặt" <?= $data['PhuongThucThanhToan']=='Tiền mặt' ? 'selected' : '' ?>>Tiền mặt</option>
                    <option value="Chuyển khoản" <?= $data['PhuongThucThanhToan']=='Chuyển khoản' ? 'selected' : '' ?>>Chuyển khoản</option>
                </select>

                <label class="form-label fw-bold">Mã hóa đơn</label>
                <input type="text" name="SoHoaDon" class="form-control mb-3"
                       value="<?= $data['SoHoaDon'] ?>">

                <label class="form-label fw-bold">Ảnh chứng từ</label><br>

                <?php if (!empty($data['AnhChungTu'])): ?>
                    <img src="uploads/<?= $data['AnhChungTu'] ?>" class="img-thumbnail mb-2" width="200">
                <?php endif; ?>

                <input type="file" name="AnhChungTu" class="form-control mb-3">
            </div>
        </div>

        <button class="btn btn-warning mt-3 fw-bold px-4">
            Lưu Cập Nhật
        </button>

    </form>
</div>


</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Giao Dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: Inter, sans-serif; }
        
        .sidebar {
            width: 250px; height: 100vh; background: #085f63; position: fixed; top:0; left:0;
            color: white; padding-top: 20px;
        }
        .sidebar a {
            color: #d9f7f5; padding: 12px 20px; display: block; text-decoration: none;
            transition: 0.2s; border-radius: 6px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.12);
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .card-custom {
            border-radius: 12px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .btn-submit {
            background: #ff9f0a; border:none; padding:12px 28px;
            font-weight: 600; color:white; border-radius: 8px;
        }
        .btn-submit:hover { background: #e28700; color:white; }

        .btn-cancel {
            background: #ccc; padding: 12px 28px; border-radius: 8px;
            color: #333; text-decoration:none; font-weight:600;
        }
    </style>
</head>

<body>

<div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <hr style="color: #aad;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

<!-- MAIN -->
<div class="main-content">

    <a href="index.php?act=hdv_vanhanh&id=<?= $maLich ?>" class="text-secondary mb-3 d-inline-block">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>

    <h3 class="fw-bold">Thêm Giao Dịch</h3>
    <p class="text-muted">Ghi nhận thu — chi trong quá trình vận hành tour</p>

    <form action="index.php?act=hdv_add_transaction" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="MaDoan" value="<?= $maDoan ?>">
        <input type="hidden" name="MaLichLamViec" value="<?= $maLich ?>">

        <div class="row">

            <!-- THÔNG TIN GIAO DỊCH -->
            <div class="col-lg-8">
                <div class="card card-custom p-4">

                    <h5 class="fw-bold text-success mb-3"><i class="fa fa-file-invoice-dollar"></i> Thông tin giao dịch</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Loại giao dịch *</label>
                            <select name="LoaiGiaoDich" class="form-select" required>
                                <option value="thu">🟢 Thu (tiền vào)</option>
                                <option value="chi">🔴 Chi (tiền ra)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Ngày giao dịch *</label>
                            <input type="date" class="form-control" name="NgayGiaoDich"
                                   value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Số tiền *</label>
                        <input type="number" class="form-control" name="SoTien" required>
                    </div>

                    <div class="mb-3">
                        <label>Hạng mục *</label>
                        <input type="text" class="form-control" name="HangMucChi" required>
                    </div>

                    <div class="mb-3">
                        <label>Ghi chú</label>
                        <textarea name="MoTa" class="form-control" rows="3"></textarea>
                    </div>

                </div>
            </div>

            <!-- CHỨNG TỪ -->
            <div class="col-lg-4">
                <div class="card card-custom p-4">

                    <h5 class="fw-bold text-primary mb-3"><i class="fa fa-receipt"></i> Chứng từ & thanh toán</h5>

                    <div class="mb-3">
                        <label>Phương thức thanh toán</label>
                        <select name="PhuongThuc" class="form-select">
                            <option value="Tiền mặt">💵 Tiền mặt</option>
                            <option value="Chuyển khoản">🏦 Chuyển khoản</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Mã hóa đơn</label>
                        <input type="text" class="form-control" name="SoHoaDon">
                    </div>

                    <div class="mb-3">
                        <label>Ảnh chứng từ</label>
                        <input type="file" class="form-control" name="AnhChungTu">
                    </div>

                </div>
            </div>

        </div>

        <div class="mt-4 text-end">
            <a href="index.php?act=hdv_vanhanh&id=<?= $maLich ?>" class="btn-cancel me-2">Hủy</a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Lưu giao dịch
            </button>
        </div>

    </form>

</div>

</body>
</html>

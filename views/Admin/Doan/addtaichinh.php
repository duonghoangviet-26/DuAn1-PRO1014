<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Giao Dịch Tài Chính</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

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

        .content {
            margin-left: 250px;
            padding: 25px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>

        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listDKH"><i class="fa fa-users"></i> Quản lí đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa-solid fa-money-bill"></i> Thêm Giao Dịch Tài Chính</h4>
            </div>

            <div class="card-body">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Loại giao dịch *</label>
                            <select name="LoaiGiaoDich" class="form-select">
                                <option value="thu">Thu</option>
                                <option value="chi">Chi</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Ngày giao dịch *</label>
                            <input type="date" name="NgayGiaoDich" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Số tiền *</label>
                            <input type="number" name="SoTien" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hạng mục / Lý do *</label>
                        <input type="text" name="HangMucChi" class="form-control" placeholder="VD: Ăn trưa ngày 1..." required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Phương thức thanh toán</label>
                            <select name="PhuongThucThanhToan" class="form-select">
                                <option value="Tiền mặt">Tiền mặt</option>
                                <option value="Chuyển khoản">Chuyển khoản</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Số hóa đơn / chứng từ</label>
                            <input type="text" name="SoHoaDon" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Ảnh chứng từ</label>
                            <input type="file" name="AnhChungTu" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi chú thêm</label>
                        <textarea name="MoTa" class="form-control" rows="3"></textarea>
                    </div>

                    <button name="btnSave" class="btn btn-success">
                        <i class="fa fa-check"></i> Lưu Giao Dịch
                    </button>

                    <a href="index.php?act=taichinh&id=<?= $_GET['id'] ?>" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>

                </form>
            </div>
        </div>
    </div>

</body>

</html>

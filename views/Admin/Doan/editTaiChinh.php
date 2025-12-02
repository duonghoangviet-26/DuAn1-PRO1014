<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sửa giao dịch tài chính</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<body class="container mt-4">
 <!-- Sidebar giống DKH -->
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
    <h3>Sửa Giao Dịch Tài Chính</h3>

    <form action="index.php?act=updateTC" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="MaTaiChinh" value="<?= $data['MaTaiChinh'] ?>">
        <input type="hidden" name="MaDoan" value="<?= $MaDoan ?>">
        <input type="hidden" name="AnhCu" value="<?= $data['AnhChungTu'] ?>">

        <label>Loại giao dịch</label>
        <select name="LoaiGiaoDich" class="form-control">
            <option value="thu" <?= $data['LoaiGiaoDich'] == 'thu' ? 'selected' : '' ?>>Thu</option>
            <option value="chi" <?= $data['LoaiGiaoDich'] == 'chi' ? 'selected' : '' ?>>Chi</option>
        </select>

        <label>Ngày giao dịch</label>
        <input type="date" name="NgayGiaoDich" class="form-control"
            value="<?= $data['NgayGiaoDich'] ?>">

        <label>Số tiền</label>
        <input type="number" name="SoTien" class="form-control"
            value="<?= $data['SoTien'] ?>">

        <label>Hạng mục</label>
        <input type="text" name="HangMucChi" class="form-control"
            value="<?= $data['HangMucChi'] ?>">

        <label>Phương thức thanh toán</label>
        <select name="PhuongThucThanhToan" class="form-control">
            <option value="Tiền mặt" <?= $data['PhuongThucThanhToan'] == 'Tiền mặt' ? 'selected' : '' ?>>Tiền mặt</option>
            <option value="Chuyển khoản" <?= $data['PhuongThucThanhToan'] == 'Chuyển khoản' ? 'selected' : '' ?>>Chuyển khoản</option>
        </select>

        <label>Số hóa đơn</label>
        <input type="text" name="SoHoaDon" class="form-control"
            value="<?= $data['SoHoaDon'] ?>">

        <label>Ảnh chứng từ</label><br>
        <?php if ($data['AnhChungTu']): ?>
            <img src="uploads/<?= $data['AnhChungTu'] ?>" width="90"><br>
        <?php endif; ?>
        <input type="file" name="AnhChungTu" class="form-control">

        <label>Ghi chú</label>
        <textarea name="MoTa" class="form-control"><?= $data['MoTa'] ?></textarea>

        <button name="btnUpdate" class="btn btn-success mt-3">Cập nhật</button>

        <a href="index.php?act=taichinh&id=<?= $MaDoan ?>" class="btn btn-secondary mt-3">Hủy</a>

    </form>

</body>

</html>
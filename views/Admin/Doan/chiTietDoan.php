<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        padding-left: 250px;
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
        display: block;
        padding: 10px 20px;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }

    .content {
        padding: 20px;
    }

    .sidebar a.active {
        background-color: #0d6efd;
        color: #fff;
        font-weight: bold;
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
        <a href="index.php?act=listDKH" class="active"><i class="fa fa-users"></i> Quản lý đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content container mt-4">

        <h3 class="text-primary fw-bold mb-3">Chi tiết Đoàn khởi hành</h3>

        <div class="card p-3 mb-4">
            <h4 class="mb-3"><?= htmlspecialchars($tour['TenTour'] ?? '') ?></h4>

            <p><b>Ngày đi:</b> <?= htmlspecialchars($doan['NgayKhoiHanh'] ?? '') ?></p>
            <p><b>Ngày về:</b> <?= htmlspecialchars($doan['NgayVe'] ?? '') ?></p>
            <p><b>Giờ khởi hành:</b> <?= htmlspecialchars($doan['GioKhoiHanh'] ?? '') ?></p>
            <p><b>Điểm tập trung:</b> <?= htmlspecialchars($doan['DiemTapTrung'] ?? '') ?></p>

            <p><b>Hướng dẫn viên:</b>
                <?= ($hdv && isset($hdv['HoTen']))
                    ? htmlspecialchars($hdv['HoTen'])
                    : 'Chưa gán hướng dẫn viên'; ?>
            </p>


            <p><b>Tài xế:</b>
                <?= ($taixe && isset($taixe['TenLaiXe']))
                    ? htmlspecialchars($taixe['TenLaiXe'])
                    : 'Chưa gán tài xế'; ?>
            </p>

        </div>

        <h4 class="fw-bold mb-3">Lịch trình</h4>

        <?php if (!empty($lichtrinh)) : ?>
        <?php foreach ($lichtrinh as $lt) : ?>
        <?php
                $sang = array_filter(explode("\n", $lt['NoiDungSang']));
                $trua = array_filter(explode("\n", $lt['NoiDungTrua']));
                $chieu = array_filter(explode("\n", $lt['NoiDungChieu']));
                $toi = array_filter(explode("\n", $lt['NoiDungToi']));

                ?>
        <div class="card p-3 mb-4 border">

            <h5 class="fw-bold text-primary">
                Ngày <?= htmlspecialchars($lt['NgayThu']) ?> – <?= htmlspecialchars($lt['TieuDeNgay']) ?>
            </h5>

            <p><b>Giờ tập trung:</b> <?= htmlspecialchars($lt['GioTapTrung']) ?></p>
            <p><b>Giờ xuất phát:</b> <?= htmlspecialchars($lt['GioXuatPhat']) ?></p>
            <p><b>Giờ kết thúc:</b> <?= htmlspecialchars($lt['GioKetThuc']) ?></p>

            <?php
                    $khachsan = "Chưa gán";
                    $nhahang = "Chưa gán";

                    $ngaySuDung = date('Y-m-d', strtotime($doan['NgayKhoiHanh'] . ' + ' . ($lt['NgayThu'] - 1) . ' days'));

                    foreach ($nccTheoNgay as $n) {

                        if ($n['NgaySuDung'] == $ngaySuDung) {

                            if ($n['LoaiDichVu'] == 'khach_san') {
                                $khachsan = $n['TenNhaCungCap'];
                            }

                            if ($n['LoaiDichVu'] == 'nha_hang') {
                                $nhahang = $n['TenNhaCungCap'];
                            }
                        }
                    }
                    ?>
            <p><b>🏨 Khách sạn:</b> <?= htmlspecialchars($khachsan) ?></p>
            <p><b>🍽 Nhà hàng:</b> <?= htmlspecialchars($nhahang) ?></p>



            <hr>

            <!-- BUỔI SÁNG -->
            <h6 class="mt-3 text-success">🌅 Hoạt động buổi sáng</h6>
            <?php if (!empty($sang)) : ?>
            <?php foreach ($sang as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI TRƯA -->
            <h6 class="mt-3 text-warning">🍽 Hoạt động buổi trưa</h6>
            <?php if (!empty($trua)) : ?>
            <?php foreach ($trua as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI CHIỀU -->
            <h6 class="mt-3 text-info">🌇 Hoạt động buổi chiều</h6>
            <?php if (!empty($chieu)) : ?>
            <?php foreach ($chieu as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

            <!-- BUỔI TỐI -->
            <h6 class="mt-3 text-danger">🌙 Hoạt động buổi tối</h6>
            <?php if (!empty($toi)) : ?>
            <?php foreach ($toi as $line) : ?>
            <div><?= htmlspecialchars($line) ?></div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Không có hoạt động</p>
            <?php endif; ?>

        </div>

        <?php endforeach; ?>
        <?php else : ?>
        <div class="alert alert-info">Chưa có lịch trình cho tour này.</div>
        <?php endif; ?>
        <div class="text-center mt-4 mb-5">
            <a href="index.php?act=listDKH" class="btn btn-secondary px-4">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

</body>

</html>
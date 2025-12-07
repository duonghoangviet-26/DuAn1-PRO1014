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
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container mt-4">

            <h3 class="fw-bold text-primary mb-3">Chi Tiết Tour</h3>

            <div class="card shadow">

                <div class="row g-0">

                    <div class="col-md-4 text-center p-3">
                        <?php if (!empty($tour['LinkAnhBia'])) { ?>
                            <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $tour['LinkAnhBia'] ?>"
                                class="img-fluid rounded"
                                style="max-height: 260px; object-fit:cover;">
                        <?php } else { ?>
                            <img src="https://via.placeholder.com/300x200?text=No+Image"
                                class="img-fluid rounded">
                        <?php } ?>

                        <h5 class="mt-3 fw-bold"><?= htmlspecialchars($tour['TenTour']) ?></h5>
                        <span class="badge bg-info">Mã Tour: <?= $tour['MaTour'] ?></span>
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">

                            <table class="table table-borderless">
                                <tr>
                                    <th>Tên tour:</th>
                                    <td><?= $tour['TenTour'] ?></td>
                                </tr>

                                <tr>
                                    <th>Danh mục:</th>
                                    <td><?= $tour['TenDanhMuc'] ?></td>
                                </tr>

                                <tr>
                                    <th>Giá:</th>
                                    <td class="text-danger fw-bold">
                                        <?= number_format($tour['GiaBanMacDinh'], 0, ',', '.') ?>đ
                                    </td>
                                </tr>

                                <tr>
                                    <th>Giá vốn:</th>
                                    <td class="fw-semibold text-primary">
                                        <?= $tour['GiaVonDuKien'] !== null
                                            ? number_format($tour['GiaVonDuKien'], 0, ',', '.') . 'đ'
                                            : '—' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Số ngày:</th>
                                    <td><?= $tour['SoNgay'] ?> ngày</td>
                                </tr>

                                <tr>
                                    <th>Số đêm:</th>
                                    <td><?= $tour['SoDem'] ?> đêm</td>
                                </tr>

                                <tr>
                                    <th>Khởi hành:</th>
                                    <td><?= $tour['DiemKhoiHanh'] ?></td>
                                </tr>

                                <tr>
                                    <th>Ngày bắt đầu:</th>
                                    <td><?= date("d/m/Y", strtotime($tour['NgayBatDau'])) ?></td>
                                </tr>

                                <tr>
                                    <th>Ngày kết thúc:</th>
                                    <td><?= date("d/m/Y", strtotime($tour['NgayKetThuc'])) ?></td>
                                </tr>

                                <tr>
                                    <th>Mô tả:</th>
                                    <td><?= nl2br($tour['MoTa']) ?></td>
                                </tr>
                            </table>


                        </div>
                    </div>
                </div>
            </div>


            <div class="card shadow mt-4">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fa fa-calendar-day"></i> Lịch Trình Tour
                </div>

                <div class="card-body">

                    <?php if (!empty($lichTrinh)) { ?>
                        <?php foreach ($lichTrinh as $lt) { ?>

                            <div class="border rounded p-3 mb-4 bg-light">

                                <h4 class="fw-bold text-primary mb-3">
                                    📅 Ngày <?= $lt['NgayThu'] ?>
                                </h4>

                                <p><b>Tiêu đề ngày:</b> <?= htmlspecialchars($lt['TieuDeNgay'] ?: "—") ?></p>

                                <p><b>Nơi ở:</b> <?= htmlspecialchars($lt['NoiO'] ?: "Không có") ?></p>

                                <p><b>Địa điểm tham quan:</b> <?= htmlspecialchars($lt['DiaDiemThamQuan'] ?: "Không có") ?></p>

                                <div class="mt-3">
                                    <b>Thời gian chung:</b>
                                    <ul class="mt-1">
                                        <li><b>Giờ tập trung:</b> <?= $lt['GioTapTrung'] ?: "—" ?></li>
                                        <li><b>Giờ xuất phát:</b> <?= $lt['GioXuatPhat'] ?: "—" ?></li>
                                        <li><b>Giờ kết thúc:</b> <?= $lt['GioKetThuc'] ?: "—" ?></li>
                                    </ul>
                                </div>

                                <hr>

                                <h5 class="text-success mt-3">🌅 Hoạt động buổi sáng</h5>
                                <div class="p-2 bg-white border rounded">
                                    <?= nl2br(htmlspecialchars($lt['NoiDungSang'] ?: "Không có hoạt động")) ?>
                                </div>

                                <h5 class="text-warning mt-3">🍽 Hoạt động buổi trưa</h5>
                                <div class="p-2 bg-white border rounded">
                                    <?= nl2br(htmlspecialchars($lt['NoiDungTrua'] ?: "Không có hoạt động")) ?>
                                </div>

                                <h5 class="text-primary mt-3">🌤 Hoạt động buổi chiều</h5>
                                <div class="p-2 bg-white border rounded">
                                    <?= nl2br(htmlspecialchars($lt['NoiDungChieu'] ?: "Không có hoạt động")) ?>
                                </div>

                                <h5 class="text-dark mt-3">🌙 Hoạt động buổi tối</h5>
                                <div class="p-2 bg-white border rounded">
                                    <?= nl2br(htmlspecialchars($lt['NoiDungToi'] ?: "Không có hoạt động")) ?>
                                </div>

                                <hr>

                                <p><b>Bữa ăn bao gồm:</b>
                                    <?= $lt['CoBuaSang'] ? "Sáng ✓ " : "" ?>
                                    <?= $lt['CoBuaTrua'] ? "Trưa ✓ " : "" ?>
                                    <?= $lt['CoBuaToi'] ? "Tối ✓ " : "" ?>
                                </p>

                            </div>

                        <?php } ?>
                    <?php } else { ?>

                        <p class="text-muted">Chưa có lịch trình cho tour này.</p>

                    <?php } ?>

                </div>
            </div>



            <!-- ===================== CHÍNH SÁCH TOUR ===================== -->
            <div class="card shadow mt-4 mb-5">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="fa fa-file-contract"></i> Chính Sách Tour
                </div>

                <!-- <div class="card-body">
                    <?php if (!empty($chinhSach)) { ?>

                        <h5 class="fw-bold text-secondary">Chính sách đặt tour</h5>
                        <p><?= nl2br(htmlspecialchars($chinhSach['ChinhSachDatTour'])) ?></p>

                        <h5 class="fw-bold text-secondary">Chính sách hủy tour</h5>
                        <p><?= nl2br(htmlspecialchars($chinhSach['ChinhSachHuy'])) ?></p>

                        <h5 class="fw-bold text-secondary">Chính sách hoàn tiền</h5>
                        <p><?= nl2br(htmlspecialchars($chinhSach['ChinhSachHoan'])) ?></p>

                        <h5 class="fw-bold text-secondary">Điều khoản riêng</h5>
                        <p><?= nl2br(htmlspecialchars($chinhSach['DieuKhoan'])) ?></p>

                    <?php } else { ?>
                        <p class="text-muted">Chưa có chính sách cho tour này.</p>
                    <?php } ?>

                </div> -->
            </div>

            <a href="index.php?act=listTour" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>

            <a href="index.php?act=editTour&id=<?= $tour['MaTour'] ?>" class="btn btn-warning text-white ms-2">
                <i class="fa fa-edit"></i> Sửa Tour
            </a>

        </div>
    </div>


</body>

</html>
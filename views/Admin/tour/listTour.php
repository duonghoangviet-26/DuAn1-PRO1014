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

        .mota {
            max-width: 200px;
            /* chiều rộng hiển thị mô tả */
            white-space: nowrap;
            /* KHÔNG cho xuống dòng */
            overflow: hidden;
            /* ẩn phần dư */
            text-overflow: ellipsis;
            /* thêm dấu ... */
            display: block;
        }

        /* table td,
        table th {
            white-space: nowrap;
            /* Không xuống dòng */
        /* overflow: hidden; */
        /* Ẩn phần dư */
        /* text-overflow: ellipsis; */
        /* Thêm dấu ... */
        /* max-width: 150px; */
        /* Giới hạn độ rộng mỗi ô */
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
        <div class="container-fluid mt-4">

            <h3 class="mb-3 fw-bold text-primary">Quản Lý Tour</h3>

            <a href="index.php?act=createTourForm" class="btn btn-success">Thêm Tour</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>STT</th>
                            <th>Tên tour</th>
                            <th>Danh mục</th>
                            <th>Giá Vốn</th>
                            <th>Giá Bán</th>
                            <th>Địa điểm khởi hành</th>
                            <th>Số ngày</th>
                            <th>Số Đêm</th>
                            <th>Ảnh</th>
                            <th>Mô tả</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listTour as $i => $t) { ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="text-start"><?= htmlspecialchars($t['TenTour']) ?></td>
                                <td><?= htmlspecialchars($t['TenDanhMuc']) ?></td>
                                <td>
                                    <?= $t['GiaVonDuKien'] !== null ? number_format($t['GiaVonDuKien'], 0, ',', '.') . 'đ' : '0đ' ?>
                                </td>
                                <td><?= number_format($t['GiaBanMacDinh'], 0, ',', '.') ?>đ</td>



                                <td><?= htmlspecialchars($t['DiemKhoiHanh']) ?></td>

                                <td><?= (int)$t['SoNgay'] ?></td>

                                <td><?= (int)$t['SoDem'] ?></td> <!-- ⭐ Thêm số đêm -->

                                <!-- Ảnh tour -->
                                <td>
                                    <?php if (!empty($t['LinkAnhBia'])) { ?>
                                        <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $t['LinkAnhBia'] ?>"
                                            style="width:80px; height:60px; object-fit:cover;">
                                    <?php } else { ?>
                                        <span class="text-muted">Không có ảnh</span>
                                    <?php } ?>
                                </td>

                                <td class="mota text-start"><?= htmlspecialchars($t['MoTa']) ?></td>

                                <!-- ⭐ NGÀY BẮT ĐẦU -->
                                <td><?= !empty($t['NgayBatDau']) ? date("d/m/Y", strtotime($t['NgayBatDau'])) : "—" ?></td>

                                <!-- ⭐ NGÀY KẾT THÚC -->
                                <td><?= !empty($t['NgayKetThuc']) ? date("d/m/Y", strtotime($t['NgayKetThuc'])) : "—" ?></td>

                                <!-- Hành động -->
                                <td>
                                    <!-- Nút xem chi tiết -->
                                    <a href="index.php?act=chiTietTour&id=<?= $t['MaTour'] ?>"
                                        class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Nút sửa -->
                                    <a href="index.php?act=editTour&id=<?= $t['MaTour'] ?>"
                                        class="btn btn-warning btn-sm">
                                        Sửa
                                    </a>

                                    <!-- Nút xóa -->
                                    <a onclick="return confirm('Xóa tour này?')"
                                        href="index.php?act=deleteTour&id=<?= $t['MaTour'] ?>"
                                        class="btn btn-danger btn-sm">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>


                </table>

            </div>
        </div>
    </div>

</body>

</html>
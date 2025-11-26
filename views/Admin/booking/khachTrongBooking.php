<?php
ob_start();
session_name('BOOKINGSESSID'); // đặt tên riêng, tránh xung đột
session_set_cookie_params([
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Căn giữa, spacing đẹp */
        table.table {
            font-size: 14px;
            vertical-align: middle;
        }

        /* Cột giá tiền */
        td.price {
            font-weight: 600;
            color: #0d6efd;
            /* xanh bootstrap */
        }

        /* Badge trạng thái */
        .badge-cho {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-coc {
            background: #cfe2ff;
            color: #084298;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-done {
            background: #d1e7dd;
            color: #0f5132;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cancel {
            background: #f8d7da;
            color: #842029;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Nút thao tác */
        .btn-khach,
        .btn-edit,
        .btn-delete {
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-khach {
            background: #e0f3ff;
            color: #0d6efd;
        }

        .btn-khach:hover {
            background: #b6e0ff;
        }

        .btn-edit {
            background: #fde2ba;
            color: #b35c00;
        }

        .btn-edit:hover {
            background: #fcd49b;
        }

        .btn-delete {
            background: #f8d7da;
            color: #842029;
        }

        .btn-delete:hover {
            background: #f3c2c6;
        }

        /* Container nút hành động */
        td.actions {
            display: flex;
            gap: 8px;
            white-space: nowrap;
        }

        /* Nút Sửa */
        .btn-edit {
            background: #ffc107;
            /* vàng */
            color: #5a4400;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        /* Nút Xóa */
        .btn-delete {
            background: #dc3545;
            /* đỏ */
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-delete:hover {
            background: #bb2d3b;
        }
    </style>

</head>

<body class="bg-light">
    <pre><?php print_r($_SESSION); ?></pre>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-0"><i class="fas fa-calendar-alt text-primary"></i>Khách Trong Booking</h2>
                    </div>
                    <div class="col-md-8">
                        <a href="index.php?act=listBooking" class=" btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?act=createKhachTrongBooking&MaBooking=<?= $booking['MaBooking'] ?>"
                            class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm Khách
                        </a>

                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <div class="info-box">
                <div><strong>Tour:</strong> <?= htmlspecialchars($booking['TenTour'] ?? '') ?></div>
                <div>
                    <strong>Đoàn:</strong>
                    <?php if (!empty($booking['NgayKhoiHanh'])): ?>
                        Khởi hành <?= date('d/m/Y', strtotime($booking['NgayKhoiHanh'])) ?>
                        <?php if (!empty($booking['NgayVe'])): ?>
                            - Về <?= date('d/m/Y', strtotime($booking['NgayVe'])) ?>
                        <?php endif; ?>
                    <?php else: ?>
                        Chưa gán đoàn
                    <?php endif; ?>
                </div>
                <div><strong>Điểm tập trung:</strong> <?= htmlspecialchars($booking['DiemTapTrung'] ?? '---') ?></div>
                <div><strong>Yêu cầu đặc biệt:</strong>
                    <?= nl2br(htmlspecialchars($booking['YeuCauDacBiet'] ?? '---')) ?></div>
            </div>

            <br><br>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Số giấy tờ</th>
                                    <th>SĐT</th>
                                    <th>Yêu cầu đặc biệt</th>
                                    <th>Loại phòng</th>
                                    <!-- <th>Điểm danh</th> -->
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listKhach as $k):

                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($k['HoTen']) ?></td>
                                        <td><?= $k['GioiTinh'] ?></td>
                                        <td><?= $k['NgaySinh'] ?></td>
                                        <td><?= htmlspecialchars($k['SoGiayTo']) ?></td>
                                        <td><?= htmlspecialchars($k['SoDienThoai']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($k['GhiChuDacBiet'])) ?></td>
                                        <td><?= $k['LoaiPhong'] ?></td>
                                        <!-- <td>
                                <?php if ($k['TrangThaiDiemDanh']): ?>
                                <span class="badge-dd dd-yes">Đã điểm danh</span>
                                <?php else: ?>
                                <span class="badge-dd dd-no">Chưa điểm danh</span>
                                <?php endif; ?>
                            </td> -->
                                        <td class="actions">
                                            <!-- <a
                                        href="?act=diemDanhProcess&MaKhachTrongBooking=<?= $k['MaKhachTrongBooking'] ?>&MaBooking=<?= $booking['MaBooking'] ?>&status=<?= $k['TrangThaiDiemDanh'] ? 0 : 1 ?>">
                                        <button class="btn-diemdanh">
                                            <?= $k['TrangThaiDiemDanh'] ? 'Bỏ điểm danh' : 'Điểm danh' ?>
                                        </button>
                                    </a> -->
                                            <a href="index.php?act=editKhachTrongBooking&MaKhachTrongBooking=<?= $k['MaKhachTrongBooking'] ?>&MaBooking=<?= $booking['MaBooking'] ?>"
                                                class="btn btn-warning btn-sm">
                                                Sửa
                                            </a>
                                            <a href="index.php?act=deleteKhachTrongBooking&MaKhachTrongBooking=<?= $k['MaKhachTrongBooking'] ?>&MaBooking=<?= $booking['MaBooking'] ?>"
                                                onclick="return confirm('Bạn có muốn xóa khách này khỏi booking?');">
                                                <button class="btn-delete">Xóa</button>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
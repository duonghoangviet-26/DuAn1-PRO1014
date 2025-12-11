<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Điểm Danh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        background: #f5f8fa;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
        color: #ecf0f1;
        padding-top: 20px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        z-index: 1000;
    }

    .sidebar-header {
        padding: 0 25px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 15px;
    }

    .sidebar-header h4 {
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff;
        display: flex;
        align-items: center;
    }

    .sidebar-menu {
        padding: 0 10px;
    }

    .sidebar-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #95a5a6;
        margin: 15px 15px 5px;
        font-weight: 600;
    }

    .sidebar a {
        color: #bdc3c7;
        padding: 12px 15px;
        text-decoration: none;
        display: flex;
        align-items: center;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        margin-bottom: 5px;
    }

    .sidebar a i {
        width: 25px;
        text-align: center;
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar a.active {
        background-color: #3498db;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }


    .content {
        margin-left: 260px;
        padding: 30px;
    }

    .card-day {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .card-header-day {
        background-color: #085f63;
        color: white;
        border-radius: 12px 12px 0 0 !important;
        padding: 15px;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>

        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard" class="active"><i class="fa fa-home"></i> Trang chủ</a>

            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>

            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng
                xuất</a>
        </div>
    </div>

    <div class="content">
        <div class="mb-4">
            <a href="index.php?act=listTourOfHDV" class="text-secondary text-decoration-none"><i
                    class="fa-solid fa-arrow-left"></i> Quay lại</a>
            <h3 class="fw-bold text-primary mt-2">Lịch Sử Điểm Danh</h3>
            <p class="text-muted">Tour: <?= $thongTinDoan['TenTour'] ?> (Đoàn: <?= $thongTinDoan['MaDoan'] ?>)</p>
        </div>

        <?php if (empty($history)): ?>
        <div class="alert alert-warning text-center">
            <i class="fa-solid fa-triangle-exclamation"></i> Chưa có dữ liệu điểm danh nào.
        </div>
        <?php else: ?>
        <?php foreach ($history as $ngayLabel => $buois): ?>
        <div class="card card-day">
            <div class="card-header card-header-day">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold">
                        <i class="fa-regular fa-calendar-check"></i> <?= $ngayLabel ?>
                    </h5>

                    <?php
                            $firstRows = reset($buois); // Lấy danh sách khách của buổi đầu tiên
                            $oneRow = $firstRows[0];    // Lấy 1 dòng để đọc dữ liệu lịch trình

                            // Dò tìm tên cột mô tả (Ưu tiên: TieuDe -> NoiDung -> MoTa -> TenLichTrinh)
                            $moTaHoatDong = $oneRow['TieuDe']
                                ?? $oneRow['NoiDung']
                                ?? $oneRow['MoTa']
                                ?? $oneRow['TenLichTrinh']
                                ?? $oneRow['TenHoatDong']
                                ?? 'Chi tiết lịch trình';
                            ?>
                    <span class="badge bg-warning text-dark text-wrap text-start"
                        style="max-width: 60%; font-weight: normal;">
                        <i class="fa-solid fa-map-location-dot"></i> <?= $moTaHoatDong ?>
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <?php foreach ($buois as $tenBuoi => $dsKhach): ?>
                    <div class="col-md-12 mb-3">
                        <h6 class="fw-bold text-primary border-bottom pb-2">
                            <?php
                                        $labelBuoi = '';
                                        switch ($tenBuoi) {
                                            case 'sang':
                                                $labelBuoi = 'Buổi Sáng';
                                                break;
                                            case 'trua':
                                                $labelBuoi = 'Buổi Trưa';
                                                break;
                                            case 'chieu':
                                                $labelBuoi = 'Buổi Chiều';
                                                break;
                                            case 'toi':
                                                $labelBuoi = 'Buổi Tối';
                                                break;
                                            default:
                                                $labelBuoi = 'Buổi ' . ucfirst($tenBuoi);
                                        }
                                        echo '<i class="fa-regular fa-clock me-1"></i> ' . $labelBuoi;
                                        ?>
                        </h6>

                        <table class="table table-sm table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ Tên</th>
                                    <th>SĐT</th>
                                    <th>Trạng Thái</th>
                                    <th><i class="fa-regular fa-clock"></i> Giờ Check-in</th>
                                    <th>Ghi Chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dsKhach as $k): ?>
                                <tr>
                                    <td><?= $k['HoTen'] ?></td>
                                    <td><?= $k['SoDienThoai'] ?></td>
                                    <td>
                                        <?php
                                                        if ($k['TrangThai'] == 'co_mat') echo '<span class="badge bg-success">Có mặt</span>';
                                                        elseif ($k['TrangThai'] == 'vang') echo '<span class="badge bg-danger">Vắng</span>';
                                                        elseif ($k['TrangThai'] == 'tre') echo '<span class="badge bg-warning text-dark">Đi muộn</span>';
                                                        else echo $k['TrangThai'];
                                                        ?>
                                    </td>
                                    <td class="text-secondary" style="font-size: 0.9rem;">
                                        <?= !empty($k['ThoiGianCheckIn']) ? date('H:i:s', strtotime($k['ThoiGianCheckIn'])) : '-' ?>
                                    </td>
                                    <td class="text-muted fst-italic"><?= $k['GhiChu'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>
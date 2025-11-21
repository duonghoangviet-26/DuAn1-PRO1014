<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-0"><i class="fas fa-calendar-alt text-primary"></i> Quản lý Booking Tour</h2>
                        <p class="text-muted mb-0">Hệ thống điều hành tour du lịch</p>
                    </div>
                    <div class="col-md-8">
                        <a href="index.php?act=/" class=" btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?act=createBooking" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tạo Booking Mới
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Thống kê -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Tổng booking</h6>
                        <h3 class="mb-0"><?= $statistics['TongBooking'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                    <div class="card-body">
                        <h6 class="text-warning">Chờ cọc</h6>
                        <h3 class="mb-0 text-warning"><?= $statistics['ChoCoc'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                    <div class="card-body">
                        <h6 class="text-info">Đã cọc</h6>
                        <h3 class="mb-0 text-info"><?= $statistics['DaCoc'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <h6 class="text-success">Hoàn tất</h6>
                        <h3 class="mb-0 text-success"><?= $statistics['HoanTat'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="index.php" class="row g-3">
                    <input type="hidden" name="controller" value="booking">
                    <input type="hidden" name="action" value="index">

                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã booking, tên khách..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    </div>

                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="all">Tất cả trạng thái</option>
                            <option value="cho_coc" <?= ($_GET['status'] ?? '') == 'cho_coc' ? 'selected' : '' ?>>Chờ
                                cọc</option>
                            <option value="da_coc" <?= ($_GET['status'] ?? '') == 'da_coc' ? 'selected' : '' ?>>Đã cọc
                            </option>
                            <option value="hoan_tat" <?= ($_GET['status'] ?? '') == 'hoan_tat' ? 'selected' : '' ?>>Hoàn
                                tất</option>
                            <option value="da_huy" <?= ($_GET['status'] ?? '') == 'da_huy' ? 'selected' : '' ?>>Đã hủy
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Tìm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Mã Booking</th>
                                <th>Tour</th>
                                <th>Khách hàng</th>
                                <th>Số khách</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bookings)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">Chưa có booking nào</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>
                                            <strong><?= $booking['MaCodeBooking'] ?></strong><br>
                                            <small
                                                class="text-muted"><?= date('d/m/Y', strtotime($booking['NgayTao'])) ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($booking['TenTour'] ?? '') ?></td>
                                        <td>
                                            <?= htmlspecialchars($booking['TenKhachHang']) ?><br>
                                            <small class="text-muted"><?= $booking['SoDienThoai'] ?></small>
                                        </td>
                                        <td>
                                            <i class="fas fa-users"></i>
                                            <?= $booking['TongNguoiLon'] + $booking['TongTreEm'] + $booking['TongEmBe'] ?>
                                        </td>
                                        <td>
                                            <strong><?= number_format($booking['TongTien'], 0, ',', '.') ?>đ</strong><br>
                                            <small class="text-muted">Còn lại:
                                                <?= number_format($booking['SoTienConLai'] ?? 0, 0, ',', '.') ?>đ
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm status-select"
                                                onchange="updateStatus(<?= $booking['MaBooking'] ?>, this.value)">
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
                                        </td>
                                        <td>
                                            <a href="index.php?controller=booking&action=detail&id=<?= $booking['MaBooking'] ?>"
                                                class="btn btn-sm btn-info" title="Xem">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?controller=booking&action=edit&id=<?= $booking['MaBooking'] ?>"
                                                class="btn btn-sm btn-warning" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?controller=booking&action=delete&id=<?= $booking['MaBooking'] ?>"
                                                class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(bookingId, status) {
            if (!confirm('Bạn có chắc muốn thay đổi trạng thái?')) {
                location.reload();
                return;
            }

            fetch('index.php?controller=booking&action=updateStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + bookingId + '&status=' + status
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cập nhật thành công!');
                        location.reload();
                    }
                });
        }
    </script>
</body>

</html>
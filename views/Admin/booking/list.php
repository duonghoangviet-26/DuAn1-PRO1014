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

    /* Căn giữa các nút */
    td.actions {
        white-space: nowrap;
        display: flex;
        gap: 6px;
    }
    </style>

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
                                <th>ID</th>
                                <!-- <th>Mã Booking</th> -->
                                <th>Tour</th>
                                <th>Đoàn</th>
                                <th>Khách hàng</th>
                                <th>Loại</th>
                                <th>SL</th>
                                <th>Tổng tiền</th>
                                <th>Đã trả</th>
                                <th>Còn lại</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($bookings as $b): ?>
                            <tr>
                                <td><?= $i++ ?> </td>
                                <!-- <td><?= htmlspecialchars($b['MaCodeBooking']) ?></td> -->
                                <td><?= htmlspecialchars($b['TenTour'] ?? '') ?></td>
                                <td>
                                    <?php if (!empty($b['NgayKhoiHanh'])): ?>
                                    <?= date('d/m/Y', strtotime($b['NgayKhoiHanh'])) ?>
                                    <?php else: ?>
                                    —
                                    <?php endif; ?>
                                    <?php
                                        $TongTien = $b['TongTien'] ?? 0;
                                        $DaCoc    = $b['SoTienDaCoc'] ?? 0;
                                        $DaTra    = $b['SoTienDaTra'] ?? 0;

                                        $ConLai = $TongTien - $DaCoc - $DaTra;
                                        if ($ConLai < 0) $ConLai = 0;
                                        ?>
                                </td>
                                <td><?= htmlspecialchars($b['TenKhachHang'] ?? '') ?></td>
                                <td><?= $b['LoaiBooking'] == 'nhom' ? 'Nhóm' : 'Cá nhân' ?></td>
                                <td>
                                    NL: <?= $b['TongNguoiLon'] ?>,
                                    TE: <?= $b['TongTreEm'] ?>,
                                    EB: <?= $b['TongEmBe'] ?>
                                </td>
                                <td class="price"><?= number_format($b['TongTien'] ?? 0, 0, ',', '.') ?>đ</td>
                                <td class="price"><?= number_format($b['SoTienDaCoc'] ?? 0, 0, ',', '.') ?>đ</td>
                                <td class="price"><?= number_format($ConLai, 0, ',', '.') ?>đ</td>


                                <td>
                                    <?php
                                        $st = $b['TrangThai'];
                                        if ($st == 'cho_coc') echo '<span class="badge badge-cho">Chờ cọc</span>';
                                        elseif ($st == 'da_coc') echo '<span class="badge badge-coc">Đã cọc</span>';
                                        elseif ($st == 'hoan_tat') echo '<span class="badge badge-done">Hoàn tất</span>';
                                        elseif ($st == 'da_huy') echo '<span class="badge badge-cancel">Đã hủy</span>';
                                        ?>
                                </td>
                                <td><?= $b['NgayTao'] ?></td>
                                <td class="actions">
                                    <a href="index.php?act=listDKH" class="btn btn-info btn-sm">Chi tiết</a>

                                    <a href="index.php?act=khachTrongBooking&MaBooking=<?= $b['MaBooking'] ?>"
                                        class="btn btn-info btn-sm">Khách</a>

                                    <a href="?act=editBooking&MaBooking=<?= $b['MaBooking'] ?>"
                                        class="btn btn-warning btn-sm"
                                        onclick="return confirm('Bạn có muốn sửa không??');">Sửa</a>

                                    <a href="?act=deleteBooking&MaBooking=<?= $b['MaBooking'] ?>"
                                        class="btn btn-danger btn-sm" onclick="return confirm('Xóa booking này?');">
                                        Xóa
                                    </a>
                                </td>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        // Nếu các phần tử không tồn tại → không chạy JS tính tổng
        const tourSelect = document.getElementById('tourSelect');
        const adults = document.getElementById('adults');
        const children = document.getElementById('children');
        const babies = document.getElementById('babies');
        const totalAmount = document.getElementById('totalAmount');

        // Nếu không có form booking → DỪNG TẠI ĐÂY → KHÔNG BAO LỖI
        if (!tourSelect || !adults || !children || !babies || !totalAmount) {
            return;
        }

        function calculateTotal() {
            const basePrice = parseFloat(tourSelect.options[tourSelect.selectedIndex].dataset.price) || 0;

            const nl = parseInt(adults.value) || 0;
            const te = parseInt(children.value) || 0;
            const eb = parseInt(babies.value) || 0;

            const total = (nl * basePrice) + (te * basePrice * 0.7) + (eb * basePrice * 0.3);

            totalAmount.value = Math.round(total);
        }

        tourSelect.addEventListener('change', calculateTotal);
        adults.addEventListener('input', calculateTotal);
        children.addEventListener('input', calculateTotal);
        babies.addEventListener('input', calculateTotal);
    });
    </script>


</body>

</html>
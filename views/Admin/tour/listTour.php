<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        background-color: #f3f4f6;
        font-family: 'Inter', sans-serif;
        margin: 0;
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
        overflow-y: auto;
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
        transition: 0.3s;
        margin-bottom: 5px;
    }

    .sidebar a i {
        width: 25px;
        text-align: center;
        margin-right: 10px;
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

    .main-content {
        margin-left: 260px;
        padding: 30px;
        width: calc(100% - 260px);
        min-height: 100vh;
    }

    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        background: #fff;
        overflow: hidden;
    }

    .card-header-custom {
        background-color: #fff;
        border-bottom: 1px solid #f0f0f0;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-modern thead th {
        background-color: #f8f9fa;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 15px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #374151;
        font-size: 0.9rem;
    }

    .table-modern tbody tr:hover {
        background-color: #f9fafb;
    }

    .tour-img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .tour-desc {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-active {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pause {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-stop {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: 0.2s;
        border: none;
        margin-right: 4px;
    }

    .btn-view {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-view:hover {
        background: #0284c7;
        color: #fff;
    }

    .btn-edit {
        background: #fef3c7;
        color: #d97706;
    }

    .btn-edit:hover {
        background: #d97706;
        color: #fff;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #fff;
    }

    .btn-clone {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .btn-clone:hover {
        background: #7e22ce;
        color: #fff;
    }

    .page-link {
        border: none;
        border-radius: 50% !important;
        margin: 0 5px;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }

    .page-item.active .page-link {
        background-color: #3b82f6;
        color: white;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
    }

    .page-item.disabled .page-link {
        background-color: transparent;
        color: #d1d5db;
    }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fa-solid fa-earth-americas me-2 text-info"></i> TRAVEL ADMIN</h4>
        </div>

        <div class="sidebar-menu">
            <a href="index.php?act=admin_dashboard"><i class="fa fa-home"></i> Trang chủ</a>

            <div class="sidebar-title">Quản lý Sản phẩm</div>
            <a href="index.php?act=listdm"><i class="fa fa-layer-group"></i> Danh mục Tour</a>
            <a href="index.php?act=listTour" class="active"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
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

    <div class="main-content">
        <div class="container-fluid">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Quản Lý Tour</h3>
                    <p class="text-muted mb-0">Danh sách các gói tour du lịch hiện có</p>
                </div>

                <div class="d-flex gap-2">
                    <form method="GET" action="" class="d-flex">
                        <input type="hidden" name="act" value="listTour">
                        <select name="trangthai" onchange="this.form.submit()" class="form-select me-2"
                            style="width: 160px;">
                            <option value="">Tất cả trạng thái</option>
                            <option value="hoat_dong"
                                <?= (($_GET['trangthai'] ?? '') == 'hoat_dong') ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="tam_dung"
                                <?= (($_GET['trangthai'] ?? '') == 'tam_dung') ? 'selected' : '' ?>>Tạm dừng</option>
                            <option value="da_ket_thuc"
                                <?= (($_GET['trangthai'] ?? '') == 'da_ket_thuc') ? 'selected' : '' ?>>Đã kết thúc
                            </option>
                        </select>
                    </form>

                    <form method="GET" action="" class="d-flex">
                        <input type="hidden" name="act" value="listTour">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm tên tour..."
                                value="<?= $_GET['keyword'] ?? '' ?>">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>

                    <a href="index.php?act=createTourForm" class="btn btn-success text-white shadow-sm">
                        <i class="fas fa-plus me-1"></i> Thêm Mới
                    </a>
                </div>
            </div>

            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Thông tin Tour</th>
                                <th>Danh mục</th>
                                <th>Giá bán</th>
                                <th>Lịch trình</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listTour)): ?>
                            <?php foreach ($listTour as $i => $t) { ?>
                            <tr>
                                <td class="ps-4 fw-bold text-secondary"><?= $i + 1 + ($page - 1) * 10 ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($t['LinkAnhBia'])): ?>
                                        <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $t['LinkAnhBia'] ?>"
                                            class="tour-img me-3">
                                        <?php else: ?>
                                        <div
                                            class="tour-img me-3 bg-light d-flex align-items-center justify-content-center text-muted small">
                                            No Image</div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark mb-1 text-wrap" style="max-width: 250px;">
                                                <?= htmlspecialchars($t['TenTour']) ?>
                                            </div>
                                            <small class="text-muted d-block tour-desc"
                                                title="<?= htmlspecialchars($t['MoTa']) ?>">
                                                <?= htmlspecialchars($t['MoTa']) ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-light text-dark border"><?= htmlspecialchars($t['TenDanhMuc']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">
                                        <?= number_format($t['GiaBanMacDinh'], 0, ',', '.') ?>đ</div>
                                    <small
                                        class="text-muted "><?= $t['GiaVonDuKien'] ? number_format($t['GiaVonDuKien'], 0, ',', '.') . 'đ' : '' ?></small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column small">
                                        <span><i class="far fa-clock me-1 text-primary"></i> <?= (int)$t['SoNgay'] ?>N
                                            <?= (int)$t['SoDem'] ?>Đ</span>
                                        <span class="text-muted"><i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                            <?= htmlspecialchars($t['DiemKhoiHanh']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                            if ($t['TrangThai'] == 'hoat_dong') {
                                                echo '<span class="badge badge-status status-active">Hoạt động</span>';
                                            } elseif ($t['TrangThai'] == 'tam_dung') {
                                                echo '<span class="badge badge-status status-pause">Tạm dừng</span>';
                                            } else {
                                                echo '<span class="badge badge-status status-stop">Đã kết thúc</span>';
                                            }
                                            ?>
                                </td>
                                <td>
                                    <small class="d-block text-muted">Bắt đầu:
                                        <?= !empty($t['NgayBatDau']) ? date("d/m/Y", strtotime($t['NgayBatDau'])) : "—" ?></small>
                                    <small class="d-block text-muted">Kết thúc:
                                        <?= !empty($t['NgayKetThuc']) ? date("d/m/Y", strtotime($t['NgayKetThuc'])) : "—" ?></small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="index.php?act=chiTietTour&id=<?= $t['MaTour'] ?>"
                                            class="btn-action btn-view" title="Chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?act=editTour&id=<?= $t['MaTour'] ?>"
                                            class="btn-action btn-edit" title="Sửa">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="index.php?act=cloneTour&id=<?= $t['MaTour'] ?>"
                                            class="btn-action btn-clone" title="Nhân bản">
                                            <i class="fas fa-clone"></i>
                                        </a>
                                        <a href="index.php?act=deleteTour&id=<?= $t['MaTour'] ?>"
                                            class="btn-action btn-delete" title="Xóa"
                                            onclick="return confirm('Bạn có chắc muốn xóa tour này?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-search fa-3x mb-3 opacity-25"></i>
                                    <p>Không tìm thấy tour nào phù hợp.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPage) && $totalPage > 1): ?>
                <div class="card-footer bg-white border-top-0 py-3">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?act=listTour&page=<?= $page - 1 ?>"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?act=listTour&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?act=listTour&page=<?= $page + 1 ?>"><i
                                        class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
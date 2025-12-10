<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đoàn Khởi Hành</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* --- SIDEBAR STYLE --- */
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

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-open {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-full {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-cancel {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .status-done {
            background-color: #e0f2fe;
            color: #075985;
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

        .btn-users {
            background: #dbeafe;
            color: #2563eb;
        }

        .btn-users:hover {
            background: #2563eb;
            color: #fff;
        }

        .btn-finance {
            background: #d1fae5;
            color: #059669;
        }

        .btn-finance:hover {
            background: #059669;
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
            <a href="index.php?act=listTour"><i class="fa fa-map-location-dot"></i> Quản lý Tour</a>
            <a href="index.php?act=listDKH" class="active"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

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

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Đoàn Khởi Hành</h3>
                    <p class="text-muted mb-0">Quản lý lịch trình các đoàn khách</p>
                </div>
                <a href="index.php?act=createDKH" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Thêm Đoàn Mới
                </a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Thông tin Tour</th>
                                <th>Thời gian</th>
                                <th>Nhân sự</th>
                                <th class="text-center">Số chỗ</th>
<th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listDoan)): ?>
                                <?php foreach ($listDoan as $d): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-secondary">#<?= $d['MaDoan'] ?></td>
                                        <td>
                                            <div class="fw-bold text-dark text-wrap" style="max-width: 200px;">
                                                <?= htmlspecialchars($d['TenTour']) ?>
                                            </div>
                                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                                <?= htmlspecialchars($d['DiemTapTrung']) ?></small>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column small">
                                                <span class="text-success fw-bold">Đi:
                                                    <?= date('d/m/Y', strtotime($d['NgayKhoiHanh'])) ?></span>
                                                <span class="text-muted">Về:
                                                    <?= date('d/m/Y', strtotime($d['NgayVe'])) ?></span>
                                                <span class="text-primary"><i class="far fa-clock me-1"></i>
                                                    <?= $d['GioKhoiHanh'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <div><i class="fas fa-flag text-warning me-1"></i>
                                                    <?= $d['TenHDV'] ?: '<span class="text-muted italic">--</span>' ?></div>
                                                <div><i class="fas fa-steering-wheel text-secondary me-1"></i>
                                                    <?= $d['TenTaiXe'] ?: '<span class="text-muted italic">--</span>' ?></div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="fw-bold"><?= $d['DaDat'] ?> / <?= $d['SoChoToiDa'] ?></div>
                                            <small class="text-success">Còn <?= $d['ConTrong'] ?></small>
                                        </td>
                                        <td class="text-center">
                                            <?php
$status = $d['TrangThai'];

                                            switch ($status) {

                                                case 'san_sang':
                                                    echo '<span class="badge badge-status status-open" style="background:#dbeafe; color:#1e40af;">Sẵn sàng</span>';
                                                    break;

                                                case 'dang_dien_ra':
                                                    echo '<span class="badge badge-status status-full" style="background:#fef9c3; color:#b45309;">Đang diễn ra</span>';
                                                    break;

                                                case 'da_ket_thuc':
                                                    echo '<span class="badge badge-status status-done" style="background:#e0f2fe; color:#0369a1;">Đã kết thúc</span>';
                                                    break;

                                                default:
                                                    echo '<span class="badge badge-status status-cancel">Không rõ</span>';
                                                    break;
                                            }
                                            ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="index.php?act=listKhachTrongTour&MaTour=<?= $d['MaTour'] ?>"
                                                    class="btn-action btn-users" title="Danh sách khách">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                                <a href="index.php?act=chiTietDKH&id=<?= $d['MaDoan'] ?>"
                                                    class="btn-action btn-view" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="index.php?act=taichinh&id=<?= $d['MaDoan'] ?>"
                                                    class="btn-action btn-finance" title="Quản lý tài chính">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                </a>
                                                <a href="index.php?act=editDKH&id=<?= $d['MaDoan'] ?>"
                                                    class="btn-action btn-edit" title="Sửa">
                                                    <i class="fas fa-pen"></i>
                                                </a>
<a href="index.php?act=deleteDKH&MaDoan=<?= $d['MaDoan'] ?>"
                                                    class="btn-action btn-delete" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa đoàn này?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-bus fa-3x mb-3 opacity-25"></i>
                                        <p>Chưa có đoàn khởi hành nào.</p>
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
                                    <a class="page-link" href="?act=listDKH&page=<?= $page - 1 ?>"><i
                                            class="fas fa-chevron-left"></i></a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?act=listDKH&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=listDKH&page=<?= $page + 1 ?>"><i
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
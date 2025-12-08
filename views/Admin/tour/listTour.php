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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", "Segoe UI", sans-serif;
            background-color: #f3f6fb;
            padding-left: 260px;
            color: #1f2937;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            padding-top: 25px;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
        }

        .sidebar h4 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 30px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .sidebar a {
            padding: 14px 25px;
            display: flex;
            gap: 10px;
            align-items: center;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.25s ease;
            font-size: 15px;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: white;
            border-left: 3px solid #38bdf8;
        }

        .sidebar a.active {
            background-color: #0284c7;
            border-left: 3px solid #fff;
        }

        .content {
            padding: 30px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
        }

        .search-box {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 18px;
        }

        .search-box .input-group {
            width: 380px;
        }

        .search-box input {
            border-radius: 10px 0 0 10px !important;
        }

        .search-box button {
            border-radius: 0 10px 10px 0 !important;
            background-color: #0ea5e9;
            border: none;
        }

        .btn {
            border-radius: 8px !important;
            padding: 7px 14px !important;
            font-weight: 500;
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border: none;
            color: #000;
        }

        .btn-info {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
        }

        .table-wrapper {
            padding: 20px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 14px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
        }

        .table th {
            padding: 14px;
            font-size: 15px;
        }

        .table td {
            padding: 14px;
            vertical-align: middle !important;
            font-size: 15px;
        }

        .mota {
            max-width: 260px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .table img {
            width: 85px;
            height: 65px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .pagination .page-item .page-link {
            border-radius: 8px !important;
            margin: 0 4px;
        }

        .pagination .page-item.active .page-link {
            background-color: #0284c7;
            border-color: #0284c7;
        }

        form input,
        form select,
        form textarea {
            border-radius: 10px !important;
            border: 1px solid #d1d5db;
        }

        form input:focus,
        form textarea:focus,
        form select:focus {
            border-color: #0ea5e9 !important;
            box-shadow: 0 0 6px rgba(14, 165, 233, 0.5) !important;
        }

        .card,
        .box {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 3px 14px rgba(0, 0, 0, 0.1);
        }


        .top-bar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-right: 10px;
        }

        .btn-add-tour {
            height: 42px;
            display: flex;
            align-items: center;
            padding: 0 18px !important;
        }

        .search-form .input-group {
            width: 350px;
        }

        .search-form input {
            height: 42px !important;
            border-radius: 10px 0 0 10px !important;
        }

        .search-form button {
            height: 42px !important;
            border-radius: 0 10px 10px 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-filter select {
            width: 180px;
            height: 42px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding-left: 10px;
        }

        /* Khung chính giống trang danh mục */
        .box-container {
            background: #fff;
            padding: 0;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header màu xanh */
        .box-header {
            background: linear-gradient(90deg, #0b66ff, #007bff);
            color: white;
            padding: 18px 22px;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Icon trong header */
        .box-header i {
            margin-right: 8px;
        }

        /* Thanh bên phải trong header */
        .header-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Bộ lọc trạng thái */
        .header-right select {
            height: 40px;
            border-radius: 8px;
        }

        /* Ô tìm kiếm */
        .header-right .input-group {
            width: 260px;
        }

        .header-right input {
            height: 40px;
            border-radius: 8px 0 0 8px !important;
        }

        .header-right button {
            height: 40px;
            border-radius: 0 8px 8px 0 !important;
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

            <div class="box-container">

                <!-- HEADER -->
                <div class="box-header">
                    <div>
                        <i class="fa-solid fa-route"></i> Quản Lý Tour
                    </div>

                    <div class="header-right">
                        <!-- Lọc trạng thái -->
                        <form method="GET" action="">
                            <input type="hidden" name="act" value="listTour">
                            <select name="trangthai" onchange="this.form.submit()" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="hoat_dong" <?= (($_GET['trangthai'] ?? '') == 'hoat_dong') ? 'selected' : '' ?>>Hoạt động</option>
                                <option value="tam_dung" <?= (($_GET['trangthai'] ?? '') == 'tam_dung') ? 'selected' : '' ?>>Tạm dừng</option>
                                <option value="da_ket_thuc" <?= (($_GET['trangthai'] ?? '') == 'da_ket_thuc') ? 'selected' : '' ?>>Đã kết thúc</option>
                            </select>
                        </form>

                        <!-- Tìm kiếm -->
                        <form method="GET" action="">
                            <input type="hidden" name="act" value="listTour">
                            <div class="input-group">
                                <input type="text" name="keyword"
                                    class="form-control"
                                    placeholder="Tìm kiếm tour..."
                                    value="<?= $_GET['keyword'] ?? '' ?>">
                                <button class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Nút thêm -->
                        <a href="index.php?act=createTourForm" class="btn btn-success">
                            <i class="fa fa-plus"></i> Thêm Tour
                        </a>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="table-responsive p-3">



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
                                    <th>Trạng thái</th>
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

                                        <td><?= (int)$t['SoDem'] ?></td>

                                        <td>
                                            <?php if (!empty($t['LinkAnhBia'])) { ?>
                                                <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $t['LinkAnhBia'] ?>"
                                                    style="width:80px; height:60px; object-fit:cover;">
                                            <?php } else { ?>
                                                <span class="text-muted">Không có ảnh</span>
                                            <?php } ?>
                                        </td>

                                        <td class="mota text-start"><?= htmlspecialchars($t['MoTa']) ?></td>

                                        <td> <?php
                                                if ($t['TrangThai'] == 'hoat_dong') {
                                                    echo '<span class="badge bg-success">Hoạt động</span>';
                                                } elseif ($t['TrangThai'] == 'tam_dung') {
                                                    echo '<span class="badge bg-warning text-dark">Tạm dừng</span>';
                                                } else {
                                                    echo '<span class="badge bg-secondary">Đã kết thúc</span>';
                                                }
                                                ?>
                                        </td>

                                        <td><?= !empty($t['NgayBatDau']) ? date("d/m/Y", strtotime($t['NgayBatDau'])) : "—" ?></td>

                                        <td><?= !empty($t['NgayKetThuc']) ? date("d/m/Y", strtotime($t['NgayKetThuc'])) : "—" ?></td>

                                        <td>
                                            <div class="action-buttons">
                                                <a href="index.php?act=chiTietTour&id=<?= $t['MaTour'] ?>"
                                                    class="btn btn-info btn-sm text-white">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="index.php?act=editTour&id=<?= $t['MaTour'] ?>"
                                                    class="btn btn-warning btn-sm">
                                                    Sửa
                                                </a>

                                                <a onclick="return confirm('Xóa tour này?')"
                                                    href="index.php?act=deleteTour&id=<?= $t['MaTour'] ?>"
                                                    class="btn btn-danger btn-sm">
                                                    Xóa
                                                </a>

                                                <a href="index.php?act=cloneTour&id=<?= $t['MaTour'] ?>"
                                                    class="btn btn-secondary btn-sm" title="Nhân bản tour">
                                                    <i class="fa-solid fa-clone"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>


                        </table>

                        <nav>
                            <ul class="pagination justify-content-center mt-4">

                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=listTour&page=<?= $page - 1 ?>">«</a>
                                </li>

                                <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?act=listTour&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?act=listTour&page=<?= $page + 1 ?>">»</a>
                                </li>

                            </ul>
                        </nav>


                    </div>
                </div>
            </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Quản Lý Tour</h3>
                    <p class="text-muted mb-0">Danh sách các gói tour du lịch hiện có</p>
                </div>
                <a href="index.php?act=createTourForm" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Thêm Tour Mới
                </a>
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
                            <?php foreach ($listTour as $i => $t) { ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary"><?= $i + 1 + ($page - 1) * 10 ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if (!empty($t['LinkAnhBia'])): ?>
                                                <img src="/DUAN1-PRO1014/uploads/imgproduct/<?= $t['LinkAnhBia'] ?>" class="tour-img me-3">
                                            <?php else: ?>
                                                <div class="tour-img me-3 bg-light d-flex align-items-center justify-content-center text-muted small">No Image</div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-bold text-dark mb-1 text-wrap" style="max-width: 250px;">
                                                    <?= htmlspecialchars($t['TenTour']) ?>
                                                </div>
                                                <small class="text-muted d-block tour-desc" title="<?= htmlspecialchars($t['MoTa']) ?>">
                                                    <?= htmlspecialchars($t['MoTa']) ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($t['TenDanhMuc']) ?></span></td>
                                    <td>
                                        <div class="fw-bold text-success"><?= number_format($t['GiaBanMacDinh'], 0, ',', '.') ?>đ</div>
                                        <small class="text-muted text-decoration-line-through"><?= $t['GiaVonDuKien'] ? number_format($t['GiaVonDuKien'], 0, ',', '.') . 'đ' : '' ?></small>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column small">
                                            <span><i class="far fa-clock me-1 text-primary"></i> <?= (int)$t['SoNgay'] ?>N <?= (int)$t['SoDem'] ?>Đ</span>
                                            <span class="text-muted"><i class="fas fa-map-marker-alt me-1 text-danger"></i> <?= htmlspecialchars($t['DiemKhoiHanh']) ?></span>
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
                                        <small class="d-block text-muted">Bắt đầu: <?= !empty($t['NgayBatDau']) ? date("d/m/Y", strtotime($t['NgayBatDau'])) : "—" ?></small>
                                        <small class="d-block text-muted">Kết thúc: <?= !empty($t['NgayKetThuc']) ? date("d/m/Y", strtotime($t['NgayKetThuc'])) : "—" ?></small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="index.php?act=chiTietTour&id=<?= $t['MaTour'] ?>" class="btn-action btn-view" title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?act=editTour&id=<?= $t['MaTour'] ?>" class="btn-action btn-edit" title="Sửa">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="index.php?act=cloneTour&id=<?= $t['MaTour'] ?>" class="btn-action btn-clone" title="Nhân bản">
                                                <i class="fas fa-clone"></i>
                                            </a>
                                            <a href="index.php?act=deleteTour&id=<?= $t['MaTour'] ?>" class="btn-action btn-delete" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa tour này?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPage) && $totalPage > 1): ?>
                <div class="card-footer bg-white border-top-0 py-3">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?act=listTour&page=<?= $page - 1 ?>"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?act=listTour&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?act=listTour&page=<?= $page + 1 ?>"><i class="fas fa-chevron-right"></i></a>
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
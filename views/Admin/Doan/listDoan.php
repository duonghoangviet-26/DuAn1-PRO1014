<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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
            margin-left: 250px;
            padding: 20px;
        }

        .badge-open {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-full {
            background-color: #f8d7da;
            color: #842029;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cancel {
            background-color: #e2e3e5;
            color: #41464b;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-done {
            background-color: #cfe2ff;
            color: #084298;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Cột hành động */
        td.actions {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        /* Nút hành động chung */
        .actions a {
            text-decoration: none;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
        }

        /* Nút danh sách khách */
        .btn-list {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-list:hover {
            background-color: #0b5ed7;
            color: #fff;
        }

        /* Nút chỉnh sửa */
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #fff;
        }

        /* Nút xóa */
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>

        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="index.php?act=listTour"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listKH"><i class="fa fa-users"></i> Quản lí khách hàng</a>
        <a href="index.php?act=listDKH"><i class="fa fa-users"></i> Quản lí đoàn khởi hành</a>
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-map-marked-alt"></i> Quản Lý Đoàn Khỏi Hành</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <!-- Thanh công cụ -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="index.php?act=createDKH" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Thêm Đoàn Khởi Hành
                                </a>
                            </div>
                        </div>

                        <!-- Bảng danh sách tour -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Ngày đi</th>
                                        <th>Ngày về</th>
                                        <th>Giờ khởi hành</th>
                                        <th>Điểm tập trung</th>
                                        <th>HDV</th>
                                        <th>Tài xế</th>
                                        <th>Chỗ</th>
                                        <th>Đã đặt</th>
                                        <th>Còn trống</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <?php foreach ($listDoan as $d): ?>
                                    <tr>
                                        <td><?= $d['MaDoan'] ?></td>
                                        <td><?= htmlspecialchars($d['TenTour']) ?></td>
                                        <td><?= $d['NgayKhoiHanh'] ?></td>
                                        <td><?= $d['NgayVe'] ?></td>
                                        <td><?= $d['GioKhoiHanh'] ?></td>
                                        <td><?= htmlspecialchars($d['DiemTapTrung']) ?></td>
                                        <td><?= $d['TenHDV'] ?></td>
                                        <td><?= $d['TenTaiXe'] ?></td>

                                        <!-- Tổng chỗ -->
                                        <td><?= $d['SoChoToiDa'] ?></td>

                                        <!-- Đã đặt -->
                                        <td><?= $d['DaDat'] ?></td>
                                        <td><?= $d['ConTrong'] ?></td>

                                        <!-- Trạng thái -->
                                        <td>
                                            <?php
                                            $status = $d['TrangThai'] ?? 'con_cho';
                                            if ($status === 'con_cho') {
                                                echo '<span class="badge badge-open">Còn chỗ</span>';
                                            } elseif ($status === 'het_cho') {
                                                echo '<span class="badge badge-full">Hết chỗ</span>';
                                            } elseif ($status === 'da_huy') {
                                                echo '<span class="badge badge-cancel">Đã hủy</span>';
                                            } else {
                                                echo '<span class="badge badge-done">Hoàn thành</span>';
                                            }
                                            ?>
                                        </td>

                                        <!-- Hành động -->
                                        <td class="actions">
                                            <a href="index.php?act=listKhachTrongTour&MaTour=<?= $d['MaTour'] ?>"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-users"></i> Khách
                                            </a>

                                            <a href="index.php?act=editDKH&id=<?= $d['MaDoan'] ?>" class="btn-edit">
                                                <i class="fa fa-pen"></i> Sửa
                                            </a>

                                            <a href="index.php?act=deleteDKH&MaDoan=<?= $d['MaDoan'] ?>" class="btn-delete"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa đoàn này?');">
                                                <i class="fa fa-trash"></i> Xóa
                                            </a>

                                            <a href="index.php?act=chiTietDKH&id=<?= $d['MaDoan'] ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i> Xem
                                            </a>
                                            <a href="index.php?act=taichinh&id=<?= $d['MaDoan'] ?>" class="btn btn-info btn-sm">Tài chính</a>

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
    </div>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
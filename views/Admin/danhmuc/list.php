\
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị Tour</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <a href="index.php?act=listNCC"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-map-marked-alt"></i> Quản Lý Danh Mục</h4>
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
                                <a href="index.php?act=creatDanhMuc" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Thêm Danh Mục
                                </a>
                            </div>
                        </div>

                        <!-- Bảng danh sách tour -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="10%">Tên danh mục</th>
                                        <th width="15%">Mô tả</th>
                                        <th width="10%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    if (!empty($listdanhmuc)):
                                        foreach ($listdanhmuc as $danhmuc):
                                    ?>
                                    <tr>
                                        <td><?= $stt++ ?></td>
                                        <td><?= htmlspecialchars($danhmuc['TenDanhMuc']) ?></td>
                                        <td><?= htmlspecialchars($danhmuc['MoTa']) ?></td>
                                        <td>
                                            <a href="index.php?act=editDanhMuc&MaDanhMuc=<?= $danhmuc['MaDanhMuc'] ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <a href="index.php?act=deleteDanhMuc&id=<?= $danhmuc['MaDanhMuc'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')">
                                                <i class="fa fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    else:
                                        ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Không có danh mục nào</td>
                                    </tr>
                                    <?php endif; ?>
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
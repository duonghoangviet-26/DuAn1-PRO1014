\
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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=Home"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="index.php?act=listBooking"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- Nội dung -->
    <div class="content">
        <nav class="navbar navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Hệ thống quản lý Tour du lịch</span>
            </div>
        </nav>

        <div class="container">
            <h2 class="mb-3">Chào mừng bạn đến với trang quản trị</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fa fa-list fa-2x text-primary mb-2"></i>
                            <h5>Danh mục Tour</h5>
                            <p>Quản lý các danh mục tour</p>
                            <a href="index.php?act=listdm" class="btn btn-sm btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fa fa-route fa-2x text-success mb-2"></i>
                            <h5>Tour</h5>
                            <p>Thêm, sửa, xóa tour</p>
                            <a href="#" class="btn btn-sm btn-success">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fa fa-book fa-2x text-warning mb-2"></i>
                            <h5>Booking</h5>
                            <p>Quản lý đặt tour</p>
                            <a href="#" class="btn btn-sm btn-warning text-white">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fa fa-users fa-2x text-info mb-2"></i>
                            <h5>Tài khoản</h5>
                            <p>Quản lý hướng dẫn viên</p>
                            <a href="#" class="btn btn-sm btn-info text-white">Xem chi tiết</a>
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
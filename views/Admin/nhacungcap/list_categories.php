<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Nhà Cung Cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: #ccc; display: block; padding: 10px 20px; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; color: #fff; }
        .content { margin-left: 250px; padding: 20px; }

        /* CSS cho các ô (giống trang Tổng quan) */
        .category-card .card-body {
            transition: transform 0.2s;
        }
        .category-card:hover .card-body {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center text-light mb-4">Admin Panel</h4>
        <a href="index.php?act=/"><i class="fa fa-home"></i> Tổng quan</a>
        <a href="index.php?act=listdm"><i class="fa fa-list"></i> Danh mục tour</a>
        <a href="#"><i class="fa fa-route"></i> Quản lý tour</a>
        <a href="#"><i class="fa fa-book"></i> Quản lý booking</a>
        <a href="index.php?act=listNCC" class="bg-primary text-white"><i class="fa fa-handshake"></i> Quản lý nhà cung cấp</a>
        <a href="index.php?act=listNV"><i class="fa fa-users"></i> Tài khoản / HDV</a>
        <a href="#"><i class="fa fa-chart-bar"></i> Báo cáo thống kê</a>
        <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container-fluid py-4">
            <h2 class="mb-4">Quản Lý Nhà Cung Cấp</h2>
            <p>Chọn một loại nhà cung cấp để xem danh sách chi tiết.</p>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm category-card">
                        <div class="card-body">
                            <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                            <h5>Khách sạn</h5>
                            <p>Quản lý các khách sạn, resort</p>
                            <a href="index.php?act=listNCCByCategory&loai=khach_san" class="btn btn-sm btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm category-card">
                        <div class="card-body">
                            <i class="fa fa-utensils fa-2x text-success mb-2"></i>
                            <h5>Nhà hàng</h5>
                            <p>Quản lý các nhà hàng, quán ăn</p>
                            <a href="index.php?act=listNCCByCategory&loai=nha_hang" class="btn btn-sm btn-success">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm category-card">
                        <div class="card-body">
                            <i class="fa fa-bus-alt fa-2x text-warning mb-2"></i>
                            <h5>Vận chuyển</h5>
                            <p>Quản lý các nhà xe, vé máy bay</p>
                            <a href="index.php?act=listNCCByCategory&loai=van_chuyen" class="btn btn-sm btn-warning text-white">Xem chi tiết</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm category-card">
                        <div class="card-body">
                            <i class="fa fa-passport fa-2x text-info mb-2"></i>
                            <h5>Visa</h5>
                            <p>Quản lý các dịch vụ làm visa</p>
                            <a href="index.php?act=listNCCByCategory&loai=visa" class="btn btn-sm btn-info text-white">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
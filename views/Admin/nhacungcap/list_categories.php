<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhà Cung Cấp</title>
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
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h4 { font-weight: 700; font-size: 1.2rem; color: #fff; display: flex; align-items: center; }
        .sidebar-menu { padding: 0 10px; }
        .sidebar-title { font-size: 0.75rem; text-transform: uppercase; color: #95a5a6; margin: 15px 15px 5px; font-weight: 600; }
        .sidebar a { color: #bdc3c7; padding: 12px 15px; text-decoration: none; display: flex; align-items: center; border-radius: 8px; font-size: 0.95rem; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a i { width: 25px; text-align: center; margin-right: 10px; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px); }
        .sidebar a.active { background-color: #3498db; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); }

        /* --- CONTENT STYLE --- */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* --- CARD STYLE --- */
        .category-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.08);
        }

        .card-body { padding: 30px 20px; }

        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            transition: 0.3s;
        }

        /* Màu sắc riêng cho từng loại */
        .card-hotel .icon-box { background: #e0f2fe; color: #0284c7; }
        .card-hotel:hover .icon-box { background: #0284c7; color: #fff; }

        .card-restaurant .icon-box { background: #dcfce7; color: #16a34a; }
        .card-restaurant:hover .icon-box { background: #16a34a; color: #fff; }

        .card-transport .icon-box { background: #fef3c7; color: #d97706; }
        .card-transport:hover .icon-box { background: #d97706; color: #fff; }

        .card-visa .icon-box { background: #fae8ff; color: #9333ea; }
        .card-visa:hover .icon-box { background: #9333ea; color: #fff; }

        .card-title { font-weight: 700; color: #1f2937; margin-bottom: 10px; font-size: 1.1rem; }
        .card-text { color: #6b7280; font-size: 0.9rem; margin-bottom: 20px; }

        .btn-view {
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
            border: 1px solid transparent;
        }

        .btn-view-primary { background: #e0f2fe; color: #0284c7; }
        .btn-view-primary:hover { background: #0284c7; color: #fff; }

        .btn-view-success { background: #dcfce7; color: #16a34a; }
        .btn-view-success:hover { background: #16a34a; color: #fff; }

        .btn-view-warning { background: #fef3c7; color: #d97706; }
        .btn-view-warning:hover { background: #d97706; color: #fff; }

        .btn-view-info { background: #fae8ff; color: #9333ea; }
        .btn-view-info:hover { background: #9333ea; color: #fff; }

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
            <a href="index.php?act=listDKH"><i class="fa fa-bus"></i> Đoàn khởi hành</a>

            <div class="sidebar-title">Kinh doanh</div>
            <a href="index.php?act=listBooking"><i class="fa fa-file-invoice-dollar"></i> Booking & Đơn hàng</a>
            <a href="index.php?act=listKH"><i class="fa fa-users"></i> Khách hàng</a>

            <div class="sidebar-title">Hệ thống</div>
            <a href="index.php?act=listNCC" class="active"><i class="fa fa-handshake"></i> Đối tác & NCC</a>
            <a href="index.php?act=listNV"><i class="fa-solid fa-id-card"></i> Nhân sự</a>
            <a href="index.php?act=listTaiKhoan"><i class="fa fa-user-gear"></i> Tài khoản </a>
            
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Quản Lý Nhà Cung Cấp</h3>
                    <p class="text-muted mb-0">Danh sách đối tác dịch vụ du lịch</p>
                </div>
                </div>

            <div class="row g-4">
                <div class="col-xl-3 col-md-6">
                    <div class="category-card card-hotel text-center">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa fa-hotel"></i>
                            </div>
                            <h5 class="card-title">Khách Sạn</h5>
                            <p class="card-text">Quản lý hệ thống lưu trú, khách sạn, resort đối tác.</p>
                            <a href="index.php?act=listNCCByCategory&loai=khach_san" class="btn-view btn-view-primary">
                                Xem danh sách <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="category-card card-restaurant text-center">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa fa-utensils"></i>
                            </div>
                            <h5 class="card-title">Nhà Hàng</h5>
                            <p class="card-text">Danh sách nhà hàng, quán ăn phục vụ đoàn khách.</p>
                            <a href="index.php?act=listNCCByCategory&loai=nha_hang" class="btn-view btn-view-success">
                                Xem danh sách <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="category-card card-transport text-center">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa fa-bus-alt"></i>
                            </div>
                            <h5 class="card-title">Vận Chuyển</h5>
                            <p class="card-text">Đối tác nhà xe, vé máy bay, tàu hỏa du lịch.</p>
                            <a href="index.php?act=listNCCByCategory&loai=van_chuyen" class="btn-view btn-view-warning">
                                Xem danh sách <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="category-card card-visa text-center">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa fa-passport"></i>
                            </div>
                            <h5 class="card-title">Dịch Vụ Visa</h5>
                            <p class="card-text">Các đơn vị hỗ trợ làm visa, giấy tờ nhập cảnh.</p>
                            <a href="index.php?act=listNCCByCategory&loai=visa" class="btn-view btn-view-info">
                                Xem danh sách <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Nhà Cung Cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f3f4f6; font-family: 'Inter', sans-serif; margin: 0; }

        .sidebar {
            width: 260px; height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1; padding-top: 20px; box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            z-index: 1000; overflow-y: auto;
        }
        .sidebar-header { padding: 0 25px 25px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; }
        .sidebar-header h4 { font-weight: 700; font-size: 1.2rem; color: #fff; display: flex; align-items: center; }
        .sidebar-menu { padding: 0 10px; }
        .sidebar-title { font-size: 0.75rem; text-transform: uppercase; color: #95a5a6; margin: 15px 15px 5px; font-weight: 600; }
        .sidebar a { color: #bdc3c7; padding: 12px 15px; text-decoration: none; display: flex; align-items: center; border-radius: 8px; font-size: 0.95rem; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a i { width: 25px; text-align: center; margin-right: 10px; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px); }
        .sidebar a.active { background-color: #3498db; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3); }

        .main-content { margin-left: 260px; padding: 30px; width: calc(100% - 260px); min-height: 100vh; }
        .card-detail { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; margin-bottom: 25px; }
        .card-header-detail { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        
        .detail-item { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px dashed #e5e7eb; }
        .detail-item:last-child { border-bottom: none; }
        .detail-label { color: #6b7280; font-weight: 500; }
        .detail-value { font-weight: 600; color: #111827; text-align: right; }

        .badge-type { padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; }
        .badge-status-active { background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; }
        .badge-status-inactive { background: #f3f4f6; color: #4b5563; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; }
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
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=listNCCByCategory&loai=<?= $ncc['LoaiNhaCungCap'] ?>" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Chi Tiết Nhà Cung Cấp</h3>
                        <p class="text-muted mb-0">Thông tin đối tác: <strong><?= $ncc['TenNhaCungCap'] ?></strong></p>
                    </div>
                </div>
                <div>
                    <a href="index.php?act=editNCC&id=<?= $ncc['MaNhaCungCap'] ?>" class="btn btn-warning text-white shadow-sm">
                        <i class="fas fa-edit me-1"></i> Chỉnh sửa
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-detail h-100">
                        <div class="card-header-detail">
                            <h5 class="fw-bold text-primary mb-0"><i class="fas fa-info-circle me-2"></i> Thông Tin Cơ Bản</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-building fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1"><?= $ncc['TenNhaCungCap'] ?></h5>
                                    <span class="badge badge-type"><?= ucwords(str_replace('_', ' ', $ncc['LoaiNhaCungCap'])) ?></span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Mã Code:</span>
                                <span class="detail-value text-primary"><?= $ncc['MaCodeNCC'] ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Trạng thái:</span>
                                <span class="detail-value">
                                    <?php if ($ncc['TrangThai'] == 'hoat_dong'): ?>
                                        <span class="badge-status-active">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge-status-inactive">Ngưng HĐ</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Người liên hệ:</span>
                                <span class="detail-value"><?= $ncc['NguoiLienHe'] ?></span>
                            </div>
                            
                            <?php if ($ncc['LoaiNhaCungCap'] == 'van_chuyen'): ?>
                            <div class="mt-3 p-3 bg-light rounded border">
                                <h6 class="text-primary small fw-bold mb-2"><i class="fas fa-steering-wheel"></i> THÔNG TIN LÁI XE</h6>
                                <div class="detail-item border-0 py-1">
                                    <span class="detail-label">Tài xế:</span>
                                    <span class="detail-value text-danger"><?= !empty($ncc['TenLaiXe']) ? $ncc['TenLaiXe'] : '---' ?></span>
                                </div>
                                <div class="detail-item border-0 py-1">
                                    <span class="detail-label">SĐT Lái xe:</span>
                                    <span class="detail-value"><?= !empty($ncc['SDTLaiXe']) ? $ncc['SDTLaiXe'] : '---' ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-detail mb-4">
                        <div class="card-header-detail">
                            <h5 class="fw-bold text-success mb-0"><i class="fas fa-address-book me-2"></i> Liên Hệ</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="detail-item">
                                <span class="detail-label">Số điện thoại:</span>
                                <span class="detail-value"><a href="tel:<?= $ncc['SoDienThoai'] ?>" class="text-decoration-none fw-bold text-dark"><?= $ncc['SoDienThoai'] ?></a></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value"><a href="mailto:<?= $ncc['Email'] ?>" class="text-decoration-none text-muted"><?= $ncc['Email'] ?></a></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Địa chỉ:</span>
                                <span class="detail-value text-break" style="max-width: 60%;"><?= $ncc['DiaChi'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-detail">
                        <div class="card-header-detail">
                            <h5 class="fw-bold text-warning mb-0"><i class="fas fa-file-contract me-2"></i> Hợp Đồng & Dịch Vụ</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="detail-label d-block mb-1">Dịch vụ cung cấp:</label>
                                <div class="p-2 bg-light rounded text-secondary small">
                                    <?= !empty($ncc['DichVuCungCap']) ? nl2br($ncc['DichVuCungCap']) : 'Chưa cập nhật' ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Thời hạn HĐ:</span>
                                <span class="detail-value">
                                    <?= date('d/m/Y', strtotime($ncc['NgayBatDauHopDong'])) ?> - 
                                    <?= date('d/m/Y', strtotime($ncc['NgayKetThucHopDong'])) ?>
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Đánh giá:</span>
                                <span class="detail-value text-warning">
                                    <?= $ncc['DanhGia'] ?> <i class="fas fa-star"></i>
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">File Hợp Đồng:</span>
                                <span class="detail-value">
                                    <?php if(!empty($ncc['FileHopDong'])): ?>
                                        <a href="<?= $ncc['FileHopDong'] ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-download"></i> Tải về</a>
                                    <?php else: ?>
                                        <span class="text-muted italic">Chưa có file</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-detail mt-2">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-secondary mb-2">Ghi chú nội bộ:</h6>
                    <p class="text-muted mb-0 fst-italic">
                        <?= !empty($ncc['GhiChu']) ? nl2br($ncc['GhiChu']) : 'Không có ghi chú nào.' ?>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
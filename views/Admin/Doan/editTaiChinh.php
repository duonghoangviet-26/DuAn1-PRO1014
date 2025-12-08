<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Giao Dịch Tài Chính</title>
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

        .card-form { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background: #fff; margin-bottom: 20px; }
        .card-header-custom { background-color: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; border-radius: 12px 12px 0 0; }
        .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); } /* Màu cam edit */
        
        .btn-submit { background-color: #f59e0b; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; color: white; }
        .btn-submit:hover { background-color: #d97706; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2); color: white; }
        
        .btn-cancel { background-color: #f3f4f6; color: #4b5563; border: none; padding: 12px 30px; font-weight: 600; border-radius: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-cancel:hover { background-color: #e5e7eb; color: #1f2937; }

        .img-preview { width: 100%; max-width: 200px; border-radius: 8px; border: 2px solid #e5e7eb; padding: 4px; margin-bottom: 10px; }
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
            <a href="index.php?act=logout" class="text-danger mt-3"><i class="fa fa-right-from-bracket"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="index.php?act=taichinh&id=<?= $MaDoan ?>" class="text-secondary me-3 fs-4"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Cập Nhật Giao Dịch</h3>
                        <p class="text-muted mb-0">Chỉnh sửa thông tin thu chi</p>
                    </div>
                </div>
            </div>

            <form action="index.php?act=updateTC" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MaTaiChinh" value="<?= $data['MaTaiChinh'] ?>">
                <input type="hidden" name="MaDoan" value="<?= $MaDoan ?>">
                <input type="hidden" name="AnhCu" value="<?= $data['AnhChungTu'] ?>">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-warning mb-0"><i class="fas fa-edit me-2"></i> Thông Tin Giao Dịch</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Loại giao dịch <span class="text-danger">*</span></label>
                                        <select name="LoaiGiaoDich" class="form-select" required>
                                            <option value="thu" <?= $data['LoaiGiaoDich'] == 'thu' ? 'selected' : '' ?>>🟢 Thu (Tiền vào)</option>
                                            <option value="chi" <?= $data['LoaiGiaoDich'] == 'chi' ? 'selected' : '' ?>>🔴 Chi (Tiền ra)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ngày giao dịch <span class="text-danger">*</span></label>
                                        <input type="date" name="NgayGiaoDich" class="form-control" value="<?= $data['NgayGiaoDich'] ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số tiền <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="SoTien" class="form-control" value="<?= $data['SoTien'] ?>" required>
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Hạng mục / Lý do <span class="text-danger">*</span></label>
                                    <input type="text" name="HangMucChi" class="form-control" value="<?= $data['HangMucChi'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ghi chú thêm</label>
                                    <textarea name="MoTa" class="form-control" rows="3"><?= $data['MoTa'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-form h-100">
                            <div class="card-header-custom">
                                <h5 class="fw-bold text-primary mb-0"><i class="fas fa-receipt me-2"></i> Chứng Từ & Thanh Toán</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="form-label">Phương thức thanh toán</label>
                                    <select name="PhuongThucThanhToan" class="form-select">
                                        <option value="Tiền mặt" <?= $data['PhuongThucThanhToan'] == 'Tiền mặt' ? 'selected' : '' ?>>💵 Tiền mặt</option>
                                        <option value="Chuyển khoản" <?= $data['PhuongThucThanhToan'] == 'Chuyển khoản' ? 'selected' : '' ?>>🏦 Chuyển khoản</option>
                                        <option value="Thẻ tín dụng" <?= $data['PhuongThucThanhToan'] == 'Thẻ tín dụng' ? 'selected' : '' ?>>💳 Thẻ tín dụng</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mã hóa đơn / Chứng từ</label>
                                    <input type="text" name="SoHoaDon" class="form-control" value="<?= $data['SoHoaDon'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ảnh chứng từ</label>
                                    <?php if (!empty($data['AnhChungTu'])): ?>
                                        <div class="mb-2">
                                            <img src="uploads/<?= $data['AnhChungTu'] ?>" class="img-preview" alt="Chứng từ">
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted small italic">Chưa có ảnh chứng từ.</p>
                                    <?php endif; ?>
                                    
                                    <input type="file" name="AnhChungTu" class="form-control mt-2">
                                    <div class="form-text text-muted small">Chọn ảnh mới nếu muốn thay đổi.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-form p-3 sticky-bottom text-end mt-2">
                    <a href="index.php?act=taichinh&id=<?= $MaDoan ?>" class="btn btn-cancel me-2">Hủy bỏ</a>
                    <button type="submit" name="btnUpdate" class="btn btn-submit text-white">
                        <i class="fas fa-save me-2"></i> Lưu Cập Nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
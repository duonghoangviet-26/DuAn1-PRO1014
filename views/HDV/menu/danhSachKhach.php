<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f5f8fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; z-index: 1000; }
        .sidebar h4 { text-align: center; margin-bottom: 30px; font-weight: bold; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; font-size: 16px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #0a7b80; color: #fff; }
        .sidebar a.active { border-left: 4px solid #ffc107; }
        
        .content { margin-left: 260px; padding: 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); background: white; }
        .avatar-circle { width: 40px; height: 40px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #085f63; font-weight: bold; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình</a>
        <a href="index.php?act=hdv_schedule" class="active"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="#"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_quanlykhach&id=<?= $_GET['id'] ?? '' ?>"><i class="fa-solid fa-user-check"></i> Quản lý khách</a> <hr style="border-color: #aad; margin: 20px;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold" style="color: #085f63;">Danh Sách Đoàn Khách</h3>
                <p class="text-muted mb-0">
                    Tour: <strong><?= $thongTinChung['TenTour'] ?></strong> <br> 
                    Đoàn: <strong>#<?= $thongTinChung['MaDoan'] ?></strong>
                </p>
            </div>
            <a href="index.php?act=hdv_schedule" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-custom p-3 text-center border-bottom border-4 border-primary">
                    <h6 class="text-muted">Tổng khách</h6>
                    <h3 class="fw-bold text-primary"><?= count($listKhach) ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                 <div class="card card-custom p-3 text-center border-bottom border-4 border-info">
                    <h6 class="text-muted">Ngày khởi hành</h6>
                    <h5 class="fw-bold text-info"><?= date('d/m/Y', strtotime($thongTinChung['NgayKhoiHanh'])) ?></h5>
                </div>
            </div>
        </div>

        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Thông tin chi tiết</h5>
                <input type="text" id="searchGuest" class="form-control w-25" placeholder="Tìm kiếm tên khách...">
            </div>

            <?php if(empty($listKhach)): ?>
                <div class="alert alert-warning text-center">Chưa có dữ liệu khách hàng cho đoàn này.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-bordered" id="guestTable">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th>STT</th>
                                <th>Họ và Tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Giấy tờ</th> <th>SĐT</th>     <th>Loại phòng</th> <th>Ghi chú đặc biệt</th> <th>Booking ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listKhach as $index => $kh): 
                                $avatarChar = strtoupper(substr($kh['HoTen'], 0, 1));
                            ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $index + 1 ?></td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2"><?= $avatarChar ?></div>
                                        <div class="fw-bold text-dark"><?= $kh['HoTen'] ?></div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <?php 
                                    $gioiTinh = strtolower($kh['GioiTinh']); 
                                    if($gioiTinh == 'nam'): ?>
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info">Nam</span>
                                    <?php elseif($gioiTinh == 'nu' || $gioiTinh == 'nữ'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Nữ</span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?= !empty($kh['NgaySinh']) ? date('d/m/Y', strtotime($kh['NgaySinh'])) : '-' ?>
                                </td>

                                <td class="text-center text-primary fw-bold">
                                    <?= $kh['SoGiayTo'] ?? '-' ?>
                                </td>

                                <td class="text-center">
                                    <?= !empty($kh['SoDienThoai']) ? $kh['SoDienThoai'] : '-' ?>
                                </td>

                                <td class="text-center">
                                    <?php if($kh['LoaiPhong'] == 'don'): ?>
                                        <span class="badge bg-secondary">Đơn</span>
                                    <?php elseif($kh['LoaiPhong'] == 'doi' || $kh['LoaiPhong'] == '2_giuong'): ?>
                                        <span class="badge bg-primary">Đôi/2 Giường</span>
                                    <?php else: ?>
                                        <?= $kh['LoaiPhong'] ?? '-' ?>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if(!empty($kh['GhiChuDacBiet'])): ?>
                                        <span class="text-danger fw-bold"><i class="fas fa-exclamation-circle"></i> <?= $kh['GhiChuDacBiet'] ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">Không có</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center"><span class="badge bg-light text-dark border">#<?= $kh['MaBooking'] ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchGuest').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#guestTable tbody tr');
            
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.indexOf(value) > -1 ? '' : 'none';
            });
        });
    </script>
</body>
</html>
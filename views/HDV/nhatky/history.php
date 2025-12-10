<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Điểm Danh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #0a7b80; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        .card-day { border: none; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-header-day { background-color: #085f63; color: white; border-radius: 12px 12px 0 0 !important; padding: 15px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV" style="background: #0a7b80; color: #fff;"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <hr style="color: #aad;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="mb-4">
            <a href="index.php?act=listTourOfHDV" class="text-secondary text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
            <h3 class="fw-bold text-primary mt-2">Lịch Sử Điểm Danh</h3>
            <p class="text-muted">Tour: <?= $thongTinDoan['TenTour'] ?> (Đoàn: <?= $thongTinDoan['MaDoan'] ?>)</p>
        </div>

        <?php if(empty($history)): ?>
            <div class="alert alert-warning text-center">
                <i class="fa-solid fa-triangle-exclamation"></i> Chưa có dữ liệu điểm danh nào.
            </div>
        <?php else: ?>
            <?php foreach($history as $ngayLabel => $buois): ?>
                <div class="card card-day">
                    <div class="card-header card-header-day">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 fw-bold">
                                <i class="fa-regular fa-calendar-check"></i> <?= $ngayLabel ?>
                            </h5>
                            
                            <?php 
                                $firstRows = reset($buois); // Lấy danh sách khách của buổi đầu tiên
                                $oneRow = $firstRows[0];    // Lấy 1 dòng để đọc dữ liệu lịch trình
                                
                                // Dò tìm tên cột mô tả (Ưu tiên: TieuDe -> NoiDung -> MoTa -> TenLichTrinh)
                                $moTaHoatDong = $oneRow['TieuDe'] 
                                             ?? $oneRow['NoiDung'] 
                                             ?? $oneRow['MoTa'] 
                                             ?? $oneRow['TenLichTrinh'] 
                                             ?? $oneRow['TenHoatDong']
                                             ?? 'Chi tiết lịch trình';
                            ?>
                            <span class="badge bg-warning text-dark text-wrap text-start" style="max-width: 60%; font-weight: normal;">
                                <i class="fa-solid fa-map-location-dot"></i> <?= $moTaHoatDong ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($buois as $tenBuoi => $dsKhach): ?>
                                <div class="col-md-12 mb-3">
                                    <h6 class="fw-bold text-primary border-bottom pb-2">
                                        <?php 
                                            $labelBuoi = '';
                                            switch($tenBuoi) {
                                                case 'sang': $labelBuoi = 'Buổi Sáng'; break;
                                                case 'trua': $labelBuoi = 'Buổi Trưa'; break;
                                                case 'chieu': $labelBuoi = 'Buổi Chiều'; break;
                                                case 'toi':  $labelBuoi = 'Buổi Tối'; break;
                                                default:     $labelBuoi = 'Buổi ' . ucfirst($tenBuoi);
                                            }
                                            echo '<i class="fa-regular fa-clock me-1"></i> ' . $labelBuoi;
                                        ?>
                                    </h6>
                                    
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Họ Tên</th>
                                                <th>SĐT</th>
                                                <th>Trạng Thái</th>
                                                <th><i class="fa-regular fa-clock"></i> Giờ Check-in</th> 
                                                <th>Ghi Chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($dsKhach as $k): ?>
                                                <tr>
                                                    <td><?= $k['HoTen'] ?></td>
                                                    <td><?= $k['SoDienThoai'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($k['TrangThai'] == 'co_mat') echo '<span class="badge bg-success">Có mặt</span>';
                                                            elseif($k['TrangThai'] == 'vang') echo '<span class="badge bg-danger">Vắng</span>';
                                                            elseif($k['TrangThai'] == 'tre') echo '<span class="badge bg-warning text-dark">Đi muộn</span>';
                                                            else echo $k['TrangThai'];
                                                        ?>
                                                    </td>
                                                    <td class="text-secondary" style="font-size: 0.9rem;">
                                                        <?= !empty($k['ThoiGianCheckIn']) ? date('H:i:s', strtotime($k['ThoiGianCheckIn'])) : '-' ?>
                                                    </td>
                                                    <td class="text-muted fst-italic"><?= $k['GhiChu'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
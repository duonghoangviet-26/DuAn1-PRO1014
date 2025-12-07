<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm Danh Khách Hàng</title>
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
        .panel-header {
            background-color: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #dee2e6; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .table thead th { background-color: #f1f4f9; color: #495057; font-weight: 600; border-bottom: 2px solid #dee2e6; }
        .table tbody td { vertical-align: middle; font-size: 0.95rem; }
        select.status-select { font-weight: bold; border-radius: 6px; cursor: pointer;}
        select.status-select.co_mat { color: #198754; border-color: #198754; }
        select.status-select.vang { color: #dc3545; border-color: #dc3545; }
        select.status-select.tre { color: #ffc107; border-color: #ffc107; }

        .input-note { border: none; border-bottom: 1px solid #ccc; background: transparent; width: 100%; padding: 5px; transition: 0.3s; }
        .input-note:focus { outline: none; border-bottom: 2px solid #085f63; background: #fff; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang Chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="#"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="#" class="active"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <hr style="border-color: #aad; margin: 20px;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary"><i class="fas fa-clipboard-check me-2"></i> Điểm Danh Khách Hàng</h3>
                <p class="text-muted mb-0">Tour: <strong><?= $thongTinChung['TenTour'] ?></strong> | Đoàn: <strong><?= $thongTinChung['MaDoan'] ?></strong></p>
            </div>
            <div>
                <a href="index.php?act=hdv_schedule" class="btn btn-outline-secondary me-2">Hủy</a>
                <button onclick="document.getElementById('formDiemDanh').submit()" class="btn btn-primary"><i class="fas fa-save me-1"></i> Lưu Thay Đổi</button>
            </div>
        </div>

        <div class="panel-header">
            <form method="GET" action="index.php" id="formFilter">
                <input type="hidden" name="act" value="hdv_quanlykhach">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-success">1. Chọn Ngày</label>
                        <select name="id_lichtrinh" class="form-select shadow-none border-success" onchange="this.form.submit()">
                            <?php if(empty($listLichTrinh)): ?>
                                <option value="">Chưa có lịch trình</option>
                            <?php else: ?>
                                <?php foreach ($listLichTrinh as $lt): ?>
                                    <option value="<?= $lt['MaLichTrinh'] ?>" <?= ($lt['MaLichTrinh'] == $selectedLichTrinh) ? 'selected' : '' ?>>
                                        Ngày <?= $lt['NgayThu'] ?>: <?= $lt['TieuDeNgay'] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-primary">2. Chọn Buổi</label>
                        <select name="buoi" class="form-select shadow-none border-primary" onchange="this.form.submit()">
                            <?php 
                                $sessions = [
                                    'sang' => 'Buổi Sáng', 
                                    'trua' => 'Buổi Trưa', 
                                    'chieu' => 'Buổi Chiều', 
                                    'toi' => 'Buổi Tối'
                                ];
                                foreach($sessions as $key => $label):
                            ?>
                                <option value="<?= $key ?>" <?= ($key == $selectedBuoi) ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-bold text-muted">Hoạt động chính</label>
                        <?php 
                            $colName = 'NoiDung' . ucfirst($selectedBuoi); 
                            $rawContent = !empty($currentLichTrinh[$colName]) ? $currentLichTrinh[$colName] : '';
                            $shortContent = !empty($rawContent) ? strip_tags($rawContent) : 'Không có hoạt động ghi nhận';
                        ?>
                        
                        <div class="input-group">
                            <input type="text" class="form-control bg-light" value="<?= $shortContent ?>" readonly>
                            
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalActivity" title="Xem toàn bộ nội dung">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <?php if(!empty($listKhach) && !empty($selectedLichTrinh)): ?>
                <form action="index.php?act=hdv_submit_diemdanh" method="POST" id="formDiemDanh">
                    <input type="hidden" name="MaLichTrinh" value="<?= $selectedLichTrinh ?>">
                    <input type="hidden" name="MaLichLamViec" value="<?= $_GET['id'] ?>">
                    <input type="hidden" name="buoi" value="<?= $selectedBuoi ?>">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle border mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%" class="text-start">Họ Tên</th>
                                    <th width="15%">Thông tin</th>
                                    <th width="10%">Giấy tờ</th>
                                    <th width="10%">Note</th>
                                    <th width="20%">Trạng Thái</th>
                                    <th width="20%">Ghi Chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listKhach as $index => $kh): 
                                    $maKhach = $kh['MaKhachTrongBooking'];
                                    $status = $ddStatus[$maKhach]['TrangThai'] ?? 'co_mat';
                                    $note = $ddStatus[$maKhach]['GhiChu'] ?? '';
                                    
                                    $statusClass = '';
                                    if($status == 'co_mat') $statusClass = 'co_mat';
                                    elseif($status == 'vang') $statusClass = 'vang';
                                    elseif($status == 'tre') $statusClass = 'tre';

                                    $gioiTinh = strtolower($kh['GioiTinh'] ?? '');
                                ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= $index + 1 ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $kh['HoTen'] ?></div>
                                        <small class="text-muted">Booking: #<?= $kh['MaBooking'] ?></small>
                                    </td>
                                    <td class="small">
                                        <?php if($gioiTinh == 'nam'): ?> <i class="fas fa-mars text-primary"></i> Nam
                                        <?php elseif($gioiTinh == 'nu' || $gioiTinh == 'nữ'): ?> <i class="fas fa-venus text-danger"></i> Nữ
                                        <?php else: ?> - <?php endif; ?>
                                        <br>
                                        <i class="fas fa-phone text-success"></i> <?= !empty($kh['SoDienThoai']) ? $kh['SoDienThoai'] : '-' ?>
                                    </td>
                                    <td class="text-center text-primary fw-bold"><?= !empty($kh['SoGiayTo']) ? $kh['SoGiayTo'] : '-' ?></td>
                                    <td class="small">
                                        <?php if(!empty($kh['GhiChuDacBiet'])): ?> <div class="text-danger fw-bold" title="<?= $kh['GhiChuDacBiet'] ?>"><i class="fas fa-exclamation-circle"></i> Lưu ý</div> <?php endif; ?>
                                    </td>
                                    <td>
                                        <select name="attendance[<?= $maKhach ?>]" class="form-select status-select <?= $statusClass ?>" onchange="updateColor(this)">
                                            <option value="co_mat" <?= $status == 'co_mat' ? 'selected' : '' ?>>&#xf00c; Có mặt</option>
                                            <option value="vang" <?= $status == 'vang' ? 'selected' : '' ?>>&#xf00d; Vắng</option>
                                            <option value="tre" <?= $status == 'tre' ? 'selected' : '' ?>>&#xf017; Muộn</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="input-note" name="note[<?= $maKhach ?>]" value="<?= $note ?>" placeholder="Ghi chú...">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3 mb-3 pe-3">
                        <button type="submit" class="btn btn-primary px-5 py-2 shadow"><i class="fas fa-save me-2"></i> LƯU ĐIỂM DANH</button>
                    </div>
                </form>
                <?php else: ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3 text-warning"></i><br>
                        Chưa có dữ liệu khách hàng hoặc chưa chọn lịch trình.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalActivity" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title fw-bold"><i class="fas fa-info-circle me-2"></i> Chi tiết hoạt động</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold text-primary mb-2">
                        <?php 
                            $sessionLabels = ['sang' => 'Buổi Sáng', 'trua' => 'Buổi Trưa', 'chieu' => 'Buổi Chiều', 'toi' => 'Buổi Tối'];
                            echo $sessionLabels[$selectedBuoi] ?? 'Hoạt động';
                        ?>
                    </h6>
                    <div class="p-3 bg-light rounded border">
                        <?php 
                            if (!empty($rawContent)) {
                                echo nl2br($rawContent);
                            } else {
                                echo '<span class="text-muted">Không có thông tin chi tiết cho buổi này.</span>';
                            }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateColor(select) {
            select.classList.remove('co_mat', 'vang', 'tre');
            select.classList.add(select.value);
        }
        document.querySelectorAll('.status-select').forEach(sel => updateColor(sel));
    </script>
</body>
</html>
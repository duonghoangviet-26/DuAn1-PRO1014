<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Vận Hành Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f8fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #085f63;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            color: white;
            z-index: 1000;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a {
            color: #d9f7f5;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0a7b80;
            color: #fff;
        }

        .sidebar a.active {
            border-left: 4px solid #ffc107;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .card-finance {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .balance-card {
            background: linear-gradient(135deg, #085f63 0%, #137a70 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #085f63;
            border-bottom: 3px solid #085f63;
        }

        .nav-tabs .nav-link {
            color: #666;
        }

        .card-supplier {
            border: 1px solid #eee;
            border-radius: 10px;
            transition: 0.2s;
            background: white;
            margin-bottom: 15px;
        }

        .card-supplier:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .btn-call {
            background-color: #e3f2fd;
            color: #0d6efd;
            border: none;
            font-weight: 600;
        }

        .btn-call:hover {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="#"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="#" class="active"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark">Vận Hành Tour</h3>
                <p class="text-muted mb-0">Tour: <strong><?= $thongTinChung['TenTour'] ?></strong> (Đoàn #<?= $thongTinChung['MaDoan'] ?>)</p>
            </div>
            <a href="index.php?act=hdv_schedule" class="btn btn-outline-secondary">Thoát</a>
        </div>

        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#finance">💰 Quản Lý Tài Chính</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#supplier">🏨 Nhà Cung Cấp</button></li>
        </ul>

        <div class="tab-content">
            <div class="d-flex justify-content-end p-3">
                <a href="index.php?act=hdv_add_form&doan=<?= $maDoan ?>&lich=<?= $maLich ?>"
                    class="btn btn-success fw-bold">
                    <i class="fa fa-plus-circle me-1"></i> Thêm giao dịch
                </a>
            </div>

            <div class="tab-pane fade show active" id="finance">
                <div class="card card-table">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Ngày GD</th>
                                    <th>Loại</th>
                                    <th>Hạng mục / Nội dung</th>
                                    <th>Số tiền</th>
                                    <th>Thanh toán</th>
                                    <th>Chứng từ</th>
                                    <th>Ghi chú</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (!empty($listTaiChinh)): ?>
                                    <?php foreach ($listTaiChinh as $r): ?>


                                        <tr>
                                            <!-- Ngày -->
                                            <td class="ps-4 text-muted small">
                                                <?= date('d/m/Y', strtotime($r['NgayGiaoDich'])) ?>
                                            </td>

                                            <!-- Loại giao dịch -->
                                            <td>
                                                <?php if ($r['LoaiGiaoDich'] == 'thu'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-arrow-up me-1"></i> Thu
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-arrow-down me-1"></i> Chi
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Hạng mục -->
                                            <td class="fw-bold text-dark">
                                                <?= htmlspecialchars($r['HangMucChi']) ?>
                                            </td>

                                            <!-- Số tiền -->
                                            <td class="<?= $r['LoaiGiaoDich'] == 'thu' ? 'text-success' : 'text-danger' ?> fw-bold">
                                                <?= $r['LoaiGiaoDich'] == 'thu' ? '+' : '-' ?>
                                                <?= number_format($r['SoTien']) ?>
                                            </td>

                                            <!-- PTTT -->
                                            <td>
                                                <span class="text-secondary small">
                                                    <i class="fas fa-credit-card me-1"></i>
                                                    <?= $r['PhuongThucThanhToan'] ?>
                                                </span>
                                            </td>

                                            <!-- Chứng từ -->
                                            <td>
                                                <?php if ($r['AnhChungTu']): ?>
                                                    <a href="uploads/<?= $r['AnhChungTu'] ?>" target="_blank">
                                                        <img src="uploads/<?= $r['AnhChungTu'] ?>"
                                                            class="img-thumb"
                                                            style="height:45px; border-radius:5px;">
                                                    </a>
                                                    <div class="small text-muted mt-1">#<?= $r['SoHoaDon'] ?></div>
                                                <?php else: ?>
                                                    <span class="text-muted small fst-italic">Không có ảnh</span>
                                                    <?php if ($r['SoHoaDon']): ?>
                                                        <div class="small text-muted">#<?= $r['SoHoaDon'] ?></div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Ghi chú -->
                                            <td class="small text-muted fst-italic">
                                                <?= nl2br(htmlspecialchars($r['MoTa'])) ?>
                                            </td>

                                            <!-- Hành động -->
                                            <td class="text-center">
                                                <div class="d-flex gap-2 justify-content-center">

                                                    <!-- Nút sửa -->
                                                    <a class="btn btn-warning btn-sm"
                                                        href="index.php?act=hdv_edit_tc&id=<?= $r['MaTaiChinh'] ?>&lich=<?= $maLich ?>">
                                                        <i class="fas fa-pen"></i>
                                                    </a>

                                                    <button class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#historyModal<?= $r['MaTaiChinh'] ?>">
                                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                                    </button>

                                                    <!-- Nút xóa -->
                                                    <a href="index.php?act=hdv_delete_transaction&id_tc=<?= $r['MaTaiChinh'] ?>&id_lich=<?= $maLich ?>"
                                                        onclick="return confirm('Xóa giao dịch này?')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $history = !empty($r['LichSuChinhSua']) ? json_decode($r['LichSuChinhSua'], true) : [];
                                        ?>

                                        <div class="modal fade" id="historyModal<?= $r['MaTaiChinh'] ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Lịch sử chỉnh sửa (#<?= $r['MaTaiChinh'] ?>)</h5>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php if (!$history): ?>
                                                            <p class="text-muted fst-italic">Chưa có lịch sử chỉnh sửa.</p>
                                                        <?php else: ?>
                                                            <?php foreach ($history as $log): ?>
                                                                <div class="border rounded p-3 mb-3 bg-light">
                                                                    <p><strong>Người sửa:</strong> <?= $log['user'] ?></p>
                                                                    <p><strong>Thời gian:</strong> <?= $log['time'] ?></p>

                                                                    <ul>
                                                                        <?php foreach ($log['changes'] as $c): ?>
                                                                            <li>
                                                                                <strong><?= $c['field'] ?>:</strong>
                                                                                <span class="text-danger"><?= htmlspecialchars($c['old']) ?></span>
                                                                                →
                                                                                <span class="text-success"><?= htmlspecialchars($c['new']) ?></span>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="fas fa-file-invoice fa-3x mb-3 opacity-25"></i>
                                            <p>Chưa có giao dịch tài chính nào cho đoàn này.</p>
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="tab-pane fade" id="supplier">
                <div class="card card-finance p-4">
                    <h5 class="fw-bold text-primary mb-4"><i class="fas fa-handshake me-2"></i> Đối tác phục vụ đoàn này</h5>

                    <?php if (empty($listNhaCungCap)): ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-circle fa-2x mb-2"></i><br>
                            Chưa có dịch vụ/nhà cung cấp nào được đặt cho đoàn này.
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($listNhaCungCap as $ncc): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card-supplier p-3 h-100 shadow-sm">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div style="max-width: 85%;">
                                                <h6 class="fw-bold mb-1 text-dark text-truncate" title="<?= $ncc['TenNhaCungCap'] ?>">
                                                    <?= $ncc['TenNhaCungCap'] ?>
                                                </h6>
                                                <span class="badge bg-info text-dark mb-1">
                                                    <?= ucfirst(str_replace('_', ' ', $ncc['DichVuCungCapThucTe'])) ?>
                                                </span>
                                            </div>
                                            <div class="bg-light rounded-circle p-2 text-center" style="width: 40px; height: 40px;">
                                                <?php
                                                // Icon theo loại
                                                $icon = 'fa-store';
                                                if (strpos($ncc['LoaiNhaCungCap'], 'xe') !== false) $icon = 'fa-bus';
                                                elseif (strpos($ncc['LoaiNhaCungCap'], 'khach_san') !== false) $icon = 'fa-bed';
                                                elseif (strpos($ncc['LoaiNhaCungCap'], 'nha_hang') !== false) $icon = 'fa-utensils';
                                                ?>
                                                <i class="fas <?= $icon ?> text-muted"></i>
                                            </div>
                                        </div>

                                        <div class="small text-muted mb-3">
                                            <p class="mb-1 text-truncate"><i class="fas fa-map-marker-alt me-2 text-danger"></i> <?= $ncc['DiaChi'] ?? '---' ?></p>
                                            <p class="mb-1"><i class="fas fa-user me-2 text-secondary"></i> LH: <?= $ncc['NguoiLienHe'] ?? 'Lễ tân' ?></p>

                                            <?php if (!empty($ncc['GhiChuDichVu'])): ?>
                                                <p class="mb-0 text-warning fst-italic"><i class="fas fa-note-sticky me-2"></i> Note: <?= $ncc['GhiChuDichVu'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <?php if (!empty($ncc['SoDienThoai'])): ?>
                                                <a href="tel:<?= $ncc['SoDienThoai'] ?>" class="btn btn-call btn-sm">
                                                    <i class="fas fa-phone-alt me-1"></i> Gọi: <?= $ncc['SoDienThoai'] ?>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (!empty($ncc['SDTLaiXe'])): ?>
                                                <a href="tel:<?= $ncc['SDTLaiXe'] ?>" class="btn btn-outline-success btn-sm fw-bold">
                                                    <i class="fas fa-steering-wheel me-1"></i> Gọi Tài xế: <?= $ncc['SDTLaiXe'] ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalAddChi" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Thêm Khoản Chi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?act=hdv_add_transaction" method="POST">
                        <input type="hidden" name="MaLichLamViec" value="<?= $maLich ?>">
                        <input type="hidden" name="MaDoan" value="<?= $maDoan ?>">
                        <input type="hidden" name="LoaiGiaoDich" value="chi">

                        <div class="mb-3"><label>Hạng mục</label><input type="text" name="HangMucChi" class="form-control" placeholder="VD: Ăn trưa, Vé tham quan..." required></div>
                        <div class="mb-3"><label>Số tiền</label><input type="number" name="SoTien" class="form-control" required></div>
                        <div class="mb-3"><label>Ngày GD</label><input type="date" name="NgayGiaoDich" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
                        <div class="mb-3"><label>PTTT</label><select name="PhuongThuc" class="form-select">
                                <option value="TienMat">Tiền mặt</option>
                                <option value="ChuyenKhoan">Chuyển khoản</option>
                            </select></div>
                        <div class="mb-3"><label>Số Hóa Đơn (nếu có)</label><input type="text" name="SoHoaDon" class="form-control"></div>
                        <div class="mb-3"><label>Ghi chú</label><textarea name="MoTa" class="form-control"></textarea></div>
                        <button type="submit" class="btn btn-danger w-100">Lưu Khoản Chi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddThu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Thêm Khoản Thu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?act=hdv_add_transaction" method="POST">
                        <input type="hidden" name="MaLichLamViec" value="<?= $maLich ?>">
                        <input type="hidden" name="MaDoan" value="<?= $maDoan ?>">
                        <input type="hidden" name="LoaiGiaoDich" value="thu">

                        <div class="mb-3">
                            <label class="fw-bold">Hạng mục thu</label>
                            <input type="text" name="HangMucChi" class="form-control" placeholder="VD: Thu tiền tip, Thu hộ vé..." required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Số tiền</label>
                            <input type="number" name="SoTien" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Ngày GD</label>
                            <input type="date" name="NgayGiaoDich" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">PTTT</label>
                            <select name="PhuongThuc" class="form-select">
                                <option value="TienMat">Tiền mặt</option>
                                <option value="ChuyenKhoan">Chuyển khoản</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Ghi chú</label>
                            <textarea name="MoTa" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Lưu Khoản Thu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Viết Nhật Ký Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #0a7b80; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        .form-card { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4><i class="fa-solid fa-route"></i> HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-calendar-days"></i> Lịch trình & Lịch làm việc</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-users"></i> Danh sách khách</a>
        <a href="index.php?act=listTourOfHDV"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-compass"></i> Vận hành tour</a>
        <a href="index.php?act=hdv_schedule"><i class="fa-solid fa-user-check"></i> Quản lý khách</a>
        <hr style="color: #aad;">
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> <?= $_SESSION['error'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <?php $old = $_SESSION['old_data'] ?? []; ?>

                    <h3 class="mb-4 text-primary fw-bold"><i class="fa-solid fa-pen-nib"></i> Viết Nhật Ký Mới</h3>
                    
                    <div class="form-card">
                        <h5 class="border-bottom pb-2 mb-4">Tour: <span class="text-danger"><?= $thongTinDoan['TenTour'] ?></span></h5>

                        <form action="index.php?act=postAddNhatKy" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="MaDoan" value="<?= $maDoan ?>">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ngày ghi nhận</label>
                                    <input type="date" class="form-control" name="NgayGhi" 
                                           value="<?= $old['NgayGhi'] ?? date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Giờ ghi nhận</label>
                                    <input type="time" class="form-control" name="GioGhi" 
                                           value="<?= $old['GioGhi'] ?? date('H:i') ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tình trạng / Sự cố</label>
                                <select class="form-select" name="LoaiSuCo">
                                    <?php $loai = $old['LoaiSuCo'] ?? 'Bình thường'; ?>
                                    <option value="Bình thường" <?= $loai == 'Bình thường' ? 'selected' : '' ?>>✅ Hoạt động bình thường</option>
                                    <option value="Sự cố xe" <?= $loai == 'Sự cố xe' ? 'selected' : '' ?>>🚌 Sự cố xe cộ</option>
                                    <option value="Sự cố khách sạn" <?= $loai == 'Sự cố khách sạn' ? 'selected' : '' ?>>🏨 Sự cố khách sạn</option>
                                    <option value="Sự cố ăn uống" <?= $loai == 'Sự cố ăn uống' ? 'selected' : '' ?>>🍽️ Sự cố ăn uống</option>
                                    <option value="Sức khỏe khách" <?= $loai == 'Sức khỏe khách' ? 'selected' : '' ?>>🚑 Sức khỏe khách hàng</option>
                                    <option value="Khác" <?= $loai == 'Khác' ? 'selected' : '' ?>>⚠️ Khác</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nội dung chi tiết (*)</label>
                                <textarea class="form-control" name="NoiDung" rows="5" 
                                    placeholder="- Đã đón khách tại điểm hẹn chưa?&#10;- Tình hình sức khỏe đoàn?&#10;- Các dịch vụ (ăn, ngủ, xe) có ổn không?&#10;- Khách có phản hồi gì đặc biệt không?" 
                                    required><?= $old['NoiDung'] ?? '' ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Hình ảnh đính kèm (Nếu có)</label>
                                <input type="file" class="form-control" name="LinkAnh" accept="image/*">
                                <div class="form-text text-muted"><i class="fa-solid fa-camera"></i> Chụp ảnh hóa đơn, vé tham quan hoặc hiện trường sự cố (nếu có).</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php?act=listNhatKy&maDoan=<?= $maDoan ?>" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="fa-solid fa-save"></i> Lưu Nhật Ký
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(isset($_SESSION['old_data'])) unset($_SESSION['old_data']); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Nhật Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: #f5f8fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 260px; height: 100vh; background: #085f63; position: fixed; top: 0; left: 0; padding-top: 30px; color: white; }
        .sidebar a { color: #d9f7f5; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #0a7b80; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        .form-card { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px; }
        .img-preview { max-width: 150px; border-radius: 8px; margin-top: 10px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4">HDV Panel</h4>
        <a href="index.php?act=hdv_dashboard"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <a href="index.php?act=listTourOfHDV" style="background: #0a7b80;"><i class="fa-solid fa-book"></i> Nhật ký tour</a>
        <a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="mb-4 text-warning fw-bold"><i class="fa-solid fa-edit"></i> Chỉnh Sửa Nhật Ký</h3>
                    
                    <div class="form-card">
                        <form action="index.php?act=postEditNhatKy" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="MaNhatKy" value="<?= $nk['MaNhatKy'] ?>">
                            <input type="hidden" name="MaDoan" value="<?= $nk['MaDoan'] ?>">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ngày ghi nhận</label>
                                    <input type="date" class="form-control" name="NgayGhi" value="<?= $nk['NgayGhi'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Giờ ghi nhận</label>
                                    <input type="time" class="form-control" name="GioGhi" value="<?= date('H:i', strtotime($nk['GioGhi'])) ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tình trạng / Sự cố</label>
                                <select class="form-select" name="LoaiSuCo">
                                    <option value="Bình thường" <?= $nk['LoaiSuCo'] == 'Bình thường' ? 'selected' : '' ?>>✅ Hoạt động bình thường</option>
                                    <option value="Sự cố xe" <?= $nk['LoaiSuCo'] == 'Sự cố xe' ? 'selected' : '' ?>>🚌 Sự cố xe cộ</option>
                                    <option value="Sự cố khách sạn" <?= $nk['LoaiSuCo'] == 'Sự cố khách sạn' ? 'selected' : '' ?>>🏨 Sự cố khách sạn</option>
                                    <option value="Sự cố ăn uống" <?= $nk['LoaiSuCo'] == 'Sự cố ăn uống' ? 'selected' : '' ?>>🍽️ Sự cố ăn uống</option>
                                    <option value="Sức khỏe khách" <?= $nk['LoaiSuCo'] == 'Sức khỏe khách' ? 'selected' : '' ?>>🚑 Sức khỏe khách hàng</option>
                                    <option value="Khác" <?= $nk['LoaiSuCo'] == 'Khác' ? 'selected' : '' ?>>⚠️ Khác</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nội dung chi tiết</label>
                                <textarea class="form-control" name="NoiDung" rows="5" required><?= $nk['NoiDung'] ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Hình ảnh (Chọn để thay đổi)</label>
                                <input type="file" class="form-control" name="LinkAnh" accept="image/*">
                                
                                <?php if (!empty($nk['LinkAnh'])): ?>
                                    <div class="mt-2">
                                        <p class="text-muted small mb-1">Ảnh hiện tại:</p>
                                        <img src="./uploads/nhatky/<?= $nk['LinkAnh'] ?>" class="img-preview" alt="Ảnh cũ">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php?act=listNhatKy&maDoan=<?= $nk['MaDoan'] ?>" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Hủy
                                </a>
                                <button type="submit" class="btn btn-warning px-5 text-dark fw-bold">
                                    <i class="fa-solid fa-check"></i> Cập Nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
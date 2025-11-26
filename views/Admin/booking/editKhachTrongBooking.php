<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Booking Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Card */
        .card {
            border-radius: 12px;
            border: none;
        }

        .card-body {
            padding: 25px 30px;
        }

        /* Nhóm form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        /* Hiệu ứng focus */
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
        }

        /* Hàng ngang */
        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Textarea */
        .form-group textarea {
            min-height: 90px;
            resize: vertical;
        }

        /* Nút submit */
        .btn-submit {
            width: 100%;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 12px 0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-submit:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <a href="index.php?controller=booking&action=index" class="btn btn-light me-3">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h3 class="mb-0">Update Khách Trong Booking</h3>
                                <p class="text-muted mb-0">Nhập thông tin cần Update</p>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">

                <div class="card shadow-sm">
                    <div class="card-body">

                        <h4 class="mb-3">Sửa thông tin khách</h4>

                        <form action="index.php?act=updateKhachTrongBooking" method="POST">

                            <input type="hidden" name="MaKhachTrongBooking"
                                value="<?= $khach['MaKhachTrongBooking'] ?>">
                            <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">

                            <div class="form-group">
                                <label>Họ tên *</label>
                                <input type="text" name="HoTen" required value="<?= $khach['HoTen'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="GioiTinh">
                                    <option value="nam" <?= $khach['GioiTinh'] == 'nam' ? 'selected' : '' ?>>Nam
                                    </option>
                                    <option value="nu" <?= $khach['GioiTinh'] == 'nu' ? 'selected' : '' ?>>Nữ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" name="NgaySinh" value="<?= $khach['NgaySinh'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Số giấy tờ</label>
                                <input type="text" name="SoGiayTo" value="<?= $khach['SoGiayTo'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="SoDienThoai" value="<?= $khach['SoDienThoai'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Ghi chú đặc biệt</label>
                                <textarea name="GhiChuDacBiet"><?= $khach['GhiChuDacBiet'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Loại phòng</label>
                                <select name="LoaiPhong">
                                    <option value="don" <?= $khach['LoaiPhong'] == 'don' ? 'selected' : '' ?>>Phòng đơn
                                    </option>
                                    <option value="doi" <?= $khach['LoaiPhong'] == 'doi' ? 'selected' : '' ?>>Phòng đôi
                                    </option>
                                    <option value="2_giuong" <?= $khach['LoaiPhong'] == '2_giuong' ? 'selected' : '' ?>>
                                        2
                                        giường</option>
                                </select>
                            </div>

                            <button class="btn-submit">Cập nhật</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
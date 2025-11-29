<?php
// session_start();
?>

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
                                <h3 class="mb-0">Thêm Khách Trong Booking</h3>
                                <p class="text-muted mb-0">Nhập đầy đủ thông tin khách hàng trong Tour </p>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="index.php?act=createKhachTrongBookingProcess" method="POST">
                            <input type="hidden" name="MaBooking" value="<?= $booking['MaBooking'] ?>">

                            <div class="form-group">
                                <label>Họ tên *</label>
                                <input type="text" name="HoTen" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select name="GioiTinh">
                                        <option value="">-- Chọn --</option>
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                        <option value="khac">Khác</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" name="NgaySinh">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Số giấy tờ (CMND/CCCD/Hộ chiếu)</label>
                                    <input type="text" name="SoGiayTo" required>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="SoDienThoai" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Yêu cầu / Ghi chú đặc biệt</label>
                                <textarea name="GhiChuDacBiet"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Loại phòng</label>
                                <select name="LoaiPhong">
                                    <option value="">-- Chọn --</option>
                                    <option value="don">Phòng đơn</option>
                                    <option value="doi">Phòng đôi</option>
                                    <option value="2_giuong">2 giường</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-submit">Thêm khách</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
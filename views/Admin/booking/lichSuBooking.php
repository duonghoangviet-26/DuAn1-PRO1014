<?php
function isJson($string)
{
    if (!is_string($string)) return false;
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Căn giữa, spacing đẹp */
        table.table {
            font-size: 14px;
            vertical-align: middle;
        }

        /* Cột giá tiền */
        td.price {
            font-weight: 600;
            color: #0d6efd;
            /* xanh bootstrap */
        }

        /* Badge trạng thái */
        .badge-cho {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-coc {
            background: #cfe2ff;
            color: #084298;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-done {
            background: #d1e7dd;
            color: #0f5132;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cancel {
            background: #f8d7da;
            color: #842029;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Nút thao tác */
        .btn-khach,
        .btn-edit,
        .btn-delete {
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-khach {
            background: #e0f3ff;
            color: #0d6efd;
        }

        .btn-khach:hover {
            background: #b6e0ff;
        }

        .btn-edit {
            background: #fde2ba;
            color: #b35c00;
        }

        .btn-edit:hover {
            background: #fcd49b;
        }

        .btn-delete {
            background: #f8d7da;
            color: #842029;
        }

        .btn-delete:hover {
            background: #f3c2c6;
        }

        table.table-sm th {
            background: #fafafa;
            font-weight: 600;
        }

        table.table-sm td,
        table.table-sm th {
            font-size: 13px;
            vertical-align: middle;
            white-space: normal;
            word-break: break-all;
        }

        /* Căn giữa các nút */
        td.actions {
            white-space: nowrap;
            display: flex;
            gap: 6px;
        }

        .json-box {
            white-space: pre-wrap;
            font-size: 13px;
            line-height: 1.25rem;
        }
    </style>

</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Lịch sử trạng thái - Booking #<?= htmlspecialchars($booking['MaBooking']) ?></h4>
            <a href="index.php?act=listBooking" class="btn btn-secondary btn-sm">
                ← Quay lại danh sách
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <p><b>Tour:</b> <?= htmlspecialchars($booking['TenTour'] ?? '') ?></p>
                <p><b>Khách hàng:</b> <?= htmlspecialchars($booking['TenKhachHang'] ?? '') ?></p>
                <p><b>Trạng thái hiện tại:</b>
                    <span class="badge bg-warning text-dark"><?= htmlspecialchars($booking['TrangThai']) ?></span>
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><b>Lịch sử thay đổi</b></div>

            <div class="card-body">

                <?php if (empty($histories)): ?>
                    <p class="text-muted">Chưa có thay đổi nào.</p>

                <?php else: ?>
                    <ul class="list-group">
                        <?php foreach ($histories as $row): ?>
                            <?php
                            $cu  = !empty($row['TrangThaiCu']) ? json_decode($row['TrangThaiCu'], true) : [];
                            $moi = !empty($row['TrangThaiMoi']) ? json_decode($row['TrangThaiMoi'], true) : [];

                            ?>
                            <li class="list-group-item mb-4 p-4 shadow-sm" style="border-radius: 10px;">

                                <!-- Header -->
                                <div class="mb-3">
                                    <div><b>Thay đổi lúc:</b> <?= date('d/m/Y H:i', strtotime($row['NgayDoi'])) ?></div>
                                    <div><b>Người đổi:</b> <?= htmlspecialchars($row['HoTen'] ?? 'Hệ thống') ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-sm table-bordered align-middle">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width:30%;">Trường thay đổi</th>
                                                    <th style="width:35%;" class="text-danger">Giá trị cũ</th>
                                                    <th style="width:35%;" class="text-success">Giá trị mới</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $allKeys = array_unique(array_merge(array_keys($cu ?? []), array_keys($moi ?? [])));
                                                $hasChange = false;

                                                foreach ($allKeys as $key):
                                                    $oldVal = $cu[$key] ?? '';
                                                    $newVal = $moi[$key] ?? '';

                                                    // Bỏ qua nếu giống nhau
                                                    if ($oldVal === $newVal) continue;

                                                    // Đánh dấu có thay đổi
                                                    $hasChange = true;
                                                ?>
                                                    <tr>
                                                        <th><?= htmlspecialchars($key) ?></th>
                                                        <td><?= htmlspecialchars($oldVal) ?></td>
                                                        <td><?= htmlspecialchars($newVal) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php if (!$hasChange): ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted fst-italic">Không có thay đổi
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>




                            </li>

                        <?php endforeach; ?>

                    </ul>
                <?php endif; ?>

            </div>
        </div>


    </div>
</body>

</html>
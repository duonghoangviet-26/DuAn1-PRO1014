<?php
class doanKhoiHanhModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả đoàn + tài xế
    public function getAllDoan()
    {
        $sql = "
        SELECT 
            d.*,
            t.TenTour,
            nv.HoTen AS TenHDV,
            ncc.TenLaiXe AS TenTaiXe,

            COALESCE(b.total_people, 0) AS DaDat,
            (d.SoChoToiDa - COALESCE(b.total_people, 0)) AS ConTrong

        FROM doankhoihanh d
        JOIN tour t ON d.MaTour = t.MaTour
        LEFT JOIN nhanvien nv ON d.MaHuongDanVien = nv.MaNhanVien

        -- tài xế
        LEFT JOIN dichvucuadoan dv 
            ON dv.MaDoan = d.MaDoan AND dv.LoaiDichVu = 'van_chuyen'
        LEFT JOIN nhacungcap ncc 
            ON ncc.MaNhaCungCap = dv.MaNhaCungCap

        -- tổng khách đã đặt
        LEFT JOIN (
            SELECT 
                MaDoan,
                SUM(TongNguoiLon + TongTreEm + TongEmBe) AS total_people
            FROM booking
            GROUP BY MaDoan
        ) AS b ON b.MaDoan = d.MaDoan

        ORDER BY d.MaDoan DESC
    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 đoàn + tài xế
    public function getOneDoan($id)
    {
        $sql = "
        SELECT 
            dk.*,
            dv.MaNhaCungCap AS MaTaiXe
        FROM doankhoihanh dk
        LEFT JOIN (
            SELECT MaDoan, MIN(MaNhaCungCap) AS MaNhaCungCap
            FROM dichvucuadoan
            WHERE LoaiDichVu = 'van_chuyen'
            GROUP BY MaDoan
        ) dv ON dk.MaDoan = dv.MaDoan
        WHERE dk.MaDoan = ?
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Trạng thái đoàn khởi hành
    public function autoUpdateTrangThai()
    {
        $today = date("Y-m-d");

        // Đã kết thúc
        $this->conn->prepare("
        UPDATE doankhoihanh 
        SET TrangThai = 'hoan_thanh'
        WHERE NgayVe < ?
    ")->execute([$today]);

        // Đang diễn ra
        $this->conn->prepare("
        UPDATE doankhoihanh
        SET TrangThai = 'het_cho'
        WHERE NgayKhoiHanh <= ? AND NgayVe >= ?
    ")->execute([$today, $today]);

        // Sẵn sàng
        $this->conn->prepare("
        UPDATE doankhoihanh
        SET TrangThai = 'con_cho'
        WHERE NgayKhoiHanh > ? AND TrangThai != 'da_huy'
    ")->execute([$today]);
    }


    // Lấy tour
    public function getAllTour()
    {
        $stmt = $this->conn->prepare("
        SELECT * FROM tour
        WHERE TrangThai = 'hoat_dong'
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllHDV()
    {
        $stmt = $this->conn->prepare("
            SELECT MaNhanVien, HoTen 
            FROM nhanvien 
            WHERE VaiTro='huong_dan_vien' AND TrangThai='dang_lam'
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNhaXe()
    {
        $stmt = $this->conn->prepare("
            SELECT MaNhaCungCap, TenNhaCungCap, TenLaiXe, SDTLaiXe 
            FROM nhacungcap
            WHERE LoaiNhaCungCap = 'van_chuyen'
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update đoàn
    public function updateDKH($data)
    {
        // tính số chỗ còn trống
        $soBooking = $this->countBookingOfDoan($data['MaDoan']);
        $soConTrong = $data['SoChoToiDa'] - $soBooking;
        if ($soConTrong < 0) $soConTrong = 0;

        $sql = "UPDATE doankhoihanh SET 
                MaTour = ?,
                NgayKhoiHanh = ?,
                NgayVe = ?,
                GioKhoiHanh = ?,
                DiemTapTrung = ?,
                SoChoToiDa = ?,
                SoChoConTrong = ?, 
                MaHuongDanVien = ?,
                 MaTaiXe = ?
            WHERE MaDoan = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $data['MaTour'],
            $data['NgayKhoiHanh'],
            $data['NgayVe'],
            $data['GioKhoiHanh'],
            $data['DiemTapTrung'],
            $data['SoChoToiDa'],
            $soConTrong,
            !empty($data['MaHuongDanVien']) ? $data['MaHuongDanVien'] : null,
            !empty($data['MaTaiXe']) ? $data['MaTaiXe'] : null,
            $data['MaDoan']
        ]);

        if (!empty($data['MaTaiXe'])) {
            $this->insertTaiXeChoDoan($data['MaDoan'], $data['MaTaiXe'], $data['NgayKhoiHanh']);
        }

        return true;
    }

    public function deleteDoan($id)
    {
        // Xoá lịch làm việc trước
        $this->conn->prepare("DELETE FROM lichlamviec WHERE MaDoan=?")
            ->execute([$id]);

        // Xoá booking thuộc đoàn
        $this->conn->prepare("DELETE FROM booking WHERE MaDoan=?")
            ->execute([$id]);

        // Xoá dịch vụ của đoàn
        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=?")
            ->execute([$id]);

        // Xoá đoàn
        return $this->conn->prepare("DELETE FROM doankhoihanh WHERE MaDoan=?")
            ->execute([$id]);
    }
    // Thêm đoàn
    public function insertDoan($data)
    {
        $data['MaHuongDanVien'] = !empty($data['MaHuongDanVien']) ? $data['MaHuongDanVien'] : null;
        $data['MaTaiXe'] = !empty($data['MaTaiXe']) ? $data['MaTaiXe'] : null;
        $sql = "INSERT INTO doankhoihanh
            (MaTour, NgayKhoiHanh, NgayVe, GioKhoiHanh, DiemTapTrung,
             SoChoToiDa, SoChoConTrong, MaHuongDanVien, MaTaiXe, TrangThai)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['MaTour'],
            $data['NgayKhoiHanh'],
            $data['NgayVe'],
            $data['GioKhoiHanh'],
            $data['DiemTapTrung'],
            $data['SoChoToiDa'],
            $data['SoChoConTrong'],
            $data['MaHuongDanVien'],
            $data['MaTaiXe'],
            $data['TrangThai'] ?? 'san_sang',
        ]);

        return $this->conn->lastInsertId();
    }
    public function insertDichVuDoan($MaDoan, $MaNCC, $Loai, $NgayThu)
    {
        $sql = "INSERT INTO dichvucuadoan 
            (MaDoan, MaNhaCungCap, LoaiDichVu, TenDichVu, NgaySuDung) 
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $MaDoan,
            $MaNCC,
            $Loai,
            ucfirst(str_replace('_', ' ', $Loai)), // tên dịch vụ
            $NgayThu
        ]);
    }

    // Kiểm tra số chỗ còn chống trong đoàn 
    public function updateSoChoConTrong($MaDoan)
    {
        // đếm tổng SỐ NGƯỜI đã đặt
        $sql = "SELECT SUM(TongNguoiLon + TongTreEm + TongEmBe) 
            FROM booking 
            WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        $soNguoi = (int)$stmt->fetchColumn();

        // lấy số chỗ tối đa
        $sql = "SELECT SoChoToiDa FROM doankhoihanh WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        $soChoToiDa = (int)$stmt->fetchColumn();

        // tính còn trống
        $soChoConTrong = $soChoToiDa - $soNguoi;
        if ($soChoConTrong < 0) $soChoConTrong = 0;

        // cập nhật DB
        $sql = "UPDATE doankhoihanh SET SoChoConTrong = ? WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$soChoConTrong, $MaDoan]);
    }

    // Gán tài xế
    public function insertTaiXeChoDoan($MaDoan, $MaTaiXe, $NgaySuDung)
    {
        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=? AND LoaiDichVu='van_chuyen'")
            ->execute([$MaDoan]);

        $sql = "INSERT INTO dichvucuadoan 
            (MaDoan, MaNhaCungCap, LoaiDichVu, TenDichVu, NgaySuDung)
            VALUES (?, ?, 'van_chuyen', 'Tài xế', ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$MaDoan, $MaTaiXe, $NgaySuDung]);
    }

    public function getTaiXeById($MaTaiXe)
    {
        $sql = "SELECT * FROM nhacungcap WHERE MaNhaCungCap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaTaiXe]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Đếm số booking của đoàn
    public function countBookingOfDoan($MaDoan)
    {
        $sql = "SELECT COUNT(*) FROM booking WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchColumn();
    }


    public function getTotalBookingByDoan($MaDoan)
    {
        $sql = "SELECT 
                SUM(TongNguoiLon + TongTreEm + TongEmBe) AS total_people
            FROM booking
            WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);

        $total = $stmt->fetchColumn();
        return $total ? $total : 0;
    }

    public function getLichTrinhByTour($MaTour)
    {
        $sql = "SELECT * FROM lichtrinh WHERE MaTour = ? ORDER BY NgayThu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaTour]);
        return $stmt->fetchAll();
    }

    public function getNhaCungCapByType($type)
    {
        $sql = "SELECT * FROM nhacungcap WHERE LoaiNhaCungCap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }
    public function getDoanById($MaDoan)
    {
        $sql = "SELECT * FROM doankhoihanh WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetch();
    }
    public function getTourById($MaTour)
    {
        $sql = "SELECT * FROM tour WHERE MaTour = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaTour]);
        return $stmt->fetch();
    }
    public function getHDVById($MaHDV)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaHDV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getTaiXeByDoan($MaDoan)
    {
        $sql = "SELECT ncc.*
            FROM dichvucuadoan dv
            JOIN nhacungcap ncc ON dv.MaNhaCungCap = ncc.MaNhaCungCap
            WHERE dv.MaDoan = ? AND dv.LoaiDichVu = 'van_chuyen'
            LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function getNCCTheoLichTrinh($MaDoan)
    {
        // Lấy NCC từ bảng doankhoihanh (vì chỉ có tài xế ở đây)
        $sql = "SELECT 
                d.MaDoan,
                d.MaTaiXe AS MaNCC,
                ncc.TenNhaCungCap,
                ncc.LoaiNhaCungCap
            FROM doankhoihanh d
JOIN nhacungcap ncc ON d.MaTaiXe = ncc.MaNhaCungCap
            WHERE d.MaDoan = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchAll();
    }

    // get đoàn by tour
    public function getDoanByTour($maTour)
    {
        $sql = "SELECT 
                d.MaDoan, 
                d.MaTour, 
                d.NgayKhoiHanh, 
                d.SoChoConTrong,
                t.TenTour
            FROM doankhoihanh d
            JOIN tour t ON t.MaTour = d.MaTour
            WHERE d.MaTour = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maTour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDichVuByDoan($MaDoan)
    {
        $sql = "
            SELECT dv.*, ncc.TenNhaCungCap
            FROM dichvucuadoan dv
            JOIN nhacungcap ncc ON dv.MaNhaCungCap = ncc.MaNhaCungCap
            WHERE dv.MaDoan = ?
            ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNCCTheoNgay($MaDoan)
    {
        $sql = "SELECT 
                dv.NgaySuDung,
                TIMESTAMPDIFF(DAY, dk.NgayKhoiHanh, dv.NgaySuDung) + 1 AS NgayThu,
                dv.LoaiDichVu,
                dv.MaNhaCungCap,
                ncc.TenNhaCungCap
            FROM dichvucuadoan dv
            JOIN doankhoihanh dk ON dk.MaDoan = dv.MaDoan
            JOIN nhacungcap ncc ON dv.MaNhaCungCap = ncc.MaNhaCungCap
            WHERE dv.MaDoan = ?
            ORDER BY dv.NgaySuDung ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTongThu($MaDoan)
    {
        $sql = "SELECT SUM(SoTien) AS TongThu 
            FROM taichinhtour 
            WHERE MaDoan = :MaDoan AND LoaiGiaoDich = 'thu'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['MaDoan' => $MaDoan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getTongChi($MaDoan)
    {
        $sql = "SELECT SUM(SoTien) AS TongChi 
            FROM taichinhtour 
            WHERE MaDoan = :MaDoan AND LoaiGiaoDich = 'chi'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['MaDoan' => $MaDoan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllTaiChinh($MaDoan)
    {
        $sql = "SELECT * FROM taichinhtour 
            WHERE MaDoan = :MaDoan 
            ORDER BY NgayGiaoDich DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['MaDoan' => $MaDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertTaiChinh($data)
    {
        $sql = "INSERT INTO taichinhtour 
            (MaDoan, LoaiGiaoDich, NgayGiaoDich, SoTien, HangMucChi,
             PhuongThucThanhToan, SoHoaDon, MoTa, AnhChungTu)
            VALUES 
            (:MaDoan, :LoaiGiaoDich, :NgayGiaoDich, :SoTien, :HangMucChi,
             :PhuongThucThanhToan, :SoHoaDon, :MoTa, :AnhChungTu)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
    public function getTaiChinhById($id)
    {
        $sql = "SELECT * FROM taichinhtour WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


   public function updateTaiChinhById($id, $data)
{
    $sql = "UPDATE taichinhtour SET
                LoaiGiaoDich = :LoaiGiaoDich,
                NgayGiaoDich = :NgayGiaoDich,
                SoTien       = :SoTien,
                HangMucChi   = :HangMucChi,
                PhuongThucThanhToan = :PhuongThucThanhToan,
                SoHoaDon     = :SoHoaDon,
                AnhChungTu   = :AnhChungTu,
                MoTa         = :MoTa,
                LichSuChinhSua = :LichSuChinhSua
            WHERE MaTaiChinh = :id";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        'LoaiGiaoDich' => $data['LoaiGiaoDich'],
        'NgayGiaoDich' => $data['NgayGiaoDich'],
        'SoTien'       => $data['SoTien'],
        'HangMucChi'   => $data['HangMucChi'],
        'PhuongThucThanhToan' => $data['PhuongThucThanhToan'],
        'SoHoaDon'     => $data['SoHoaDon'],
        'AnhChungTu'   => $data['AnhChungTu'],
        'MoTa'         => $data['MoTa'],
        'LichSuChinhSua' => $data['LichSuChinhSua'] ?? null,
        'id'           => $id
    ]);
}


    public function getTotalPeopleByDoan($MaDoan)
    {
        $sql = "SELECT 
                SUM(TongNguoiLon + TongTreEm + TongEmBe) AS total_people
            FROM booking
            WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchColumn() ?: 0;
    }

    public function deleteTaiChinh($id)
    {
        $sql = "DELETE FROM taichinhtour WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
//     public function addLog($MaDoan, $MaNguoi, $NoiDung, $MaTaiChinh)
// {
//   $sql = "INSERT INTO nhatkytour 
//         (MaDoan, MaNguoiTao, NgayGhi, GioGhi, NoiDung, LoaiSuCo)
//         VALUES (?, ?, CURDATE(), CURTIME(), ?, 'chinh_sua_tai_chinh')";

//     $stmt = $this->conn->prepare($sql);
//     return $stmt->execute([$MaDoan, $MaNguoi, $NoiDung]);

// }

}

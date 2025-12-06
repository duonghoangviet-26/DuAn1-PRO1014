<?php
class DiemDanhModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy toàn bộ lịch trình của Tour
    public function getLichTrinhByTour($maTour) {
        $sql = "SELECT * FROM lichtrinh WHERE MaTour = :maTour ORDER BY NgayThu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maTour' => $maTour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Lấy chi tiết 1 dòng lịch trình
    public function getLichTrinhById($maLichTrinh) {
        $sql = "SELECT * FROM lichtrinh WHERE MaLichTrinh = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $maLichTrinh]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. Lấy danh sách khách 
    public function getKhachByDoan($maDoan) {
        $sql = "SELECT ktb.MaKhachTrongBooking, ktb.HoTen, ktb.GioiTinh, ktb.NgaySinh, 
                       ktb.SoDienThoai, ktb.SoGiayTo, ktb.GhiChuDacBiet, ktb.LoaiPhong,
                       b.MaBooking
                FROM khachtrongbooking ktb
                JOIN booking b ON ktb.MaBooking = b.MaBooking
                WHERE b.MaDoan = :maDoan 
                AND b.TrangThai != 'huy' 
                AND b.TrangThai != 'cho_xac_nhan'"; 
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrangThaiDiemDanh($maLichTrinh, $buoi) {
        $sql = "SELECT * FROM diemdanh WHERE MaLichTrinh = :mlt AND Buoi = :buoi";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':mlt' => $maLichTrinh, ':buoi' => $buoi]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveDiemDanh($maLichTrinh, $maKhach, $trangThai, $ghiChu, $buoi) {
        $sqlCheck = "SELECT MaDiemDanh FROM diemdanh 
                     WHERE MaLichTrinh = :mlt AND MaKhachTrongBooking = :mktb AND Buoi = :buoi";
        $stmt = $this->conn->prepare($sqlCheck);
        $stmt->execute([':mlt' => $maLichTrinh, ':mktb' => $maKhach, ':buoi' => $buoi]);
        $exist = $stmt->fetch();

        if ($exist) {
            $sql = "UPDATE diemdanh SET TrangThai = :tt, GhiChu = :gc, ThoiGianCheckIn = NOW() WHERE MaDiemDanh = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tt' => $trangThai, ':gc' => $ghiChu, ':id' => $exist['MaDiemDanh']]);
        } else {
            $sql = "INSERT INTO diemdanh (MaLichTrinh, MaKhachTrongBooking, Buoi, TrangThai, GhiChu) 
                    VALUES (:mlt, :mktb, :buoi, :tt, :gc)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':mlt' => $maLichTrinh, ':mktb' => $maKhach, ':buoi' => $buoi, ':tt' => $trangThai, ':gc' => $ghiChu]);
        }
    }
}
?>
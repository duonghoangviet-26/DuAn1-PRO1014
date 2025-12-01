<?php
class lichLamViecModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getLichByNhanVien($MaNhanVien)
    {
        $sql = "SELECT llv.*, dkh.NgayKhoiHanh, t.TenTour 
                FROM lichlamviec llv
                LEFT JOIN doankhoihanh dkh ON llv.MaDoan = dkh.MaDoan
                LEFT JOIN tour t ON dkh.MaTour = t.MaTour 
                WHERE llv.MaNhanVien = :maNV
                ORDER BY llv.NgayLamViec DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maNV' => $MaNhanVien]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhanVienById($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllHuongDanVien()
    {
        $sql = "SELECT * FROM nhanvien WHERE VaiTro != 'admin'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDoanKhoiHanh()
    {
        $sql = "SELECT * FROM doankhoihanh ORDER BY NgayKhoiHanh DESC"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoanById($maDoan)
    {
        $sql = "SELECT * FROM doankhoihanh WHERE MaDoan = :maDoan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDoanByNhanVien($maNhanVien)
    {
        
        $sql = "SELECT * FROM doankhoihanh 
                WHERE MaHuongDanVien = :maNV 
                ORDER BY NgayKhoiHanh DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maNV' => $maNhanVien]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertLich($maNV, $maDoan, $ngayLam, $ghiChu = '', $trangThai = 'ranh')
    {
        $sql = "INSERT INTO lichlamviec (MaNhanVien, MaDoan, NgayLamViec, TrangThai, GhiChu) 
                VALUES (:maNV, :maDoan, :ngayLam, :trangThai, :ghiChu)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':maNV' => $maNV,
            ':maDoan' => $maDoan,
            ':ngayLam' => $ngayLam,
            ':trangThai' => $trangThai,
            ':ghiChu' => $ghiChu
        ]);
    }

    public function getLichById($maLich)
    {
        $sql = "SELECT * FROM lichlamviec WHERE MaLichLamViec = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $maLich]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLich($maLich, $maNV, $maDoan, $ngayLam, $ghiChu, $trangThai)
    {
        $sql = "UPDATE lichlamviec 
                SET MaNhanVien = :maNV, MaDoan = :maDoan, NgayLamViec = :ngayLam, GhiChu = :ghiChu, TrangThai = :trangThai
                WHERE MaLichLamViec = :maLich";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':maNV' => $maNV,
            ':maDoan' => $maDoan,
            ':ngayLam' => $ngayLam,
            ':maLich' => $maLich,
            ':ghiChu' => $ghiChu,
            'trangThai' => $trangThai
        ]);
    }

    public function deleteLich($id)
    {
        $sql = "DELETE FROM lichlamviec WHERE MaLichLamViec = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getLichTrinhByTour($maTour) {
        $sql = "SELECT * FROM lichtrinh 
                WHERE MaTour = :maTour 
                ORDER BY NgayThu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maTour' => $maTour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetailLichLamViec($maLich) {
        $sql = "SELECT llv.*, dkh.MaTour, dkh.NgayKhoiHanh, dkh.NgayVe, t.TenTour
                FROM lichlamviec llv
                JOIN doankhoihanh dkh ON llv.MaDoan = dkh.MaDoan
                JOIN tour t ON dkh.MaTour = t.MaTour 
                WHERE llv.MaLichLamViec = :maLich";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maLich' => $maLich]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAnhDaiDienTour($maTour) {
        $sql = "SELECT DuongDanAnh 
                FROM anhtour 
                WHERE MaTour = :maTour 
                ORDER BY ThuTuHienThi ASC 
                LIMIT 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maTour' => $maTour]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
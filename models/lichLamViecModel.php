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
        $sql = "SELECT * FROM lichlamviec WHERE MaNhanVien = :id ORDER BY NgayLamViec DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $MaNhanVien]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertLich($MaNhanVien, $NgayLamViec, $TrangThai, $MaDoan, $GhiChu)
    {
        $sql = "INSERT INTO lichlamviec (MaNhanVien, NgayLamViec, TrangThai, MaDoan, GhiChu)
                VALUES (:MaNhanVien, :NgayLamViec, :TrangThai, :MaDoan, :GhiChu)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':MaNhanVien' => $MaNhanVien,
            ':NgayLamViec' => $NgayLamViec,
            ':TrangThai' => $TrangThai,
            ':MaDoan' => $MaDoan,
            ':GhiChu' => $GhiChu
        ]);
    }

    public function deleteLich($MaLichLamViec)
    {
        $sql = "DELETE FROM lichlamviec WHERE MaLichLamViec = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $MaLichLamViec]);
    }

    public function getNhanVienById($MaNhanVien)
    {
    $sql = "SELECT HoTen FROM nhanvien WHERE MaNhanVien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$MaNhanVien]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

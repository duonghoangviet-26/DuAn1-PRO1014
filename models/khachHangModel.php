<?php
class khachHangModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllKhachHang()
    {
        try {
            $sql = "SELECT * FROM khachhang ORDER BY MAKhachHang ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi :" . $e->getMessage());
            return [];
        }
    }

    public function deleteKH($id)
    {
        $sql = "DELETE FROM khachhang WHERE MaKhachHang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function creatKhachHang($data)
    {
        try {
            $sql = "INSERT INTO khachhang 
        (MaCodeKhachHang, HoTen, SoDienThoai, Email, DiaChi, NgaySinh, GioiTinh, SoGiayTo, 
         LoaiKhach, TenCongTy, MaSoThue, GhiChu)
        VALUES 
        (:MaCodeKhachHang, :HoTen, :SoDienThoai, :Email, :DiaChi, :NgaySinh, :GioiTinh, :SoGiayTo,
         :LoaiKhach, :TenCongTy, :MaSoThue, :GhiChu)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute($data);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi createKhachHang: " . $e->getMessage());
            return false;
        }
    }
    public function getKhachHangById($id)
    {
        $sql = "SELECT * FROM khachhang WHERE MaKhachHang = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
    // public  function getKhachHangById($id)
    // {
    //     $sql = "SELECT * FROM KhachHang WHERE MaCodeKhachHang = :id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    // Cập nhật khách hàng
    public function updateKhachHang($data)
    {
        $sql = "UPDATE khachhang SET
                HoTen = :HoTen,
                SoDienThoai = :SoDienThoai,
                Email = :Email,
                DiaChi = :DiaChi,
                NgaySinh = :NgaySinh,
                GioiTinh = :GioiTinh,
                SoGiayTo = :SoGiayTo,
                LoaiKhach = :LoaiKhach,
                TenCongTy = :TenCongTy,
                MaSoThue = :MaSoThue,
                GhiChu = :GhiChu
            WHERE MaKhachHang = :MaKhachHang";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}

<?php
class DanhSachTaiKhoanModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan()
    {
        $sql = "SELECT * FROM taikhoan ORDER BY MaTaiKhoan DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneTaiKhoan($id)
    {
        $sql = "SELECT * FROM taikhoan WHERE MaTaiKhoan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertTaiKhoan($tenDangNhap, $matKhau, $vaiTro, $trangThai)
    {
        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, VaiTro, TrangThai) VALUES (:TenDangNhap, :MatKhau, :VaiTro, :TrangThai)";
        $stmt = $this->conn->prepare($sql);
        $hashPass = password_hash($matKhau, PASSWORD_BCRYPT);
        $stmt->bindParam(':TenDangNhap', $tenDangNhap);
        $stmt->bindParam(':MatKhau', $hashPass);
        $stmt->bindParam(':VaiTro', $vaiTro);
        $stmt->bindParam(':TrangThai', $trangThai);
        $stmt->execute();
    }

    public function updateTaiKhoan($id, $tenDangNhap, $vaiTro, $trangThai)
    {
        $sql = "UPDATE taikhoan SET TenDangNhap = :TenDangNhap, VaiTro = :VaiTro, TrangThai = :TrangThai WHERE MaTaiKhoan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':TenDangNhap', $tenDangNhap);
        $stmt->bindParam(':VaiTro', $vaiTro);
        $stmt->bindParam(':TrangThai', $trangThai);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateMatKhau($id, $matKhauMoi)
    {
        $sql = "UPDATE taikhoan SET MatKhau = :MatKhau WHERE MaTaiKhoan = :id";
        $stmt = $this->conn->prepare($sql);
        $hashPass = password_hash($matKhauMoi, PASSWORD_BCRYPT);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':MatKhau', $hashPass);
        $stmt->execute();
    }

    public function deleteTaiKhoan($id)
    {
        $sql = "DELETE FROM taikhoan WHERE MaTaiKhoan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
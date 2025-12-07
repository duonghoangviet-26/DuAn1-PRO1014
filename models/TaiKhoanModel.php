<?php
class TaiKhoanModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllNhanVien()
    {
        $sql = "SELECT * FROM nhanvien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertTaiKhoanAdmin($tenDangNhap, $matKhau, $vaiTro, $maNhanVien)
    {
        $hashPass = password_hash($matKhau, PASSWORD_BCRYPT);
        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, VaiTro, MaNhanVien, TrangThai) 
                VALUES (:user, :pass, :role, :maNV, 'hoat_dong')";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user' => $tenDangNhap,
            ':pass' => $hashPass,
            ':role' => $vaiTro,
            ':maNV' => $maNhanVien
        ]);
    }
    public function checkUser($tenDangNhap, $matKhau)
    {
        $sql = "SELECT * FROM taikhoan WHERE TenDangNhap = :user AND TrangThai = 'hoat_dong'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user' => $tenDangNhap]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($matKhau, $user['MatKhau'])) {
            return $user;
        }
        return false;
    }
    public function insertTaiKhoan($tenDangNhap, $matKhau)
    {
        $hashPass = password_hash($matKhau, PASSWORD_BCRYPT);

        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, VaiTro, TrangThai) 
                VALUES (:user, :pass, 'khach_hang', 'hoat_dong')";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user' => $tenDangNhap,
            ':pass' => $hashPass
        ]);
    }

    public function checkNhanVienHasAccount($maNhanVien)
    {
        if (empty($maNhanVien)) return false;

        $sql = "SELECT COUNT(*) FROM taikhoan WHERE MaNhanVien = :maNV";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maNV' => $maNhanVien]);
        return $stmt->fetchColumn() > 0;
    }

    public function getNhanVienChuaCoTaiKhoan() {
    $sql = "SELECT * FROM nhanvien 
            WHERE MaNhanVien NOT IN (SELECT MaNhanVien FROM taikhoan WHERE MaNhanVien IS NOT NULL)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function checkUserExist($tenDangNhap)
    {
        $sql = "SELECT COUNT(*) FROM taikhoan WHERE TenDangNhap = :user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user' => $tenDangNhap]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
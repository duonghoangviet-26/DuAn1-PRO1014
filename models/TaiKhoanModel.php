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
        // SỬA: Bỏ mã hóa, lưu mật khẩu thô
        $hashPass = $matKhau; 

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

        // SỬA: So sánh trực tiếp chuỗi (Plain text)
        if ($user && $matKhau == $user['MatKhau']) {
            return $user;
        }
        return false;
    }

    public function insertTaiKhoan($tenDangNhap, $matKhau)
    {
        // SỬA: Bỏ mã hóa, lưu mật khẩu thô
        $hashPass = $matKhau;

        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, VaiTro, TrangThai) 
                VALUES (:user, :pass, 'khach_hang', 'hoat_dong')";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user' => $tenDangNhap,
            ':pass' => $hashPass
        ]);
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
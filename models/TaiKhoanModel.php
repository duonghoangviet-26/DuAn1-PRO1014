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

    public function checkUserForReset($tenDangNhap, $email, $sdt) {
        $sql = "SELECT tk.MaTaiKhoan 
                FROM taikhoan tk 
                JOIN nhanvien nv ON tk.MaNhanVien = nv.MaNhanVien 
                WHERE tk.TenDangNhap = :user 
                AND nv.Email = :email 
                AND nv.SoDienThoai = :sdt";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user' => $tenDangNhap,
            ':email' => $email,
            ':sdt' => $sdt
        ]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function resetPassword($maTaiKhoan, $newPass) {
        $hashPass = password_hash($newPass, PASSWORD_BCRYPT);
        $sql = "UPDATE taikhoan SET MatKhau = :pass WHERE MaTaiKhoan = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':pass' => $hashPass, ':id' => $maTaiKhoan]);
    }
}
?>
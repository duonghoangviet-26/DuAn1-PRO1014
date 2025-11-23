<?php
class TaiKhoanModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Hàm kết nối CSDL của bạn
    }

    // Kiểm tra đăng nhập
    public function checkUser($tenDangNhap, $matKhau)
    {
        // 1. Tìm user theo tên đăng nhập
        $sql = "SELECT * FROM taikhoan WHERE TenDangNhap = :user AND TrangThai = 'hoat_dong'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user' => $tenDangNhap]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Nếu có user, kiểm tra mật khẩu đã mã hóa
        if ($user && password_verify($matKhau, $user['MatKhau'])) {
            return $user; // Trả về thông tin user nếu đúng
        }
        return false; // Sai tài khoản hoặc mật khẩu
    }

    // Đăng ký tài khoản mới (Mặc định vai trò là Khách hàng hoặc User thường)
    public function insertTaiKhoan($tenDangNhap, $matKhau)
    {
        // Mã hóa mật khẩu trước khi lưu
        $hashPass = password_hash($matKhau, PASSWORD_BCRYPT);

        $sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, VaiTro, TrangThai) 
                VALUES (:user, :pass, 'khach_hang', 'hoat_dong')";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user' => $tenDangNhap,
            ':pass' => $hashPass
        ]);
    }

    // Kiểm tra tên đăng nhập đã tồn tại chưa
    public function checkUserExist($tenDangNhap)
    {
        $sql = "SELECT COUNT(*) FROM taikhoan WHERE TenDangNhap = :user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user' => $tenDangNhap]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
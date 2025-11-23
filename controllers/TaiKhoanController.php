<?php
class TaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoanModel();
    }

    // --- XỬ LÝ ĐĂNG NHẬP ---
    public function login()
    {
        // Nếu đã đăng nhập rồi thì chuyển trang luôn
        if (isset($_SESSION['user'])) {
            $this->redirectUser($_SESSION['user']['VaiTro']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['TenDangNhap'];
            $pass = $_POST['MatKhau'];

            // Gọi model kiểm tra
            $result = $this->modelTaiKhoan->checkUser($user, $pass);

            if ($result) {
                // Đăng nhập thành công -> Lưu session
                $_SESSION['user'] = $result;

                // Cập nhật lần đăng nhập cuối (Tùy chọn)
                // $this->modelTaiKhoan->updateLastLogin($result['MaTaiKhoan']);

                // === PHÂN QUYỀN CHUYỂN HƯỚNG ===
                $this->redirectUser($result['VaiTro']);
                
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng, hoặc tài khoản bị khóa!";
                require_once "./views/Auth/login.php";
            }
        } else {
            require_once "./views/Auth/login.php";
        }
    }

    // Hàm phụ để điều hướng dựa trên VaiTro
    private function redirectUser($vaiTro)
    {
        switch ($vaiTro) {
            case 'admin':
                header("Location: index.php?act=admin_dashboard"); // Trang Admin
                break;
            case 'huong_dan_vien':
            case 'dieu_hanh': // Gộp chung nếu muốn
                header("Location: index.php?act=hdv_dashboard"); // Trang HDV
                break;
            default:
                header("Location: index.php"); // Trang chủ khách hàng
                break;
        }
        exit();
    }

    // --- XỬ LÝ ĐĂNG KÝ ---
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['TenDangNhap'];
            $pass = $_POST['MatKhau'];
            $rePass = $_POST['MatKhau2'];

            $errors = [];

            // Validate cơ bản
            if ($pass !== $rePass) {
                $errors[] = "Mật khẩu xác nhận không khớp!";
            }
            if ($this->modelTaiKhoan->checkUserExist($user)) {
                $errors[] = "Tên đăng nhập đã tồn tại!";
            }

            if (empty($errors)) {
                // Thêm vào DB
                if ($this->modelTaiKhoan->insertTaiKhoan($user, $pass)) {
                    echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='index.php?act=login';</script>";
                    exit();
                } else {
                    $errors[] = "Lỗi hệ thống, vui lòng thử lại.";
                }
            }

            require_once "./views/Auth/register.php";
        } else {
            require_once "./views/Auth/register.php";
        }
    }

    // --- ĐĂNG XUẤT ---
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?act=login");
        exit();
    }
}
?>
<?php
class TaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoanModel();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            $this->redirectUser($_SESSION['user']['VaiTro']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['TenDangNhap'];
            $pass = $_POST['MatKhau'];
            $result = $this->modelTaiKhoan->checkUser($user, $pass);

            if ($result) {
                $_SESSION['user'] = $result;
                $this->redirectUser($result['VaiTro']);
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng, hoặc tài khoản bị khóa!";
                require_once "./views/taikhoan/login.php";
            }
        } else {
            require_once "./views/taikhoan/login.php";
        }
    }

    public function formAddTaiKhoan()
    {
        $this->checkAuthAdmin();
        $listNhanVien = $this->modelTaiKhoan->getAllNhanVien();

        require_once "./views/Admin/taikhoan/addTaiKhoan.php";
    }

    public function postAddTaiKhoan()
    {
        $this->checkAuthAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maNhanVien = $_POST['MaNhanVien'] ?? null;
            $user       = $_POST['TenDangNhap'];
            $pass       = $_POST['MatKhau'];
            $vaiTro     = $_POST['VaiTro'];

            $errors = [];
            if (empty($user) || empty($pass)) {
                $errors[] = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!";
            }
            if ($this->modelTaiKhoan->checkUserExist($user)) {
                $errors[] = "Tên đăng nhập đã tồn tại!";
            }

            if (empty($errors)) {
                if ($this->modelTaiKhoan->insertTaiKhoanAdmin($user, $pass, $vaiTro, $maNhanVien)) {
                    echo "<script>alert('Thêm tài khoản thành công!'); window.location.href='index.php?act=listNV';</script>";
                    exit();
                } else {
                    $errors[] = "Lỗi hệ thống, vui lòng thử lại.";
                }
            }

            $listNhanVien = $this->modelTaiKhoan->getAllNhanVien();
            require_once "./views/Admin/taikhoan/addTaiKhoan.php";
        }
    }
    private function redirectUser($vaiTro)
    {
        switch ($vaiTro) {
            case 'admin':
                header("Location: index.php?act=admin_dashboard");
                break;
            case 'huong_dan_vien':
                header("Location: index.php?act=hdv_dashboard");
                break;
            default:
                header("Location: index.php");
                break;
        }
        exit();
    }

    private function checkAuthAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'admin') {
            echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php?act=login';</script>";
            exit();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?act=login");
        exit();
    }
}
?>
<?php
class DanhSachTaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new DanhSachTaiKhoanModel();
    }

    public function listTaiKhoan()
    {
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan();
        require_once './views/Admin/danhsachtaikhoan/listTaiKhoan.php';
    }

    public function formAddTaiKhoan()
    {
        require_once './views/Admin/danhsachtaikhoan/addTaiKhoan.php';
    }

    public function postAddTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tenDangNhap = $_POST['TenDangNhap'];
            $matKhau = $_POST['MatKhau'];
            $vaiTro = $_POST['VaiTro'];
            $trangThai = $_POST['TrangThai'] ?? 'hoat_dong';

            if(!empty($tenDangNhap) && !empty($matKhau)){
                 $this->modelTaiKhoan->insertTaiKhoan($tenDangNhap, $matKhau, $vaiTro, $trangThai);
            }
            
            header("Location: index.php?act=listTaiKhoan");
            exit;
        }
    }

    public function formEditTaiKhoan()
    {
        $id = $_GET['id'];
        $tk = $this->modelTaiKhoan->getOneTaiKhoan($id);
        require_once './views/Admin/danhsachtaikhoan/editTaiKhoan.php';
    }

    public function postEditTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['MaTaiKhoan'];
            $tenDangNhap = $_POST['TenDangNhap'];
            $vaiTro = $_POST['VaiTro'];
            $matKhauMoi = $_POST['MatKhau']; 
            $trangThai = $_POST['TrangThai'];

            $this->modelTaiKhoan->updateTaiKhoan($id, $tenDangNhap, $vaiTro, $trangThai);

            if (!empty($matKhauMoi)) {
                $this->modelTaiKhoan->updateMatKhau($id, $matKhauMoi);
            }

            header("Location: index.php?act=listTaiKhoan");
            exit;
        }
    }

    public function deleteTaiKhoan()
    {
        $id = $_GET['id'];
        $this->modelTaiKhoan->deleteTaiKhoan($id);
        header("Location: index.php?act=listTaiKhoan");
        exit;
    }
}
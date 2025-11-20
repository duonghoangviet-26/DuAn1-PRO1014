<?php
class nhanVienController
{
    public $modelNhanVien;

    public function __construct()
    {
        $this->modelNhanVien = new nhanVienModel();
    }

    public function listNV()
    {
        $listNhanVien = $this->modelNhanVien->getAllNhanVien();
        require_once "./views/Admin/nhanvien/list.php";
    }
    public function creatNV() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $HoTen = $_POST['HoTen'];
        $VaiTro = $_POST['VaiTro'];
        $SoDienThoai = $_POST['SoDienThoai'];
        $Email = $_POST['Email'];
        $linkAnh = null;
        $MaCodeNhanVien = 'NV' . rand(1000, 9999);

            if (isset($_FILES['LinkAnhDaiDien']) && $_FILES['LinkAnhDaiDien']['error'] === 0) {

                $folder = "./uploads/nhanvien/";
                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES['LinkAnhDaiDien']['name']);
                $targetFile = $folder . $fileName;

                if (move_uploaded_file($_FILES['LinkAnhDaiDien']['tmp_name'], $targetFile)) {
                    $linkAnh = $fileName;
                }
            }

        $this->modelNhanVien->insertNhanVien($HoTen, $VaiTro, $SoDienThoai, $Email, $linkAnh, $MaCodeNhanVien);

        header("Location: index.php?act=listNV");
        exit();
    }
    require_once "./views/Admin/nhanvien/addNhanVien.php";
    }
    public function editNV()
    {
        if (!isset($_GET['id'])) {
            die("Thiếu ID nhân viên");
        }

        $id = $_GET['id'];
        $nhanVien = $this->modelNhanVien->getNhanVienById($id);

        if (!$nhanVien) {
            die("Không tìm thấy nhân viên");
        }

        require_once "./views/Admin/nhanvien/editNhanVien.php";
    }

    public function updateNV()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['MaNhanVien'];
            $TenNhanVien = $_POST['HoTen'];
            $VaiTro = $_POST['VaiTro'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $anh = $_POST['AnhCu']; // Giữ ảnh cũ nếu không upload ảnh mới

            if (isset($_FILES['LinkAnhDaiDien']) && $_FILES['LinkAnhDaiDien']['error'] === 0) {

                $folder = "./uploads/nhanvien/";
                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES['LinkAnhDaiDien']['name']);
                $targetFile = $folder . $fileName;

                if (move_uploaded_file($_FILES['LinkAnhDaiDien']['tmp_name'], $targetFile)) {
                    $anh = $fileName;
                }
            }
            $this->modelNhanVien->updateNhanVien($id, $TenNhanVien, $VaiTro, $SoDienThoai, $Email, $anh,  $_POST['TrangThai']);

            header("Location: index.php?act=listNV");
            exit();
        }
    }
    public function deleteNV()
{
    if (!isset($_GET['id'])) {
        die("Thiếu ID nhân viên cần xóa");
    }

    $id = $_GET['id'];

    $this->modelNhanVien->deleteNhanVien($id);
    header("Location: index.php?act=listNV");
    exit();
}
    public function chiTietNV()
{
    if (!isset($_GET['id'])) {
        echo "Không tìm thấy ID nhân viên!";
        return;
    }

    $id = $_GET['id'];

    $model = new nhanVienModel();
    $nhanVien = $model->getNhanVienById($id);

    if (!$nhanVien) {
        echo "Nhân viên không tồn tại!";
        return;
    }

    require_once 'views/Admin/nhanvien/chiTietNhanVien.php';
}
}

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
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;
        $totalRecords = $this->modelNhanVien->countAllNhanVien();
        $totalPages = ceil($totalRecords / $limit);
        $listNhanVien = $this->modelNhanVien->getAllNhanVien($limit, $offset);
        require_once "./views/Admin/nhanvien/list.php";
    }


    public function creatNV() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'];
            $VaiTro = $_POST['VaiTro'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $NgaySinh = $_POST['NgaySinh'];
            $GioiTinh = $_POST['GioiTinh'];
            $DiaChi = $_POST['DiaChi'];
            $ChungChi = $_POST['ChungChi'];
            $NgonNgu = $_POST['NgonNgu'];
            $SoNamKinhNghiem = $_POST['SoNamKinhNghiem'];
            $ChuyenMon = $_POST['ChuyenMon'];
            $TrangThai = $_POST['TrangThai'];
            
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
            $this->modelNhanVien->insertNhanVien(
                $HoTen, $VaiTro, $SoDienThoai, $Email, $linkAnh, $MaCodeNhanVien,
                $NgaySinh, $GioiTinh, $DiaChi, $ChungChi, $NgonNgu, $SoNamKinhNghiem, $ChuyenMon, $TrangThai
            );

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
            $HoTen = $_POST['HoTen'];
            $VaiTro = $_POST['VaiTro'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $NgaySinh = $_POST['NgaySinh'];
            $GioiTinh = $_POST['GioiTinh'];
            $DiaChi = $_POST['DiaChi'];
            $ChungChi = $_POST['ChungChi'];
            $NgonNgu = $_POST['NgonNgu'];
            $SoNamKinhNghiem = $_POST['SoNamKinhNghiem'];
            $ChuyenMon = $_POST['ChuyenMon'];
            $TrangThai = $_POST['TrangThai'];
            
            $anh = $_POST['AnhCu'];

            if (isset($_FILES['LinkAnhDaiDien']) && $_FILES['LinkAnhDaiDien']['error'] === 0) {
                $folder = "./uploads/nhanvien/";
                if (!is_dir($folder)) { mkdir($folder, 0777, true); }
                $fileName = time() . "_" . basename($_FILES['LinkAnhDaiDien']['name']);
                $targetFile = $folder . $fileName;
                if (move_uploaded_file($_FILES['LinkAnhDaiDien']['tmp_name'], $targetFile)) {
                    $anh = $fileName;
                }
            }

            $this->modelNhanVien->updateNhanVien(
                $id, $HoTen, $VaiTro, $SoDienThoai, $Email, $anh, $TrangThai,
                $NgaySinh, $GioiTinh, $DiaChi, $ChungChi, $NgonNgu, $SoNamKinhNghiem, $ChuyenMon
            );

            header("Location: index.php?act=listNV");
            exit();
        }
    }
    public function deleteNV()
{
    if (!isset($_GET['id'])) {
        echo "<script>alert('Thiếu ID!'); history.back();</script>";
        return;
    }
    $id = $_GET['id'];
    $nhanVien = $this->modelNhanVien->getNhanVienById($id);

    if (!$nhanVien) {
        echo "<script>alert('Nhân viên không tồn tại!'); history.back();</script>";
        return;
    }
    if ($nhanVien['TrangThai'] == 'da_nghi') {
        $this->modelNhanVien->destroyNhanVien($id);
        $message = "Đã xóa vĩnh viễn nhân viên khỏi hệ thống!";
    } else {
        $this->modelNhanVien->deleteNhanVien($id);
        $message = "Đã chuyển nhân viên sang trạng thái nghỉ việc!";
    }

    echo "<script>alert('$message'); window.location.href='index.php?act=listNV';</script>";
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
public function getSearchNV()
    {
        $listNhanVienRanh = [];
        $selectedDate = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['NgayCanTim'])) {
            $selectedDate = $_POST['NgayCanTim'];
        } else {
            $selectedDate = date('Y-m-d');
        }
        $listNhanVienRanh = $this->modelNhanVien->getSearchNV($selectedDate);
        require_once "./views/Admin/nhanvien/SearchNV.php";
    }
}

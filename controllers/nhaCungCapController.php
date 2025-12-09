<?php

class nhaCungCapController
{
    public $modelNhaCungCap;

    public function __construct()
    {
        $this->modelNhaCungCap = new nhaCungCapModel();
    }

    public function listNCC()
    {
        require_once "./views/Admin/nhacungcap/list_categories.php";
    }

    public function listNCCByCategory()
    {
        $loai_ncc = $_GET['loai'];
        $listNhaCungCap = $this->modelNhaCungCap->getNhaCungCapByCategory($loai_ncc);
        require_once "./views/Admin/nhacungcap/list.php";
    }

    public function showFormThemNCC()
    {
        require_once "./views/Admin/nhacungcap/add.php";
    }

    public function addNCC()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];

            if (empty($_POST['MaCodeNCC'])) {
                $errors[] = 'Mã Code NCC không được để trống';
            }
            if (empty($_POST['TenNhaCungCap'])) {
                $errors[] = 'Tên Nhà Cung Cấp không được để trống';
            }

            $email = $_POST['Email'];
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email không đúng định dạng';
            }

            $sdt = $_POST['SoDienThoai'];
            if (!empty($sdt) && !preg_match('/^[0-9]+$/', $sdt)) {
<<<<<<< HEAD
                $errors[] = 'Số điện thoại chỉ được nhập số';
=======
                $errors[] = 'Số điện thoại chỉ được nhập số (không chứa chữ hay ký tự đặc biệt)';
>>>>>>> f1431ecd357a65b9c43fd7796fa30ff4d6e6ecce
            }

            if ($_POST['LoaiNhaCungCap'] == 'van_chuyen') {
                $sdtLaiXe = $_POST['SDTLaiXe'];
                if (!empty($sdtLaiXe) && !preg_match('/^[0-9]+$/', $sdtLaiXe)) {
                    $errors[] = 'SĐT Lái xe chỉ được nhập số';
                }
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                $_SESSION['old_data'] = $_POST;
                header("Location: " . BASE_URL . "?act=addNCC&loai=" . $_POST['LoaiNhaCungCap']);
                exit;
            }

            $data = [
                'MaCodeNCC' => $_POST['MaCodeNCC'],
                'TenNhaCungCap' => $_POST['TenNhaCungCap'],
                'LoaiNhaCungCap' => $_POST['LoaiNhaCungCap'],
                'NguoiLienHe' => $_POST['NguoiLienHe'],

                'TenLaiXe' => trim($_POST['TenLaiXe'] ?? ''),
                'SDTLaiXe' => trim($_POST['SDTLaiXe'] ?? ''),
                'SoDienThoai' => trim($_POST['SoDienThoai']),
                'Email' => trim($_POST['Email']),

                'SoDienThoai' => trim($_POST['SoDienThoai']),
                'Email' => trim($_POST['Email']),
                'DiaChi' => $_POST['DiaChi'],
                'DichVuCungCap' => $_POST['DichVuCungCap'],
                'FileHopDong' => $_POST['FileHopDong'],
                'NgayBatDauHopDong' => $_POST['NgayBatDauHopDong'],
                'NgayKetThucHopDong' => $_POST['NgayKetThucHopDong'],
                'DanhGia' => $_POST['DanhGia'],
                'GhiChu' => $_POST['GhiChu'],
                'TrangThai' => $_POST['TrangThai']
            ];

            $this->modelNhaCungCap->insertNhaCungCap($data);

            if(isset($_SESSION['old_data'])) unset($_SESSION['old_data']);

            header("Location: " . BASE_URL . "?act=listNCCByCategory&loai=" . $data['LoaiNhaCungCap']);
            exit;
        }
    }

    public function showFormSuaNCC()
    {
        $id = $_GET['id'];
        $ncc = $this->modelNhaCungCap->getOneNhaCungCap($id);
        require_once "./views/Admin/nhacungcap/edit.php";
    }

    public function updateNCC()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];

            if (empty($_POST['MaCodeNCC'])) {
                $errors[] = 'Mã Code NCC không được để trống';
            }
            if (empty($_POST['TenNhaCungCap'])) {
                $errors[] = 'Tên Nhà Cung Cấp không được để trống';
            }

            $email = $_POST['Email'];
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email không đúng định dạng';
            }

            $sdt = $_POST['SoDienThoai'];
            if (!empty($sdt) && !preg_match('/^[0-9]+$/', $sdt)) {
                $errors[] = 'Số điện thoại chỉ được nhập số';
            }

            if ($_POST['LoaiNhaCungCap'] == 'van_chuyen') {
                $sdtLaiXe = $_POST['SDTLaiXe'];
                if (!empty($sdtLaiXe) && !preg_match('/^[0-9]+$/', $sdtLaiXe)) {
                    $errors[] = 'SĐT Lái xe chỉ được nhập số';
                }
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors);
                header("Location: " . BASE_URL . "?act=editNCC&id=" . $_POST['MaNhaCungCap']);
                exit;
            }

            $id = trim($_POST['MaNhaCungCap']);
            $data = [
                'MaCodeNCC' => $_POST['MaCodeNCC'],
                'TenNhaCungCap' => $_POST['TenNhaCungCap'],
                'LoaiNhaCungCap' => $_POST['LoaiNhaCungCap'],
                'NguoiLienHe' => $_POST['NguoiLienHe'],

                'TenLaiXe' => trim($_POST['TenLaiXe'] ?? ''),
                'SDTLaiXe' => trim($_POST['SDTLaiXe'] ?? ''),
                'SoDienThoai' => trim($_POST['SoDienThoai']),
                'Email' => trim($_POST['Email']),
                
                'DiaChi' => $_POST['DiaChi'],
                'DichVuCungCap' => $_POST['DichVuCungCap'],
                'FileHopDong' => $_POST['FileHopDong'],
                'NgayBatDauHopDong' => $_POST['NgayBatDauHopDong'],
                'NgayKetThucHopDong' => $_POST['NgayKetThucHopDong'],
                'DanhGia' => $_POST['DanhGia'],
                'GhiChu' => $_POST['GhiChu'],
                'TrangThai' => $_POST['TrangThai']
            ];

            $this->modelNhaCungCap->updateNhaCungCap($id, $data);

            header("Location: " . BASE_URL . "?act=listNCCByCategory&loai=" . $data['LoaiNhaCungCap']);
            exit;
        }
    }

    public function deleteNCC()
    {
        $id = $_GET['id'];

        $ncc = $this->modelNhaCungCap->getOneNhaCungCap($id);
        $loai_ncc = $ncc['LoaiNhaCungCap'];

        $this->modelNhaCungCap->deleteNhaCungCap($id);

        header("Location: " . BASE_URL . "?act=listNCCByCategory&loai=" . $loai_ncc);
        exit;
    }

    public function showDetailNCC()
    {
        $id = $_GET['id'];
        $ncc = $this->modelNhaCungCap->getOneNhaCungCap($id);
        require_once "./views/Admin/nhacungcap/detail.php";
    }
}

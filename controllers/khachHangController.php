<?php
class khachHangController
{
    public $khachHangModel;

    public function __construct()
    {
        $this->khachHangModel = new khachHangModel();
    }


    public  function listKH()
    {
        try {
            $keyword = $_GET['keyword'] ?? '';

        if ($keyword !== '') {
            $listKhachHang = $this->khachHangModel->searchKhachHangByName($keyword);
        } else {
            $listKhachHang = $this->khachHangModel->getAllKhachHang();
        }
            include './views/Admin/Khachhang/listKH.php';
        } catch (Exception $e) {
            die("Lỗi: " . $e->getMessage());
        }
    }

    public  function deleteKH()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $rowsDeleted = $this->khachHangModel->deleteKH($id);

            if ($rowsDeleted > 0) {
                $_SESSION['success'] = "Xóa danh mục thành công!";
            } else {
                $_SESSION['error'] = "Không tìm thấy danh mục để xóa.";
            }
        } else {
            $_SESSION['error'] = "ID không hợp lệ.";
        }
        header("Location: index.php?act=listKH");
        exit;
    }

    public function creatKH()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu và trim khoảng trắng
            $hoTen = trim($_POST['HoTen'] ?? '');
            $soDienThoai = trim($_POST['SoDienThoai'] ?? '');

            // Validate dữ liệu bắt buộc
            $errors = [];

            if ($hoTen === '') {
                $errors[] = 'empty_name';
            }

            if ($soDienThoai === '') {
                $errors[] = 'empty_phone';
            }

            // Nếu có lỗi, redirect về form với thông báo lỗi
            if (!empty($errors)) {
                $errorString = urlencode(implode(",", $errors));
                header("Location: index.php?act=creatKH&error=$errorString");
                exit();
            }


            $data = [
                ':MaCodeKhachHang' => $_POST['MaCodeKhachHang'] ?? '',
                ':HoTen' => trim($_POST['HoTen']),
                ':SoDienThoai' => trim($_POST['SoDienThoai']),
                ':Email' => trim($_POST['Email'] ?? ''),
                ':DiaChi' => trim($_POST['DiaChi'] ?? ''),
                ':NgaySinh' => $_POST['NgaySinh'] ?? null,
                ':GioiTinh' => $_POST['GioiTinh'] ?? '',
                ':SoGiayTo' => $_POST['SoGiayTo'] ?? '',
                ':LoaiKhach' => $_POST['LoaiKhach'] ?? 'Ca nhan',
                ':TenCongTy' => $_POST['TenCongTy'] ?? null,
                ':MaSoThue' => $_POST['MaSoThue'] ?? null,
                ':GhiChu' => $_POST['GhiChu'] ?? ''
            ];

            try {
                $result = $this->khachHangModel->creatKhachHang($data);
                if ($result) {
                    header("Location: index.php?act=listKH");
                } else {
                    header("Location: index.php?act=listKH");
                }
            } catch (Exception $e) {
                header("Location: index.php?act=listKH");
            }
            exit();
        }
        require_once "./views/Admin/Khachhang/addKH.php";
    }
    public function editKH()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?act=listKH");
            exit();
        }

        $kh = $this->khachHangModel->getKhachHangById($id);
        if (!$kh) {
            echo "<div class='alert alert-warning'>Khách hàng không tồn tại!</div>";
            exit();
        }

        require_once './views/Admin/Khachhang/editKH.php';
    }
    public function updateKH()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (empty($_POST['HoTen'])) $errors[] = 'empty_name';
            if (empty($_POST['SoDienThoai'])) $errors[] = 'empty_phone';

            if (!empty($errors)) {
                header("Location: index.php?act=editKH&id={$_POST['MaCodeKhachHang']}&error=" . implode(',', $errors));
                exit();
            }

            $data = [
                ':MaCodeKhachHang' => $_POST['MaCodeKhachHang'],
                ':HoTen' => trim($_POST['HoTen']),
                ':SoDienThoai' => trim($_POST['SoDienThoai']),
                ':Email' => trim($_POST['Email'] ?? ''),
                ':DiaChi' => trim($_POST['DiaChi'] ?? ''),
                ':NgaySinh' => $_POST['NgaySinh'] ?? null,
                ':GioiTinh' => $_POST['GioiTinh'] ?? '',
                ':SoGiayTo' => $_POST['SoGiayTo'] ?? '',
                ':LoaiKhach' => $_POST['LoaiKhach'] ?? 'ca_nhan',
                ':TenCongTy' => $_POST['TenCongTy'] ?? '',
                ':MaSoThue' => $_POST['MaSoThue'] ?? '',
                ':GhiChu' => $_POST['GhiChu'] ?? ''
            ];

            $result = $this->khachHangModel->updateKhachHang($data);
            if ($result) {
                header("Location: index.php?act=listKH");
            } else {
                header("Location: index.php?act=editKH&id={$_POST['MaCodeKhachHang']}&error=db_error");
            }
            exit();
        }
    }
}

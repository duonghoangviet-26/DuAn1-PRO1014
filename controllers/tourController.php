<?php
class tourController
{
    public $modelTour;

    public function __construct()
    {
        $this->modelTour = new tourModel();
    }

    public function Home()
    {
        require_once "./views/trangchu.php";
    }

    public function getCategoryAll()
    {
        try {
            $listdanhmuc = $this->modelTour->getCategoryAll();
            require_once "./views/Admin/danhmuc/list.php";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function deleteDanhMuc()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $rowsDeleted = $this->modelTour->deleteDanhMuc($id);

            if ($rowsDeleted > 0) {
                $_SESSION['success'] = "Xóa danh mục thành công!";
            } else {
                $_SESSION['error'] = "Không tìm thấy danh mục để xóa.";
            }
        } else {
            $_SESSION['error'] = "ID không hợp lệ.";
        }
        // Quay lại danh sách (sử dụng router của index.php)
        header("Location: index.php?act=listdm");
        exit;
    }

    // Thêm danh mục 
    public function creatDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $TenDanhMuc = $_POST['TenDanhMuc'] ?? '';
            $MoTa = $_POST['MoTa'] ?? '';

            if ($TenDanhMuc != '') {
                $this->modelTour->creatDanhMuc($TenDanhMuc, $MoTa);
                $_SESSION['success'] = "Thêm danh mục thành công!";
                header("Location: index.php?act=listdm");
                exit;
            } else {
                $_SESSION['error'] = "Tên danh mục không được để trống!";
            }
        }

        require_once "./views/Admin/danhmuc/addDanhMuc.php";
    }



    public function editDanhMuc()
    {
        $MaDanhMuc = isset($_GET['MaDanhMuc']) ? intval($_GET['MaDanhMuc']) : 0;
        if ($MaDanhMuc <= 0) {
            $_SESSION['error'] = "Mã danh mục không hợp lệ!";
            header("Location: index.php?act=listdm");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $TenDanhMuc = $_POST['TenDanhMuc'] ?? '';
            $MoTa = $_POST['MoTa'] ?? '';

            if ($TenDanhMuc != '') {
                $MaDanhMuc = $_GET['MaDanhMuc'] ?? null;

                if ($MaDanhMuc) {
                    $this->modelTour->updateDanhMuc($MaDanhMuc, $TenDanhMuc, $MoTa);
                    $_SESSION['success'] = "Sửa danh mục thành công!";
                    header("Location: index.php?act=listdm");
                    exit;
                } else {
                    $_SESSION['error'] = "Mã danh mục không hợp lệ!";
                }
            } else {
                $_SESSION['error'] = "Tên danh mục không được để trống!";
            }
        }
        $dm = $this->modelTour->getDanhMucByMa($MaDanhMuc);
        require_once "./views/Admin/danhmuc/editDanhMuc.php";
    }
}

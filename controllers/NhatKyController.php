<?php
class NhatKyController {
    public $model;

    public function __construct() {
        $this->model = new NhatKyModel();
    }

    public function listTourOfHDV() {
        $maHDV = $_SESSION['user']['MaNhanVien'] ?? 0; 
        $listTour = $this->model->getTourPhuTrach($maHDV);
        require_once './views/HDV/nhatky/listTour.php';
    }

    public function listNhatKy() {
        $maDoan = $_GET['maDoan'];
        $thongTinDoan = $this->model->getThongTinDoan($maDoan);
        $listNhatKy = $this->model->getNhatKyByDoan($maDoan);
        require_once './views/HDV/nhatky/listNhatKy.php';
    }

    public function formAddNhatKy() {
        $maDoan = $_GET['maDoan'];
        $thongTinDoan = $this->model->getThongTinDoan($maDoan);
        require_once './views/HDV/nhatky/add.php';
    }

    public function postAddNhatKy() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maDoan = $_POST['MaDoan'];

            $errors = [];

            if (empty(trim($_POST['NoiDung']))) {
                $errors[] = "Nội dung nhật ký không được để trống.";
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngayGhi = $_POST['NgayGhi'];
            $gioGhi = $_POST['GioGhi'];
            $ngayHienTai = date('Y-m-d');
            $gioHienTai = date('H:i');

            if ($ngayGhi > $ngayHienTai) {
                $errors[] = "Ngày ghi nhận không được là ngày tương lai.";
            } 
            elseif ($ngayGhi == $ngayHienTai && $gioGhi > $gioHienTai) {
                $errors[] = "Giờ ghi nhận không được lớn hơn giờ hiện tại ($gioHienTai).";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);
                $_SESSION['old_data'] = $_POST; 
                header("Location: index.php?act=addNhatKy&maDoan=$maDoan");
                exit;
            }

            $linkAnh = '';
            if (!empty($_FILES['LinkAnh']['name'])) {
                $duoiFile = strtolower(pathinfo($_FILES['LinkAnh']['name'], PATHINFO_EXTENSION));
                $duoiChoPhep = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (!in_array($duoiFile, $duoiChoPhep)) {
                     $_SESSION['error'] = "Chỉ chấp nhận file ảnh (JPG, PNG, GIF).";
                     header("Location: index.php?act=addNhatKy&maDoan=$maDoan");
                     exit;
                }

                $target_dir = "./uploads/nhatky/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
                $linkAnh = time() . "_" . basename($_FILES["LinkAnh"]["name"]);
                move_uploaded_file($_FILES["LinkAnh"]["tmp_name"], $target_dir . $linkAnh);
            }

            $this->model->insertNhatKy(
                $maDoan, $_POST['NgayGhi'], $_POST['GioGhi'], 
                $_POST['NoiDung'], $_POST['LoaiSuCo'], $linkAnh, 
                $_SESSION['user']['MaNhanVien'] ?? 0
            );
            
            if(isset($_SESSION['old_data'])) unset($_SESSION['old_data']);

            header("Location: index.php?act=listNhatKy&maDoan=$maDoan");
            exit;
        }
    }

    public function formEditNhatKy() {
        $id = $_GET['id'];
        $nk = $this->model->getOneNhatKy($id);
        require_once './views/HDV/nhatky/edit.php';
    }

    public function postEditNhatKy() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['MaNhatKy'];
            $maDoan = $_POST['MaDoan'];
            
            $errors = [];
            if (empty(trim($_POST['NoiDung']))) {
                $errors[] = "Nội dung không được để trống.";
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngayGhi = $_POST['NgayGhi'];
            $gioGhi = $_POST['GioGhi'];
            $ngayHienTai = date('Y-m-d');
            $gioHienTai = date('H:i');

            if ($ngayGhi > $ngayHienTai) {
                $errors[] = "Ngày ghi không được là ngày tương lai.";
            }
            elseif ($ngayGhi == $ngayHienTai && $gioGhi > $gioHienTai) {
                 $errors[] = "Giờ ghi nhận không được lớn hơn giờ hiện tại.";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);
                header("Location: index.php?act=editNhatKy&id=$id");
                exit;
            }

            $nhatKyCu = $this->model->getOneNhatKy($id);
            $linkAnh = $nhatKyCu['LinkAnh']; 

            if (!empty($_FILES['LinkAnh']['name'])) {
                $target_dir = "./uploads/nhatky/";
                $linkAnh = time() . "_" . basename($_FILES["LinkAnh"]["name"]);
                move_uploaded_file($_FILES["LinkAnh"]["tmp_name"], $target_dir . $linkAnh);
            }

            $this->model->updateNhatKy(
                $id, $_POST['NgayGhi'], $_POST['GioGhi'], 
                $_POST['NoiDung'], $_POST['LoaiSuCo'], $linkAnh
            );
            
            header("Location: index.php?act=listNhatKy&maDoan=$maDoan");
            exit;
        }
    }

    public function deleteNhatKy() {
        $id = $_GET['id'];
        $maDoan = $_GET['maDoan'];
        $this->model->deleteNhatKy($id);
        header("Location: index.php?act=listNhatKy&maDoan=$maDoan");
    }
}
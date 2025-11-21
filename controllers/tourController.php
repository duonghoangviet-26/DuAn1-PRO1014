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

    // ================= TOUR CONTROLLER =================

    public function getAllTour()
    {
        $model = new tourModel();
        $listTour = $model->getAllTour();
        include "views/Admin/tour/listTour.php";
    }


    public function createTourForm()
    {
        $model = new tourModel();
        $danhmuc = $model->getAllDanhMuc();
        include "views/Admin/tour/addTour.php";
    }
    // ================= XỬ LÝ THÊM TOUR =================
    public function createTour()
    {
        if (isset($_POST['btn-add'])) {

            $TenTour        = $_POST['TenTour'];
            $GiaBanMacDinh  = $_POST['GiaBanMacDinh'];
            $DiemKhoiHanh   = $_POST['DiemKhoiHanh'];
            $SoNgay         = $_POST['SoNgay'];
            $MoTa           = $_POST['MoTa'];
            $MaDanhMuc      = $_POST['MaDanhMuc'];
            $NgayBatDau     = $_POST['NgayBatDau'];
            $NgayKetThuc    = $_POST['NgayKetThuc'];
            $GiaVonDuKien = $_POST['GiaVonDuKien'];
            $SoDem = $_POST['SoDem'];
            // $ChinhSachBaoGom      = $_POST['ChinhSachBaoGom'] ?? "";
            // $ChinhSachKhongBaoGom = $_POST['ChinhSachKhongBaoGom'] ?? "";
            // $ChinhSachHuy         = $_POST['ChinhSachHuy'] ?? "";
            // $ChinhSachHoanTien    = $_POST['ChinhSachHoanTien'] ?? "";


            // ==== XỬ LÝ ẢNH ====
            $LinkAnhBia = "";
            if (isset($_FILES['LinkAnhBia']) && $_FILES['LinkAnhBia']['error'] == 0) {

                $fileName = time() . "_" . preg_replace('/\s+/', '_', $_FILES['LinkAnhBia']['name']);
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/DUAN1-PRO1014/uploads/imgproduct/";

                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $target = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['LinkAnhBia']['tmp_name'], $target)) {
                    $LinkAnhBia = $fileName;
                }
            }

            // ==== LƯU TOUR
            $model = new tourModel();
            $model->addTour(
                $TenTour,
                $GiaBanMacDinh,
                $DiemKhoiHanh,
                $SoNgay,
                $SoDem,
                $MoTa,
                $MaDanhMuc,
                $LinkAnhBia,
                $GiaVonDuKien,
                $NgayBatDau,
                $NgayKetThuc
                
            );
            $idTour = $model->getLastId();

            // LƯU CHÍNH SÁCH
            // $model->updateChinhSach(
            //     $idTour,
            //     $ChinhSachBaoGom,
            //     $ChinhSachKhongBaoGom,
            //     $ChinhSachHuy,
            //     $ChinhSachHoanTien
            // );
            // Lấy ID tour vừa tạo đúng cách
            $idTour = $model->getLastId();

            // ========== THÊM LỊCH TRÌNH ==========
            if (!empty($_POST['NgayThu'])) {

                foreach ($_POST['NgayThu'] as $i => $ngayThu) {

                    $TieuDeNgay = $_POST['TieuDeNgay'][$i] ?? "";
                    $ChiTietHoatDong = $_POST['ChiTietHoatDong'][$i] ?? "";
                    $DiaDiem = $_POST['DiaDiemThamQuan'][$i] ?? "";
                    $Sang = $_POST['CoBuaSang'][$i] ?? 0;
                    $Trua = $_POST['CoBuaTrua'][$i] ?? 0;
                    $Toi  = $_POST['CoBuaToi'][$i] ?? 0;
                    $NoiO = $_POST['NoiO'][$i] ?? "";
                    $GioTapTrung = $_POST['GioTapTrung'][$i] ?? null;
                    $GioXuatPhat = $_POST['GioXuatPhat'][$i] ?? null;
                    $GioKetThuc = $_POST['GioKetThuc'][$i] ?? null;
                    $GioHoatDong = $_POST['GioHoatDong'][$i] ?? null;
                    $model->addLichTrinh(
                        $idTour,
                        $ngayThu,
                        $TieuDeNgay,
                        $ChiTietHoatDong,
                        $DiaDiem,
                        $Sang,
                        $Trua,
                        $Toi,
                        $NoiO,
                        $GioTapTrung,
                        $GioXuatPhat,
                        $GioKetThuc,
                        $GioHoatDong
                    );
                }
            }

            // ==== LƯU CHÍNH SÁCH ====
            // $model->updateChinhSach(
            //     $idTour,
            //     $_POST['ChinhSachBaoGom'],
            //     $_POST['ChinhSachKhongBaoGom'],
            //     $_POST['ChinhSachHuy'],
            //     $_POST['ChinhSachHoanTien'],
            // );

            header("Location: index.php?act=listTour");
            exit();
        }
    }



    //FORM SỬA TOUR =================
    public function editTourForm()
    {
        $model = new tourModel();
        $tour = $model->getTourById($_GET['id']);
        $danhmuc = $model->getAllDanhMuc();

        // Thêm dòng này
        $lichTrinh = $model->getLichTrinhByTour($_GET['id']);

        include "views/Admin/tour/edit.php";
    }

    // ================= CẬP NHẬT TOUR =================
    public function updateTour()
    {
        $id          = $_POST['MaTour'];
        $TenTour     = $_POST['TenTour'];
        $Gia         = $_POST['GiaBanMacDinh'];
        $KhoiHanh    = $_POST['DiemKhoiHanh'];
        $SoNgay      = $_POST['SoNgay'];
        $SoDem=$_POST['SoDem'];
        $MoTa        = $_POST['MoTa'];
        $MaDanhMuc   = $_POST['MaDanhMuc'];
        $GiaVonDuKien=$_POST['GiaVonDuKien'];
        $NgayBatDau  = $_POST['NgayBatDau'];
        $NgayKetThuc = $_POST['NgayKetThuc'];
        // $ChinhSachBaoGom      = $_POST['ChinhSachBaoGom'];
        // $ChinhSachKhongBaoGom = $_POST['ChinhSachKhongBaoGom'];
        // $ChinhSachHuy         = $_POST['ChinhSachHuy'];
        // $ChinhSachHoanTien    = $_POST['ChinhSachHoanTien'];
        // // Lấy dữ liệu chính sách
        // $ChinhSachBaoGom      = $_POST['ChinhSachBaoGom'];
        // $ChinhSachKhongBaoGom = $_POST['ChinhSachKhongBaoGom'];

        $model = new tourModel();
        $tourOld = $model->getTourById($id);

        // Ảnh cũ
        $LinkAnhBia = $tourOld['LinkAnhBia'];

        // Nếu có ảnh mới
        if (!empty($_FILES['LinkAnhBia']['name'])) {

            // Xóa ảnh cũ
            if (file_exists("uploads/imgproduct/" . $LinkAnhBia)) {
                unlink("uploads/imgproduct/" . $LinkAnhBia);
            }
            // Lưu ảnh mới
            $file = $_FILES['LinkAnhBia'];
            $fileName = time() . "_" . $file['name'];
            $target = "uploads/imgproduct/" . $fileName;

            move_uploaded_file($file['tmp_name'], $target);
            $LinkAnhBia = $fileName;
        }

        // Cập nhật tour
        $model->updateTour(
            $id,
            $TenTour,
            $Gia,
            $KhoiHanh,
            $SoNgay,
            $SoDem,
            $MoTa,
            $MaDanhMuc,
            $LinkAnhBia,
            $GiaVonDuKien,
            $NgayBatDau,
            $NgayKetThuc
            // $ChinhSachBaoGom,
            // $ChinhSachKhongBaoGom,
            // $ChinhSachHuy,
            // $ChinhSachHoanTien
        );
        // ==== CẬP NHẬT LỊCH TRÌNH ====
        if (!empty($_POST['MaLichTrinh'])) {
            foreach ($_POST['MaLichTrinh'] as $i => $idLT) {

                $TieuDeNgay = $_POST['TieuDeNgay'][$i] ?? "";
                $ChiTiet = $_POST['ChiTietHoatDong'][$i] ?? "";
                $DiaDiem = $_POST['DiaDiemThamQuan'][$i] ?? "";
                $Sang = isset($_POST['CoBuaSang'][$i]) ? 1 : 0;
                $Trua = isset($_POST['CoBuaTrua'][$i]) ? 1 : 0;
                $Toi  = isset($_POST['CoBuaToi'][$i]) ? 1 : 0;
                $NoiO = $_POST['NoiO'][$i] ?? "";

                $GioTapTrung = $_POST['GioTapTrung'][$i] ?? null;
                $GioXuatPhat = $_POST['GioXuatPhat'][$i] ?? null;
                $GioKetThuc  = $_POST['GioKetThuc'][$i] ?? null;
                $GioHoatDong = $_POST['GioHoatDong'][$i] ?? null;
                $model->updateLichTrinh(
                    $idLT,
                    $TieuDeNgay,
                    $ChiTiet,
                    $DiaDiem,
                    $Sang,
                    $Trua,
                    $Toi,
                    $NoiO,
                    $GioTapTrung,
                    $GioXuatPhat,
                    $GioKetThuc,
                    $GioHoatDong
                );
            }
        }
        header("Location: index.php?act=listTour");
        exit();
    }

    //XÓA TOUR
    public function deleteTour()
    {
        $model = new tourModel();

        $tour = $model->getTourById($_GET['id']);

        if (!empty($tour['LinkAnhBia']) && file_exists("uploads/imgproduct/" . $tour['LinkAnhBia'])) {
            unlink("uploads/imgproduct/" . $tour['LinkAnhBia']);
        }

        $model->deleteTour($_GET['id']);
        header("Location: index.php?act=listTour");
    }
    // ================= CHI TIẾT TOUR =================
    public function detailTour()
    {
        $id = $_GET['id'];

        $model = new tourModel();

        // Lấy thông tin tour
        $tour = $model->getTourById($id);

        // Lấy lịch trình
        $lichTrinh = $model->getLichTrinhByTour($id);


        include "views/Admin/tour/chiTietTour.php";
    }
}

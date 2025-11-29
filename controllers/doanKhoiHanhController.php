<?php
class doanKhoiHanhController
{
    public $doanKhoiHanh;

    public function __construct()
    {
        $this->doanKhoiHanh = new doanKhoiHanhModel();
    }

    public function listDKH()
    {
        $listDoan = $this->doanKhoiHanh->getAllDoan();
        foreach ($listDoan as &$d) {
            $soBooking = $this->doanKhoiHanh->countBookingOfDoan($d['MaDoan']);
            $d['DaDat'] = $soBooking;
            $d['ConTrong'] = $d['SoChoToiDa'] - $soBooking;
            if ($d['ConTrong'] < 0) $d['ConTrong'] = 0;
        }

        $doans = $this->doanKhoiHanh->getAllDKH();
        foreach ($doans as &$d) {

            $soNguoiBooking = $this->doanKhoiHanh->getTotalBookingByDoan($d['MaDoan']);

            $soChoToiDa = (int)$d['SoChoToiDa'];

            $d['DaDat']    = $soNguoiBooking;
            $d['ConTrong'] = $soChoToiDa - $soNguoiBooking;
        }
        include './views/Admin/Doan/listDoan.php';
    }

    public function createDKH()
    {
        $tour = $this->doanKhoiHanh->getAllTour();
        $hdv = $this->doanKhoiHanh->getAllHDV();
        $taixe = $this->doanKhoiHanh->getAllNhaXe();

        // ---- THÊM VÀO ----
        $lichtrinh = [];
        $hotels = [];
        $restaurants = [];
        // ------------------

        // Khi chọn tour nhưng chưa bấm "Thêm"
        if (!empty($_POST['MaTour']) && !isset($_POST['btnSave'])) {

            // TOUR ĐƯỢC CHỌN
            foreach ($tour as $t) {
                if ($t['MaTour'] == $_POST['MaTour']) {
                    $tourSelected = $t;
                    break;
                }
            }

            // ---- LẤY LỊCH TRÌNH THEO TOUR ----
            $lichtrinh = $this->doanKhoiHanh->getLichTrinhByTour($_POST['MaTour']);

            // ---- LẤY KHÁCH SẠN ----
            $hotels = $this->doanKhoiHanh->getNhaCungCapByType('khach_san');

            // ---- LẤY NHÀ HÀNG ----
            $restaurants = $this->doanKhoiHanh->getNhaCungCapByType('nha_hang');
        }

        // Khi bấm nút Thêm
        if (isset($_POST['btnSave'])) {

            $MaDoan = $this->doanKhoiHanh->insertDoan([
                'MaTour' => $_POST['MaTour'],
                'NgayKhoiHanh' => $_POST['NgayKhoiHanh'],
                'NgayVe' => $_POST['NgayVe'],
                'GioKhoiHanh' => $_POST['GioKhoiHanh'],
                'DiemTapTrung' => $_POST['DiemTapTrung'],
                'SoChoToiDa' => $_POST['SoChoToiDa'],
                'MaHuongDanVien' => $_POST['MaHuongDanVien'],
            ]);

            // Lưu tài xế
            if (!empty($_POST['MaTaiXe'])) {
                $this->doanKhoiHanh->insertTaiXeChoDoan(
                    $MaDoan,
                    $_POST['MaTaiXe'],
                    $_POST['NgayKhoiHanh']
                );
            }

            header("Location:index.php?act=listDKH");
            exit;
        }

        include './views/Admin/Doan/addDoan.php';
    }



    public function deleteDKH()
    {
        if (isset($_GET['MaDoan'])) {
            $id = $_GET['MaDoan'];
            $this->doanKhoiHanh->deleteDoan($id);
        }
        header("Location:index.php?act=listDKH");
        exit;
    }



    public function editDKH()
    {
        if (!isset($_GET['id'])) {
            header("Location:index.php?act=listDKH");
            exit;
        }

        $id = $_GET['id'];

        $doan = $this->doanKhoiHanh->getOneDoan($id);
        $tour = $this->doanKhoiHanh->getAllTour();
        $hdv = $this->doanKhoiHanh->getAllHDV();
        $taixe = $this->doanKhoiHanh->getAllNhaXe();

        include './views/Admin/Doan/editDoan.php';
    }

    public function updateDKH()
    {
        if (isset($_POST['btnUpdate'])) {

            $this->doanKhoiHanh->updateDKH($_POST);

            header("Location:index.php?act=listDKH");
            exit;
        }
    }

   public function chiTietDKH()
{
    if (!isset($_GET['id'])) {
        header("Location:index.php?act=listDKH");
        exit;
    }

    $id = $_GET['id'];

    // Lấy thông tin đoàn
    $doan = $this->doanKhoiHanh->getDoanById($id);
    if (!$doan) {
        die("Đoàn không tồn tại");
    }

    // Lấy thông tin tour
    $tour = $this->doanKhoiHanh->getTourById($doan['MaTour']);

    // Lấy hướng dẫn viên nếu có
    $hdv = null;
    if (!empty($doan['MaHuongDanVien'])) {
        $hdv = $this->doanKhoiHanh->getHDVById($doan['MaHuongDanVien']);
    }

    // Lấy tài xế nếu có
    $taixe = null;
    if (!empty($doan['MaTaiXe'])) {
        $taixe = $this->doanKhoiHanh->getTaiXeByDoan($id);
    }

    // Lịch trình của tour
    $lichtrinh = $this->doanKhoiHanh->getLichTrinhByTour($doan['MaTour']);

    // KHÔNG có bảng ncc theo ngày → để rỗng để tránh lỗi
    $nccTheoNgay = [];

    include './views/Admin/Doan/chiTietDoan.php';
}

}

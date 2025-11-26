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
        include './views/Admin/Doan/listDoan.php';
    }

    public function createDKH()
{
    $tour = $this->doanKhoiHanh->getAllTour();
    $hdv = $this->doanKhoiHanh->getAllHDV();
    $taixe = $this->doanKhoiHanh->getAllNhaXe();

    $tourSelected = null;

    // Khi chọn tour nhưng chưa bấm "Thêm"
    if (!empty($_POST['MaTour']) && !isset($_POST['btnSave'])) {
        foreach ($tour as $t) {
            if ($t['MaTour'] == $_POST['MaTour']) {
                $tourSelected = $t;
                break;
            }
        }
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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
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
}



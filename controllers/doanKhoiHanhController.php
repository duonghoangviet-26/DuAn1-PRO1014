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
        include './views/Admin/Doan/listDoan.php';
    }

    public function createDKH()
    {
        $tour = $this->doanKhoiHanh->getAllTour();
        $hdv = $this->doanKhoiHanh->getAllHDV();
        $taixe = $this->doanKhoiHanh->getAllNhaXe();

        if (isset($_POST['btnSave'])) {

            $MaDoan = $this->doanKhoiHanh->insertDoan([
                'MaTour' => $_POST['MaTour'],
                'NgayKhoiHanh' => $_POST['NgayKhoiHanh'],
                'NgayVe' => $_POST['NgayVe'],
                'GioKhoiHanh' => $_POST['GioKhoiHanh'],
                'DiemTapTrung' => $_POST['DiemTapTrung'],
                'SoChoToiDa' => $_POST['SoChoToiDa'],
                'MaHuongDanVien' => $_POST['MaHuongDanVien'],
                'MaTaiXe' => $_POST['MaTaiXe'],
            ]);
            $this->doanKhoiHanh->insertTaiXeChoDoan($MaDoan, $_POST['MaTaiXe'], $_POST['NgayKhoiHanh']);
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



<?php
class DiemDanhController
{
    public $modelDiemDanh;
    public $modelLichLamViec;

    public function __construct()
    {
        $this->modelDiemDanh = new DiemDanhModel();
        $this->modelLichLamViec = new lichLamViecModel();
    }

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'huong_dan_vien') { header("Location: index.php?act=login"); exit(); }
        if (!isset($_GET['id'])) { die("Thiếu mã lịch làm việc!"); }
        $maLich = $_GET['id'];
        $thongTinChung = $this->modelLichLamViec->getDetailLichLamViec($maLich);
        if (!$thongTinChung) { die("Không tìm thấy thông tin chuyến đi!"); }
        
        $maDoan = $thongTinChung['MaDoan'];
        $maTour = $thongTinChung['MaTour'];
        $listLichTrinh = $this->modelDiemDanh->getLichTrinhByTour($maTour);
        $selectedLichTrinh = (isset($_GET['id_lichtrinh']) && $_GET['id_lichtrinh'] != "") 
                              ? $_GET['id_lichtrinh'] 
                              : (!empty($listLichTrinh) ? $listLichTrinh[0]['MaLichTrinh'] : 0);
        
        $selectedBuoi = $_GET['buoi'] ?? 'sang';
        $currentLichTrinh = [];
        if ($selectedLichTrinh > 0) {
            $currentLichTrinh = $this->modelDiemDanh->getLichTrinhById($selectedLichTrinh);
        }
        $listKhach = $this->modelDiemDanh->getKhachByDoan($maDoan);
        $dataDiemDanh = $this->modelDiemDanh->getTrangThaiDiemDanh($selectedLichTrinh, $selectedBuoi);
        
        $ddStatus = [];
        foreach ($dataDiemDanh as $dd) {
            $ddStatus[$dd['MaKhachTrongBooking']] = $dd;
        }

        require_once "views/HDV/menu/quanLyKhach.php";
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maLichTrinh = $_POST['MaLichTrinh'];
            $maLichLamViec = $_POST['MaLichLamViec'];
            $buoi = $_POST['buoi'];
            
            $attendanceData = $_POST['attendance'] ?? []; 
            $notes = $_POST['note'] ?? [];

            foreach ($attendanceData as $maKhach => $trangThai) {
                $ghiChu = $notes[$maKhach] ?? '';
                $this->modelDiemDanh->saveDiemDanh($maLichTrinh, $maKhach, $trangThai, $ghiChu, $buoi);
            }

            echo "<script>
                    alert('Đã lưu điểm danh buổi " . strtoupper($buoi) . " thành công!'); 
                    window.location.href='index.php?act=hdv_quanlykhach&id=$maLichLamViec&id_lichtrinh=$maLichTrinh&buoi=$buoi';
                  </script>";
        }
    }

    public function viewGuestList() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'huong_dan_vien') {
            header("Location: index.php?act=login"); exit();
        }

        if (!isset($_GET['id'])) {
            die("Thiếu mã lịch làm việc!");
        }
        $maLich = $_GET['id'];

        $model = new lichLamViecModel();
        $modelDD = new DiemDanhModel();
        $thongTinChung = $model->getDetailLichLamViec($maLich);
        if (!$thongTinChung) { die("Không tìm thấy thông tin chuyến đi!"); }
        $maDoan = $thongTinChung['MaDoan'];
        $listKhach = $modelDD->getKhachByDoan($maDoan);
        require_once "views/HDV/menu/danhSachKhach.php";
    }
}
?>
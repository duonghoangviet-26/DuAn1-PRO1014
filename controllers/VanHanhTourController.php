<?php
class VanHanhTourController {
    public $modelVanHanh;
    public $modelLichLamViec;

    public function __construct() {
        $this->modelVanHanh = new VanHanhTourModel();
        $this->modelLichLamViec = new lichLamViecModel();
    }

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'huong_dan_vien') { 
            header("Location: index.php?act=login"); exit(); 
        }
        
        if (!isset($_GET['id'])) { die("Thiếu mã lịch làm việc!"); }
        $maLich = $_GET['id'];
        $thongTinChung = $this->modelLichLamViec->getDetailLichLamViec($maLich);
        if (!$thongTinChung) { die("Không tìm thấy thông tin chuyến đi!"); }
        $maDoan = $thongTinChung['MaDoan'];
        $maTaiKhoan = $_SESSION['user']['MaTaiKhoan'] ?? 0;
        $listTaiChinh = $this->modelVanHanh->getTaiChinhByDoan($maDoan);
        
        $tongThu = 0;
        $tongChi = 0;
        foreach($listTaiChinh as $tc) {
            if($tc['LoaiGiaoDich'] == 'thu') $tongThu += $tc['SoTien'];
            else $tongChi += $tc['SoTien'];
        }
        $conLai = $tongThu - $tongChi;

        $listSuCo = $this->modelVanHanh->getThongBaoByTaiKhoan($maTaiKhoan);
        $listNhaCungCap = $this->modelVanHanh->getNhaCungCapByDoan($maDoan);
        require_once "views/HDV/menu/vanHanhTour.php";
    }

    public function addTransaction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maLich = $_POST['MaLichLamViec'];
            $maDoan = $_POST['MaDoan'];
            
            $loaiGD = $_POST['LoaiGiaoDich'];
            $hangMuc = $_POST['HangMucChi'];
            $soTien = $_POST['SoTien'];
            $ngayGD = $_POST['NgayGiaoDich'];
            $moTa = $_POST['MoTa'];
            $phuongThuc = $_POST['PhuongThuc'];
            $soHoaDon = $_POST['SoHoaDon'];
            
            $maNguoiTao = $_SESSION['user']['MaTaiKhoan'] ?? 0;

            $this->modelVanHanh->addTaiChinh($maDoan, $loaiGD, $hangMuc, $soTien, $ngayGD, $moTa, $phuongThuc, $soHoaDon, $maNguoiTao);
            
            header("Location: index.php?act=hdv_vanhanh&id=$maLich");
        }
    }
    
    public function deleteTransaction() {
        if(isset($_GET['id_tc']) && isset($_GET['id_lich'])) {
            $this->modelVanHanh->deleteTaiChinh($_GET['id_tc']);
            header("Location: index.php?act=hdv_vanhanh&id=" . $_GET['id_lich']);
        }
    }
}
?>
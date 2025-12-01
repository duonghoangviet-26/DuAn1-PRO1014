<?php

class lichLamViecController
{
    public function lichLamViec()
    {
        $model = new lichLamViecModel();

        if (!isset($_GET['id'])) {
            die("Không tìm thấy nhân viên!");
        }

        $MaNhanVien = $_GET['id'];
        $ds_lich = $model->getLichByNhanVien($MaNhanVien);
        $nhanvien = $model->getNhanVienById($MaNhanVien);

        require_once "views/Admin/LichLamViec/LichLamViec.php";
    }


    public function addForm()
    {
        $model = new lichLamViecModel();
        if (isset($_GET['idNV'])) {
            $idNV = $_GET['idNV'];
            $nhanVienHienTai = $model->getNhanVienById($idNV);
        } else {
            die("Chưa chọn nhân viên để phân công!");
        }
        $doan = $model->getDoanByNhanVien($idNV);
        
        require_once "views/Admin/LichLamViec/addLichLamViec.php";
    }

    public function add()
    {
        if (!isset($_POST['MaDoan']) || !isset($_POST['MaNhanVien'])) {
            die("Thiếu dữ liệu!");
        }
        $MaDoan = $_POST['MaDoan'];
        $MaNhanVien = $_POST['MaNhanVien'];
        $GhiChu = $_POST['GhiChu'] ?? ''; 
        $TrangThai = $_POST['TrangThai'] ?? 'ranh';
        $model = new lichLamViecModel();
        $doanCheck = $model->getDoanById($MaDoan);
        if ($doanCheck['MaHuongDanVien'] != $MaNhanVien) {
            echo "<script>alert('Lỗi: Nhân viên này không thuộc đoàn đã chọn!'); history.back();</script>";
            exit();
        }
        $NgayKhoiHanh = $doanCheck['NgayKhoiHanh'];
        $result = $model->insertLich($MaNhanVien, $MaDoan, $NgayKhoiHanh, $GhiChu, $TrangThai);

        if ($result) {
            header("Location: index.php?act=lichlamviec&id=" . $MaNhanVien);
            exit();
        } else {
            die("Lỗi khi thêm lịch làm việc!");
        }
    }

    public function editForm()
    {
        if (!isset($_GET['MaLichLamViec'])) { die("Không tìm thấy lịch!"); }
        $model = new lichLamViecModel();
        $MaLich = $_GET['MaLichLamViec'];
        $lich = $model->getLichById($MaLich);
        $nhanVienHienTai = $model->getNhanVienById($lich['MaNhanVien']); 
        $doanHienTai = $model->getDoanById($lich['MaDoan']);
        $nhanVienHienTai = $model->getNhanVienById($lich['MaNhanVien']); 
        require_once "views/Admin/LichLamViec/editLichLamViec.php";
    }

    public function edit()
    {
        $MaLich = $_POST['MaLichLamViec'];
        $MaNhanVien = $_POST['MaNhanVien'];
        $MaDoan = $_POST['MaDoan'];
        $GhiChu = $_POST['GhiChu'] ?? ''; 
        $TrangThai = $_POST['TrangThai'];
        $model = new lichLamViecModel();
        $doan = $model->getDoanById($MaDoan);
        $NgayKhoiHanh = $doan['NgayKhoiHanh'];
        $model->updateLich($MaLich, $MaNhanVien, $MaDoan, $NgayKhoiHanh, $GhiChu, $TrangThai);
        header("Location: index.php?act=lichlamviec&id=" . $MaNhanVien);
        exit();
    }


    public function delete()
    {
        if (!isset($_GET['id']) || !isset($_GET['MaLichLamViec'])) {
            die("Dữ liệu không hợp lệ!");
        }
        $MaNhanVien = $_GET['id'];
        $MaLichLamViec = $_GET['MaLichLamViec'];
        $model = new lichLamViecModel();
        if ($model->deleteLich($MaLichLamViec)) {
            header("Location: index.php?act=lichlamviec&id=" . $MaNhanVien);
            exit();
        } else {
            die("Lỗi: Không thể xóa lịch làm việc này.");
        }
    }

//Khu vực HDV
    public function mySchedule()
    {
        if (!isset($_SESSION['user']) || 
           ($_SESSION['user']['VaiTro'] !== 'huong_dan_vien' && $_SESSION['user']['VaiTro'] !== 'dieu_hanh')) {
            header("Location: index.php?act=login");
            exit();
        }

        if (isset($_SESSION['user']['MaNhanVien'])) {
            $maNhanVien = $_SESSION['user']['MaNhanVien'];
        } else {
            echo "<script>alert('Tài khoản này chưa liên kết với hồ sơ nhân viên!'); window.location.href='index.php';</script>";
            exit();
        }

        $model = new lichLamViecModel();
        $ds_lich = $model->getLichByNhanVien($maNhanVien);
        require_once "views/HDV/LT&LLV/LichTrinhVaLichLamViec.php";
    }
    public function getLichTrinhByTour() {
        if (!isset($_GET['id'])) { 
            echo "<script>alert('Thiếu mã lịch!'); window.location.href='index.php?act=hdv_schedule';</script>";
            exit();
        }
        $maLich = $_GET['id'];
        $model = new lichLamViecModel();
        $thongTinChung = $model->getDetailLichLamViec($maLich);

        if (!$thongTinChung) { 
            echo "<script>alert('Không tìm thấy thông tin chuyến đi!'); window.location.href='index.php?act=hdv_schedule';</script>";
            exit(); 
        }
        $maTour = $thongTinChung['MaTour'];
        $lichTrinhChiTiet = $model->getLichTrinhByTour($maTour);

        require_once "views/HDV/LT&LLV/chiTietLichTrinh.php";
    }
}

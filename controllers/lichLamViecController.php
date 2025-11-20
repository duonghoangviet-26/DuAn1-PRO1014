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

        require_once "views/Admin/LichLamViec/lichLamViec.php";
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !isset($_GET['MaLichLamViec'])) {
            die("Dữ liệu không hợp lệ!");
        }

        $MaNhanVien = $_GET['id'];
        $MaLichLamViec = $_GET['MaLichLamViec'];

        $model = new lichLamViecModel();
        $model->deleteLich($MaLichLamViec);

        header("Location: index.php?act=lichLamViec&id=" . $MaNhanVien);
        exit();
    }
    
}
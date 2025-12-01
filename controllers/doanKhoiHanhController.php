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

        $lichtrinh = [];
        $hotels = [];
        $restaurants = [];

        // Khi chọn tour nhưng chưa bấm "Thêm"
        if (!empty($_POST['MaTour']) && !isset($_POST['btnSave'])) {

            foreach ($tour as $t) {
                if ($t['MaTour'] == $_POST['MaTour']) {
                    $tourSelected = $t;
                    break;
                }
            }

            $lichtrinh = $this->doanKhoiHanh->getLichTrinhByTour($_POST['MaTour']);
            $hotels = $this->doanKhoiHanh->getNhaCungCapByType('khach_san');
            $restaurants = $this->doanKhoiHanh->getNhaCungCapByType('nha_hang');
        }

        // Khi bấm nút Thêm
        if (isset($_POST['btnSave'])) {
            // --- Tính toán số chỗ ---
            $soChoToiDa    = (int) $_POST['SoChoToiDa'];
            $soChoConTrong = $soChoToiDa; // khi mới tạo, số chỗ còn trống = tối đa

            // 1) LƯU ĐOÀN TRƯỚC
            $MaDoan = $this->doanKhoiHanh->insertDoan([
                'MaTour'         => $_POST['MaTour'],
                'NgayKhoiHanh'   => $_POST['NgayKhoiHanh'],
                'NgayVe'         => $_POST['NgayVe'],
                'GioKhoiHanh'    => $_POST['GioKhoiHanh'],
                'DiemTapTrung'   => $_POST['DiemTapTrung'],
                'SoChoToiDa'     => $soChoToiDa,
                'SoChoConTrong'  => $soChoConTrong,
                'MaHuongDanVien' => $_POST['MaHuongDanVien'],
                'MaTaiXe'        => $_POST['MaTaiXe'],
                'TrangThai'      => 'con_cho',
            ]);

            // 2) LƯU TÀI XẾ
            if (!empty($_POST['MaTaiXe'])) {
                $this->doanKhoiHanh->insertTaiXeChoDoan(
                    $MaDoan,
                    $_POST['MaTaiXe'],
                    $_POST['NgayKhoiHanh']
                );
            }


            // 3) LƯU KHÁCH SẠN THEO NGÀY
            if (!empty($_POST['khachsan'])) {
                foreach ($_POST['khachsan'] as $ngayThu => $maKS) {

                    if (!empty($maKS)) {

                        // Tính ngày sử dụng từ Ngày khởi hành
                        $NgaySuDung = date(
                            'Y-m-d',
                            strtotime($_POST['NgayKhoiHanh'] . " + " . ($ngayThu - 1) . " days")
                        );

                        $this->doanKhoiHanh->insertDichVuDoan(
                            $MaDoan,
                            $maKS,
                            'khach_san',
                            $NgaySuDung   // <-- Giờ là ngày thật
                        );
                    }
                }
            }

            if (!empty($_POST['nhahang'])) {
                foreach ($_POST['nhahang'] as $ngayThu => $maNH) {

                    if (!empty($maNH)) {

                        $NgaySuDung = date(
                            'Y-m-d',
                            strtotime($_POST['NgayKhoiHanh'] . " + " . ($ngayThu - 1) . " days")
                        );

                        $this->doanKhoiHanh->insertDichVuDoan(
                            $MaDoan,
                            $maNH,
                            'nha_hang',
                            $NgaySuDung
                        );
                    }
                }
            }

            header("Location:index.php?act=listDKH");
            exit;
        }

        include './views/Admin/Doan/addDoan.php';
    }




    public function deleteDKH()
    {
        $id = $_GET['id'] ?? ($_GET['MaDoan'] ?? 0);

        if ($id) {
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
        $lichtrinh = $this->doanKhoiHanh->getLichTrinhByTour($doan['MaTour']);
        $hotels = $this->doanKhoiHanh->getNhaCungCapByType('khach_san');
        $restaurants = $this->doanKhoiHanh->getNhaCungCapByType('nha_hang');
        $hdv = $this->doanKhoiHanh->getAllHDV();
        $taixe = $this->doanKhoiHanh->getAllNhaXe();

        // LẤY KHÁCH SẠN / NHÀ HÀNG THEO NGÀY
        $dichvu = $this->doanKhoiHanh->getNCCTheoNgay($id);

        $dvMap = [];
        foreach ($dichvu as $dv) {
            $dvMap[$dv['NgayThu']][$dv['LoaiDichVu']] = $dv['MaNhaCungCap'];
        }


        include './views/Admin/Doan/editDoan.php';
    }


    public function updateDKH()
    {
        if (isset($_POST['btnUpdate'])) {

            $this->doanKhoiHanh->updateDKH($_POST);

            $MaDoan = $_POST['MaDoan'];
            $ngayKhoiHanh = $_POST['NgayKhoiHanh'];


            // Lưu khách sạn theo ngày
            if (!empty($_POST['khachsan'])) {
                foreach ($_POST['khachsan'] as $ngayThu => $maKS) {
                    if (!empty($maKS)) {
                        $NgaySuDung = date("Y-m-d", strtotime($ngayKhoiHanh . " + " . ($ngayThu - 1) . " days"));

                        $this->doanKhoiHanh->insertDichVuDoan(
                            $MaDoan,
                            $maKS,
                            'khach_san',
                            $NgaySuDung
                        );
                    }
                }
            }

            // Lưu nhà hàng theo ngày
            if (!empty($_POST['nhahang'])) {
                foreach ($_POST['nhahang'] as $ngayThu => $maNH) {
                    if (!empty($maNH)) {
                        $NgaySuDung = date("Y-m-d", strtotime($ngayKhoiHanh . " + " . ($ngayThu - 1) . " days"));

                        $this->doanKhoiHanh->insertDichVuDoan(
                            $MaDoan,
                            $maNH,
                            'nha_hang',
                            $NgaySuDung
                        );
                    }
                }
            }

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

        $nccTheoNgay = $this->doanKhoiHanh->getNCCTheoNgay($id);

        $khachSanDaChon = [];
        $nhaHangDaChon = [];

        foreach ($nccTheoNgay as $row) {
            if ($row['LoaiDichVu'] == 'khach_san') {
                $khachSanDaChon[$row['NgayThu']] = $row['MaNhaCungCap'];
            }
            if ($row['LoaiDichVu'] == 'nha_hang') {
                $nhaHangDaChon[$row['NgayThu']] = $row['MaNhaCungCap'];
            }
        }


        include './views/Admin/Doan/chiTietDoan.php';
    }



    // Get doan by Tour 
    public function getDoanByTour()
    {
        $maTour = $_GET['MaTour'] ?? 0;

        $doanModel = new doanKhoiHanhModel();
        $listDoan = $doanModel->getDoanByTour($maTour);

        echo json_encode($listDoan);
        exit;
    }
}

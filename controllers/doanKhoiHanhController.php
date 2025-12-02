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

        $doan = $this->doanKhoiHanh->getDoanById($id);
        if (!$doan) {
            die("Đoàn không tồn tại");
        }

        $tour = $this->doanKhoiHanh->getTourById($doan['MaTour']);

        $hdv = null;
        if (!empty($doan['MaHuongDanVien'])) {
            $hdv = $this->doanKhoiHanh->getHDVById($doan['MaHuongDanVien']);
        }

        $taixe = null;
        if (!empty($doan['MaTaiXe'])) {
            $taixe = $this->doanKhoiHanh->getTaiXeByDoan($id);
        }

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

    public function taichinh()
    {
        if (!isset($_GET['id'])) {
            header("Location:index.php?act=listDKH");
            exit;
        }

        $MaDoan = $_GET['id'];

        $thu  = $this->doanKhoiHanh->getTongThu($MaDoan);
        $chi  = $this->doanKhoiHanh->getTongChi($MaDoan);
        $list = $this->doanKhoiHanh->getAllTaiChinh($MaDoan);

        $tongthu  = $thu['TongThu'] ?? 0;
        $tongchi  = $chi['TongChi'] ?? 0;
        $loinhuan = $tongthu - $tongchi;

        include "./views/Admin/Doan/taichinh.php";
    }


    public function addTaiChinh()
    {
        $MaDoan = $_GET['id'];

        // Nếu submit form
        if (isset($_POST['btnSave'])) {

            $data = [
                'MaDoan'   => $MaDoan,
                'LoaiGiaoDich' => $_POST['LoaiGiaoDich'],
                'NgayGiaoDich' => $_POST['NgayGiaoDich'],
                'SoTien'   => $_POST['SoTien'],
                'HangMucChi' => $_POST['HangMucChi'],
                'PhuongThucThanhToan' => $_POST['PhuongThucThanhToan'],
                'SoHoaDon' => $_POST['SoHoaDon'],
                'MoTa'     => $_POST['MoTa'],
                'AnhChungTu' => null
            ];

            // Xử lý upload ảnh
            if (!empty($_FILES['AnhChungTu']['name'])) {
                $filename = time() . "_" . $_FILES['AnhChungTu']['name'];
                move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $filename);
                $data['AnhChungTu'] = $filename;
            }

            // Gọi model lưu DB
            $this->doanKhoiHanh->insertTaiChinh($data);

            header("Location:index.php?act=taichinh&id=" . $MaDoan);
            exit;
        }

        include "./views/Admin/Doan/addtaichinh.php";
    }
    public function deleteTaiChinh()
    {
        if (!isset($_GET['id']) || !isset($_GET['doan'])) {
            header("Location:index.php?act=listDKH");
            exit;
        }

        $id = $_GET['id']; 
        $MaDoan = $_GET['doan'];
        $data = $this->doanKhoiHanh->getTaiChinhById($id);

        if (!empty($data['AnhChungTu']) && file_exists("uploads/" . $data['AnhChungTu'])) {
            unlink("uploads/" . $data['AnhChungTu']);
        }

        $this->doanKhoiHanh->deleteTaiChinh($id);

        header("Location:index.php?act=taichinh&id=" . $MaDoan);
        exit;
    }
   public function editTaiChinh()
{
    if (!isset($_GET['id']) || !isset($_GET['doan'])) {
        header("Location:index.php?act=listDKH");
        exit;
    }

    $id = $_GET['id'];  
    $MaDoan = $_GET['doan'];

    $data = $this->doanKhoiHanh->getTaiChinhById($id);

    include "./views/Admin/Doan/editTaiChinh.php";
}

public function updateTaiChinh()
{
    if (!isset($_POST['btnUpdate'])) {
        header("Location:index.php?act=listDKH");
        exit;
    }

    $id     = $_POST['MaTaiChinh'];
    $MaDoan = $_POST['MaDoan'];

    $AnhChungTu = $_POST['AnhCu'];

    if (!empty($_FILES['AnhChungTu']['name'])) {

        if (!empty($AnhChungTu) && file_exists("uploads/" . $AnhChungTu)) {
            unlink("uploads/" . $AnhChungTu);
        }

        $AnhChungTu = time() . "_" . $_FILES['AnhChungTu']['name'];
        move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $AnhChungTu);
    }

    $data = [
        'LoaiGiaoDich' => $_POST['LoaiGiaoDich'],
        'NgayGiaoDich' => $_POST['NgayGiaoDich'],
        'SoTien'       => $_POST['SoTien'],
        'HangMucChi'   => $_POST['HangMucChi'],
        'PhuongThucThanhToan' => $_POST['PhuongThucThanhToan'],
        'SoHoaDon'     => $_POST['SoHoaDon'],
        'AnhChungTu'   => $AnhChungTu,
        'MoTa'         => $_POST['MoTa']
    ];

    $this->doanKhoiHanh->updateTaiChinhById($id, $data);

    header("Location:index.php?act=taichinh&id=" . $MaDoan);
    exit;
}

}

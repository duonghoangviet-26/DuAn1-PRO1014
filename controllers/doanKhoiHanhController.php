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
        $this->doanKhoiHanh->autoUpdateTrangThai();


        foreach ($listDoan as $d) {
            $this->doanKhoiHanh->updateSoChoConTrong($d['MaDoan']);
        }

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

        $tour = $this->doanKhoiHanh->getAllTour();
        $errors = [];

        if (isset($_POST['btnSave'])) {

            //  Validate 
            if (empty($_POST['MaTour'])) $errors[] = "Vui lòng chọn tour.";
            if (empty($_POST['NgayKhoiHanh'])) $errors[] = "Ngày khởi hành không được để trống.";
            if (empty($_POST['NgayVe'])) $errors[] = "Ngày về không được để trống.";
            if (empty($_POST['GioKhoiHanh'])) $errors[] = "Vui lòng nhập giờ khởi hành.";
            if (empty($_POST['DiemTapTrung'])) $errors[] = "Điểm tập trung không được để trống.";

            if (empty($_POST['SoChoToiDa'])) {
                $errors[] = "Số chỗ tối đa không được để trống.";
            } else if (!is_numeric($_POST['SoChoToiDa']) || $_POST['SoChoToiDa'] <= 0) {
                $errors[] = "Số chỗ tối đa phải là số nguyên dương.";
            }

            if (empty($errors)) {

                // Lấy thông tin tour từ DB
                $tourInfo = $this->doanKhoiHanh->getTourById($_POST['MaTour']);

                $tourStart = strtotime($tourInfo['NgayBatDau']);
                $tourEnd   = strtotime($tourInfo['NgayKetThuc']);

                $doanStart = strtotime($_POST['NgayKhoiHanh']);
                $doanEnd   = strtotime($_POST['NgayVe']);

                //  Ngày khởi hành đoàn < ngày bắt đầu tour
                if ($doanStart < $tourStart) {
                    $errors[] = "Ngày khởi hành đoàn phải từ " . $tourInfo['NgayBatDau'] . " trở đi.";
                }

                //  Ngày khởi hành đoàn > ngày kết thúc tour
                if ($doanStart > $tourEnd) {
                    $errors[] = "Ngày khởi hành đoàn phải trước hoặc bằng ngày " . $tourInfo['NgayKetThuc'] . ".";
                }

                //  Ngày về đoàn lớn hơn ngày kết thúc tour
                if ($doanEnd > $tourEnd) {
                    $errors[] = "Ngày về của đoàn không được sau ngày kết thúc tour (" . $tourInfo['NgayKetThuc'] . ").";
                }

                //  Ngày về < ngày đi
                if ($doanEnd < $doanStart) {
                    $errors[] = "Ngày về không được nhỏ hơn ngày khởi hành.";
                }

                // //  Ngày khởi hành không được là ngày quá khứ
                // if ($doanStart < strtotime(date('Y-m-d'))) {
                //     $errors[] = "Ngày khởi hành không được ở quá khứ.";
                // }
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);
                include './views/Admin/Doan/addDoan.php';
                return;
            }

            $MaDoan = $this->doanKhoiHanh->insertDoan([
                'MaTour'        => $_POST['MaTour'],
                'NgayKhoiHanh'  => $_POST['NgayKhoiHanh'],
                'NgayVe'        => $_POST['NgayVe'],
                'GioKhoiHanh'   => $_POST['GioKhoiHanh'],
                'DiemTapTrung'  => $_POST['DiemTapTrung'],
                'SoChoToiDa'    => $_POST['SoChoToiDa'],
                'SoChoConTrong' => $_POST['SoChoToiDa'],
                'TrangThai'     => 'san_sang',
                'MaHuongDanVien' => null,
                'MaTaiXe' => $_POST['MaTaiXe'],
            ]);
            if (!empty($_POST['MaTaiXe'])) {
                $this->doanKhoiHanh->insertTaiXeChoDoan($MaDoan, $_POST['MaTaiXe'], $_POST['NgayKhoiHanh']);
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
            $taixe = $this->doanKhoiHanh->getTaiXeById($doan['MaTaiXe']);
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

    //tai chính
    public function taichinh()
    {
        if (!isset($_GET['id'])) {
            header("Location:index.php?act=listDKH");
            exit;
        }
        $MaDoan = $_GET['id'];
        $thu = $this->doanKhoiHanh->getTongThu($MaDoan);
        $chi = $this->doanKhoiHanh->getTongChi($MaDoan);
        $tongthu = $thu['TongThu'] ?? 0;
        $tongchi = $chi['TongChi'] ?? 0;
        $doan = $this->doanKhoiHanh->getDoanById($MaDoan);
        $tour = $this->doanKhoiHanh->getTourById($doan['MaTour']);
        $giavon = $tour['GiaVonDuKien'] ?? 0;
        $soNguoi = $this->doanKhoiHanh->getTotalPeopleByDoan($MaDoan);
        $tongGiaVon = $giavon * $soNguoi;
        $loinhuan = $tongthu - $tongchi - $tongGiaVon;
        $list = $this->doanKhoiHanh->getAllTaiChinh($MaDoan);

        include "./views/Admin/Doan/taichinh.php";
    }


    public function addTaiChinh()
    {
        $MaDoan = $_GET['id'];

        if (isset($_POST['btnSave'])) {

            $filename = null;
            if (!empty($_FILES['AnhChungTu']['name'])) {
                $filename = time() . "_" . $_FILES['AnhChungTu']['name'];
                move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $filename);
            }

            $data = [
                'MaDoan' => $MaDoan,
                'LoaiGiaoDich' => $_POST['LoaiGiaoDich'],
                'NgayGiaoDich' => $_POST['NgayGiaoDich'],
                'SoTien' => $_POST['SoTien'],
                'HangMucChi' => $_POST['HangMucChi'],
                'PhuongThucThanhToan' => $_POST['PhuongThucThanhToan'],
                'SoHoaDon' => $_POST['SoHoaDon'],
                'AnhChungTu' => $filename,
                'MoTa' => $_POST['MoTa']
            ];

            $this->doanKhoiHanh->insertTaiChinh($data);

            header("Location:index.php?act=taichinh&id=" . $MaDoan);
            exit;
        }

        include "./views/Admin/Doan/addTaiChinh.php";
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

        $id = $_POST['MaTaiChinh'];
        $MaDoan = $_POST['MaDoan'];

        // Lấy dữ liệu cũ để so sánh
        $old = $this->doanKhoiHanh->getTaiChinhById($id);

        $oldImage = $_POST['AnhCu'];
        $newImage = $oldImage;

        if (!empty($_FILES['AnhChungTu']['name'])) {
            if ($oldImage && file_exists("uploads/" . $oldImage)) {
                unlink("uploads/" . $oldImage);
            }

            $newImage = time() . "_" . $_FILES['AnhChungTu']['name'];
            move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $newImage);
        }

        // Dữ liệu mới
        $data = [
            'LoaiGiaoDich' => $_POST['LoaiGiaoDich'],
            'NgayGiaoDich' => $_POST['NgayGiaoDich'],
            'SoTien' => $_POST['SoTien'],
            'HangMucChi' => $_POST['HangMucChi'],
            'PhuongThucThanhToan' => $_POST['PhuongThucThanhToan'],
            'SoHoaDon' => $_POST['SoHoaDon'],
            'AnhChungTu' => $newImage,
            'MoTa' => $_POST['MoTa']
        ];

        // TẠO LỊCH SỬ CHỈNH SỬA
        $changes = [];

        foreach ($data as $field => $newValue) {
            $oldValue = $old[$field] ?? '';

            if ($oldValue != $newValue) {
                $changes[] = [
                    'field' => $field,
                    'old'   => $oldValue,
                    'new'   => $newValue
                ];
            }
        }

        // Chỉ lưu lịch sử nếu có thay đổi
        if (!empty($changes)) {

            $tenNguoi = $_SESSION['user']['HoTen'] ?? 'Không rõ';
            $vaiTro   = $_SESSION['user']['VaiTro'] ?? 'khác';

            if ($vaiTro == 'admin') $vaiTroText = "Admin";
            else if ($vaiTro == 'huong_dan_vien') $vaiTroText = "HDV";
            else $vaiTroText = ucfirst($vaiTro);

            $nguoiSua = $vaiTroText . " (" . $tenNguoi . ")";

            $history = json_decode($old['LichSuChinhSua'] ?? '[]', true);

            // Thêm bản ghi mới
            $history[] = [
                'user' => $nguoiSua,
                'time' => date("d/m/Y H:i:s"),
                'changes' => $changes
            ];

            // Gán lại vào database
            $data['LichSuChinhSua'] = json_encode($history, JSON_UNESCAPED_UNICODE);
        }

        // Cập nhật DB
        $this->doanKhoiHanh->updateTaiChinhById($id, $data);


        header("Location:index.php?act=taichinh&id=" . $MaDoan);
        exit;
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
}

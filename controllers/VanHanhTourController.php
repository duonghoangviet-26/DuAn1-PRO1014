<?php
class VanHanhTourController
{
    public $modelVanHanh;
    public $modelLichLamViec;

    public function __construct()
    {
        $this->modelVanHanh = new VanHanhTourModel();
        $this->modelLichLamViec = new lichLamViecModel();
    }

    public function index()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] !== 'huong_dan_vien') {
            header("Location: index.php?act=login");
            exit();
        }

        $maLich = $_GET['id'] ?? 0;
        $thongTinChung = $this->modelLichLamViec->getDetailLichLamViec($maLich);

        if (!$thongTinChung) die("Không tìm thấy thông tin chuyến đi!");

        $maDoan = $thongTinChung['MaDoan'];
        $maTaiKhoan = $_SESSION['user']['MaTaiKhoan'];

        $listTaiChinh = $this->modelVanHanh->getTaiChinhByDoan($maDoan);
        $listNhaCungCap = $this->modelVanHanh->getNhaCungCapByDoan($maDoan);

        require_once "views/HDV/menu/vanHanhTour.php";
    }

    //      CREATE
    public function addTransaction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $maNguoiTao = $_SESSION['user']['MaNhanVien'] ?? NULL;

            // XỬ LÝ UPLOAD ẢNH
            $filename = NULL;
            if (!empty($_FILES['AnhChungTu']['name'])) {
                $filename = time() . "_" . $_FILES['AnhChungTu']['name'];
                move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $filename);
            }

            $this->modelVanHanh->addTaiChinh(
                $_POST['MaDoan'],
                $_POST['LoaiGiaoDich'],
                $_POST['HangMucChi'],
                $_POST['SoTien'],
                $_POST['NgayGiaoDich'],
                $_POST['MoTa'],
                $_POST['PhuongThuc'],
                $_POST['SoHoaDon'],
                $maNguoiTao,
                $filename
            );

            header("Location: index.php?act=hdv_vanhanh&id=" . $_POST['MaLichLamViec']);
        }
    }


    //      DELETE
    public function deleteTransaction()
    {
        if (isset($_GET['id_tc'], $_GET['id_lich'])) {
            $this->modelVanHanh->deleteTaiChinh($_GET['id_tc']);
            header("Location: index.php?act=hdv_vanhanh&id=" . $_GET['id_lich']);
        }
    }
    //      EDIT FORM
    public function editForm()
    {
        $id = $_GET['id'] ?? 0;
        $maLich = $_GET['lich'] ?? 0;

        $data = $this->modelVanHanh->getTaiChinhById($id);

        if (!$data) die("Không tìm thấy giao dịch!");

        $maDoan = $data['MaDoan'];

        require_once "views/HDV/menu/editVanHanhTour.php";
    }
    //      UPDATE
    public function updateTransaction()
    {
        $id     = $_POST['MaTaiChinh'];
        $maDoan = $_POST['MaDoan'];
        $maLich = $_POST['MaLichLamViec'];

        // Ảnh cũ
        $anhCu = $_POST['AnhCu'];
        $anhMoi = $anhCu;

        // Xử lý upload ảnh mới
        if (!empty($_FILES['AnhChungTu']['name'])) {
            $filename = time() . "_" . $_FILES['AnhChungTu']['name'];
            move_uploaded_file($_FILES['AnhChungTu']['tmp_name'], "uploads/" . $filename);
            $anhMoi = $filename;
        }

        // Dữ liệu cũ
        $oldData = $this->modelVanHanh->getTaiChinhById($id);

        $fields = [
            "LoaiGiaoDich" => "Loại giao dịch",
            "HangMucChi" => "Hạng mục",
            "SoTien" => "Số tiền",
            "NgayGiaoDich" => "Ngày GD",
            "MoTa" => "Ghi chú",
            "PhuongThucThanhToan" => "Phương thức",
            "SoHoaDon" => "Hóa đơn"
        ];

        $changes = [];

        foreach ($fields as $key => $label) {
            if ($oldData[$key] != $_POST[$key]) {
                $changes[] = [
                    "field" => $label,
                    "old"   => $oldData[$key],
                    "new"   => $_POST[$key]
                ];
            }
        }

        // Lấy lịch sử cũ
        $oldLog = $this->modelVanHanh->getLogById($id);
        $oldLog = $oldLog ? json_decode($oldLog, true) : [];

        /* 🔥 LẤY NGƯỜI SỬA + VAI TRÒ */
        $tenNguoi = $_SESSION['user']['HoTen'] ?? 'Không rõ';
        $vaiTro   = $_SESSION['user']['VaiTro'] ?? 'khac';

        if ($vaiTro === 'admin') $vaiTroText = "Admin";
        elseif ($vaiTro === 'huong_dan_vien') $vaiTroText = "HDV";
        else $vaiTroText = ucfirst($vaiTro);

        $nguoiSua = $vaiTroText . " (" . $tenNguoi . ")";

        // Nếu có thay đổi → ghi lịch sử
        if (!empty($changes)) {
            $oldLog[] = [
                "user" => $nguoiSua,
                "time" => date("d/m/Y H:i:s"),
                "changes" => $changes
            ];
        }

        $logJSON = json_encode($oldLog, JSON_UNESCAPED_UNICODE);

        // Cập nhật DB
        $this->modelVanHanh->updateTaiChinhFull(
            $id,
            $_POST['LoaiGiaoDich'],
            $_POST['HangMucChi'],
            $_POST['SoTien'],
            $_POST['NgayGiaoDich'],
            $_POST['MoTa'],
            $_POST['PhuongThucThanhToan'],
            $_POST['SoHoaDon'],
            $anhMoi,
            $logJSON
        );

        header("Location: index.php?act=hdv_vanhanh&id=" . $maLich);
    }


    public function addForm()
    {
        $maDoan = $_GET['doan'];
        $maLich = $_GET['lich'];

        require_once "views/HDV/menu/addVanHanhTour.php";
    }
    public function viewLog()
    {
        $id_tc = $_GET['id_tc'];
        $maDoan = $_GET['doan'];

        $history = $this->modelVanHanh->getLogByTransaction($maDoan, $id_tc);

        require_once "views/HDV/menu/lichSuTaiChinh.php";
    }
}

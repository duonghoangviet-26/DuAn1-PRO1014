<?php
class bookingController
{
    public $modelBooking;
    public $modelTour;
    public $modelNhanVien;
    public $doanKhoiHanh;
    public  $khachHangModel;

    public function __construct()
    {
        $this->modelBooking = new bookingModel();
        $this->modelNhanVien = new nhanVienModel();
        $this->modelTour = new tourModel();
        $this->doanKhoiHanh = new doanKhoiHanhModel();
        $this->khachHangModel = new khachHangModel();
    }

    public function listBookingAll()
    {
        $filters = [
            'TrangThai' => $_GET['status'] ?? 'all',
            'search' => $_GET['search'] ?? ''
        ];

        $bookings = $this->modelBooking->getAllBooking($filters);
        $statistics = $this->modelBooking->getStatistics();

        require_once './views/Admin/booking/list.php';
    }

    public function deleteBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;
        if ($MaBooking) {
            $this->modelBooking->deleteBooking($MaBooking);
        }
        header("Location: index.php?act=listBooking");
        exit();
    }

    public function createBooking()
    {
        $tours = $this->modelTour->getAllTours();
        $khachHangs = $this->modelTour->getAllKhachHang();
        $listDoan = $this->doanKhoiHanh->getAllDoan();
        require_once './views/Admin/booking/addBooking.php';
    }
    public function createBookingProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $MaCodeBooking = !empty($_POST['MaCodeBooking'])
                ? $_POST['MaCodeBooking']
                : 'BK' . date('YmdHis');
            $MaTour         = $_POST['MaTour'] ?? null;
            $MaDoan         = $_POST['MaDoan'] ?? null;
            $MaKhachHang    = $_POST['MaKhachHang'] ?? null;

            $LoaiBooking    = $_POST['LoaiBooking'] ?? 'ca_nhan';
            $TongNguoiLon   = (int)($_POST['TongNguoiLon'] ?? 0);
            $TongTreEm      = (int)($_POST['TongTreEm'] ?? 0);
            $TongEmBe       = (int)($_POST['TongEmBe'] ?? 0);

            $TongTien       = (float)($_POST['TongTien'] ?? 0);
            $SoTienDaCoc    = (float)($_POST['SoTienDaCoc'] ?? 0);
            $SoTienDaTra    = (float)($_POST['SoTienDaTra'] ?? 0);
            $SoTienConLai   = $TongTien - $SoTienDaTra;
            $TrangThai = $_POST['TrangThai'] ?? 'cho_coc';

            $YeuCauDacBiet  = $_POST['YeuCauDacBiet'] ?? null;
            $MaNguoiTao     = 1;

            $data = [
                ':MaCodeBooking' => $MaCodeBooking,
                ':MaTour' => $MaTour,
                ':MaDoan' => $MaDoan,
                ':MaKhachHang' => $MaKhachHang,
                ':LoaiBooking' => $LoaiBooking,
                ':TongNguoiLon' => $TongNguoiLon,
                ':TongTreEm' => $TongTreEm,
                ':TongEmBe' => $TongEmBe,
                ':TongTien' => $TongTien,
                ':SoTienDaCoc' => $SoTienDaCoc,
                ':SoTienDaTra' => $SoTienDaTra,
                ':SoTienConLai' => $SoTienConLai,
                ':TrangThai' => $TrangThai,
                ':YeuCauDacBiet' => $YeuCauDacBiet,
                ':MaNguoiTao' => $MaNguoiTao,
            ];


            // Chèn booking
            $this->modelBooking->createBooking($data);

            // Redirect đúng
            header("Location: index.php?act=listBooking");
            exit;
        }
    }

    public function editBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;

        if ($MaBooking) {
            // Lấy dữ liệu booking để đổ ra form
            $booking = $this->modelBooking->getOneBooking($MaBooking);
            $tours = $this->modelTour->getAllTours();
            $khachHangs = $this->modelTour->getAllKhachHang();
            $listDoan = $this->doanKhoiHanh->getAllDoan();

            require_once './views/Admin/booking/editBooking.php';
        } else {
            header("Location: index.php?act=listBooking");
            exit();
        }
    }


    public function editBookingProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaBooking = $_POST['MaBooking'];

            $oldBooking = $this->modelBooking->getOneBooking($MaBooking);
            $TrangThaiCu = $oldBooking['TrangThai'] ?? 'cho_coc';

            $MaTour = $_POST['MaTour'] ?: null;
            $MaDoan = $_POST['MaDoan'] ?: null;
            $MaKhachHang = $_POST['MaKhachHang'] ?: null;
            $LoaiBooking = $_POST['LoaiBooking'] ?? 'ca_nhan';

            $TongNguoiLon = (int)($_POST['TongNguoiLon'] ?? 0);
            $TongTreEm = (int)($_POST['TongTreEm'] ?? 0);
            $TongEmBe = (int)($_POST['TongEmBe'] ?? 0);

            $TongTien = (float)($_POST['TongTien'] ?? 0);
            $SoTienDaCoc = (float)($_POST['SoTienDaCoc'] ?? 0);
            $SoTienDaTra = (float)($_POST['SoTienDaTra'] ?? 0);

            $SoTienConLai = $TongTien - $SoTienDaTra;

            $YeuCauDacBiet = $_POST['YeuCauDacBiet'] ?? null;
            $TrangThai = $_POST['TrangThai'] ?? 'cho_coc';

            $data = [
                ':MaBooking' => $MaBooking,
                ':MaTour' => $MaTour,
                ':MaDoan' => $MaDoan,
                ':MaKhachHang' => $MaKhachHang,
                ':LoaiBooking' => $LoaiBooking,
                ':TongNguoiLon' => $TongNguoiLon,
                ':TongTreEm' => $TongTreEm,
                ':TongEmBe' => $TongEmBe,
                ':TongTien' => $TongTien,
                ':SoTienDaCoc' => $SoTienDaCoc,
                ':SoTienDaTra' => $SoTienDaTra,
                ':SoTienConLai' => $SoTienConLai,
                ':YeuCauDacBiet' => $YeuCauDacBiet,
                ':TrangThai' => $TrangThai,
            ];

            $this->modelBooking->updateBooking($data);

            // Nếu trạng thái thay đổi thì lưu lịch sử
            // if ($TrangThaiCu != $TrangThai) {
            //     $MaNguoiDoi = 1; // sau này lấy từ session
            //     $this->modelBooking->addLichSuTrangThai($MaBooking, $TrangThaiCu, $TrangThai, $MaNguoiDoi, null);
            // }

            header("Location: index.php?act=listBooking");
            exit();
        }
    }



    // Khách trong Booking
    public function khachTrongBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;
        if (!$MaBooking) {
            header("Location: ?act=listBooking");
            exit();
        }
        $booking = $this->modelBooking->getBookingDetailWithDoan($MaBooking);
        $listKhach = $this->modelBooking->getKhachTrongBooking($MaBooking);
        require_once './views/Admin/booking/khachTrongBooking.php';
    }

    public function deleteKhachTrongBooking()
    {
        $MaKhachTrongBooking = $_GET['MaKhachTrongBooking'] ?? null;
        $MaBooking = $_GET['MaBooking'] ?? null;

        if ($MaKhachTrongBooking) {
            $this->modelBooking->deleteKhachTrongBooking($MaKhachTrongBooking);
        }

        header("Location: index.php?act=khachTrongBooking&MaBooking=$MaBooking");
        exit();
    }

    public function createKhachTrongBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;
        if (!$MaBooking) {
            header("Location: ?act=listBooking");
            exit();
        }

        $booking = $this->modelBooking->getBookingDetailWithDoan($MaBooking);

        $TongNguoiLon = isset($booking['TongNguoiLon']) ? (int)$booking['TongNguoiLon'] : 0;
        $TongTreEm = isset($booking['TongTreEm']) ? (int)$booking['TongTreEm'] : 0;
        $TongEmBe = isset($booking['TongEmBe']) ? (int)$booking['TongEmBe'] : 0;

        $soToiDa = $TongNguoiLon + $TongTreEm + $TongEmBe;

        $soHienTai = $this->modelBooking->countKhachTrongBooking($MaBooking);

        if ($soHienTai >= $soToiDa) {
            $_SESSION['error'] = "Booking này chỉ cho phép {$soToiDa} khách. Bạn đã đủ số lượng.";
            header("Location: index.php?act=khachTrongBooking&MaBooking=$MaBooking");
            exit();
        }

        require_once './views/Admin/booking/addKhachTrongBooking.php';
    }

    public function createKhachTrongBookingProcess()
    {
        if (session_status() == PHP_SESSION_NONE) session_start(); // ⬅️ Thêm dòng này

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaBooking = $_POST['MaBooking'];
            $booking = $this->modelBooking->getBookingDetailWithDoan($MaBooking);

            $TongNguoiLon = (int)($booking['TongNguoiLon'] ?? 0);
            $TongTreEm = (int)($booking['TongTreEm'] ?? 0);
            $TongEmBe = (int)($booking['TongEmBe'] ?? 0);

            $soToiDa = $TongNguoiLon + $TongTreEm + $TongEmBe;
            $soHienTai = $this->modelBooking->countKhachTrongBooking($MaBooking);

            if ($soHienTai >= $soToiDa) {
                $_SESSION['error'] = "Số lượng khách đã đạt tối đa ($soToiDa người). Không thể thêm nữa.";

                // Debug test
                echo "SESSION ID: " . session_id() . "<br>";
                print_r($_SESSION);
                exit();
            }

            $data = [
                ':MaBooking' => $MaBooking,
                ':HoTen' => $_POST['HoTen'],
                ':GioiTinh' => $_POST['GioiTinh'] ?? null,
                ':NgaySinh' => $_POST['NgaySinh'] ?: null,
                ':SoGiayTo' => $_POST['SoGiayTo'] ?? null,
                ':SoDienThoai' => $_POST['SoDienThoai'] ?? null,
                ':GhiChuDacBiet' => $_POST['GhiChuDacBiet'] ?? null,
                ':LoaiPhong' => $_POST['LoaiPhong'] ?? null,
            ];

            $this->modelBooking->createKhachTrongBooking($data);

            header("Location: index.php?act=khachTrongBooking&MaBooking=$MaBooking");
            exit();
        }
    }





    public function editKhachTrongBooking()
    {
        $MaKhach = $_GET['MaKhachTrongBooking'] ?? null;
        $MaBooking = $_GET['MaBooking'] ?? null;

        if (!$MaKhach || !$MaBooking) {
            header("Location: index.php?act=khachTrongBooking&MaBooking=$MaBooking");
            exit();
        }

        $khach = $this->modelBooking->getKhachById($MaKhach);
        $booking = $this->modelBooking->getBookingDetailWithDoan($MaBooking);

        require_once './views/Admin/booking/editKhachTrongBooking.php';
    }

    public function updateKhachTrongBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $MaKhach = $_POST['MaKhachTrongBooking'];
            $MaBooking = $_POST['MaBooking'];

            $data = [
                ':MaKhach' => $MaKhach,
                ':HoTen' => $_POST['HoTen'],
                ':GioiTinh' => $_POST['GioiTinh'],
                ':NgaySinh' => $_POST['NgaySinh'],
                ':SoGiayTo' => $_POST['SoGiayTo'],
                ':SoDienThoai' => $_POST['SoDienThoai'],
                ':GhiChuDacBiet' => $_POST['GhiChuDacBiet'],
                ':LoaiPhong' => $_POST['LoaiPhong'],
            ];

            $this->modelBooking->updateKhachTrongBooking($data);

            header("Location: index.php?act=khachTrongBooking&MaBooking=$MaBooking");
            exit();
        }
    }
}

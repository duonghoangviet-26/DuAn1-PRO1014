<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        $this->doanKhoiHanh->autoUpdateTrangThai();
        $tours = $this->modelTour->getAllTours();
        $khachHangs = $this->modelTour->getAllKhachHang();
        $listDoan = $this->doanKhoiHanh->getAllDoanDangHoatDong();
        require_once './views/Admin/booking/addBooking.php';
    }
    // public function createBookingProcess()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $MaDoan = $_POST['MaDoan'];
    //         $doanModel = new doanKhoiHanhModel();
    //         $soChoConTrong = (int)$_POST['SoChoConTrong'];

    //         $tongNguoiLon = (int)$_POST['TongNguoiLon'];
    //         $tongTreEm    = (int)$_POST['TongTreEm'];
    //         $tongEmBe     = (int)$_POST['TongEmBe'];

    //         $tongNguoi = $tongNguoiLon + $tongTreEm + $tongEmBe;
    //         if ($tongNguoi > $soChoConTrong) {
    //             if (session_status() === PHP_SESSION_NONE) session_start();

    //             $_SESSION['error'] = "Không thể tạo booking! Bạn đang đặt $tongNguoi khách nhưng đoàn chỉ còn $soChoConTrong chỗ.";

    //             header("Location: index.php?act=createBooking&MaDoan=" . $MaDoan);
    //             exit();
    //         }



    //         //  Lưu thông tin khách đại diện

    //         //  Tạo mã khách hàng đại diện
    //         $MaCodeKhachHang = "KH" . date("YmdHis");
    //         $data = [
    //             ':MaCodeKhachHang' => $MaCodeKhachHang,
    //             ':HoTen'           => $_POST['KH_HoTen'],
    //             ':SoDienThoai'     => $_POST['KH_SDT'],
    //             ':Email'           => $_POST['KH_Email'] ?? null,
    //             ':DiaChi'          => $_POST['KH_DiaChi'] ?? null,
    //             ':NgaySinh'        => $_POST['KH_NgaySinh'] ?? null,
    //             ':GioiTinh'        => $_POST['KH_GioiTinh'] ?? "khac",
    //             ':SoGiayTo'        => $_POST['KH_SoGiayTo'] ?? null,
    //             ':LoaiKhach'       => $_POST['LoaiKhach'],
    //             ':TenCongTy'       => ($_POST['LoaiKhach'] == 'cong_ty') ? ($_POST['KH_TenCongTy'] ?? null) : null,
    //             ':MaSoThue'        => ($_POST['LoaiKhach'] == 'cong_ty') ? ($_POST['KH_MaSoThue'] ?? null) : null,
    //             ':GhiChu'          => $_POST['KH_GhiChu'] ?? null
    //         ];

    //         // Lưu khách đại diện → lấy ID
    //         $khachHangModel = new khachHangModel();
    //         $MaKhachHang = $khachHangModel->creatKhachHang($data);


    //         // Xử lý tạo Booking nếu k tự ren ra mã booking 
    //         $MaCodeBooking = !empty($_POST['MaCodeBooking'])
    //             ? $_POST['MaCodeBooking']
    //             : 'BK' . date('YmdHis');

    //         $TongTien     = (float)($_POST['TongTien'] ?? 0);
    //         $SoTienDaCoc  = (float)($_POST['SoTienDaCoc'] ?? 0);
    //         // $SoTienDaTra  = (float)($_POST['SoTienDaTra'] ?? 0);
    //         $SoTienConLai = $TongTien - $SoTienDaCoc;
    //         if ($SoTienDaCoc == $TongTien) {
    //             $TrangThaiHopLe = "hoan_tat";
    //         } elseif ($SoTienDaCoc > 0) {
    //             $TrangThaiHopLe = "da_coc";
    //         } else {
    //             $TrangThaiHopLe = "cho_coc";
    //         }

    //         $TrangThaiUserChon = $_POST['TrangThai'] ?? 'cho_coc';

    //         // Nếu trạng thái người chọn k  hợp lệ -> báo lỗi
    //         if ($TrangThaiUserChon != $TrangThaiHopLe) {
    //             if (session_status() === PHP_SESSION_NONE) session_start();

    //             $_SESSION['error'] = "Trạng thái không hợp lệ với số tiền thanh toán!";
    //             header("Location: index.php?act=createBooking");
    //             exit();
    //         }
    //         $dataBooking = [
    //             ':MaCodeBooking' => $MaCodeBooking,
    //             ':MaTour'        => $_POST['MaTour'],
    //             ':MaDoan'        => $_POST['MaDoan'],
    //             ':MaKhachHang'   => $MaKhachHang,
    //             ':LoaiBooking'   => $_POST['LoaiBooking'],

    //             ':TongNguoiLon'  => $_POST['TongNguoiLon'],
    //             ':TongTreEm'     => $_POST['TongTreEm'],
    //             ':TongEmBe'      => $_POST['TongEmBe'],

    //             ':TongTien'      => $TongTien,
    //             ':SoTienDaCoc'   => $SoTienDaCoc,
    //             // ':SoTienDaTra'   => $SoTienDaTra,
    //             ':SoTienConLai'  => $SoTienConLai,

    //             ':TrangThai'     => $TrangThaiHopLe,
    //             ':YeuCauDacBiet' => $_POST['YeuCauDacBiet'] ?? null,
    //             ':MaNguoiTao'    => 1
    //         ];

    //         //  Lưu Booking → lấy ID
    //         $MaBooking = $this->modelBooking->createBooking($dataBooking);

    //         // Cập nhật số chỗ còn trống của đoàn
    //         $soChoMoi = $soChoConTrong - $tongNguoi;
    //         $doanModel->updateSoChoConTrong($MaDoan);
    //         $MaNguoiDoi = 1;


    //         // Lưu lịch sử trạng thái 
    //         $this->modelBooking->addLichSuTrangThai(
    //             $MaBooking,
    //             null,
    //             $TrangThaiHopLe,
    //             $MaNguoiDoi,
    //             'Tạo booking mới'
    //         );


    //         // lưu dữ liệu khách trong booking
    //         if (isset($_POST['khach']) && is_array($_POST['khach'])) {

    //             foreach ($_POST['khach'] as $kh) {

    //                 $this->modelBooking->insertKhach([
    //                     'MaBooking'      => $MaBooking,
    //                     'HoTen'          => $kh['HoTen'] ?? '',
    //                     'GioiTinh'       => $kh['GioiTinh'] ?? '',
    //                     'NgaySinh'       => $kh['NgaySinh'] ?? null,
    //                     'SoGiayTo'       => $kh['GiayTo'] ?? '',
    //                     'SoDienThoai'    => $kh['SDT'] ?? '',
    //                     'GhiChuDacBiet'  => $kh['GhiChu'] ?? '',
    //                     'LoaiPhong'      => $kh['LoaiPhong'] ?? 'don',
    //                 ]);
    //             }
    //         }


    //         header("Location: index.php?act=listBooking");
    //         exit;
    //     }
    // }

    public function createBookingProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $MaDoan = $_POST['MaDoan'];
            $doanModel = new doanKhoiHanhModel();
            $doanInfo = $doanModel->getOneDoan($MaDoan);

            if ($doanInfo['TrangThai'] !== 'san_sang') {
                $_SESSION['error'] = "Đoàn này không còn ở trạng thái sẵn sàng để booking!";
                header("Location: index.php?act=createBooking");
                exit();
            }
            $soChoConTrong = (int)$doanInfo['SoChoConTrong'];


            $tongNguoiLon = (int)$_POST['TongNguoiLon'];
            $tongTreEm    = (int)$_POST['TongTreEm'];
            $tongEmBe     = (int)$_POST['TongEmBe'];

            $tongNguoi = $tongNguoiLon + $tongTreEm + $tongEmBe;


            if ($tongNguoi > $soChoConTrong) {

                if (session_status() === PHP_SESSION_NONE) session_start();

                $_SESSION['error'] =
                    "Không thể tạo booking! Bạn đang đặt $tongNguoi khách nhưng đoàn chỉ còn $soChoConTrong chỗ.";

                header("Location: index.php?act=createBooking&MaDoan=" . $MaDoan);
                exit();
            }

            // tạo khách hàng đại diện
            $MaCodeKhachHang = "KH" . date("YmdHis");

            $data = [
                ':MaCodeKhachHang' => $MaCodeKhachHang,
                ':HoTen'           => $_POST['KH_HoTen'],
                ':SoDienThoai'     => $_POST['KH_SDT'],
                ':Email'           => $_POST['KH_Email'] ?? null,
                ':DiaChi'          => $_POST['KH_DiaChi'] ?? null,
                ':NgaySinh'        => $_POST['KH_NgaySinh'] ?? null,
                ':GioiTinh'        => $_POST['KH_GioiTinh'] ?? "khac",
                ':SoGiayTo'        => $_POST['KH_SoGiayTo'] ?? null,
                ':LoaiKhach'       => $_POST['LoaiKhach'],
                ':TenCongTy'       => ($_POST['LoaiKhach'] == 'cong_ty') ? ($_POST['KH_TenCongTy'] ?? null) : null,
                ':MaSoThue'        => ($_POST['LoaiKhach'] == 'cong_ty') ? ($_POST['KH_MaSoThue'] ?? null) : null,
                ':GhiChu'          => $_POST['KH_GhiChu'] ?? null
            ];

            $khachHangModel = new khachHangModel();
            $MaKhachHang = $khachHangModel->creatKhachHang($data);

            // Booking
            $MaCodeBooking = !empty($_POST['MaCodeBooking'])
                ? $_POST['MaCodeBooking']
                : 'BK' . date('YmdHis');

            $TongTien = (float)($_POST['TongTien'] ?? 0);
            $SoTienDaCoc = (float)($_POST['SoTienDaCoc'] ?? 0);
            $SoTienConLai = $TongTien - $SoTienDaCoc;

            // Xác định trạng thái hợp lệ
            if ($SoTienDaCoc == $TongTien) {
                $TrangThaiHopLe = "hoan_tat";
            } elseif ($SoTienDaCoc > 0) {
                $TrangThaiHopLe = "da_coc";
            } else {
                $TrangThaiHopLe = "cho_coc";
            }

            // Kiểm tra người dùng chọn sai trạng thái
            if (($_POST['TrangThai'] ?? 'cho_coc') != $TrangThaiHopLe) {
                if (session_status() === PHP_SESSION_NONE) session_start();

                $_SESSION['error'] = "Trạng thái không hợp lệ với số tiền thanh toán!";
                header("Location: index.php?act=createBooking");
                exit();
            }

            // dữ liệu booking
            $dataBooking = [
                ':MaCodeBooking' => $MaCodeBooking,
                ':MaTour'        => $_POST['MaTour'],
                ':MaDoan'        => $MaDoan,
                ':MaKhachHang'   => $MaKhachHang,
                ':LoaiBooking'   => $_POST['LoaiBooking'],
                ':TongNguoiLon'  => $tongNguoiLon,
                ':TongTreEm'     => $tongTreEm,
                ':TongEmBe'      => $tongEmBe,
                ':TongTien'      => $TongTien,
                ':SoTienDaCoc'   => $SoTienDaCoc,
                ':SoTienConLai'  => $SoTienConLai,
                ':TrangThai'     => $TrangThaiHopLe,
                ':YeuCauDacBiet' => $_POST['YeuCauDacBiet'] ?? null,
                ':MaNguoiTao'    => 1
            ];


            $MaBooking = $this->modelBooking->createBooking($dataBooking);


            // cập nhật số chỗ còn chôngs
            $soChoMoi = $soChoConTrong - $tongNguoi;

            $doanModel->updateSoChoConTrong($MaDoan);
            // Lưu lịch sử trạng thái


            $this->modelBooking->addLichSuTrangThai(
                $MaBooking,
                null,
                $TrangThaiHopLe,
                1,
                'Tạo booking mới'
            );
            // lưu danh sách khách


            // lưu danh sách khách

            if (!empty($_POST['khach'])) {
                foreach ($_POST['khach'] as $kh) {
                    $this->modelBooking->insertKhach([
                        'MaBooking'      => $MaBooking,
                        'HoTen'          => $kh['HoTen'] ?? '',
                        'GioiTinh'       => $kh['GioiTinh'] ?? '',
                        'NgaySinh'       => $kh['NgaySinh'] ?? null,
                        'SoGiayTo'       => $kh['GiayTo'] ?? '',
                        'SoDienThoai'    => $kh['SDT'] ?? '',
                        'GhiChuDacBiet'  => $kh['GhiChu'] ?? '',
                        'LoaiPhong'      => $kh['LoaiPhong'] ?? 'don',
                    ]);
                }
            }

            header("Location: index.php?act=listBooking");
            exit();
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
            $khachDaiDien = $this->khachHangModel->getKhachHangById($booking['MaKhachHang']);
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

            $SoTienConLai = $TongTien - $SoTienDaCoc;


            $YeuCauDacBiet = $_POST['YeuCauDacBiet'] ?? null;
            $TrangThai = $_POST['TrangThai'] ?? 'cho_coc';
            // VALIDATION LOGIC TRẠNG THÁI
            if ($SoTienDaCoc > 0 && $TrangThai == 'cho_coc') {
                $_SESSION['error'] = "Khách đã đặt cọc, không thể chọn trạng thái 'Chờ cọc'!";
                header("Location: index.php?act=editBooking&MaBooking=" . $MaBooking);
                exit();
            }

            if ($SoTienDaCoc ==  $TongTien && $TrangThai != 'hoan_tat') {
                $_SESSION['error'] = "Khách đã thanh toán đủ, trạng thái phải là 'Hoàn tất'!";
                header("Location: index.php?act=editBooking&MaBooking=" . $MaBooking);
                exit();
            }

            if ($SoTienDaCoc == 0 && $TrangThai == 'da_coc') {
                $_SESSION['error'] = "Chưa có tiền cọc, không thể đặt trạng thái 'Đã cọc'!";
                header("Location: index.php?act=editBooking&MaBooking=" . $MaBooking);
                exit();
            }


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
                ':SoTienConLai' => $SoTienConLai,
                ':YeuCauDacBiet' => $YeuCauDacBiet,
                ':TrangThai' => $TrangThai,
            ];
            // var_dump($data);
            // die();
            // Chuẩn hóa các giá trị số: nếu trống thì về 0
            foreach (['TongTien', 'SoTienDaCoc', 'SoTienConLai'] as $field) {
                if ($data[":$field"] === '' || $data[":$field"] === null) {
                    $data[":$field"] = 0;
                }
            }

            $this->modelBooking->updateBooking($data);
            // lấy dữ liệu mới sau khi update
            $newBooking = $this->modelBooking->getOneBooking($MaBooking);

            // chuyển thành JSON để lưu
            $TrangThaiCu = json_encode($oldBooking, JSON_UNESCAPED_UNICODE);
            $TrangThaiMoi = json_encode($newBooking, JSON_UNESCAPED_UNICODE);

            // người sửa
            $MaNguoiDoi = $_SESSION['user']['MaNhanVien'] ?? null;

            // lưu lịch sử
            $this->modelBooking->addLichSuFull($MaBooking, $TrangThaiCu, $TrangThaiMoi, $MaNguoiDoi);
            if ($TrangThaiCu != $TrangThai) {

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $MaNguoiDoi = $_SESSION['user']['MaNhanVien'] ?? null;

                $this->modelBooking->addLichSuTrangThai(
                    $MaBooking,
                    $TrangThaiCu,
                    $TrangThai,
                    $MaNguoiDoi,
                    null
                );
            }

            $khachUpdate = [
                ':MaKhachHang' => $MaKhachHang,
                ':HoTen'       => $_POST['KH_HoTen'],
                ':SoDienThoai' => $_POST['KH_SDT'],
                ':Email'       => $_POST['KH_Email'] ?? null,
                ':DiaChi'      => $_POST['KH_DiaChi'] ?? null,
                ':NgaySinh'    => $_POST['KH_NgaySinh'] ?? null,
                ':GioiTinh'    => $_POST['KH_GioiTinh'] ?? 'khac',
                ':SoGiayTo'    => $_POST['KH_SoGiayTo'] ?? null,
                ':LoaiKhach'   => $_POST['LoaiKhach'] ?? 'ca_nhan',
                ':TenCongTy'   => $_POST['KH_TenCongTy'] ?? null,
                ':MaSoThue'    => $_POST['KH_MaSoThue'] ?? null,
                ':GhiChu'      => $_POST['KH_GhiChu'] ?? null
            ];

            $this->khachHangModel->updateKhachHang($khachUpdate);


            header("Location: index.php?act=listBooking");
            exit();
        }
    }



    // Khách trong Booking
    public function khachTrongBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;
        if (!$MaBooking) {
            header("Location: index.php?act=listBooking");
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


    // Lấy khách hàng cùng 1 đoàn  gộp vào cùng nhau 

    public function listKhachTrongDoan()
    {
        $MaDoan = $_GET['MaDoan'] ?? null;

        if (!$MaDoan) {
            header("Location:index.php?act=listDKH");
            exit;
        }

        $doan = $this->doanKhoiHanh->getDoanById($MaDoan);
        $tour = $this->doanKhoiHanh->getTourById($doan['MaTour']);

        $listKhach = $this->modelBooking->getKhachTheoDoan($MaDoan);

        require "./views/Admin/Doan/listKhachTrongTour.php";
    }



    // Lịch sử Booking
    public function lichSuBooking()
    {
        $MaBooking = $_GET['MaBooking'] ?? null;

        if (!$MaBooking) {
            header("Location: index.php?act=listBooking");
            exit();
        }

        // Lấy thông tin booking
        $booking = $this->modelBooking->getBookingById($MaBooking);

        // Lấy lịch sử trạng thái
        $histories = $this->modelBooking->getLichSuTrangThaiByBooking($MaBooking);

        require_once "./views/Admin/booking/lichSuBooking.php";
    }
}

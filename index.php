<?php
session_start();
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/tourController.php';
require_once './controllers/nhanVienController.php';
require_once './controllers/khachHangController.php';
require_once './controllers/bookingController.php';
require_once './controllers/nhaCungCapController.php';
require_once './controllers/lichLamViecController.php';
require_once './controllers/doanKhoiHanhController.php';
require_once './controllers/TaiKhoanController.php';

require_once './controllers/DanhSachTaiKhoanController.php';

require_once './controllers/DiemDanhController.php';



// Require toàn bộ file Models
require_once './models/tourModel.php';
require_once './models/nhanVienModel.php';
require_once './models/bookingModel.php';
require_once './models/nhaCungCapModel.php';
require_once './models/lichLamViecModel.php';
require_once './models/khachHangModel.php';
require_once './models/doanKhoiHanhModel.php';
require_once './models/TaiKhoanModel.php';

require_once './models/DanhSachTaiKhoanModel.php';

require_once './models/DiemDanhModel.php';



// Route
$act = $_GET['act'] ?? 'login';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Login, Logout, addTaiKhoan
    'login'     => (new TaiKhoanController())->login(),
    'logout'    => (new TaiKhoanController())->logout(),
    'addTaiKhoan'     => (new TaiKhoanController())->formAddTaiKhoan(),
    'postAddTaiKhoan' => (new TaiKhoanController())->postAddTaiKhoan(),

    // ADMIN DASHBOARD 
    'admin_dashboard' => (function () {
        checkAuth('admin');
        require_once './views/trangChu.php';
    })(),

    //HDV DASHBOARD 
    'hdv_dashboard' => (function () {
        checkAuth('huong_dan_vien');
        require_once './views/HDV/trangChuHDV.php';
    })(),
    // đăng nhập
    '/', 'home' => (new tourController())->Home(),

    // Danh mục
    'listdm' => (new tourController())->getCategoryAll(),
    'deleteDanhMuc' => (new tourController())->deleteDanhMuc(),
    'creatDanhMuc' => (new tourController())->creatDanhMuc(),
    'editDanhMuc' => (new tourController())->editDanhMuc(),


    // Quản lí tour
    'listTour'        => (new tourController())->getAllTour(),
    'createTourForm'  => (new tourController())->createTourForm(),
    'createTour'      => (new tourController())->createTour(),
    'editTour'        => (new tourController())->editTourForm(),
    'updateTour'      => (new tourController())->updateTour(),
    'deleteTour'      => (new tourController())->deleteTour(),
    'chiTietTour'   => (new tourController())->detailTour(),
    'cloneTour' => (new tourController())->cloneTour(),
    'cloneTourSave' => (new tourController())->cloneTourSave(),

    // Nhân viên
    'listNV', 'nhanvien' => (new nhanVienController())->listNV(),
    'creatNV' => (new nhanVienController())->creatNV(),
    'editNV' => (new nhanVienController())->editNV(),
    'deleteNV' => (new nhanVienController())->deleteNV(),
    'updateNV' => (new nhanVienController())->updateNV(),
    'searchNV' => (new nhanVienController())->getSearchNV(),
    'chitietNV' => (new nhanVienController())->chiTietNV(),

    // lịch làm việc
    'lichlamviec' => (new lichLamViecController())->lichLamViec(),
    'addLich'        => (new lichLamViecController())->addForm(),
    'submitAddLich'  => (new lichLamViecController())->add(),
    'editLich'       => (new lichLamViecController())->editForm(),
    'submitEditLich' => (new lichLamViecController())->edit(),
    'deleteLichLamViec' => (new lichLamViecController())->delete(),

    // Quản lí tour

    // default => (new tourController())->Home(),

    // Khách Hàng
    'listKH'  => (new khachHangController())->listKH(),
    'deleteKH' => (new khachHangController())->deleteKH(),
    'creatKH'  => (new khachHangController())->creatKH(),
    'editKH' => (new khachHangController())->editKH(),
    'updateKH' => (new khachHangController())->updateKH(),





    // booking
    'listBooking' => (new bookingController)->listBookingAll(),
    'deleteBooking' => (new bookingController)->deleteBooking(),
    'createBooking' => (new bookingController)->createBooking(),
    'createBookingProcess' => (new BookingController())->createBookingProcess(),
    'editBooking'  => (new bookingController)->editBooking(),
    'editBookingProcess' => (new BookingController())->editBookingProcess(),

    // khách trong booking  
    'khachTrongBooking' => (new bookingController)->khachTrongBooking(),
    'deleteKhachTrongBooking' => (new bookingController)->deleteKhachTrongBooking(),
    'createKhachTrongBooking' => (new bookingController)->createKhachTrongBooking(),
    'createKhachTrongBookingProcess' => (new bookingController)->createKhachTrongBookingProcess(),
    'editKhachTrongBooking' => (new bookingController)->editKhachTrongBooking(),
    'updateKhachTrongBooking' => (new bookingController)->updateKhachTrongBooking(),
    'listKhachTrongTour' => (new bookingController)->listKhachTrongTour(),



    // Quản lí nhà cung cấp
    'listNCC'       => (new nhaCungCapController())->listNCC(),
    'listNCCByCategory' => (new nhaCungCapController())->listNCCByCategory(),
    'addNCC'        => (new nhaCungCapController())->showFormThemNCC(), 
    'submitAddNCC'  => (new nhaCungCapController())->addNCC(),        
    'editNCC'       => (new nhaCungCapController())->showFormSuaNCC(),  
    'submitEditNCC' => (new nhaCungCapController())->updateNCC(),     
    'deleteNCC'     => (new nhaCungCapController())->deleteNCC(),      
    'detailNCC'     => (new nhaCungCapController())->showDetailNCC(), 


    // Quản lý tài khoản (danh sách mới)
    'listTaiKhoan'      => (new DanhSachTaiKhoanController())->listTaiKhoan(),
    'editTaiKhoan'      => (new DanhSachTaiKhoanController())->formEditTaiKhoan(),
    'postEditTaiKhoan'  => (new DanhSachTaiKhoanController())->postEditTaiKhoan(),
    'deleteTaiKhoan'    => (new DanhSachTaiKhoanController())->deleteTaiKhoan(),


    // Đoàn khởi hành
    'listDKH'  => (new doanKhoiHanhController())->listDKH(),
    'createDKH' => (new doanKhoiHanhController())->createDKH(),
    'deleteDKH' => (new doanKhoiHanhController())->deleteDKH(),
    'editDKH' => (new doanKhoiHanhController())->editDKH(),
    'updateDKH' => (new doanKhoiHanhController())->updateDKH(),
    'chiTietDKH' => (new doanKhoiHanhController())->chiTietDKH(),
    'getDoanByTour' => (new doanKhoiHanhController())->getDoanByTour(),
    'taichinh' => (new doanKhoiHanhController())->taichinh(),
    'addtaichinh' => (new doanKhoiHanhController())->addTaiChinh(),
    'deleteTC' => (new doanKhoiHanhController())->deleteTaiChinh(),
    'editTC' => (new doanKhoiHanhController())->editTaiChinh(),
    'updateTC' => (new doanKhoiHanhController())->updateTaiChinh(),

    default => header("Location: index.php?act=login"),

    // HDV xem lịch trình & Lịch làm việc
    'hdv_schedule' => (new lichLamViecController())->mySchedule(),
    'hdv_schedule_detail' => (new lichLamViecController())->getLichTrinhByTour(),

    // --- QUẢN LÝ ĐIỂM DANH
    'hdv_quanlykhach'     => (new DiemDanhController())->index(),
    'hdv_submit_diemdanh' => (new DiemDanhController())->store(),

    // view dsk
    'hdv_guest_list' => (new DiemDanhController())->viewGuestList(),
};

function checkAuth($roleRequired)
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?act=login");
        exit();
    }

    $currentRole = $_SESSION['user']['VaiTro'];

    if ($roleRequired == 'admin' && $currentRole !== 'admin') {
        echo "<script>alert('Bạn không có quyền truy cập trang Admin!'); window.location.href='index.php?act=login';</script>";
        exit();
    }

    if ($roleRequired == 'huong_dan_vien' && $currentRole !== 'huong_dan_vien') {
        echo "<script>alert('Đây là trang dành cho HDV!'); window.location.href='index.php?act=login';</script>";
        exit();
    }
}

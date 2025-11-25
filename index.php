<?php
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



// Require toàn bộ file Models
require_once './models/tourModel.php';
require_once './models/nhanVienModel.php';
require_once './models/bookingModel.php';
require_once './models/nhaCungCapModel.php';
require_once './models/lichLamViecModel.php';
require_once './models/khachHangModel.php';
require_once './models/doanKhoiHanhModel.php';



// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new tourController())->Home(),

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


    // Nhân viên
    'listNV', 'nhanvien' => (new nhanVienController())->listNV(),
    'creatNV' => (new nhanVienController())->creatNV(),
    'editNV' => (new nhanVienController())->editNV(),
    'deleteNV' => (new nhanVienController())->deleteNV(),
    'updateNV' => (new nhanVienController())->updateNV(),
    'chitietNV' => (new nhanVienController())->chiTietNV(),

    // lịch làm việc
    'lichlamviec' => (new lichLamViecController())->lichLamViec(),
    'deleteLichLamViec' => (new lichLamViecController())->delete(),

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



    // Quản lí nhà cung cấp
    'listNCC'       => (new nhaCungCapController())->listNCC(),
    'listNCCByCategory' => (new nhaCungCapController())->listNCCByCategory(),
    'addNCC'        => (new nhaCungCapController())->showFormThemNCC(),
    'submitAddNCC'  => (new nhaCungCapController())->addNCC(),
    'editNCC'       => (new nhaCungCapController())->showFormSuaNCC(),
    'submitEditNCC' => (new nhaCungCapController())->updateNCC(),
    'deleteNCC'     => (new nhaCungCapController())->deleteNCC(),
    'detailNCC'     => (new nhaCungCapController())->showDetailNCC(),

    // Đoàn khởi hành
    'listDKH'  => (new doanKhoiHanhController())->listDKH(),
};

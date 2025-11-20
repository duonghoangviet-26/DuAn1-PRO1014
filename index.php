<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/tourController.php';
require_once './controllers/nhanVienController.php';
require_once './controllers/bookingController.php';

// Require toàn bộ file Models
require_once './models/tourModel.php';
require_once './models/nhanVienModel.php';
require_once './models/bookingModel.php';


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


    // Nhân viên
    'listNV' => (new nhanVienController())->listNV(),
    'creatNV' => (new nhanVienController())->creatNV(),


    // booking
    'listBooking' => (new bookingController)->listBookingAll(),
    'createBooking' => (new bookingController)->createBooking(),
};

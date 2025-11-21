<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/tourController.php';
require_once './controllers/nhanVienController.php';
require_once './controllers/nhaCungCapController.php';

// Require toàn bộ file Models
require_once './models/tourModel.php';
require_once './models/nhanVienModel.php';
require_once './models/nhaCungCapModel.php';

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


    // Quản lí tour


    // Quản lí nhà cung cấp
    'listNCC'       => (new nhaCungCapController())->listNCC(),
    'listNCCByCategory' => (new nhaCungCapController())->listNCCByCategory(),
    'addNCC'        => (new nhaCungCapController())->showFormThemNCC(), 
    'submitAddNCC'  => (new nhaCungCapController())->addNCC(),        
    'editNCC'       => (new nhaCungCapController())->showFormSuaNCC(),  
    'submitEditNCC' => (new nhaCungCapController())->updateNCC(),     
    'deleteNCC'     => (new nhaCungCapController())->deleteNCC(),      
    'detailNCC'     => (new nhaCungCapController())->showDetailNCC(), 
};

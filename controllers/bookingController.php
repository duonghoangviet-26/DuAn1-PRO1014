<?php
class bookingController
{
    public $modelBooking;
    public $modelTour;
    public $modelNhanVien;

    public function __construct()
    {
        $this->modelBooking = new bookingModel();
        $this->modelNhanVien = new nhanVienModel();
        $this->modelTour = new tourModel();
    }

    // public function listBookingAll()
    // {
    //     try {
    //         $listBooking = $this->modelBooking->getBookingAll();
    //         require_once "./views/Admin/booking/list.php";
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
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

    public function createBooking()
    {
        $tours = $this->modelTour->getAllTours();
        $khachHangs = $this->modelTour->getAllKhachHang();
        require_once './views/Admin/booking/addBooking.php';
    }
}

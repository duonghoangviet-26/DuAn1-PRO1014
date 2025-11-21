<?php
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class bookingModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // public function getBookingAll()
    // {
    //     $sql = 'SELECT * FROM booking ORDER BY MaBooking';
    //     $stmt = $this->conn->prepare($sql);

    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }
    // Lấy tất cả booking
    public function getAllBooking($filters = [])
    {
        $sql = "SELECT b.*, 
                       t.TenTour, t.SoNgay, t.SoDem,
                       k.HoTen as TenKhachHang, k.SoDienThoai, k.Email
                FROM booking b
                LEFT JOIN tour t ON b.MaTour = t.MaTour
                LEFT JOIN khachhang k ON b.MaKhachHang = k.MaKhachHang
                WHERE 1=1";

        $params = [];

        if (!empty($filters['TrangThai']) && $filters['TrangThai'] != 'all') {
            $sql .= " AND b.TrangThai = ?";
            $params[] = $filters['TrangThai'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (b.MaCodeBooking LIKE ? OR k.HoTen LIKE ?)";
            $searchTerm = '%' . $filters['search'] . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        $sql .= " ORDER BY b.NgayTao DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy chi tiết booking
    public function getBookingById($id)
    {
        $sql = "SELECT b.*, 
                       t.TenTour, t.SoNgay, t.SoDem,
                       k.HoTen as TenKhachHang, k.SoDienThoai, k.Email
                FROM booking b
                LEFT JOIN tour t ON b.MaTour = t.MaTour
                LEFT JOIN khachhang k ON b.MaKhachHang = k.MaKhachHang
                WHERE b.MaBooking = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getStatistics()
    {
        $sql = "SELECT 
                    COUNT(*) as TongBooking,
                    SUM(CASE WHEN TrangThai = 'cho_coc' THEN 1 ELSE 0 END) as ChoCoc,
                    SUM(CASE WHEN TrangThai = 'da_coc' THEN 1 ELSE 0 END) as DaCoc,
                    SUM(CASE WHEN TrangThai = 'hoan_tat' THEN 1 ELSE 0 END) as HoanTat,
                    SUM(CASE WHEN TrangThai = 'da_huy' THEN 1 ELSE 0 END) as DaHuy
                FROM booking";

        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

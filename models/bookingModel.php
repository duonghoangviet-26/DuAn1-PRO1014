<?php
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class bookingModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

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


    public function deleteBooking($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Booking WHERE MaBooking = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function createBooking($data)
    {
        $sql = "INSERT INTO Booking (
        MaCodeBooking, MaTour, MaDoan, MaKhachHang, LoaiBooking,
        TongNguoiLon, TongTreEm, TongEmBe,
        TongTien, SoTienDaCoc, SoTienDaTra, SoTienConLai,
        TrangThai, YeuCauDacBiet, MaNguoiTao
    ) VALUES (
        :MaCodeBooking, :MaTour, :MaDoan, :MaKhachHang, :LoaiBooking,
        :TongNguoiLon, :TongTreEm, :TongEmBe,
        :TongTien, :SoTienDaCoc, :SoTienDaTra, :SoTienConLai,
        :TrangThai, :YeuCauDacBiet, :MaNguoiTao
    )";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (PDOException $e) {
            echo "<pre>";
            echo "❌ KHÔNG THỂ THÊM BOOKING\n";
            echo "Lỗi SQL: " . $e->getMessage();
            echo "\nDữ liệu truyền vào:\n";
            print_r($data);
            echo "</pre>";
            exit;
        }
        return true;
    }

    public function getOneBooking($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Booking WHERE MaBooking = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBooking($data)
    {
        $sql = "UPDATE booking SET
            MaTour = :MaTour,
            MaDoan = :MaDoan,
            MaKhachHang = :MaKhachHang,
            LoaiBooking = :LoaiBooking,
            TongNguoiLon = :TongNguoiLon,
            TongTreEm = :TongTreEm,
            TongEmBe = :TongEmBe,
            TongTien = :TongTien,
            SoTienDaCoc = :SoTienDaCoc,
            SoTienDaTra = :SoTienDaTra,
            SoTienConLai = :SoTienConLai,
            TrangThai = :TrangThai,
            YeuCauDacBiet = :YeuCauDacBiet
        WHERE MaBooking = :MaBooking";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Khách trong booking 

    public function getKhachTrongBooking($MaBooking)
    {
        $stmt = $this->conn->prepare("SELECT * FROM KhachTrongBooking WHERE MaBooking = :id");
        $stmt->execute([':id' => $MaBooking]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public  function getBookingDetailWithDoan($MaBooking)
    {
        $sql = "SELECT b.*, t.TenTour, d.NgayKhoiHanh, d.NgayVe, d.DiemTapTrung
                FROM Booking b
                LEFT JOIN Tour t ON b.MaTour = t.MaTour
                LEFT JOIN DoanKhoiHanh d ON b.MaDoan = d.MaDoan
                WHERE b.MaBooking = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $MaBooking]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteKhachTrongBooking($id)
    {
        $sql = "DELETE FROM KhachTrongBooking WHERE MaKhachTrongBooking = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function createKhachTrongBooking($data)
    {
        $sql = "INSERT INTO KhachTrongBooking 
                    (MaBooking, HoTen, GioiTinh, NgaySinh, SoGiayTo, SoDienThoai, GhiChuDacBiet, LoaiPhong)
                VALUES (:MaBooking, :HoTen, :GioiTinh, :NgaySinh, :SoGiayTo, :SoDienThoai, :GhiChuDacBiet, :LoaiPhong)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getKhachById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM KhachTrongBooking WHERE MaKhachTrongBooking = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateKhachTrongBooking($data)
    {
        $sql = "UPDATE KhachTrongBooking 
            SET HoTen = :HoTen,
                GioiTinh = :GioiTinh,
                NgaySinh = :NgaySinh,
                SoGiayTo = :SoGiayTo,
                SoDienThoai = :SoDienThoai,
                GhiChuDacBiet = :GhiChuDacBiet,
                LoaiPhong = :LoaiPhong
            WHERE MaKhachTrongBooking = :MaKhach";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}

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
               k.HoTen as TenKhachHang, k.SoDienThoai, k.Email,
               d.NgayKhoiHanh, d.NgayVe, d.DiemTapTrung
        FROM booking b
        LEFT JOIN tour t ON b.MaTour = t.MaTour
        LEFT JOIN khachhang k ON b.MaKhachHang = k.MaKhachHang
        LEFT JOIN doankhoihanh d ON b.MaDoan = d.MaDoan
        WHERE 1=1";

        $params = [];

        // Lọc theo trạng thái
        if (!empty($filters['TrangThai']) && $filters['TrangThai'] !== 'all') {
            $sql .= " AND b.TrangThai = ?";
            $params[] = $filters['TrangThai'];
        }

        // Tìm kiếm theo tên tour / mã booking / tên khách
        if (!empty($filters['search'])) {
            $sql .= " AND (
                b.MaCodeBooking LIKE ? 
                OR k.HoTen LIKE ?
                OR t.TenTour LIKE ?
            )";
            $searchTerm = '%' . $filters['search'] . '%';
            $params[] = $searchTerm;
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
        $sql = "SELECT b.*, t.TenTour, kh.HoTen AS TenKhachHang
            FROM Booking b
            LEFT JOIN Tour t ON b.MaTour = t.MaTour
            LEFT JOIN KhachHang kh ON b.MaKhachHang = kh.MaKhachHang
            WHERE b.MaBooking = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getKhachHangById($id)
    {
        $sql = "SELECT * FROM khachhang WHERE MaKhachHang = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
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
        $sql = "INSERT INTO booking (
        MaCodeBooking, MaTour, MaDoan, MaKhachHang, LoaiBooking,
        TongNguoiLon, TongTreEm, TongEmBe,
        TongTien, SoTienDaCoc, SoTienConLai,
        TrangThai, YeuCauDacBiet, MaNguoiTao
    ) VALUES (
        :MaCodeBooking, :MaTour, :MaDoan, :MaKhachHang, :LoaiBooking,
        :TongNguoiLon, :TongTreEm, :TongEmBe,
        :TongTien, :SoTienDaCoc,  :SoTienConLai,
        :TrangThai, :YeuCauDacBiet, :MaNguoiTao
    )";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId();
    }


    public function insertKhach($data)
    {
        $sql = "INSERT INTO khachtrongbooking 
        (MaBooking, HoTen, GioiTinh, NgaySinh, SoGiayTo, SoDienThoai, GhiChuDacBiet, LoaiPhong)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['MaBooking'],
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['SoGiayTo'],
            $data['SoDienThoai'],
            $data['GhiChuDacBiet'],
            $data['LoaiPhong'],
        ]);
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
                SoTienConLai = :SoTienConLai,
                YeuCauDacBiet = :YeuCauDacBiet,
                TrangThai = :TrangThai
            WHERE MaBooking = :MaBooking";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }


    // Khách trong booking 


    public function getKhachTrongBooking($MaBooking)
    {
        $sql = "SELECT * FROM KhachTrongBooking WHERE MaBooking = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaBooking]);
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

    // Đếm số lượng khách trong booking do người đại diện đặt booking
    public function countKhachTrongBooking($MaBooking)
    {
        $sql = "SELECT COUNT(*) AS total FROM KhachTrongBooking WHERE MaBooking = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $MaBooking]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total']; // ép kiểu int chuẩn
    }


    // truy vấn khách hàng cùng 1 đoàn 
    public function  getKhachTheoTour($MaTour)
    {
        $sql = "SELECT 
                kh.HoTen, kh.GioiTinh, kh.NgaySinh, kh.SoGiayTo, kh.SoDienThoai,
                kh.GhiChuDacBiet, kh.LoaiPhong,
                b.MaBooking, b.TrangThai, 
                t.TenTour, 
                d.NgayKhoiHanh, d.NgayVe
            FROM khachtrongbooking kh
            INNER JOIN booking b ON kh.MaBooking = b.MaBooking
            INNER JOIN tour t ON b.MaTour = t.MaTour
            LEFT JOIN doankhoihanh d ON b.MaDoan = d.MaDoan
            WHERE t.MaTour = ?
            ORDER BY d.NgayKhoiHanh, kh.HoTen ASC";

        $stm = $this->conn->prepare($sql);
        $stm->execute([$MaTour]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lịch sử booking
    public function addLichSuFull($MaBooking, $TrangThaiCu, $TrangThaiMoi, $MaNguoiDoi, $GhiChu = null)
    {
        $sql = "INSERT INTO lichsutrangthaibooking
(MaBooking, TrangThaiCu, TrangThaiMoi, MaNguoiDoi, GhiChu)
                VALUES (:MaBooking, :TrangThaiCu, :TrangThaiMoi, :MaNguoiDoi, :GhiChu)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':MaBooking'   => $MaBooking,
            ':TrangThaiCu' => $TrangThaiCu,
            ':TrangThaiMoi' => $TrangThaiMoi,
            ':MaNguoiDoi'  => $MaNguoiDoi,
            ':GhiChu'      => $GhiChu
        ]);
    }

    public function addLichSuTrangThai($MaBooking, $TrangThaiCu, $TrangThaiMoi, $MaNguoiDoi, $GhiChu = null)
    {
        $sql = "INSERT INTO lichsutrangthaibooking
            (MaBooking, TrangThaiCu, TrangThaiMoi, MaNguoiDoi, GhiChu)
            VALUES (:MaBooking, :TrangThaiCu, :TrangThaiMoi, :MaNguoiDoi, :GhiChu)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':MaBooking'   => $MaBooking,
            ':TrangThaiCu' => $TrangThaiCu,
            ':TrangThaiMoi' => $TrangThaiMoi,
            ':MaNguoiDoi'  => $MaNguoiDoi,
            ':GhiChu'      => $GhiChu
        ]);
    }


    //  LẤY LỊCH SỬ TRẠNG THÁI THEO BOOKING
    public function getLichSuTrangThaiByBooking($MaBooking)
    {
        $sql = "SELECT ls.*, nv.HoTen
            FROM lichsutrangthaibooking ls
            JOIN nhanvien nv ON nv.MaNhanVien = ls.MaNguoiDoi
            WHERE ls.MaBooking = :id
            ORDER BY ls.NgayDoi DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $MaBooking]);  // ✔ Khớp với SQL
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

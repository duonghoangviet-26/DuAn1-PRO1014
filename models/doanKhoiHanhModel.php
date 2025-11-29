<?php
class doanKhoiHanhModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả đoàn + tài xế
    public function getAllDoan()
    {
        $sql = "
            SELECT dk.*, t.TenTour,
                   nv.HoTen AS TenHDV,
                   ncc.TenLaiXe AS TenTaiXe,
                   COALESCE(dv.MaNhaCungCap, dk.MaTaiXe) AS MaTaiXeFinal
            FROM doankhoihanh dk
            JOIN tour t ON dk.MaTour = t.MaTour
            LEFT JOIN nhanvien nv ON dk.MaHuongDanVien = nv.MaNhanVien
            LEFT JOIN dichvucuadoan dv 
                ON dv.MaDoan = dk.MaDoan AND dv.LoaiDichVu = 'van_chuyen'
            LEFT JOIN nhacungcap ncc 
                ON dv.MaNhaCungCap = ncc.MaNhaCungCap
            ORDER BY dk.MaDoan ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 đoàn + tài xế
    public function getOneDoan($id)
    {
        $sql = "
            SELECT dk.*, 
                   dv.MaNhaCungCap AS MaTaiXe
            FROM doankhoihanh dk
            LEFT JOIN dichvucuadoan dv 
                ON dk.MaDoan = dv.MaDoan AND dv.LoaiDichVu='van_chuyen'
            WHERE dk.MaDoan = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy tour
    public function getAllTour()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tour");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllHDV()
    {
        $stmt = $this->conn->prepare("
            SELECT MaNhanVien, HoTen 
            FROM nhanvien 
            WHERE VaiTro='huong_dan_vien' AND TrangThai='dang_lam'
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNhaXe()
    {
        $stmt = $this->conn->prepare("
            SELECT MaNhaCungCap, TenNhaCungCap, TenLaiXe, SDTLaiXe 
            FROM nhacungcap
            WHERE LoaiNhaCungCap = 'van_chuyen'
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm đoàn
    public function insertDoan($data)
    {
        $sql = "INSERT INTO doankhoihanh
        (MaTour, NgayKhoiHanh, NgayVe, GioKhoiHanh, DiemTapTrung, 
         SoChoToiDa, SoChoConTrong, MaHuongDanVien, TrangThai)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'con_cho')";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $data['MaTour'],
            $data['NgayKhoiHanh'],
            $data['NgayVe'],
            $data['GioKhoiHanh'],
            $data['DiemTapTrung'],
            $data['SoChoToiDa'],
            $data['SoChoToiDa'], // lúc tạo đoàn chưa ai đặt
            $data['MaHuongDanVien']
        ]);

        return $this->conn->lastInsertId();
    }

    // Gán tài xế
    public function insertTaiXeChoDoan($MaDoan, $MaTaiXe, $NgaySuDung)
    {
        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=? AND LoaiDichVu='van_chuyen'")
            ->execute([$MaDoan]);

        $sql = "INSERT INTO dichvucuadoan 
            (MaDoan, MaNhaCungCap, LoaiDichVu, TenDichVu, NgaySuDung)
            VALUES (?, ?, 'van_chuyen', 'Tài xế', ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$MaDoan, $MaTaiXe, $NgaySuDung]);
    }

    // Đếm số booking của đoàn
    public function countBookingOfDoan($MaDoan)
    {
        $sql = "SELECT COUNT(*) FROM booking WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetchColumn();
    }

    // Update đoàn
    public function updateDKH($data)
    {
        // tính số chỗ còn trống
        $soBooking = $this->countBookingOfDoan($data['MaDoan']);
        $soConTrong = $data['SoChoToiDa'] - $soBooking;
        if ($soConTrong < 0) $soConTrong = 0;

        $sql = "UPDATE doankhoihanh SET 
                MaTour = ?,
                NgayKhoiHanh = ?,
                NgayVe = ?,
                GioKhoiHanh = ?,
                DiemTapTrung = ?,
                SoChoToiDa = ?,
                SoChoConTrong = ?, 
                MaHuongDanVien = ?
            WHERE MaDoan = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $data['MaTour'],
            $data['NgayKhoiHanh'],
            $data['NgayVe'],
            $data['GioKhoiHanh'],
            $data['DiemTapTrung'],
            $data['SoChoToiDa'],
            $soConTrong,
            $data['MaHuongDanVien'],
            $data['MaDoan']
        ]);

        if (!empty($data['MaTaiXe'])) {
            $this->insertTaiXeChoDoan($data['MaDoan'], $data['MaTaiXe'], $data['NgayKhoiHanh']);
        }

        return true;
    }

    public function deleteDoan($id)
    {
        $this->conn->prepare("DELETE FROM booking WHERE MaDoan=?")
            ->execute([$id]);

        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=?")
            ->execute([$id]);

        return $this->conn->prepare("DELETE FROM doankhoihanh WHERE MaDoan=?")
            ->execute([$id]);
    }

    public function getTotalBookingByDoan($MaDoan)
    {
        $sql = "SELECT 
                SUM(TongNguoiLon + TongTreEm + TongEmBe) AS total_people
            FROM booking
            WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);

        $total = $stmt->fetchColumn();
        return $total ? $total : 0;
    }

    public function getAllDKH()
    {
        $sql = "SELECT * FROM doankhoihanh";
        return $this->conn->query($sql)->fetchAll();
    }
    // public function getLichTrinhByTour($MaTour)
    // {
    //     $sql = "SELECT * FROM lichtrinh WHERE MaTour = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$MaTour]);
    //     return $stmt->fetchAll();
    // }
    public function getLichTrinhByTour($MaTour)
    {
        $sql = "SELECT * FROM lichtrinh WHERE MaTour = ? ORDER BY NgayThu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaTour]);
        return $stmt->fetchAll();
    }

    public function getNhaCungCapByType($type)
    {
        $sql = "SELECT * FROM nhacungcap WHERE LoaiNhaCungCap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }
    public function getDoanById($MaDoan)
    {
        $sql = "SELECT * FROM doankhoihanh WHERE MaDoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan]);
        return $stmt->fetch();
    }
    public function getTourById($MaTour)
    {
        $sql = "SELECT * FROM tour WHERE MaTour = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaTour]);
        return $stmt->fetch();
    }
   public function getHDVById($MaHDV)
{
    $sql = "SELECT * FROM nhanvien WHERE MaNhanVien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$MaHDV]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


   public function getTaiXeByDoan($MaDoan)
{
    $sql = "SELECT ncc.*
            FROM doankhoihanh dkh
            JOIN nhacungcap ncc ON dkh.MaTaiXe = ncc.MaNhaCungCap
            WHERE dkh.MaDoan = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$MaDoan]);
    return $stmt->fetch();    // không có dữ liệu → false
}



    public function getNCCTheoLichTrinh($MaDoan)
{
    // Lấy NCC từ bảng doankhoihanh (vì chỉ có tài xế ở đây)
    $sql = "SELECT 
                d.MaDoan,
                d.MaTaiXe AS MaNCC,
                ncc.TenNhaCungCap,
                ncc.LoaiNhaCungCap
            FROM doankhoihanh d
            JOIN nhacungcap ncc ON d.MaTaiXe = ncc.MaNhaCungCap
            WHERE d.MaDoan = ?";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$MaDoan]);
    return $stmt->fetchAll();
}
}

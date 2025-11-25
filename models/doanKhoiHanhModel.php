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


    // Các hàm lấy dữ liệu phụ
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


    // THÊM ĐOÀN — KHÔNG đưa MaTaiXe vào bảng doankhoihanh nữa
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
            $data['SoChoToiDa'],
            $data['MaHuongDanVien']
        ]);

        return $this->conn->lastInsertId();
    }


    public function insertTaiXeChoDoan($MaDoan, $MaTaiXe, $NgaySuDung)
    {
        // xóa tài xế cũ để tránh bị duplicate
        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=? AND LoaiDichVu='van_chuyen'")
            ->execute([$MaDoan]);

        // thêm tài xế mới
        $sql = "INSERT INTO dichvucuadoan 
            (MaDoan, MaNhaCungCap, LoaiDichVu, TenDichVu, NgaySuDung)
            VALUES (?, ?, 'van_chuyen', 'Tài xế', ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$MaDoan, $MaTaiXe, $NgaySuDung]);
    }


    // UPDATE ĐOÀN
    public function updateDKH($data)
    {
        $sql = "UPDATE doankhoihanh SET 
                MaTour = ?,
                NgayKhoiHanh = ?,
                NgayVe = ?,
                GioKhoiHanh = ?,
                DiemTapTrung = ?,
                SoChoToiDa = ?,
                SoChoToiDa = ?,
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
            $data['SoChoToiDa'],
            $data['MaHuongDanVien'],
            $data['MaDoan']
        ]);

        // cập nhật tài xế
        if (!empty($data['MaTaiXe'])) {
            $this->insertTaiXeChoDoan($data['MaDoan'], $data['MaTaiXe'], $data['NgayKhoiHanh']);
        }

        return true;
    }
    // XÓA ĐOÀN
    public function deleteDoan($id)
    {
        $this->conn->prepare("DELETE FROM dichvucuadoan WHERE MaDoan=?")
            ->execute([$id]);

        return $this->conn->prepare("DELETE FROM doankhoihanh WHERE MaDoan=?")
            ->execute([$id]);
    }
}

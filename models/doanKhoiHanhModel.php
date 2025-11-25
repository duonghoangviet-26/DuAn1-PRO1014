<?php
class doanKhoiHanhModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDoan()
    {
        $sql = "
        SELECT  
            dk.*,
            t.TenTour,
            nv.HoTen AS TenHDV,
            ncc.TenLaiXe AS TenTaiXe,
            ncc.TenNhaCungCap AS TenNhaXe
        FROM doankhoihanh dk
        JOIN tour t 
            ON dk.MaTour = t.MaTour

        -- HDV: nhân viên
        LEFT JOIN nhanvien nv 
            ON dk.MaHuongDanVien = nv.MaNhanVien

        -- Tài xế: lấy NCC vận chuyển của đoàn
        LEFT JOIN dichvucuadoan dv
            ON dv.MaDoan = dk.MaDoan
           AND dv.LoaiDichVu = 'van_chuyen'

        LEFT JOIN nhacungcap ncc
            ON dv.MaNhaCungCap = ncc.MaNhaCungCap

        ORDER BY dk.MaDoan DESC
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

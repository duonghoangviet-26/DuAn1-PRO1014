<?php
class nhanVienModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllNhanVien($limit, $offset)
    {
        $sql = "SELECT * FROM nhanvien 
                ORDER BY 
                CASE VaiTro 
                    WHEN 'admin' THEN 1 
                    WHEN 'huong_dan_vien' THEN 2 
                    ELSE 3 
                END ASC, 
                MaNhanVien DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhanVienById($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insertNhanVien($HoTen, $VaiTro, $SoDienThoai, $Email, $LinkAnh, 
                                   $MaCodeNhanVien, $NgaySinh, $GioiTinh, $DiaChi, 
                                   $ChungChi, $NgonNgu, $SoNamKinhNghiem, $ChuyenMon, $TrangThai)
    {
        $sql = "INSERT INTO nhanvien 
                (HoTen, VaiTro, SoDienThoai, Email, LinkAnhDaiDien, MaCodeNhanVien, NgaySinh, GioiTinh, DiaChi,
                ChungChi, NgonNgu, SoNamKinhNghiem, ChuyenMon, TrangThai)
                VALUES 
                (:HoTen, :VaiTro, :SoDienThoai, :Email, :LinkAnhDaiDien, :MaCodeNhanVien, :NgaySinh, :GioiTinh, :DiaChi,
                :ChungChi, :NgonNgu, :SoNamKinhNghiem, :ChuyenMon, :TrangThai)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':HoTen' => $HoTen,
            ':VaiTro' => $VaiTro,
            ':SoDienThoai' => $SoDienThoai,
            ':Email' => $Email,
            ':LinkAnhDaiDien' => $LinkAnh,
            ':MaCodeNhanVien' => $MaCodeNhanVien,
            ':NgaySinh' => $NgaySinh,
            ':GioiTinh' => $GioiTinh,
            ':DiaChi' => $DiaChi,
            ':ChungChi' => $ChungChi,
            ':NgonNgu' => $NgonNgu,
            ':SoNamKinhNghiem' => $SoNamKinhNghiem,
            ':ChuyenMon' => $ChuyenMon,
            ':TrangThai' => $TrangThai
        ]);
    }

    public function updateNhanVien($id, $HoTen, $VaiTro, $SoDienThoai, $Email, $LinkAnh,
                                   $TrangThai, $NgaySinh, $GioiTinh, $DiaChi, $ChungChi,
                                   $NgonNgu, $SoNamKinhNghiem, $ChuyenMon)
    {
        $sql = "UPDATE nhanvien 
                SET HoTen = :HoTen, VaiTro = :VaiTro, SoDienThoai = :SoDienThoai, Email = :Email,
                    LinkAnhDaiDien = :LinkAnh, TrangThai = :TrangThai, NgaySinh = :NgaySinh, GioiTinh = :GioiTinh,
                    DiaChi = :DiaChi, ChungChi = :ChungChi, NgonNgu = :NgonNgu, 
                    SoNamKinhNghiem = :SoNamKinhNghiem, ChuyenMon = :ChuyenMon
                WHERE MaNhanVien = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':HoTen' => $HoTen,
            ':VaiTro' => $VaiTro,
            ':SoDienThoai' => $SoDienThoai,
            ':Email' => $Email,
            ':LinkAnh' => $LinkAnh,
            ':TrangThai' => $TrangThai,
            ':NgaySinh' => $NgaySinh,
            ':GioiTinh' => $GioiTinh,
            ':DiaChi' => $DiaChi,
            ':ChungChi' => $ChungChi,
            ':NgonNgu' => $NgonNgu,
            ':SoNamKinhNghiem' => $SoNamKinhNghiem,
            ':ChuyenMon' => $ChuyenMon,
            ':id' => $id
        ]);
    }

    public function deleteNhanVien($id)
    {
        $sql = "UPDATE nhanvien SET TrangThai = 'da_nghi' WHERE MaNhanVien = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function destroyNhanVien($id)
    {
        $sql = "DELETE FROM nhanvien WHERE MaNhanVien = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    public function getSearchNV($date)
    {
        $sql = "SELECT * FROM nhanvien 
                WHERE TrangThai = 'dang_lam' 
                AND VaiTro != 'admin' 
                AND MaNhanVien NOT IN (
                    SELECT MaNhanVien 
                    FROM lichlamviec 
                    WHERE NgayLamViec = :date 
                    AND TrangThai = 'ban'
                )";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllNhanVien()
    {
        $sql = "SELECT COUNT(*) as total FROM nhanvien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}

<?php
class nhanVienModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllNhanVien()
    {
        $sql = "SELECT * FROM   nhanvien  ORDER BY MaNhanVien DESC";

        $stmt = $this->conn->prepare($sql);
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
    public function insertNhanVien($HoTen, $VaiTro, $SoDienThoai, $Email, $LinkAnh, $MaCodeNhanVien, $NgaySinh, $GioiTinh, $DiaChi, $ChungChi, $NgonNgu, $SoNamKinhNghiem, $ChuyenMon, $TrangThai)
    {
        $sql = "INSERT INTO nhanvien (HoTen, VaiTro, SoDienThoai, Email, LinkAnhDaiDien, MaCodeNhanVien, NgaySinh, GioiTinh, DiaChi, ChungChi, NgonNgu, SoNamKinhNghiem, ChuyenMon, TrangThai)
                VALUES (:HoTen, :VaiTro, :SoDienThoai, :Email, :LinkAnhDaiDien, :MaCodeNhanVien, :NgaySinh, :GioiTinh, :DiaChi, :ChungChi, :NgonNgu, :SoNamKinhNghiem, :ChuyenMon, :TrangThai)";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
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

    public function updateNhanVien($id, $HoTen, $VaiTro, $SoDienThoai, $Email, $LinkAnh, $TrangThai, $NgaySinh, $GioiTinh, $DiaChi, $ChungChi, $NgonNgu, $SoNamKinhNghiem, $ChuyenMon)
    {
        $sql = "UPDATE nhanvien 
                SET HoTen = :HoTen, VaiTro = :VaiTro, SoDienThoai = :SoDienThoai, Email = :Email, 
                    LinkAnhDaiDien = :LinkAnh, TrangThai = :TrangThai, NgaySinh = :NgaySinh, GioiTinh = :GioiTinh, DiaChi = :DiaChi,
                    ChungChi = :ChungChi, NgonNgu = :NgonNgu, SoNamKinhNghiem = :SoNamKinhNghiem, ChuyenMon = :ChuyenMon
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

}
